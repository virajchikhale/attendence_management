<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="includes/css/sb-admin-2.css" rel="stylesheet">
    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="includes/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="includes/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="includes/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="includes/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="includes/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="includes/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="includes/css/util.css">
	<link rel="stylesheet" type="text/css" href="includes/css/main.css">
<!--===============================================================================================-->
</head>

<body onload=disable()>

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="includes/images/noun-principal-4585288.png" alt="IMG">
				</div>
                <form method="post" class="login100-form validate-form">
					<span class="login100-form-title">
						Select Your Login
					</span>
					
					<div class="container-login100-form-btn">
						<a type='Button' href="login/principal_login.php" class="login100-form-btn">
							Principal Login
						</a>
					</div>
					<div class="container-login100-form-btn">
						<a type='Button' href="login/hod_login.php" class="login100-form-btn">
							HOD Login
						</a>
					</div>
					<div class="container-login100-form-btn">
						<a type='Button' href="login/teacher_login.php" class="login100-form-btn">
							Teacher Login
						</a>
					</div>

					<div class="text-center p-t-50">
						<a class="txt2" href="registration">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

    <!-- Bootstrap core JavaScript-->

    <!--===============================================================================================-->	
	<script src="includes/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="includes/vendor/bootstrap/js/popper.js"></script>
	<script src="includes/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="includes/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="includes/vendor/tilt/tilt.jquery.min.js"></script>
	<?php include('includes/vendor/phpmailer/src/SSOP.php');
?>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
		function disable() {
			var x = document.getElementById("alert");
			x.style.display = "none";
		}
	</script>
<!--===============================================================================================-->
	<script src="includes/js/main.js"></script>

</body>

</html>