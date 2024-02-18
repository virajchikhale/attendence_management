<?php
// Start the session
session_start();
if($_SESSION["user"]==""){
    echo "<script> alert('Please login....');</script>";
    echo '<script>window.location.href="../login/teacher_login.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Add student</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>


<?php
			include ('../includes/connection.php');	
			$ur = mysql_fetch_array(mysql_query("select * from teacher_reg where email='".$_SESSION["user"]."'"));
            $sql1="select * from admin_reg";
            $sql2="select * from principal_reg";
            $sql3="select * from hod_reg";
            $sql4="select * from teacher_reg";
            $sql5="select * from department";
            $result1=mysql_query($sql1);
            $result2=mysql_query($sql2);
            $result3=mysql_query($sql3);
            $result4=mysql_query($sql4);
            $result5=mysql_query($sql5);
            $admin=mysql_num_rows($result1);
            $principal=mysql_num_rows($result2);
            $hod=mysql_num_rows($result3);
            $teacher=mysql_num_rows($result4);
            $department=mysql_num_rows($result5);
            ?>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <?php
			include ('admin_includes/sidebar.php');
		?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <?php
                include ('admin_includes/header_desktop.php');
            ?>
            <!-- END HEADER DESKTOP-->

            <!-- BREADCRUMB-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <span class="au-breadcrumb-span">You are here:</span>
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            <li class="list-inline-item active">
                                                <a href="#">Home</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Add Student</li>
                                        </ul>
                                    </div>
                                    <!-- <button class="au-btn au-btn-icon au-btn--green">
                                        <i class="zmdi zmdi-plus"></i>add item</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->


            
            <br>
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Add Student in the system</h3>
                                        </div>
                                        <hr>
                                        <form action="" method="post" novalidate="novalidate">
                                            <div class="form-group">
                                                <label for="roll" class="control-label mb-1">Roll No.</label>
                                                <input id="roll" name="roll" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Roll No. of Student">
                                            </div>
                                            <div class="form-group">
                                                <label for="enroll" class="control-label mb-1">En. Roll No.</label>
                                                <input id="enroll" name="enroll" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Enrollment No. of Student">
                                                <input id="teacher_id" name="teacher_id" type="hidden" value="<?php echo  $ur['id'];?>">
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="name" class="control-label mb-1">Full Name</label>
                                                <input id="name" name="name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name of student"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" placeholder="Name of Student">
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone" class="control-label mb-1">Phone No.</label>
                                                <input  onchange=phonevalid() id="phone" name="phone" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter phone No. of student">
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="email" class="control-label mb-1">Email</label>
                                                <input onchange=emailvalid()  id="email" name="email" type="email" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" placeholder="Enter Email of Student">
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div>
                                                <button  onclick=response()  id="payment-button" type="button" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-plus fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">ADD</span>
                                                    <span id="payment-button-sending" style="display:none;">Adding...</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

           


                <?php 
    include('admin_includes/footer.php')
?>
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <script>

        
		function phonevalid() {
            
            var phone = $('#phone').val();
			//  alert(phone)
			$.ajax({
				type:'POST',
				url:'../validation/checkmob.php',
				data:{phone:phone,
					table:'student'
				},
				success:function(return_data) {
				//alert(return_data);
				if(return_data == "1"){
					alert('This Phone Number already exist in system');
					$('#phone').val('');
					$('#phone').focus();
				} 
				}
			});
			}
        
		function emailvalid() {
            var email = $('#email').val();
			//  alert(email)
			$.ajax({
				type:'POST',
				url:'../validation/emailvalid.php',
				data:{email:email,
					type:'reg',
					table:'student'
				},
				success:function(return_data) {
				// alert(return_data);
				if(return_data == "1"){
					alert('This Email already exist in system');
					$('#email').val('');
					$('#email').focus();
				} 
				}
			});
		}
        
		function response() {
            var roll = $('#roll').val();
            var enroll = $('#enroll').val();
            var name = $('#name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var teacher_id = $('#teacher_id').val();
            var	table='student';
            // alert(teacher_id);
            //alert(password);
            $.ajax({
            type:'POST',
            url:'../sqloperations/insert_student.php',
            data:{
                roll:roll,
                enroll:enroll,
                name:name,
                phone:phone,
                email:email,
                teacher_id:teacher_id,
                table:table
            },
            success:function(return_data) {
                // alert(return_data);
            if(return_data == "1"){
                alert ('Something went wrong...');
            }  else{ 
                    alert ('student added successfully');
                    window.location.href='stud_add.php';
            } 
            }
        });
        }
    </script>
    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="vendor/vector-map/jquery.vmap.js"></script>
    <script src="vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="vendor/vector-map/jquery.vmap.world.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
