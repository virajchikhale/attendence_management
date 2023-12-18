<?php
include('../includes/connection.php');

$name=$_POST['name'];
$roll=$_POST['roll'];
$enroll=$_POST['enroll'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$table=$_POST['table'];

if($table=="student"){
        // $i="select * from hod_reg where department_id='".$department."'";
        // $x=mysql_fetch_array(mysql_query($i));
        $sqlinsert="insert into student(roll, enroll, name, phone, email) 
        values('".$roll."' , '".$enroll."', '".$name."', '".$phone."', '".$email."')";
        $sqlinsert1="ALTER TABLE attendence ADD S_".$enroll." int(11) NOT NULL DEFAULT '-1'" ;

}

$res1=mysql_query($sqlinsert1);
$res=mysql_query($sqlinsert);

        
if($res) {
        echo "0";
        }
else{
        echo "1";
}
?>