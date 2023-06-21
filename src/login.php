<?php
session_start(); 
include ("../config/Config.php");
$conn = Config::mysql_conection(); 

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username'and password='$password'";

$res = mysqli_query($conn,$query);
$numRows = mysqli_num_rows($res);
if($numRows  == 1){
//echo "<h1> You are login Successfully </h1>";
header("location:../index.html");
}
else
{
	header("location:../login.html");
	//echo "<h1> failed </h1>";
}

?>