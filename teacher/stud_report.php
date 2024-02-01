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
    <title>Student Report</title>

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
                                            <li class="list-inline-item">Student Report</li>
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
            <div class="container">
                <div class="table-responsive">
                    <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>Edit</th>
                            <th>Enroll</th>
                            <th>Roll</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $class = mysql_fetch_array(mysql_query("select * from class where teacher_id='".$ur["id"]."'"));
                                    $res = mysql_query("select * from student where class_id = '".$class["id"]."'");
                                    $sr = 1;
                                    while($row = mysql_fetch_array($res))
                                    {
                                ?>
                        <tr>
                        <th scope="row">
                            <label class="control control--checkbox">
                            <button type="button" data-toggle="modal" data-target="#exampleModal_<?php echo $row['id'] ;?>"><i class="far fa-edit"></i></button>
                            <div class="control__indicator"></div>
                            </label>
                        </th>



              <div class="modal fade" id="exampleModal_<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    
                    <?php  $query1="SELECT * FROM admin_reg where id='".$row['id']."' ";
                        $query_run2=mysql_query($query1);
                        $results = mysql_fetch_array($query_run2);
                        //echo $results['keyword']; 
                        // echo $results['question']; 					  
                    ?>
					<div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">UPDATE CURRENT ADMIN</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
						  
                        <div class="modal-body">
                            <form  method="POST" enctype="multipart/form-data">
                    
                                <div class="form-group mb-3">
                                <label for="">ID</label><input type="text" name="ID" class="form-control" value="<?php echo $results['id']; ?>">
                                <label for="">First Name</label><input type="text" name="fname" class="form-control" value="<?php echo $results['fname']; ?>">
                                <label for="">Last Name</label><input type="text" name="lname" class="form-control" value="<?php echo $results['lname']; ?>">
                                <label for="">Email</label><input type="email" name="email" class="form-control" value="<?php echo $results['email']; ?>">

                                </div>
                                <div class="form-group mb-3">
                                <button type="submit" name="update_<?php echo $row['id']; ?>" class="btn btn-success">update</button>
                                </div>

                            </form>
                        </div> 
					</div>
		        </div>
			 </div>
             <?php if(isset($_POST['update_'.$row['id']]))
                {		
                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                $email=$_POST['email'];

    
                    $que="UPDATE `admin_reg` SET `fname`='".$fname."',`lname`='".$lname."',`email`='".$email."'  WHERE id='".$row['id']."'" ;
                    mysql_query($que);
                    
                    echo "<script> alert('Updated Successfully....');</script>";
                    echo '<script>window.location.href="admin-report.php";</script>';
                }?>

              <td><?php echo $row['roll'];?></td>
              <td><?php echo $row['enroll']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['phone']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <th scope="row">
                <label class="control control--checkbox">
                <button type="button" data-toggle="modal" data-target="#deleteModal_<?php echo $row['id'] ;?>"><i class="fas fa-trash-alt"></i>ff</button>
                  <div class="control__indicator"></div>
                </label>
              </th>




            <div class="modal fade" id="deleteModal_<?php echo $row['id'];?>"tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="exampleModalLongTitle" style="text-align: center;font-size: 25px;">DELETE</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure want to delete this Admin......? </p>
                        </div>
                        <div class="modal-footer">
                        <form  method="POST" enctype="multipart/form-data">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="delete_<?php echo $row['id']; ?>" class="btn btn-success">Delete</button>
                        </form>
                        </div>
                    </div>
                </div>
			</div>
            <?php if(isset($_POST['delete_'.$row['id']]))
				  {		 
				  	$que = "delete from admin_reg where id = '".$row['id']."' ";
					mysql_query($que);
					echo '<script>window.location.href="admin-report.php";</script>';
				}?>
            </tr>         
            <?php $sr++; }
            ?>
           <?php
           echo "Number of Students added " . mysql_num_rows($res) ;
            ?>
          </tbody>
        </table>
      </div>


    </div>

    </div>	
        </div>
            <!-- End of Main Content -->

			<!-- Footer -->
			<?php
				include ('../includes/footer.php');
			?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

           


            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
