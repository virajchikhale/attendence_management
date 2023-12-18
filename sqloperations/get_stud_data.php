<?php
session_start();
include('../includes/connection.php');



$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
$data = array();
$result = mysql_query("select * from student");
if (mysql_num_rows($result) > 0) {
        
        echo '[';
    while ($row = mysql_fetch_assoc($result)) {
        // echo $row['roll'];
        // echo '-';
        // echo $row['enroll'];
        // echo '-';
        // echo $row['name'];
        // echo '-';
        // echo $row['phone'];
        // echo '-';
        // echo $row['email'];
        // echo '_';

        echo ("{roll:'".$row['roll']."', enroll:'".$row['enroll']."', name:'".$row['name']."', phone:'".$row['phone']."', email:'".$row['email']."'},");

    }
    
    echo ']';
} 
// echo $row;


// $email=$_POST['email'];
// $password=md5($_POST['password']);
// $table=$_POST['table'];
// $sql="SELECT * FROM $table WHERE `email` = '".$email."' AND `password`='".$password."'";
// $result=mysql_query($sql);
// $cont=mysql_num_rows($result);

//         //echo $sql;
// if($cont>=1) {
//         $_SESSION['user'] = "$email";
//         echo $email;
//         }
// else{
//         echo "1";
// }
?>