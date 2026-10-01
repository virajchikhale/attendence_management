<?php
// Login page shared by the three roles. Expects $role ('principal' | 'hod' | 'teacher').
if (!isset($role)) {
	http_response_code(404);
	exit;
}
require_once __DIR__ . '/../includes/auth.php';

// Already signed in with this role: go straight to the portal.
if (current_user($role) !== null) {
	header('Location: ../' . $role . '/');
	exit;
}

$tables = role_tables();
$page_title = role_label($role) . '-Login';
$base = '../';
include(__DIR__ . '/../includes/layout/auth_top.php');
?>
                <form method="post" id="login-form" class="login100-form validate-form" novalidate>
					<span class="login100-form-title">
						<?php echo e(role_label($role)); ?> Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" id="email" placeholder="Email" autocomplete="username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" id="password" placeholder="Password" autocomplete="current-password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div id="alert" class="alert alert-danger" role="alert" hidden>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" id="submit" name="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="../forgot_password/<?php echo $role; ?>_forgot.php">
							Password?
						</a>
					</div>

					<div class="text-center p-t-50">
						<a class="txt2" href="../registration/<?php echo $role; ?>_reg.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
						<br>
						<a class="txt2 auth-back" href="../">
							<i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>
							Select another login
						</a>
					</div>
				</form>
<?php include(__DIR__ . '/../includes/layout/auth_bottom.php'); ?>
	<script>
		$('#login-form').on('submit', function (event) {
			event.preventDefault();
			if ($(this).find('.alert-validate').length) {
				return;
			}
			var button = $('#submit').prop('disabled', true);
			App.post('../sqloperations/login.php', {
				email: $('#email').val(),
				password: $('#password').val(),
				table: '<?php echo $tables[$role]; ?>'
			}).then(function (response) {
				if (response.ok) {
					window.location.href = '../<?php echo $role; ?>/';
					return;
				}
				button.prop('disabled', false);
				$('#alert').text(response.message).prop('hidden', false);
				$('#password').val('').focus();
			});
		});
	</script>

</body>

</html>
