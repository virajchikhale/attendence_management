<?php
require_once __DIR__ . '/../includes/auth.php';
api_begin();

$mob = post('phone');
$table = post('table');

if ($table == "student") {
	require_login_api('teacher');
} else if (role_for_table($table) === null) {
	json_fail('Something went wrong...');
}

if (db_value("SELECT COUNT(*) FROM $table WHERE phone = ?", array($mob)) > 0) {
	json_fail('This Number already exist in system');
}
json_out(true);
