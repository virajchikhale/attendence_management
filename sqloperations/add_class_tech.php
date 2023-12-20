<?php
include('../includes/connection.php');

$teacher_id=$_POST['teacher_id'];
$class_id=$_POST['class_id'];

// $i="select * from hod_reg where department_id='".$department."'";
// $x=mysql_fetch_array(mysql_query($i));
$sqlinsert="UPDATE class SET teacher_id ='".$teacher_id."' where id='".$class_id."'";
$sqlinsert1="UPDATE teacher_reg SET status ='1'";

$res1=mysql_query($sqlinsert1);
$res=mysql_query($sqlinsert);

        
if($res) {
        echo "0";
        }
else{
        echo "1";
}
?>