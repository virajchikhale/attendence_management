<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>HOD-Registration</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="../includes/css/opensans-font.css">
	<link rel="stylesheet" type="text/css" href="../includes/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="../includes/css/style.css"/>
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
<body onload="disable()">
	<div class="page-content">
		<div class="form-v1-content">
			<div class="wizard-form">
		        <form class="form-register" action="#" method="post">
		        	<div id="form-total">
		        		<!-- SECTION 1 -->
			            <h2>
			            	<p class="step-icon"><span>01</span></p>
			            	<span class="step-text">HOD's Infomation</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="wizard-header">
									<h3 class="heading">Peronal Infomation of HOD</h3>
									<p>Please enter your infomation and proceed to the next step so we can build your accounts.  </p>
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
											<input type="email" name="email" id="email" onchange=emailvalid(this.value) class="form-control" placeholder="example@email.com" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<fieldset>
											<legend>Phone Number</legend>
											<input type="text" class="form-control" onchange=checkmobno() id="phoneno" name="phoneno" placeholder="+1 888-999-7777" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<fieldset>
											<legend>Password</legend>
											<input type="password" class="form-control" onchange=passvalid() id="password" name="password" placeholder="Enter your Password" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<fieldset>
											<legend>Password</legend>
											<input type="password" class="form-control" onchange=passcon() id="cpassword" name="cpassword" placeholder="Renter your Password" required>
										</fieldset>
									</div>
								</div>
							</div>
			            </section>
						<!-- SECTION 2 -->
			            <h2>
			            	<p class="step-icon"><span>02</span></p>
			            	<span class="step-text">Admin Verification</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="wizard-header">
									<h3 class="heading">Admin Verification</h3>
									<p>Please enter the code which is provied to you by the admin.</p>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-1">
										<label for="state">Department</label>
										<select class="form-control" id="department" name="department" onchange=selectnone(this.id)>
										<option value="none">Select Department</option>
										<?php
											$resu = mysql_query("select * from department where status='0'");
											$i = 1;
											while($row = mysql_fetch_array($resu))
													{ ?>
												<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
											<?php $i++;} ?> 
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-1">
										<label for="state">Reporting</label>
										<select class="form-control" id="report_to" name="report_to" onchange=selectnone(this.id)>
										<option value="none">Select Reporting</option>
										<?php
											$resu = mysql_query("select * from principal_reg");
											$i = 1;
											while($row = mysql_fetch_array($resu))
													{ ?>
												<option value="<?php echo $row['id']; ?>"><?php echo $row['first_name']; ?></option>
											<?php $i++;} ?> 
										</select>
									</div>
								</div>
							</div>
			            </section>
			            <!-- SECTION 3 -->
			            <h2>
			            	<p class="step-icon"><span>03</span></p>
			            	<span class="step-text">OTP Verifiction</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="wizard-header">
									<h3 class="heading">OTP Verifiction</h3>
									<p>Please enter your infomation and proceed to the next step so we can build your accounts.</p>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-1">
										<fieldset>
												<legend>OTP</legend>
											<input type="text" class="form-control" onchange=otp() onkeyup=otp1()  id="otp" name="otp" placeholder="Enter your OTP" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-button form-button-2 text-right">
										<button type="Button" class="btn btn-primary btn-user btn-block" onclick=response() id="submit" name="submit" >Register</button>
									</div>
								</div>
							</div>
			            </section>
		        	</div>
		        </form>
			</div>
		</div>
	</div>
	<!--mobile number validation -->
    <script> 

	function checkmobno() {
		var mob = $('#phoneno').val();
		//alert(mob);
		$.ajax({
		type:'POST',
		url:'../validation/checkmob.php',
		data:{mob:mob,table:'hod_reg'},
		success:function(return_data) {
			if(return_data == 1){
			alert('This Number already exist in system');
			$('#phoneno').val('');
			$('#phoneno').focus();
			}   //	alert(return_data);      
		}
		});
	}

	function emailvalid(str) {
      var email = $('#email').val();
      //alert(email);
      $.ajax({
        type:'POST',
        url:'../validation/emailvalid.php',
        data:{email:email,
			type:'reg',
			table:'hod_reg'
		},
        success:function(return_data) {
          if(return_data == "1"){
            alert('This Email already exist in system');
            $('#email').val('');
            $('#email').focus();
          }  else{
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                }
                xmlhttp.open("GET", "../email/email_base.php?q="+str+"&otp="+return_data+"&type=reg_otp&position=hod", true);
                xmlhttp.send();
                //alert(return_data);
            alert('We have sent OTP to '+str);
            otp = return_data;
			
			//alert(otp);
          }   
        }
      });
    }

	function response() {

		
		var fname = $('#fname').val();
		var lname = $('#lname').val();
		var email = $('#email').val();
		var phoneno = $('#phoneno').val();
		var password = $('#password').val();
		var department = $('#department').val();
		var report_to = $('#report_to').val();
		var	table='hod_reg';
			
		
		$.ajax({
			type:'POST',
			url:'../sqloperations/insert_reg.php',
			data:{fname:fname,
				lname:lname,
				email:email,
				phoneno:phoneno,
				password:password,
				department:department,
				report_to:report_to,
				table:table
			},
			success:function(return_data) {
				//alert(return_data);
			if(return_data == "1"){
				alert('Someting went wrong!!!');
			}  else{

				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					}
					xmlhttp.open("GET", "../email/email_base.php?q="+email+"&type=thanks&position=hod", true);
					xmlhttp.send();
					alert('Signed Up Successfully....');
					window.location.href='../login/hod_login.php';
			} 
			}
		});
		}

	</script>
	<script src="../includes/js/jquery-3.3.1.min.js"></script>
	<script src="../includes/js/jquery.steps.js"></script>
	<script src="../includes/js/main_steps.js"></script>
	<script src="../includes/js/validation.js"></script>
</body>
</html>
