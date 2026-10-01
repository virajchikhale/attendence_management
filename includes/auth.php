<?php
// Session, login guards and request helpers shared by every page and AJAX handler.

require_once __DIR__ . '/connection.php';

// Account table for each role that can sign in.
function role_tables()
{
	return array(
		'principal' => 'principal_reg',
		'hod' => 'hod_reg',
		'teacher' => 'teacher_reg',
	);
}

// Maps a table name sent by the browser back to its role, or null if it is not an account table.
function role_for_table($table)
{
	$role = array_search($table, role_tables(), true);
	return $role === false ? null : $role;
}

function role_label($role)
{
	$labels = array('principal' => 'Principal', 'hod' => 'HOD', 'teacher' => 'Teacher');
	return isset($labels[$role]) ? $labels[$role] : '';
}

function year_label($year)
{
	$labels = array(1 => 'First Year', 2 => 'Second Year', 3 => 'Third Year');
	return isset($labels[(int) $year]) ? $labels[(int) $year] : 'Year ' . (int) $year;
}

function start_app_session()
{
	if (session_status() === PHP_SESSION_ACTIVE) {
		return;
	}
	session_set_cookie_params(array(
		'lifetime' => 0,
		'path' => '/',
		'httponly' => true,
		'samesite' => 'Lax',
	));
	session_start();
}

// Trimmed POST value ('' when missing).
function post($key)
{
	return isset($_POST[$key]) && is_string($_POST[$key]) ? trim($_POST[$key]) : '';
}

function json_out($ok, array $extra = array())
{
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode(array('ok' => (bool) $ok) + $extra);
	exit;
}

function json_fail($message, $status = 200)
{
	http_response_code($status);
	json_out(false, array('message' => $message));
}

// First call in every AJAX handler: POST only, and unexpected errors become a JSON failure.
function api_begin()
{
	set_exception_handler(function ($ex) {
		error_log('Request failed: ' . $ex->getMessage());
		if (!headers_sent()) {
			http_response_code(500);
			header('Content-Type: application/json; charset=utf-8');
		}
		echo json_encode(array('ok' => false, 'message' => 'Something went wrong...'));
	});
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		json_fail('Method not allowed.', 405);
	}
	start_app_session();
}

// The signed-in account row for the given role, or null.
function current_user($role)
{
	start_app_session();
	$tables = role_tables();
	if (!isset($tables[$role]) || empty($_SESSION['user']) || empty($_SESSION['role']) || $_SESSION['role'] !== $role) {
		return null;
	}
	return db_row('SELECT * FROM ' . $tables[$role] . ' WHERE email = ?', array($_SESSION['user']));
}

// Guard for pages: sends visitors who are not signed in with this role to its login page.
function require_login($role)
{
	$user = current_user($role);
	if ($user === null) {
		header('Location: ../login/' . $role . '_login.php');
		exit;
	}
	return $user;
}

// Guard for AJAX handlers.
function require_login_api($role)
{
	$user = current_user($role);
	if ($user === null) {
		json_fail('Your session has expired. Please log in again.', 401);
	}
	return $user;
}

function is_valid_date($value)
{
	$date = DateTime::createFromFormat('!Y-m-d', $value);
	return $date !== false && $date->format('Y-m-d') === $value;
}

// Attendance is stored in one column per student, named after the enrollment number.
// Enrollment numbers are therefore limited to characters that are safe in a column name.
function is_valid_enroll($value)
{
	return (bool) preg_match('/^[A-Za-z0-9]{1,10}$/', $value);
}

function attendance_column($enroll)
{
	return 'S_' . $enroll;
}

function attendance_column_exists($enroll)
{
	return db_value(
		"SELECT COUNT(*) FROM information_schema.COLUMNS
		 WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'attendence' AND COLUMN_NAME = ?",
		array(attendance_column($enroll))
	) > 0;
}

// Students a subject is taught to: everyone in that year of the department
// (older data can have more than one class, i.e. division, per year).
function students_for($department_id, $year)
{
	return db_all(
		'SELECT s.* FROM student s JOIN class c ON c.id = s.class_id
		 WHERE c.department_id = ? AND c.year = ? ORDER BY c.id, s.id',
		array($department_id, $year)
	);
}

// One-off message shown on the next page load (after a redirect).
function flash_set($message, $type = 'success')
{
	start_app_session();
	$_SESSION['flash'] = array('message' => $message, 'type' => $type);
}

function flash_take()
{
	start_app_session();
	$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
	unset($_SESSION['flash']);
	return $flash;
}

// JSON safe to print inside a <script> block.
function js_value($value)
{
	return json_encode($value, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}
