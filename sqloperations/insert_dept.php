<?php
include('../includes/connection.php');

$dept=$_POST['dept'];
$value=$_POST['value'];

// $i="select * from hod_reg where department_id='".$department."'";
// $x=mysql_fetch_array(mysql_query($i));
$sqlinsert="insert into department(name, status) 
values('".$dept."', '".$value."' )";

$res=mysql_query($sqlinsert);

        
if($res) {
        echo "0";
        }
else{
        echo "1";
}
?>