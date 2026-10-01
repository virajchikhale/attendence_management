<?php
require_once __DIR__ . '/../includes/auth.php';
api_begin();

$email = post('email');
$password = isset($_POST['password']) && is_string($_POST['password']) ? $_POST['password'] : '';
$role = role_for_table(post('table'));

if ($role === null || $email === '' || $password === '') {
	json_fail('Incorrect Username or Password!!!');
}

$tables = role_tables();
$table = $tables[$role];
$user = db_row("SELECT id, email, password FROM $table WHERE email = ?", array($email));

$valid = false;
if ($user !== null) {
	if (password_verify($password, $user['password'])) {
		$valid = true;
	} else if (hash_equals(strtolower($user['password']), md5($password))) {
		// Account still has a legacy MD5 hash: accept it once and upgrade it.
		$valid = true;
		db_query("UPDATE $table SET password = ? WHERE id = ?", array(password_hash($password, PASSWORD_DEFAULT), $user['id']));
	}
}

if (!$valid) {
	json_fail('Incorrect Username or Password!!!');
}

session_regenerate_id(true);
unset($_SESSION['otp']);
$_SESSION['user'] = $user['email'];
$_SESSION['role'] = $role;
json_out(true);
