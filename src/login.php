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
$row = mysqli_fetch_assoc($res);

if ($row['username'] === $username && $row['password'] === $password) {
	$_SESSION['username'] = $row['username'];
	$_SESSION['id'] = $row['id'];
	$_SESSION['loggedIn'] = true;
	$loggedIn = true;
	header("location:../index.php?message=Welcome back, ".$username."!");
}
}
else
{
	header("location:../login.php?error=Incorect Username or password");
	//echo "<h1> failed </h1>";
}

?>