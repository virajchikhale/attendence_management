<?php
require_once __DIR__ . '/../includes/auth.php';
api_begin();
require_login_api('principal');

$dept = post('dept');

if ($dept === '' || strlen($dept) > 100) {
	json_fail('Please enter a department name (up to 100 characters).');
}
if (db_value('SELECT COUNT(*) FROM department WHERE LOWER(name) = LOWER(?)', array($dept)) > 0) {
	json_fail('This department already exists.');
}

db_query("INSERT INTO department(name, status) VALUES(?, '0')", array($dept));
json_out(true);
