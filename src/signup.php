<?php
session_start(); 
include ("../config/Config.php");
$conn = Config::mysql_conection(); 

$username = $_POST['username'];
$password = $_POST['password'];
$conf_pass = $_POST['conf_password'];
$email = $_POST['email'];

if($conf_pass!=$password){
    header("location:../register.php?error=Your password and confirmation password do not match.");
}else{
    $sql="INSERT INTO users(username,email,password) VALUES(?,?,?)";
    $query=$conn->prepare($sql);
    $query->bind_param('sss',$username,$email,$password);
    $exec= $query->execute();
     if($exec==true)
     {
        header("location:../index.php?message=Succsesful registration.");
     }
     else
     {
        header("location:../register.php?error=Something went wrong.");
     }
}
?>
