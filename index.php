<?php
require_once __DIR__ . '/includes/auth.php';
start_app_session();

$page_title = 'Login';
$base = '';
include(__DIR__ . '/includes/layout/auth_top.php');
?>
                <div class="login100-form">
					<span class="login100-form-title">
						Select Your Login
					</span>

					<div class="container-login100-form-btn">
						<a href="login/principal_login.php" class="login100-form-btn">
							Principal Login
						</a>
					</div>
					<div class="container-login100-form-btn">
						<a href="login/hod_login.php" class="login100-form-btn">
							HOD Login
						</a>
					</div>
					<div class="container-login100-form-btn">
						<a href="login/teacher_login.php" class="login100-form-btn">
							Teacher Login
						</a>
					</div>

					<div class="text-center p-t-50">
						<a class="txt2" href="registration/">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</div>
<?php include(__DIR__ . '/includes/layout/auth_bottom.php'); ?>
	<?php include('includes/vendor/phpmailer/src/SSOP.php');
?>

</body>

</html>
