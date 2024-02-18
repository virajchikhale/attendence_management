<?php
// Start the session
session_start();
if($_SESSION["user"]==""){
    echo "<script> alert('Please login....');</script>";
    echo '<script>window.location.href="../login/teacher_login.php";</script>';
}
if(isset($_POST['Submit'])){
    $f_date = $_POST['f_date'];
    $t_date = $_POST['t_date'];
}

			include ('../includes/connection.php');	
			$ur = mysql_fetch_array(mysql_query("select * from teacher_reg where email='".$_SESSION["user"]."'"));
            $sql1="select * from admin_reg";
            $sql2="select * from principal_reg";
            $sql3="select * from hod_reg";
            $sql4="select * from teacher_reg";
            $sql5="select * from department";
            $result1=mysql_query($sql1);
            $result2=mysql_query($sql2);
            $result3=mysql_query($sql3);
            $result4=mysql_query($sql4);
            $result5=mysql_query($sql5);
            $admin=mysql_num_rows($result1);
            $principal=mysql_num_rows($result2);
            $hod=mysql_num_rows($result3);
            $teacher=mysql_num_rows($result4);
            $department=mysql_num_rows($result5);

            
$html='<table><tr><td>Enroll</td><td>Roll</td><td>Name</td>';

$class = mysql_fetch_array(mysql_query("select * from class where teacher_id='".$ur["id"]."'"));
$rees = mysql_query("select * from subject where year = '".$class["year"]."' && type = '0'");

while($roow = mysql_fetch_array($rees))
{
	$html.='<td>'.$roow['name'].'</td>'; 
}
	$html.='<td>Theory</td>';

$class = mysql_fetch_array(mysql_query("select * from class where teacher_id='".$ur["id"]."'"));
$rees = mysql_query("select * from subject where year = '".$class["year"]."' && type = '1'");

while($roow = mysql_fetch_array($rees))
{
    
	$html.='<td>'.$roow['name'].'</td>'; 
}
    
	$html.='<td>Practical</td>';
	$html.='<td>Total</td></tr>';

    $res = mysql_query("select * from student where class_id = '".$class["id"]."'");
    $sr = 1;
    while($row = mysql_fetch_array($res))
    {
        $html.='<tr><td>'.$row['roll'].'</td><td>'.$row['enroll'].'</td><td>'.$row['name'].'</td>';

        $sum=0;
        $total_lecture=0;
        $rees = mysql_query("select * from subject where year = '".$class["year"]."' && type = '0'");

        while($roow = mysql_fetch_array($rees))
        {
            $rol = 'S_'.$row["enroll"];
            $present = mysql_query("select ".$rol." from attendence where ".$rol." = '1' && subject = ".$roow['id']." && date BETWEEN '".$f_date."' AND '".$t_date."'");
            $no_of_present = mysql_num_rows($present) ;
            $absent = mysql_query("select ".$rol." from attendence where ".$rol." = '0' && subject = ".$roow['id']." && date BETWEEN '".$f_date."' AND '".$t_date."'");
            $no_of_absent = mysql_num_rows($absent) ;
            $total_no = $no_of_present+$no_of_absent;
            $percent = ($no_of_present/$total_no)*100;

            $html.='<td>'.$no_of_present.' | '. $total_no.'</td>';

            $sum=$sum+$no_of_present;
            $total_lecture=$total_lecture+$total_no;
        } 
        $total_percent = ($sum/$total_lecture)*100;

        $html.='<td>'.number_format((float)$total_percent, 2, '.', '').'%</td>';

        $sum_prat=0;
        $total_lecture_prat=0;
        $reess = mysql_query("select * from subject where year = '".$class["year"]."' && type = '1'");

        while($rooww = mysql_fetch_array($reess))
        {
            $rol = 'S_'.$row["enroll"];
            $presentt = mysql_query("select ".$rol." from attendence where ".$rol." = '1' && subject = ".$rooww['id']." && date BETWEEN '".$f_date."' AND '".$t_date."'");
            $no_of_present_prat = mysql_num_rows($presentt) ;
            $absentt = mysql_query("select ".$rol." from attendence where ".$rol." = '0' && subject = ".$rooww['id']." && date BETWEEN '".$f_date."' AND '".$t_date."'");
            $no_of_absent_prat = mysql_num_rows($absentt) ;
            $total_no_prat = $no_of_present_prat+$no_of_absent_prat;
            $percent_prat = ($no_of_present_prat/$total_no_prat)*100;

            $html.='<td>'.$no_of_present_prat.' | '.$total_no_prat.'</td>';
            
            $sum_prat=$sum_prat+$no_of_present_prat;
            $total_lecture_prat=$total_lecture_prat+$total_no_prat;
        } 
        $total_percent_prat = ($sum_prat/$total_lecture_prat)*100;

        
        $html.='<td>'.number_format((float)$total_percent_prat, 2, '.', '').'%</td>';
        $html.='<td>'.number_format((float)(($total_percent_prat+$total_percent)/2), 2, '.', '').'%</td></tr>';
        $sr++; }
        $html.='</tr></table>';

        
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=report.xls");
            // header('Content-Type:application/xls');
            // header('Content-Disposition:attachment;filename=report.xls');
        echo $html;
        
        ?>
                    

