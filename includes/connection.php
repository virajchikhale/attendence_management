<?php
// Database connection + small query helpers.
// PostgreSQL through PDO. Settings come from environment variables (see .env.example)
// and fall back to a local PostgreSQL with its default port and "postgres" user.

if (!function_exists('env')) {
	function env($key, $default = null)
	{
		$value = getenv($key);
		return ($value === false || $value === '') ? $default : $value;
	}
}

date_default_timezone_set(env('APP_TIMEZONE', 'Asia/Kolkata'));

try {
	$con = new PDO(
		sprintf(
			"pgsql:host=%s;port=%s;dbname=%s;options='--client_encoding=UTF8'",
			env('DB_HOST', 'localhost'),
			env('DB_PORT', '5432'),
			env('DB_NAME', 'student_management')
		),
		env('DB_USER', 'postgres'),
		env('DB_PASSWORD', ''),
		array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false,
		)
	);
} catch (PDOException $ex) {
	error_log('Database connection failed: ' . $ex->getMessage());
	http_response_code(503);
	exit('The application could not connect to its database. Please try again in a moment.');
}

// Runs a parameterised query and returns the statement.
function db_query($sql, array $params = array())
{
	global $con;
	$stmt = $con->prepare($sql);
	$stmt->execute($params);
	return $stmt;
}

// First row of the result, or null when there is none.
function db_row($sql, array $params = array())
{
	$row = db_query($sql, $params)->fetch();
	return $row === false ? null : $row;
}

function db_all($sql, array $params = array())
{
	return db_query($sql, $params)->fetchAll();
}

// First column of the first row, or null when there is none.
function db_value($sql, array $params = array())
{
	$value = db_query($sql, $params)->fetchColumn();
	return $value === false ? null : $value;
}

// Escapes a value for output inside HTML.
function e($value)
{
	return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
