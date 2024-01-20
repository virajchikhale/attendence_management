<?php
include('../includes/connection.php');
//error_reporting('E_ALL');
$code = $_POST['code'];

        $sql="SELECT * from details where principal_verification='".$code."'";
        $result=mysqli_query($con, $sql);
        $cnt=mysqli_num_rows($result);
        if($cnt > 0) {
                echo "0";
                }
        else{
                echo "1";
        }
?>