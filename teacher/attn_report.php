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
    <title>Report Details</title>

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

<body onload=onload() class="animsition">
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
                                            <li class="list-inline-item">Report Details</li>
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
        
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Details for</strong> Attendence Report
                    </div>
                    <div class="card-body card-block" id="class_details">
                        <form action="attn_display.php" method="post" class="form-horizontal">
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="select" class=" form-control-label">From Date</label>
                                </div>
                                <div class="col-12 col-md-3">
                                    <input type="date" id="f_date" name="f_date" class="form-control">
                                </div>
                                <div class="col col-md-2">
                                    <label for="select" class=" form-control-label">To Date</label>
                                </div>
                                <div class="col-12 col-md-3">
                                    <input type="date" id="t_date" name="t_date" class="form-control">
                                </div>
                            </div>
                    </div>
                    <div  id="start_button" class="card-footer">
                        <button type="Submit" name="Submit" class="btn btn-info">Start Attendence</button>
                    </div>
                    
                    </form>
                </div>
           


                <?php 
    include('admin_includes/footer.php')
?>
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <script>

        var date = new Date();
        var currentDate = date.toISOString().substring(0,10);

        document.getElementById('f_date').value = currentDate;
        document.getElementById('t_date').value = currentDate;
        let i = 1;
        
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
