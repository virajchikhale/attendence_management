<?php
require_once __DIR__ . '/../includes/otp.php';
api_begin();

$fname = post('fname');
$lname = post('lname');
$email = post('email');
$phoneno = post('phoneno');
$password = isset($_POST['password']) && is_string($_POST['password']) ? $_POST['password'] : '';
$report_to = post('report_to');
$department = post('department');
$table = post('table');
$role = role_for_table($table);

if ($role === null) {
	json_fail('Something went wrong...');
}
if ($fname === '' || $lname === '') {
	json_fail('Please enter your first and last name.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	json_fail('Please enter a valid email address.');
}
if (!preg_match('/^\+?[0-9]{10,15}$/', $phoneno)) {
	json_fail('Please enter a valid phone number.');
}
if (strlen($password) < 8) {
	json_fail('Password must be at least 8 characters.');
}
if (otp_verified('reg', $table, $email) === null) {
	json_fail('Please verify the OTP sent to your email first.');
}
if (db_value("SELECT COUNT(*) FROM $table WHERE email = ?", array($email)) > 0) {
	json_fail('This Email already exist in system');
}

$hash = password_hash($password, PASSWORD_DEFAULT);

if ($table == "teacher_reg") {
	if (db_row('SELECT id FROM department WHERE id = ?', array($department)) === null) {
		json_fail('Please select your department.');
	}
	$x = db_row('SELECT id FROM hod_reg WHERE department_id = ?', array($department));
	db_query(
		'INSERT INTO teacher_reg(first_name, last_name, email, phone, password, report_to, department_id, status) VALUES(?, ?, ?, ?, ?, ?, ?, 0)',
		array($fname, $lname, $email, $phoneno, $hash, $x === null ? '' : $x['id'], $department)
	);
} else if ($table == "principal_reg") {
	if (db_value('SELECT COUNT(*) FROM details WHERE principal_verification = ?', array(post('code'))) == 0) {
		json_fail('Please enter vaild Admin code.');
	}
	db_query(
		'INSERT INTO principal_reg(first_name, last_name, email, phone, password) VALUES(?, ?, ?, ?, ?)',
		array($fname, $lname, $email, $phoneno, $hash)
	);
} else if ($table == "hod_reg") {
	if (db_row("SELECT id FROM department WHERE id = ? AND status = '0'", array($department)) === null) {
		json_fail('Please select a department that has no HOD yet.');
	}
	if (db_row('SELECT id FROM principal_reg WHERE id = ?', array($report_to)) === null) {
		json_fail('Please select whom you report to.');
	}
	$con->beginTransaction();
	db_query("UPDATE department SET status = '1' WHERE id = ?", array($department));
	db_query(
		'INSERT INTO hod_reg(first_name, last_name, email, phone, password, report_to, department_id) VALUES(?, ?, ?, ?, ?, ?, ?)',
		array($fname, $lname, $email, $phoneno, $hash, $report_to, $department)
	);
	$con->commit();
}

otp_clear();
send_welcome_mail($email, $role);
json_out(true);
