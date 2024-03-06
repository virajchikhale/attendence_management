<?php
// Start the session
session_start();
if($_SESSION["user"]==""){
    echo "<script> alert('Please login....');</script>";
    echo '<script>window.location.href="../login/teacher_login.php";</script>';
}

if(isset($_POST['Submit'])){
    $year=$_POST['year'];
    // $divi=$_POST['divi'];
    $subject=$_POST['subject'];
    $date=$_POST['date'];
    $time=$_POST['time'];
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
    <title>Mark Attendence</title>

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
            // $sub = mysql_fetch_array(mysql_query("select * from subject where teacher_id='".$ur["id"]."' AND year='".$year."'"));
            // $subject=$sub['id'];
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
                                            <li class="list-inline-item">Mark Attendence</li>
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
                        <strong>Marking</strong> Attendence
                    </div>
                    <div class="card-body card-block" id="class_details">
                        <form action="" method="post" class="form-horizontal">
                    <div  id="start_button" class="card-footer">
                        <button onclick=start() type="button" class="btn btn-info">Start Attendence</button>
                    </div>
                    
                    </form>
                </div>
            <?php
                $class = mysql_fetch_array(mysql_query("select * from class where year='".$year."' && department_id='".$ur['department_id']."'"));
            	$result = mysql_query("select * from student where class_id='".$class['id']."'");
                if (mysql_num_rows($result) > 0) {
                    $i = 1;
                    while ($row = mysql_fetch_assoc($result)) {
                        ?>
                    <div hidden id='card_<?php echo $i;?>' class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title mb-3">Roll NO. :  <b><?php echo  ucfirst($row['roll']);?></b></div>
                                            <input id="roll_<?php echo $i;?>" type="hidden" value="<?php echo  ucfirst($row['enroll']);?>">
                                        </div>
                                        <div class="card-body">
                                            <div class="mx-auto d-block">
                                                <!-- <img class="rounded-circle mx-auto d-block" src="images/icon/avatar-01.jpg" alt="Card image cap"> -->
                                                <h3 class="text-sm-center mt-2 mb-1"><?php echo  ucfirst($row['name']);?></h3>
                                                <div id="student-info" class="location text-sm-center">
                                                    <i class="fa fa-map-marker"></i><?php echo  ucfirst($row['enroll']);?></div>
                                            </div>
                                            <hr>
                                            <div class="card-text text-sm-left">
                                                <b>Note:</b>
                                                <p><i class="fa fa-minus"></i> You can use <b>Space Bar</b> to mark student as <b>Present</b></p>
                                                <p><i class="fa fa-minus"></i> You can use <b>Enter</b> to mark student as <b>Absent</b></p>

                                            </div>
                                            <hr>
                                            <div class="card-text text-sm-center">
                                                <button onclick=present() type="button" class="btn btn-success">Present</button>
                                                <button onclick=absent() type="button" class="btn btn-danger">Absent</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php
                
                        $i = $i+1;
                    }
                } else {
                    echo "0 results";
                }
            ?>
            
            <div id="success_msg" class="alert alert-success" role="alert" hidden>
                <h4 class="alert-heading">Well done!</h4>
                <hr>
                <p>Your attendence were marked successfully</p>
            </div>
           

<?php 
    include('admin_includes/footer.php')
?>
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <script>
        let i = 1;
        
		function start() {
            
            let subject = "<?php echo  $subject;?>";
            let datee = "<?php echo  $date;?>";
            let time = "<?php echo  $time;?>";

            // alert(subject);
			var x = document.getElementById("card_"+i);
			x.removeAttribute("hidden");
			var y = document.getElementById("start_button");
			y.setAttribute("hidden", true);

            
            // alert(time);

            $.ajax({
                type:'POST',
                url:'../sqloperations/mark_attendence.php',
                data:{
                    date:datee,
                    time:time,
                    subject:subject,
                    type:'fill'
                },
                success:function(return_data) {
                    // alert(return_data);
                if(return_data == "1"){
                    alert ('Something went wrong...')
                }  else{ 
                    // alert ('student added successfully')
                    // window.location.href='test.php';
                } 
                }
            });
            
            document.addEventListener('keyup', event => {
            if (event.code === 'Space') {
                present();
            }
            })

            
            document.addEventListener('keyup', event => {
            if (event.code === 'Enter') {
                absent();
            }
            })

		}

        function get_time(time){
            
            let aabb = time.split(':');
            let min = Number(aabb[1]);
            let hr = Number(aabb[0]);
            let new_mint = min + 15;
            if (new_mint >= 60){
                var new_min = (15-(60-min));
                if (hr >= 23){
                    var new_hr = 0;
                    // alert(new_hr);
                }else{
                    var new_hr = hr + 1;
                    // alert(new_hr);
                }
                // alert(new_min);
            }else{
                var new_min = new_mint;
                var new_hr = hr;
                // alert(new_min);
                // alert(new_hr);
            }
            let time15 = new_hr+":"+new_min;
            return time15;
        }
        
		function present() {
            //alert("card_"+i)

            
            let datee = "<?php echo  $date;?>";
            let time = "<?php echo  $time;?>";
            let time15 = get_time(time).toString();
 
            var roll = $('#roll_'+i).val();
            $.ajax({
                type:'POST',
                url:'../sqloperations/mark_attendence.php',
                data:{
                    date:datee,
                    time:time,
                    time15:time15,
                    roll:"S_"+roll,
                    value:"1",
                    type:'attn'
                },
                success:function(return_data) {
                    // alert(return_data);
                if(return_data == "1"){
                    alert ('Something went wrong...')
                }  else{ 
                    var x = document.getElementById("card_"+i);
                    x.setAttribute("hidden", true);
                    i = i+1;
                    var element = document.getElementById("card_"+i);
                    if (element) {
                        var x = document.getElementById("card_"+i);
                        x.removeAttribute("hidden");
                    } else {
                        // alert("Attendence Complete");
                        var x = document.getElementById("success_msg");
                        x.removeAttribute("hidden");
                        // alert("Attendence Complete");
                        setTimeout('delayer()', 2000)
                    }
                    // alert("card_"+i)
                } 
                }
            });
        }

        function absent() {
        // alert("card_"+i)
            
            let datee = "<?php echo  $date;?>";
            let time = "<?php echo  $time;?>";
            let time15 = get_time(time).toString();
            // alert(time15);

            // var timeAfter15Minutes = new Date(datee.getTime() + 15 * 60000);
            // let hr15 = timeAfter15Minutes.getHours();
            // let min15 = timeAfter15Minutes.getMinutes();
            // let time15 = hr15 + ':' + min15;

            var roll = $('#roll_'+i).val();
            $.ajax({
                type:'POST',
                url:'../sqloperations/mark_attendence.php',
                data:{
                    date:datee,
                    time:time,
                    time15:time15,
                    roll:"S_"+roll,
                    value:"0",
                    type:'attn'
                },
                success:function(return_data) {
                    // alert(return_data);
                if(return_data == "1"){
                    alert ('Something went wrong...')
                }  else{ 
                    var x = document.getElementById("card_"+i);
                    x.setAttribute("hidden", true);
                    i = i+1;
                    
                    var element = document.getElementById("card_"+i);
                    if (element) {
                        var x = document.getElementById("card_"+i);
                        x.removeAttribute("hidden");
                    } else {
                        var x = document.getElementById("success_msg");
                        x.removeAttribute("hidden");
                        // alert("Attendence Complete");
                        setTimeout('delayer()', 5000);
                    }
                    // ale
                } 
                }
            });
        }

        function delayer(){
                window.location = "attn_report.php"
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
