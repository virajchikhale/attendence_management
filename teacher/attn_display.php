<?php
// Start the session
session_start();
if($_SESSION["user"]==""){
    echo "<script> alert('Please login....');</script>";
    echo '<script>window.location.href="../login/teacher_login.php";</script>';
}
if(isset($_POST['Submit'])){
    $f_date=$_POST['f_date'];
    $t_date=$_POST['t_date'];
    $year=$_POST['year'];
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
    <title>Display Report</title>

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
                                                <a href="index.php">Home</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Display Report</li>
                                        </ul>
                                    </div>
                                    <form action="attn_table.php" method="post" class="form-horizontal">
                                        <input type="hidden" id="f_date" name="f_date" value="<?php echo $f_date;?>">
                                        <input type="hidden" id="t_date" name="t_date" value="<?php echo $t_date;?>">
                                        <input type="hidden" id="year" name="year" value="<?php echo $year;?>">
                                        <button type="Submit" name="Submit" class="btn btn-success">Export to Excel Sheet</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->


            
            <!-- <section class="au-bre adcrumb m-t-75"> -->
            <br>
            <div class="container">
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Enroll</th>
                                <th>Roll</th>
                                <th>Name</th>
                            <?php
                                $class = mysql_fetch_array(mysql_query("select * from class where department_id='".$ur["department_id"]."' AND year='".$year."'"));
                                if($ur["status"]==1){                               
                                    $rees = mysql_query("select * from subject where year = '".$year."' && type = '0'");
                                }
                                else{
                                    $rees = mysql_query("select * from subject where teacher_id = '".$ur["id"]."' && year = '".$year."' && type = '0'");
                                }
                                while($roow = mysql_fetch_array($rees))
                                {
                            ?>    
                            <th><?php echo $roow['name'];?></th>
                            <?php }
                            ?>
                            
                            <th>Theory</th>
                            <?php
                                $pract_count = mysql_num_rows(mysql_query("select * from subject where teacher_id = '".$ur["id"]."' && year = '".$year."' && type = '1'"));
                                $class = mysql_fetch_array(mysql_query("select * from class where  department_id = '".$ur["department_id"]."' AND year = '".$year."'"));
                                if($ur["status"]==1){ 
                                    $rees = mysql_query("select * from subject where year = '".$year."' && type = '1'");                              
                                }
                                else{
                                    $rees = mysql_query("select * from subject where  teacher_id = '".$ur["id"]."' && year = '".$year."' && type = '1'");
                                }
                                while($roow = mysql_fetch_array($rees))
                                {
                                    // if($pract_count > 0){
                            ?>  
                              
                            <th><?php echo $roow['name'];?></th>
                            <?php 
                                    // }
                                }
                            ?>
                            <th>Practical</th>
                            <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $res = mysql_query("select * from student where class_id = '".$class["id"]."'");
                                $sr = 1;
                                while($row = mysql_fetch_array($res))
                                {
                            ?>
                            <tr>
                                <td><?php echo $row['roll'];?></td>
                                <td><?php echo $row['enroll']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                            <?php
                                $sum=0;
                                $total_lecture=0;  
                                if($ur["status"]==1){  
                                    $rees = mysql_query("select * from subject where year = '".$class["year"]."' && type = '0'");                            
                                }
                                else{
                                    $rees = mysql_query("select * from subject where teacher_id = '".$ur["id"]."' && year = '".$class["year"]."' && type = '0'");
                                }
                                while($roow = mysql_fetch_array($rees))
                                {
                                $rol = 'S_'.$row["enroll"];
                                $present = mysql_query("select ".$rol." from attendence where ".$rol." = '1' && subject = ".$roow['id']." && date BETWEEN '".$f_date."' AND '".$t_date."'");
                                $no_of_present = mysql_num_rows($present) ;
                                $absent = mysql_query("select ".$rol." from attendence where ".$rol." = '0' && subject = ".$roow['id']." && date BETWEEN '".$f_date."' AND '".$t_date."'");
                                $no_of_absent = mysql_num_rows($absent) ;
                                $total_no = $no_of_present+$no_of_absent;
                                $percent = ($no_of_present/$total_no)*100;
                            ?>    
                            <!-- <td><?php echo number_format((float)$percent, 2, '.', ''); ?></td> -->
                            <td><?php echo $no_of_present; ?> / <?php echo $total_no; ?></td>
                            <?php 
                            $sum=$sum+$no_of_present;
                            $total_lecture=$total_lecture+$total_no;
                            } $total_percent = ($sum/$total_lecture)*100;
                            ?>
                            <td><?php echo number_format((float)$total_percent, 2, '.', ''); ?>%</td>
                            <!-- <td><?php echo $sum; ?> / <?php echo $total_lecture; ?><br><?php echo number_format((float)$total_percent, 2, '.', ''); ?>%</td> -->
                            
                            
                                
                            <?php
                                $sum_prat=0;
                                $total_lecture_prat=0;
                                if($ur["status"]==1){ 
                                    $reess = mysql_query("select * from subject where year = '".$class["year"]."' && type = '1'");                              
                                }
                                else{
                                    $reess = mysql_query("select * from subject where teacher_id = '".$ur["id"]."' && year = '".$class["year"]."' && type = '1'");
                                }
                                while($rooww = mysql_fetch_array($reess))
                                {
                                $rol = 'S_'.$row["enroll"];
                                $presentt = mysql_query("select ".$rol." from attendence where ".$rol." = '1' && subject = ".$rooww['id']." && date BETWEEN '".$f_date."' AND '".$t_date."'");
                                $no_of_present_prat = mysql_num_rows($presentt) ;
                                $absentt = mysql_query("select ".$rol." from attendence where ".$rol." = '0' && subject = ".$rooww['id']." && date BETWEEN '".$f_date."' AND '".$t_date."'");
                                $no_of_absent_prat = mysql_num_rows($absentt) ;
                                $total_no_prat = $no_of_present_prat+$no_of_absent_prat;
                                $percent_prat = ($no_of_present_prat/$total_no_prat)*100;
                            ?>    
                            <!-- <td><?php echo number_format((float)$percent, 2, '.', ''); ?></td> -->
                            <td><?php echo $no_of_present_prat; ?> / <?php echo $total_no_prat; ?></td>
                            <?php 
                            $sum_prat=$sum_prat+$no_of_present_prat;
                            $total_lecture_prat=$total_lecture_prat+$total_no_prat;
                            } 
                            $total_percent_prat = ($sum_prat/$total_lecture_prat)*100;
                            ?>  
                            <td><?php echo number_format((float)$total_percent_prat, 2, '.', ''); ?>%</td>
                            <td><?php
                            if($total_lecture_prat == 0){
                                echo number_format((float)(($total_percent)), 2, '.', '');
                            } else{
                                echo number_format((float)(($total_percent_prat+$total_percent)/2), 2, '.', '');
                            } ?>%</td>
                                
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

            <!-- End of Main Content -->

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

           


    <?php 
    include('admin_includes/footer.php')
?>
            <!-- END PAGE CONTAINER-->

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
