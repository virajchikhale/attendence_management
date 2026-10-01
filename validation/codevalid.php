<?php
require_once __DIR__ . '/../includes/auth.php';
api_begin();

if (db_value('SELECT COUNT(*) FROM details WHERE principal_verification = ?', array(post('code'))) == 0) {
	json_fail('Please enter vaild Admin code.');
}
json_out(true);
