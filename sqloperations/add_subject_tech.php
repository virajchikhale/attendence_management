<?php
include('../includes/connection.php');

$teacher_id=$_POST['teacher_id'];
$subject_id=$_POST['subject_id'];

// $i="select * from hod_reg where department_id='".$department."'";
// $x=mysql_fetch_array(mysql_query($i));
$sqlinsert="UPDATE subject SET teacher_id ='".$teacher_id."' where id='".$subject_id."'";
$res=mysql_query($sqlinsert);

        
if($res) {
        echo "0";
        }
else{
        echo "1";
}
?>