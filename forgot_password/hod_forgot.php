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

    <title>HOD-Forgot</title>

    <!-- Custom fonts for this template-->
    <link href="../includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../includes/css/sb-admin-2.css" rel="stylesheet">
    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../includes/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../includes/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../includes/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../includes/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../includes/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../includes/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../includes/css/util.css">
	<link rel="stylesheet" type="text/css" href="../includes/css/main.css">
<!--===============================================================================================-->
</head>

<body onload=disable()>

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../includes/images/noun-principal-4585288.png" alt="IMG">
				</div>
                <form method="post" class="login100-form validate-form">
					<span class="login100-form-title">
						HOD Forgot Password
					</span>

					<div id="email_box" class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text"  onchange=emailvalid(this.value)  name="email" id="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					
					<div  id="otp" class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="number" name="otp"  onkeyup=otp1() onchange=aaaa() id="otpin" placeholder="Enter OTP">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					
					<div  id="pass" class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" onchange=passvalid()  id="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div  id="cpass" class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="cpass"  onchange=passcon()  id="cpassword" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div id="alert" class="alert alert-danger" role="alert">
					</div>
					
					<div class="container-login100-form-btn">
						<button type='Button' onclick=response() id="submit" name="submit"  class="login100-form-btn">
							Update
						</button>
					</div>
				</form>
				
			</div>
		</div>
	</div>


    <!--===============================================================================================-->	
	<script src="../includes/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../includes/vendor/bootstrap/js/popper.js"></script>
	<script src="../includes/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../includes/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../includes/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})

		
		function disable() {
			var x = document.getElementById("alert");
			x.style.display = "none";

			var x = document.getElementById("otp");
			x.style.display = "none";

			var y = document.getElementById("pass");
			y.style.display = "none";

			var z = document.getElementById("cpass");
			z.style.display = "none";

			var b = document.getElementById("submit");
			b.style.display = "none";
		}

		function passvalid() {
			var pass = $('#password').val();

			//alert(pass.length);
			var len = pass.length;
			//alert(len);
			if(len < 8){
				alert('Password must be atleast of 8 charechters');
				$('#password').val('');
				$('#password').focus();
			}  
		}


		function passcon() {
			var pass = $('#password').val();
			var cpass = $('#cpassword').val();

			if(pass != cpass){
				alert('Password Mismatched please try agian');
				$('#cpassword').val('');
				$('#cpassword').focus();
			}  
			
			var b = document.getElementById("submit");
			b.style.display = "block";
		}

		function emailvalid(str) {
			var email = str;
			//  alert(email)
			$.ajax({
				type:'POST',
				url:'../validation/emailvalid.php',
				data:{email:email,
					type:'forgot',
					table:'hod_reg'
				},
				success:function(return_data) {
				//alert(return_data);
				if(return_data == "1"){
					alert('This Email does not exist in system');
					$('#email').val('');
					$('#email').focus();
				}  else{
						// alert(return_data);
						var xmlhttp = new XMLHttpRequest();
						xmlhttp.onreadystatechange = function() {
						}
						xmlhttp.open("GET", "../email/email_base.php?q="+email+"&otp="+return_data+"&type=forgot_otp&position=hod", true);
						xmlhttp.send();
						// alert(return_data);
						alert('We have sent OTP to '+email);
						otp = return_data;
						
						var x = document.getElementById("otp");
						x.style.display = "block";
						
						//alert(otp);
				} 
				}
			});
			}


			function otp1() {
			var raw = $('#otpin').val();
			var otp1 = raw.trim();
			//alert(window.otp);
			//alert(otp1);
			//alert(len);
				if(otp1 == otp){


					var y = document.getElementById("pass");
					y.style.display = "block";

					var z = document.getElementById("cpass");
					z.style.display = "block";
				}
			}

			function aaaa() {
			var raw = $('#otpin').val();
			var otp1 = raw.trim();
			//alert(window.otp);
			//alert(otp1);
			//alert(len);
				if(otp1 !== otp){
					alert('Plese enter valid OTP');
					$('#otp').val('');
					$('#otp').focus();
				}  else{
					var a = document.getElementById("email");
					a.disable = true;
					var x = document.getElementById("otp");
					x.style.display = "none";

					var y = document.getElementById("pass");
					y.style.display = "block";

					var z = document.getElementById("cpass");
					z.style.display = "block";
				}
			}

		function response() {
        var email = $('#email').val();
        var password = $('#password').val();
		var	table='hod_reg';
		//alert(password);
		$.ajax({
        type:'POST',
        url:'../sqloperations/update_reg.php',
        data:{email:email,
			password:password,
			table:table
		},
        success:function(return_data) {
        // alert(return_data);
      if(return_data == "1"){
        alert('Someting went wrong!!!');
      }  else{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            }
            xmlhttp.open('GET', '../email/email_base.php?q='+email+'&type=pass_change_alert&position=hod', true);
            xmlhttp.send(); 
            alert('Password Updated Successfully....');
            window.location.href='../login/hod_login.php';
      } 
    }
      });
	}
	</script>
<!--===============================================================================================-->
	<script src="../includes/js/main.js"></script>

</body>

</html>