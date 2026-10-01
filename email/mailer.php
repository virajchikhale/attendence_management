<?php
// Outgoing email. SMTP settings come from environment variables (see .env.example).
// This file is a library for the server-side handlers; it is never requested by the browser.

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

require_once __DIR__ . '/../includes/connection.php';
require_once __DIR__ . '/phpmailer/src/Exception.php';
require_once __DIR__ . '/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/phpmailer/src/SMTP.php';

// Sends one HTML email. Returns true on success; failures are logged, not shown.
function send_app_mail($to, $subject, $message)
{
	$host = env('SMTP_HOST');
	if ($host === null) {
		error_log('Email not sent: SMTP_HOST is not configured.');
		return false;
	}

	$system_name = env('MAIL_FROM_NAME', 'Student Management');
	$username = env('SMTP_USER');

	try {
		$mail = new PHPMailer(true);
		$mail->isSMTP();
		$mail->Host = $host;
		$mail->Port = (int) env('SMTP_PORT', '587');
		$mail->Timeout = 15;

		if ($username !== null) {
			$mail->SMTPAuth = true;
			$mail->Username = $username;
			$mail->Password = env('SMTP_PASSWORD', '');
		}

		$secure = strtolower(env('SMTP_SECURE', 'tls'));
		if ($secure === 'ssl') {
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		} else if ($secure === 'tls') {
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		} else {
			$mail->SMTPSecure = '';
			$mail->SMTPAutoTLS = false;
		}

		$mail->setFrom(env('MAIL_FROM', $username !== null ? $username : 'no-reply@attendance.local'), $system_name);
		$mail->addAddress($to);
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AltBody = strip_tags($message);
		$mail->send();
		return true;
	} catch (MailException $ex) {
		error_log('Email to ' . $to . ' failed: ' . $ex->getMessage());
		return false;
	}
}

function send_otp_mail($to, $otp, $purpose, $position)
{
	$subject = 'OTP for ' . $position . ' Confirmation';
	if ($purpose === 'forgot') {
		$message = 'Dear User, your OTP for password change is <b><u> ' . $otp . ' </u></b>';
	} else {
		$message = 'Dear User, your OTP for signin Confirmation is <b><u> ' . $otp . ' </u></b>';
	}
	return send_app_mail($to, $subject, $message);
}

function send_welcome_mail($to, $position)
{
	$system_name = env('MAIL_FROM_NAME', 'Student Management');
	return send_app_mail(
		$to,
		'Welcome to ' . $system_name . ' System',
		'Thank you for registering with us as ' . $position . '.<br> You can now enjoy all the features of ' . $system_name . '.'
	);
}

function send_password_changed_mail($to, $position)
{
	$system_name = env('MAIL_FROM_NAME', 'Student Management');
	return send_app_mail(
		$to,
		'Alert from ' . $system_name . ' System',
		'Password for ' . htmlspecialchars($to, ENT_QUOTES, 'UTF-8') . ' has been changed as ' . $position . '.'
	);
}
