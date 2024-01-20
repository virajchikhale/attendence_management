<?php
session_start();
include('../includes/connection.php');

$email=$_POST['email'];
$password=md5($_POST['password']);
$table=$_POST['table'];
$sql="SELECT * FROM $table WHERE `email` = '".$email."' AND `password`='".$password."'";
$result=mysqli_query($con, $sql);
$cont=mysqli_num_rows( $result );

        //echo $sql;
if($cont>=1) {
        $_SESSION['user'] = "$email";
        echo $email;
        }
else{
        echo "1";
}
?>