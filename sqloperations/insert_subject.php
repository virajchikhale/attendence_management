<?php
include('../includes/connection.php');
include('../includes/vendor/phpmailer/src/SSOP.php');

$name=$_POST['name'];
$code=$_POST['code'];
$dept=$_POST['dept'];
$type=$_POST['type'];
$year=$_POST['year'];

// $i="select * from hod_reg where department_id='".$department."'";
// $x=mysql_fetch_array(mysql_query($i));
$sqlinsert="insert into subject(code, name, type, department_id, year) 
values('".$code."', '".$name."', '".$type."',  '".$dept."', '".$year."')";

$res=mysql_query($sqlinsert);

        
if($res) {
        echo "0";
        }
else{
        echo "1";
}
?>