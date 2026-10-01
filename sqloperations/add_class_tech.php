<?php
require_once __DIR__ . '/../includes/auth.php';
api_begin();
$ur = require_login_api('hod');

$teacher_id = post_id('teacher_id');
$class_id = post_id('class_id');

$class = db_row(
	'SELECT id FROM class WHERE id = ? AND department_id = ? AND teacher_id = 0',
	array($class_id, $ur['department_id'])
);
if ($class === null) {
	json_fail('This class already has a class teacher.');
}
$teacher = db_row(
	'SELECT id FROM teacher_reg WHERE id = ? AND department_id = ? AND status = 0',
	array($teacher_id, $ur['department_id'])
);
if ($teacher === null) {
	json_fail('Please select a teacher to be assigned.');
}

$con->beginTransaction();
db_query('UPDATE class SET teacher_id = ? WHERE id = ?', array($teacher['id'], $class['id']));
db_query('UPDATE teacher_reg SET status = 1 WHERE id = ?', array($teacher['id']));
$con->commit();
json_out(true);
