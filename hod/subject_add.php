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
    <title>Add Subject</title>

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
			$ur = mysql_fetch_array(mysql_query("select * from hod_reg where email='".$_SESSION["user"]."'"));
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
                                            <li class="list-inline-item">Add Subject</li>
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
                                        <h3 class="text-center title-2">Add Subject in the system</h3>
                                    </div>
                                    <hr>
                                    <form action="" method="post" novalidate="novalidate">
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Subject Name</label>
                                            <input id="name" name="phone" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter name of subject name">
                                        </div>                                        
                                        <input id="dept" name="dept" type="hidden" value="<?php echo $ur['department_id'];?>">
                                        <div class="form-group">
                                            <label for="code" class="control-label mb-1">Subject Code</label>
                                            <input id="code" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter name of subject code">
                                        </div>
                                        <div class="form-row">
                                            <select class="form-control" id="type" name="type" onchange=selectnone(this.id)>
                                            <option value="none">Select type</option>
                                                    <option value="1">Practical</option>
                                                    <option value="0">Theory</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <select class="form-control" id="year" name="year" onchange=selectnone(this.id)>
                                            <option value="none">Select Year</option>
                                                    <option value="1">First Year</option>
                                                    <option value="2">Second Year</option>
                                                    <option value="3>">Third Year</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div>
                                            <button  onclick=response()  id="payment-button" type="button" class="btn btn-lg btn-info btn-block">
                                                <i class="fa fa-plus fa-lg"></i>&nbsp;
                                                <span id="payment-button-amount">ADD Subject</span>
                                                <span id="payment-button-sending" style="display:none;">Adding...</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Teacher</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                        
                                        <?php
                                            $res = mysql_query("select * from subject where department_id = '".$ur['department_id']."'");
                                            $idd = 1;
                                            while($row = mysql_fetch_array($res))
                                            {

                                        ?>
                                        <tr>
                                            <td> <?php echo $idd;?></td>
                                            <td><?php echo $row['name']; ?></td>   
                                            <td><?php echo $row['code']; ?></td>                                        
                                             <?php 
                                            if($row['teacher_id']=='0'){
                                                ?>
                                                <td>
                                            <input id="subject_id" name="subject_id" type="hidden" value="<?php echo $row['id'];?>">
                                                <div class="form-row">
                                                    <select class="form-control" id="teacher_id" name="teacher_id" onchange=selectnone(this.id)>
                                                    <option value="none">Select Teacher to be assined</option>
                                                    <?php
                                                        $res1 = mysql_query("select * from teacher_reg where department_id = '".$ur['department_id']."'");
                                                        $i = 1;
                                                        while($row1 = mysql_fetch_array($res1))
                                                                { ?>
                                                            <option value="<?php echo $row1['id']; ?>"><?php echo $row1['first_name']; echo " ".$row1['last_name'];?></option>
                                                        <?php $i++;} ?> 
                                                    </select>
                                                </div>
                                                <br>
                                                <button  onclick=add_teacher()  id="add_class_tech_<?php echo $row['id'];?>" type="button" class="btn btn-sm btn-info btn-block btn-warning">
                                                    <span id="payment-button-amount">Assign Class Teacher</span>
                                                </button>
                                                <script>
                                                    function add_teacher() {
                                                        var teacher_id = $('#teacher_id').val();
                                                        var subject_id = $('#subject_id').val();
                                                        // alert(division);
                                                        // alert(year);
                                                        // alert(dept);
                                                        if(teacher_id=="none"){
                                                            $('#teacher_id').val('');
                                                            $('#teacher_id').focus();
                                                        }else{
                                                        $.ajax({
                                                        type:'POST',
                                                        url:'../sqloperations/add_subject_tech.php',
                                                        data:{
                                                            teacher_id:teacher_id,
                                                            subject_id:subject_id
                                                        },
                                                        success:function(return_data) {
                                                            // alert(return_data);
                                                        if(return_data == "1"){
                                                            alert ('Something went wrong...');
                                                        }  else{ 
                                                            alert ('Teacher assigned successfully');
                                                            window.location.href='subject_add.php';
                                                        } 
                                                        }
                                                    });}
                                                    }
                                                </script>
                                                </td>
                                                <?php
                                            }else{
                                                ?>
                                            <td><?php
                                                $res2 = mysql_query("select * from teacher_reg where id='".$row['teacher_id']."'");
                                                $row2 = mysql_fetch_array($res2);
                                            echo $row2['first_name'];echo " ".$row2['last_name'];?></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php $idd++; }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE-->
                        </div>
                    </div>
                </div>
            </div>
                

            <?php
                include ('admin_includes/footer.php');
            ?>
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <script>


		function response() {
            var name = $('#name').val();
            var code = $('#code').val();
            var dept = $('#dept').val();
            var type = $('#type').val();
            var year = $('#year').val();
            // alert(division);
            // alert(year);
            // alert(dept);
            $.ajax({
            type:'POST',
            url:'../sqloperations/insert_subject.php',
            data:{
                name:name,
                code:code,
                year:year,
                type:type,
                dept:dept
            },
            success:function(return_data) {
                // alert(return_data);
            if(return_data == "1"){
                alert ('Something went wrong...');
            }  else{ 
                alert ('Subject added successfully');
                window.location.href='subject_add.php';
            } 
            }
        });}
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
