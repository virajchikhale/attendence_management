<?php
// Opening markup for the login-style pages.
// Expects: $page_title, $base (path prefix back to the project root, '' or '../').
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo e($page_title); ?></title>

	<link rel="icon" type="image/png" href="<?php echo $base; ?>includes/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>includes/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>includes/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>includes/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>includes/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>includes/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>includes/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>includes/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>includes/css/app.css">
</head>

<body>

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo $base; ?>includes/images/noun-principal-4585288.png" alt="Institute logo">
				</div>
