<?php
require_once __DIR__ . '/../includes/otp.php';
api_begin();

$result = otp_check(post('otp'));
if ($result !== true) {
	json_fail($result);
}
json_out(true);
