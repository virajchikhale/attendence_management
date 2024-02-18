<?php
include('../includes/connection.php');

$dept=$_POST['dept'];
$year=$_POST['year'];
$division=$_POST['division'];

// $i="select * from hod_reg where department_id='".$department."'";
// $x=mysql_fetch_array(mysql_query($i));
$sqlinsert="insert into class(year, divi, department_id, teacher_id) 
values('".$year."', '".$division."', '".$dept."', '0' )";

$res=mysql_query($sqlinsert);

        
if($res) {
        echo "0";
        }
else{
        echo "1";
}
?>