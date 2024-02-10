<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="../includes/css/opensans-font.css">
	<link rel="stylesheet" type="text/css" href="../includes/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="../includes/css/style.css"/>	
	<link rel="icon" type="image/png" href="../includes/images/icons/favicon.ico"/>

	<style>
		.btn-primary{color:#fff;background-color:#28a745;border-color:#28a745}.btn-primary:hover{color:#fff;background-color:#0069d9;border-color:#0062cc}
		.btn{display:inline-block;font-weight:400;text-align:center;white-space:nowrap;vertical-align:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;line-height:1.5;border-radius:.25rem;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out}
		.btn-block{display:block;width:100%}
		.text-right{margin-left:5%!important}
		</style>
</head>
<?php
		include("../includes/connection.php");
	?>
<body>
	<div class="page-content">
		<div class="form-v1-content">
			<div class="wizard-form">
		        <form class="form-register" action="#" method="post">
		        	<div id="form-total">
		        		
			            <!-- SECTION 3 -->
			            <h2>
			            	<span class="step-text">Select registration type</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="wizard-header">
									<h3 class="heading">Registration type</h3>
								</div>
			                	<div class="wizard-header">
									<a type="Button" href="principal_reg.php" style="text-decoration:none;" class="btn btn-primary btn-user btn-block"><b>Principal Register</b></a>
								</div>
			                	<div class="wizard-header">
									<a type="Button" href="hod_reg.php" style="text-decoration:none;" class="btn btn-primary btn-user btn-block"><b>HOD Register</b></a>
								</div>
			                	<div class="wizard-header">
									<a type="Button" href="teacher_reg.php" style="text-decoration:none;" class="btn btn-primary btn-user btn-block"><b>Teacher Register</b></a>
								</div>
							</div>
			            </section>
		        	</div>
		        </form>
			</div>
		</div>
	</div>
	<!--mobile number validation -->
	<script src="../includes/js/jquery-3.3.1.min.js"></script>
	<script src="../includes/js/jquery.steps.js"></script>
	<script src="../includes/js/main_steps.js"></script>
	<script src="../includes/js/validation.js"></script>
</body>
</html>
