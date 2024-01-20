<?php
include('../includes/connection.php');
//error_reporting('E_ALL');
$email = $_POST['email'];
$table = $_POST['table'];
$type = $_POST['type'];

$sql="SELECT * from $table where email='".$email."'";
$result=mysqli_query($con, $sql);
$cnt=mysqli_num_rows($result);
$otp = (rand(100000,999999));
if($type=="reg"){
        if($cnt > 0) {
                echo "1";
                }
        else{
                echo $otp;
        }
}else if($type=="forgot"){
        if($cnt > 0) {
                echo $otp;
                }
        else{
                echo "1";
        }
}
?>