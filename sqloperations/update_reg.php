<?php
require_once __DIR__ . '/../includes/otp.php';
api_begin();

$password = isset($_POST['password']) && is_string($_POST['password']) ? $_POST['password'] : '';

// The account being reset is the one whose OTP was verified, not whatever the browser sends.
$otp = otp_verified('forgot');
if ($otp === null || role_for_table($otp['table']) === null) {
	json_fail('Please verify the OTP sent to your email first.');
}
if (strlen($password) < 8) {
	json_fail('Password must be at least 8 characters.');
}

db_query(
	'UPDATE ' . $otp['table'] . ' SET password = ? WHERE email = ?',
	array(password_hash($password, PASSWORD_DEFAULT), $otp['email'])
);

otp_clear();
send_password_changed_mail($otp['email'], role_for_table($otp['table']));
json_out(true);
