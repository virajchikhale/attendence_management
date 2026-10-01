<?php
require_once __DIR__ . '/../includes/otp.php';
api_begin();

$email = post('email');
$table = post('table');
$type = post('type');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	json_fail('Please enter a valid email address.');
}

// Students have no login, so this is only a duplicate check for the class teacher.
if ($table == "student") {
	require_login_api('teacher');
	if (db_value('SELECT COUNT(*) FROM student WHERE email = ?', array($email)) > 0) {
		json_fail('This Email already exist in system');
	}
	json_out(true);
}

if (role_for_table($table) === null) {
	json_fail('Something went wrong...');
}
$cnt = db_value("SELECT COUNT(*) FROM $table WHERE email = ?", array($email));

if ($type == "reg" || $type == "check") {
	if ($cnt > 0) {
		json_fail('This Email already exist in system');
	}
	// "check" only looks for a duplicate; no OTP is sent.
	if ($type == "check") {
		json_out(true);
	}
} else if ($type == "forgot") {
	if ($cnt == 0) {
		json_fail('This Email does not exist in system');
	}
} else {
	json_fail('Something went wrong...');
}

if (!otp_start($email, $table, $type)) {
	json_fail('We could not send the OTP email. Please try again later.');
}
json_out(true);
