<?php
require_once __DIR__ . '/../includes/auth.php';
api_begin();
$ur = require_login_api('hod');

$name = post('name');
$code = post('code');
$type = post('type');
$year = post('year');

if ($name === '' || strlen($name) > 100) {
	json_fail('Please enter the subject name (up to 100 characters).');
}
if ($code === '' || strlen($code) > 20) {
	json_fail('Please enter the subject code (up to 20 characters).');
}
if (!in_array($type, array('0', '1'), true)) {
	json_fail('Please select the subject type.');
}
if (!in_array($year, array('1', '2', '3'), true)) {
	json_fail('Please select a year.');
}
if (db_value('SELECT COUNT(*) FROM subject WHERE department_id = ? AND code = ?', array($ur['department_id'], $code)) > 0) {
	json_fail('A subject with this code already exists in your department.');
}

db_query(
	'INSERT INTO subject(code, name, type, department_id, teacher_id, year) VALUES(?, ?, ?, ?, 0, ?)',
	array($code, $name, $type, $ur['department_id'], $year)
);
json_out(true);
