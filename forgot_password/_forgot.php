<?php
// Forgot-password page shared by the three roles. Expects $role.
// Three steps on one form: email -> OTP -> new password.
if (!isset($role)) {
	http_response_code(404);
	exit;
}
require_once __DIR__ . '/../includes/auth.php';
start_app_session();

$tables = role_tables();
$page_title = role_label($role) . '-Forgot';
$base = '../';
include(__DIR__ . '/../includes/layout/auth_top.php');
?>
                <form method="post" id="forgot-form" class="login100-form" novalidate>
					<span class="login100-form-title">
						<?php echo e(role_label($role)); ?> Forgot Password
					</span>

					<div id="email_box" class="wrap-input100">
						<input class="input100" type="text" name="email" id="email" placeholder="Email" autocomplete="username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div id="otp" class="wrap-input100" hidden>
						<input class="input100" type="text" inputmode="numeric" name="otp" id="otpin" placeholder="Enter OTP" autocomplete="one-time-code">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-key" aria-hidden="true"></i>
						</span>
					</div>

					<div id="pass" class="wrap-input100" hidden>
						<input class="input100" type="password" name="pass" id="password" placeholder="New Password" autocomplete="new-password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div id="cpass" class="wrap-input100" hidden>
						<input class="input100" type="password" name="cpass" id="cpassword" placeholder="Confirm New Password" autocomplete="new-password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div id="alert" class="alert alert-danger" role="alert" hidden>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" id="submit" name="submit" class="login100-form-btn">
							Send OTP
						</button>
					</div>

					<div class="text-center p-t-50">
						<a class="txt2" href="../login/<?php echo $role; ?>_login.php">
							<i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>
							Back to Login
						</a>
					</div>
				</form>
<?php include(__DIR__ . '/../includes/layout/auth_bottom.php'); ?>
	<script>
		// 'email' -> 'otp' -> 'password'
		var step = 'email';

		function showAlert(message, kind) {
			$('#alert')
				.removeClass('alert-danger alert-success')
				.addClass(kind === 'success' ? 'alert-success' : 'alert-danger')
				.text(message)
				.prop('hidden', false);
		}

		function sendOtp(button) {
			App.post('../validation/emailvalid.php', {
				email: $('#email').val().trim(),
				type: 'forgot',
				table: '<?php echo $tables[$role]; ?>'
			}).then(function (response) {
				button.prop('disabled', false);
				if (!response.ok) {
					showAlert(response.message);
					$('#email').focus();
					return;
				}
				step = 'otp';
				$('#email').prop('readonly', true);
				$('#otp').prop('hidden', false);
				$('#otpin').focus();
				button.text('Verify OTP');
				showAlert('We have sent OTP to ' + $('#email').val().trim(), 'success');
			});
		}

		function verifyOtp(button) {
			App.post('../validation/otpvalid.php', {
				otp: $('#otpin').val().trim()
			}).then(function (response) {
				button.prop('disabled', false);
				if (!response.ok) {
					showAlert(response.message);
					$('#otpin').val('').focus();
					return;
				}
				step = 'password';
				$('#alert').prop('hidden', true);
				$('#otp').prop('hidden', true);
				$('#pass, #cpass').prop('hidden', false);
				$('#password').focus();
				button.text('Update Password');
			});
		}

		function updatePassword(button) {
			var pass = $('#password').val();
			if (pass.length < 8) {
				button.prop('disabled', false);
				showAlert('Password must be at least 8 characters.');
				$('#password').focus();
				return;
			}
			if (pass != $('#cpassword').val()) {
				button.prop('disabled', false);
				showAlert('Passwords do not match, please try again.');
				$('#cpassword').val('').focus();
				return;
			}
			App.post('../sqloperations/update_reg.php', {
				password: pass
			}).then(function (response) {
				if (!response.ok) {
					button.prop('disabled', false);
					showAlert(response.message);
					return;
				}
				$('#alert').prop('hidden', true);
				App.notifyThenGo('Password Updated Successfully....', '../login/<?php echo $role; ?>_login.php');
			});
		}

		$('#forgot-form').on('submit', function (event) {
			event.preventDefault();
			var button = $('#submit').prop('disabled', true);
			if (step === 'email') {
				sendOtp(button);
			} else if (step === 'otp') {
				verifyOtp(button);
			} else {
				updatePassword(button);
			}
		});
	</script>

</body>

</html>
