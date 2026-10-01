<?php
// Registration wizard shared by the three roles. Expects $role.
if (!isset($role)) {
	http_response_code(404);
	exit;
}
require_once __DIR__ . '/../includes/auth.php';
start_app_session();

$tables = role_tables();
$label = role_label($role);

$departments = array();
$principals = array();
if ($role === 'hod') {
	// Only departments that do not have an HOD yet.
	$departments = db_all('SELECT id, name FROM department WHERE status = 0 ORDER BY name');
	$principals = db_all('SELECT id, first_name, last_name FROM principal_reg ORDER BY first_name');
} else if ($role === 'teacher') {
	$departments = db_all('SELECT id, name FROM department ORDER BY name');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo e($label); ?>-Registration</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="../includes/css/opensans-font.css">
	<link rel="stylesheet" type="text/css" href="../includes/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="../includes/css/style.css"/>
    <link rel="stylesheet" href="../includes/css/app.css"/>
	<link rel="icon" type="image/png" href="../includes/images/icons/favicon.ico"/>
	<style>
		.btn-primary{color:#fff;background-color:#28a745;border-color:#28a745}.btn-primary:hover{color:#fff;background-color:#218838;border-color:#1e7e34}
		.btn-primary:disabled{opacity:.65;cursor:not-allowed}
		.btn{display:inline-block;font-weight:400;text-align:center;white-space:nowrap;vertical-align:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;line-height:1.5;border-radius:.25rem;cursor:pointer;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out}
		.btn-block{display:block;width:100%}
		.btn-secondary{color:#3e4061;background-color:#fff;border-color:#3e4061}.btn-secondary:hover{color:#fff;background-color:#3e4061}
		.btn-secondary:disabled{opacity:.65;cursor:not-allowed}
		</style>
</head>
<body>
	<div class="page-content">
		<div class="form-v1-content">
			<div class="wizard-form">
		        <form class="form-register" action="#" method="post" novalidate>
		        	<div id="form-total">
		        		<!-- SECTION 1 -->
			            <h2>
			            	<p class="step-icon"><span>01</span></p>
			            	<span class="step-text"><?php echo e($label); ?>'s Information</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="wizard-header">
									<h3 class="heading">Personal Information of <?php echo e($label); ?></h3>
									<p>Please enter your information and proceed to the next step so we can build your account.</p>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<fieldset>
											<legend>First Name</legend>
											<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
										</fieldset>
									</div>
									<div class="form-holder">
										<fieldset>
											<legend>Last Name</legend>
											<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<fieldset>
											<legend>Your Email</legend>
											<input type="email" name="email" id="email" class="form-control" placeholder="example@email.com" autocomplete="username" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<fieldset>
											<legend>Phone Number</legend>
											<input type="text" class="form-control" id="phoneno" name="phoneno" inputmode="tel" placeholder="10 digit mobile number" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<fieldset>
											<legend>Password</legend>
											<input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password" autocomplete="new-password" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<fieldset>
											<legend>Confirm Password</legend>
											<input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Re-enter your Password" autocomplete="new-password" required>
										</fieldset>
									</div>
								</div>
							</div>
			            </section>
						<!-- SECTION 2 -->
<?php if ($role === 'principal') { ?>
			            <h2>
			            	<p class="step-icon"><span>02</span></p>
			            	<span class="step-text">Admin Verification</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="wizard-header">
									<h3 class="heading">Admin Verification</h3>
									<p>Please enter the code which is provided to you by the admin.</p>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<fieldset>
											<legend>Verification Code</legend>
											<input type="text" class="form-control" id="code" name="code" placeholder="Enter your code" autocomplete="off" required>
										</fieldset>
									</div>
								</div>
							</div>
			            </section>
<?php } else { ?>
			            <h2>
			            	<p class="step-icon"><span>02</span></p>
			            	<span class="step-text">Department Selection</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="wizard-header">
									<h3 class="heading">Select Department</h3>
<?php if ($role === 'hod') { ?>
									<p>Please select the department and whom you are going to report to.</p>
<?php } else { ?>
									<p>Please select the department in which you are going to work.</p>
<?php } ?>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-1">
										<label for="department">Department</label>
										<select class="form-control" id="department" name="department">
										<option value="none">Select Your Department</option>
										<?php foreach ($departments as $row) { ?>
											<option value="<?php echo e($row['id']); ?>"><?php echo e($row['name']); ?></option>
										<?php } ?>
										</select>
<?php if ($role === 'hod' && count($departments) === 0) { ?>
										<p class="form-note">Every department already has an HOD. Ask the principal to add your department first.</p>
<?php } ?>
									</div>
								</div>
<?php if ($role === 'hod') { ?>
								<div class="form-row">
									<div class="form-holder form-holder-1">
										<label for="report_to">Reporting</label>
										<select class="form-control" id="report_to" name="report_to">
										<option value="none">Select Reporting</option>
										<?php foreach ($principals as $row) { ?>
											<option value="<?php echo e($row['id']); ?>"><?php echo e($row['first_name'] . ' ' . $row['last_name']); ?></option>
										<?php } ?>
										</select>
									</div>
								</div>
<?php } ?>
							</div>
			            </section>
<?php } ?>
			            <!-- SECTION 3 -->
			            <h2>
			            	<p class="step-icon"><span>03</span></p>
			            	<span class="step-text">OTP Verification</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="wizard-header">
									<h3 class="heading">OTP Verification</h3>
									<p>We will email a one-time password to the address you provided. Enter it below to finish.</p>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<fieldset>
												<legend>OTP</legend>
											<input type="text" class="form-control" id="otp" name="otp" inputmode="numeric" placeholder="Enter your OTP" autocomplete="one-time-code" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2 otp-actions">
										<button type="button" class="btn btn-secondary" id="send_otp">Send OTP</button>
										<button type="button" class="btn btn-primary" id="submit" name="submit">Register</button>
									</div>
								</div>
							</div>
			            </section>
		        	</div>
		        </form>
				<p class="wizard-login-link">Already have an account? <a href="../login/<?php echo $role; ?>_login.php">Login</a></p>
			</div>
		</div>
	</div>

	<script src="../includes/js/jquery-3.3.1.min.js"></script>
	<script src="../includes/js/jquery.steps.js"></script>
	<script src="../includes/js/app.js"></script>
    <script>
	var role = '<?php echo $role; ?>';
	var table = '<?php echo $tables[$role]; ?>';
	var otpSentTo = '';

	// Checks the personal details on the first step. Returns an error message, or '' when fine.
	function checkDetails() {
		if ($('#fname').val().trim() == '' || $('#lname').val().trim() == '') {
			return 'Please enter your first and last name.';
		}
		if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test($('#email').val().trim())) {
			return 'Please enter a valid email address.';
		}
		if (!/^\+?[0-9]{10,15}$/.test($('#phoneno').val().trim())) {
			return 'Please enter a valid phone number.';
		}
		if ($('#password').val().length < 8) {
			return 'Password must be at least 8 characters.';
		}
		if ($('#password').val() != $('#cpassword').val()) {
			return 'Passwords do not match, please try again.';
		}
		return '';
	}

	// Checks the second step (admin code, or department selection).
	function checkSelection() {
		if (role == 'principal') {
			return $('#code').val().trim() == '' ? 'Please enter the admin verification code.' : '';
		}
		if ($('#department').val() == 'none') {
			return 'Please select your department.';
		}
		if (role == 'hod' && $('#report_to').val() == 'none') {
			return 'Please select whom you report to.';
		}
		return '';
	}

	function firstProblem() {
		return checkDetails() || checkSelection();
	}

	$("#form-total").steps({
		headerTag: "h2",
		bodyTag: "section",
		transitionEffect: "fade",
		enableAllSteps: true,
		stepsOrientation: "vertical",
		autoFocus: true,
		transitionEffectSpeed: 500,
		titleTemplate : '<div class="title">#title#</div>',
		labels: {
			previous : 'Back Step',
			next : '<i class="zmdi zmdi-arrow-right"></i>',
			finish : '<i class="zmdi zmdi-check"></i>',
			current : ''
		},
		// Going forward requires the steps before the target to be filled in.
		onStepChanging: function (event, currentIndex, newIndex) {
			if (newIndex <= currentIndex) {
				return true;
			}
			var problem = checkDetails();
			if (!problem && newIndex > 1) {
				problem = checkSelection();
			}
			if (problem) {
				App.notify(problem, 'error');
				return false;
			}
			return true;
		},
		onFinished: function () {
			register();
		}
	});

	$('#email').on('change', function () {
		var field = $(this);
		if (field.val().trim() == '') {
			return;
		}
		App.post('../validation/emailvalid.php', { email: field.val().trim(), type: 'check', table: table }).then(function (response) {
			if (!response.ok) {
				App.notify(response.message, 'error');
				field.val('').focus();
			}
		});
	});

	$('#phoneno').on('change', function () {
		var field = $(this);
		if (field.val().trim() == '') {
			return;
		}
		App.post('../validation/checkmob.php', { phone: field.val().trim(), table: table }).then(function (response) {
			if (!response.ok) {
				App.notify(response.message, 'error');
				field.val('').focus();
			}
		});
	});

	$('#code').on('change', function () {
		var field = $(this);
		App.post('../validation/codevalid.php', { code: field.val().trim() }).then(function (response) {
			if (!response.ok) {
				App.notify(response.message, 'error');
				field.val('').focus();
			}
		});
	});

	$('#send_otp').on('click', function () {
		var problem = firstProblem();
		if (problem) {
			App.notify(problem, 'error');
			return;
		}
		var button = $(this).prop('disabled', true);
		var email = $('#email').val().trim();
		App.post('../validation/emailvalid.php', { email: email, type: 'reg', table: table }).then(function (response) {
			button.prop('disabled', false);
			if (!response.ok) {
				App.notify(response.message, 'error');
				return;
			}
			otpSentTo = email;
			button.text('Resend OTP');
			App.notify('We have sent OTP to ' + email, 'success');
			$('#otp').focus();
		});
	});

	function register() {
		var problem = firstProblem();
		var email = $('#email').val().trim();
		if (!problem && (otpSentTo == '' || otpSentTo != email)) {
			problem = 'Please click Send OTP and enter the code we email you.';
		}
		if (!problem && $('#otp').val().trim() == '') {
			problem = 'Please enter the OTP.';
		}
		if (problem) {
			App.notify(problem, 'error');
			return;
		}

		var button = $('#submit').prop('disabled', true);
		App.post('../validation/otpvalid.php', { otp: $('#otp').val().trim() }).then(function (response) {
			if (!response.ok) {
				button.prop('disabled', false);
				App.notify(response.message, 'error');
				$('#otp').val('').focus();
				return;
			}
			App.post('../sqloperations/insert_reg.php', {
				fname: $('#fname').val().trim(),
				lname: $('#lname').val().trim(),
				email: email,
				phoneno: $('#phoneno').val().trim(),
				password: $('#password').val(),
				department: $('#department').val(),
				report_to: $('#report_to').val(),
				code: $('#code').val(),
				table: table
			}).then(function (response) {
				if (!response.ok) {
					button.prop('disabled', false);
					App.notify(response.message, 'error');
					return;
				}
				App.notifyThenGo('Signed Up Successfully....', '../login/' + role + '_login.php');
			});
		});
	}

	$('#submit').on('click', register);
	</script>
</body>
</html>
