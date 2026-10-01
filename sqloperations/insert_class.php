<?php
require_once __DIR__ . '/../includes/auth.php';
api_begin();
$ur = require_login_api('hod');

$year = post('year');

if (!in_array($year, array('1', '2', '3'), true)) {
	json_fail('Please select a year.');
}
if (db_value('SELECT COUNT(*) FROM class WHERE department_id = ? AND year = ?', array($ur['department_id'], $year)) > 0) {
	json_fail(year_label($year) . ' class already exists in your department.');
}

db_query(
	"INSERT INTO class(year, divi, department_id, teacher_id) VALUES(?, 'A', ?, 0)",
	array($year, $ur['department_id'])
);
json_out(true);
