<?php
//session_start();
error_reporting('E_All');


$servername = "localhost";
$username = "root";
$password = "";
$database = "student_management";

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

?>