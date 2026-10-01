<?php
require_once __DIR__ . '/../includes/auth.php';
api_begin();
$ur = require_login_api('teacher');

$type = post('type');

if ($type == "fill") {
	// Opens the attendance sheet for one lecture and returns its id.
	$date = post('date');
	$time = post('time');
	$subject = db_row('SELECT id FROM subject WHERE id = ? AND teacher_id = ?', array(post('subject'), $ur['id']));

	if ($subject === null) {
		json_fail('Please select one of your subjects.');
	}
	if (!is_valid_date($date) || !preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9]$/', $time)) {
		json_fail('Please select a valid date and time.');
	}

	$id = db_value(
		'SELECT id FROM attendence WHERE date = ? AND time = ? AND subject = ? ORDER BY id LIMIT 1',
		array($date, $time . ':00', $subject['id'])
	);
	if ($id === null) {
		db_query('INSERT INTO attendence(date, time, subject) VALUES(?, ?, ?)', array($date, $time . ':00', $subject['id']));
		$id = $con->lastInsertId();
	}
	json_out(true, array('id' => (int) $id));
} else if ($type == "attn") {
	// Marks one student present (1) or absent (0) on an open sheet.
	$enroll = post('roll');
	$value = post('value');

	if (!in_array($value, array('0', '1'), true) || !is_valid_enroll($enroll)) {
		json_fail('Something went wrong...');
	}
	$sheet = db_row(
		'SELECT a.id, s.department_id, s.year FROM attendence a JOIN subject s ON s.id = a.subject
		 WHERE a.id = ? AND s.teacher_id = ?',
		array(post('id'), $ur['id'])
	);
	if ($sheet === null) {
		json_fail('This attendence sheet was not found. Please start again.');
	}
	$in_class = db_value(
		'SELECT COUNT(*) FROM student s JOIN class c ON c.id = s.class_id
		 WHERE s.enroll = ? AND c.department_id = ? AND c.year = ?',
		array($enroll, $sheet['department_id'], $sheet['year'])
	);
	if ($in_class == 0 || !attendance_column_exists($enroll)) {
		json_fail('This student is not in the class.');
	}

	db_query('UPDATE attendence SET `' . attendance_column($enroll) . '` = ? WHERE id = ?', array($value, $sheet['id']));
	json_out(true);
}

json_fail('Something went wrong...');
