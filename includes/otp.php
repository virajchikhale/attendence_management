<?php
// Email OTP used by registration and password reset.
// The code is kept in the session and checked on the server; it is never sent to the browser.

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../email/mailer.php';

const OTP_LIFETIME_SECONDS = 600;
const OTP_MAX_ATTEMPTS = 5;

// Generates a code for this email/table/purpose and emails it. Returns false if the mail could not be sent.
function otp_start($email, $table, $purpose)
{
	start_app_session();
	$code = (string) random_int(100000, 999999);
	$_SESSION['otp'] = array(
		'code' => $code,
		'email' => $email,
		'table' => $table,
		'purpose' => $purpose,
		'expires' => time() + OTP_LIFETIME_SECONDS,
		'attempts' => 0,
		'verified' => false,
	);
	if (!send_otp_mail($email, $code, $purpose, role_label(role_for_table($table)))) {
		unset($_SESSION['otp']);
		return false;
	}
	return true;
}

// Checks a code typed by the user. Returns true, or an error message.
function otp_check($code)
{
	start_app_session();
	if (empty($_SESSION['otp'])) {
		return 'Please request an OTP first.';
	}
	if (time() > $_SESSION['otp']['expires']) {
		unset($_SESSION['otp']);
		return 'This OTP has expired. Please request a new one.';
	}
	if ($_SESSION['otp']['attempts'] >= OTP_MAX_ATTEMPTS) {
		unset($_SESSION['otp']);
		return 'Too many wrong attempts. Please request a new OTP.';
	}
	if (!hash_equals($_SESSION['otp']['code'], $code)) {
		$_SESSION['otp']['attempts']++;
		return 'Please enter valid OTP';
	}
	$_SESSION['otp']['verified'] = true;
	return true;
}

// The verified OTP record for this purpose, or null. Pass $email/$table to also require a match.
function otp_verified($purpose, $table = null, $email = null)
{
	start_app_session();
	if (empty($_SESSION['otp']) || !$_SESSION['otp']['verified'] || $_SESSION['otp']['purpose'] !== $purpose) {
		return null;
	}
	if (time() > $_SESSION['otp']['expires']) {
		unset($_SESSION['otp']);
		return null;
	}
	if ($table !== null && $_SESSION['otp']['table'] !== $table) {
		return null;
	}
	if ($email !== null && strcasecmp($_SESSION['otp']['email'], $email) !== 0) {
		return null;
	}
	return $_SESSION['otp'];
}

function otp_clear()
{
	start_app_session();
	unset($_SESSION['otp']);
}
