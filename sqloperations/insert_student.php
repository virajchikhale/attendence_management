<?php
require_once __DIR__ . '/../includes/auth.php';
api_begin();
$ur = require_login_api('teacher');

$name = post('name');
$roll = post('roll');
$enroll = post('enroll');
$email = post('email');
$phone = post('phone');

$bb = db_row('SELECT * FROM class WHERE teacher_id = ? ORDER BY id LIMIT 1', array($ur['id']));
if ($bb === null) {
	json_fail('Only a class teacher can add students.');
}
if ($roll === '' || strlen($roll) > 10) {
	json_fail('Please enter the roll number (up to 10 characters).');
}
if (!is_valid_enroll($enroll)) {
	json_fail('Enrollment number must be 1 to 10 letters or digits.');
}
if ($name === '' || strlen($name) > 100) {
	json_fail('Please enter the name of the student (up to 100 characters).');
}
if (!preg_match('/^[0-9]{10}$/', $phone)) {
	json_fail('Please enter a 10 digit phone number.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 100) {
	json_fail('Please enter a valid email address.');
}
// The enrollment number names the student's attendance column, so it must be unique everywhere.
if (db_value('SELECT COUNT(*) FROM student WHERE enroll = ?', array($enroll)) > 0) {
	json_fail('This enrollment number already exists in system');
}
if (db_value('SELECT COUNT(*) FROM student WHERE class_id = ? AND roll = ?', array($bb['id'], $roll)) > 0) {
	json_fail('This roll number already exists in your class');
}

if (!attendance_column_exists($enroll)) {
	db_query('ALTER TABLE attendence ADD `' . attendance_column($enroll) . "` int(11) NOT NULL DEFAULT '-1'");
}
db_query(
	'INSERT INTO student(roll, enroll, name, phone, email, class_id) VALUES(?, ?, ?, ?, ?, ?)',
	array($roll, $enroll, $name, $phone, $email, $bb['id'])
);
json_out(true);
