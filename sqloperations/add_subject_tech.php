<?php
require_once __DIR__ . '/../includes/auth.php';
api_begin();
$ur = require_login_api('hod');

$teacher_id = post_id('teacher_id');
$subject_id = post_id('subject_id');

$subject = db_row(
	'SELECT id FROM subject WHERE id = ? AND department_id = ? AND teacher_id = 0',
	array($subject_id, $ur['department_id'])
);
if ($subject === null) {
	json_fail('This subject already has a teacher.');
}
$teacher = db_row(
	'SELECT id FROM teacher_reg WHERE id = ? AND department_id = ?',
	array($teacher_id, $ur['department_id'])
);
if ($teacher === null) {
	json_fail('Please select a teacher to be assigned.');
}

db_query('UPDATE subject SET teacher_id = ? WHERE id = ?', array($teacher['id'], $subject['id']));
json_out(true);
