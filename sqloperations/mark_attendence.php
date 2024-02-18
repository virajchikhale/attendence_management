<?php
include('../includes/connection.php');

$date=$_POST['date'];
$time=$_POST['time'];
$time15=$_POST['time15'];
$subject=$_POST['subject'];
$value=$_POST['value'];
$roll=$_POST['roll'];
$type=$_POST['type'];

if($type=="fill"){
        $sqlinsert="insert into attendence(date, time, subject) 
        values('".$date."' , '".$time."', '".$subject."')";

}else if($type=="attn"){
        $sqlinsert="UPDATE attendence SET $roll ='".$value."'  WHERE date='".$date."' && time BETWEEN '".$time."' AND '".$time15."'" ;

}

$res=mysql_query($sqlinsert);

        
if($res) {
        echo "0";
        }
else{
        echo $sql;
}
?>