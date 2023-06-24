<?php
session_start();

include ("../config/Config.php");
$conn =  Config::mysql_conection(); 
echo $_POST['conv_id'];
$id = $_POST['conv_id'];
$query = "SELECT * FROM conversions WHERE id='$id'";
$res = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($res);

if($row['from_what']=="xml"){
    $_SESSION['last_emmet'] = $row['result_from_conversion'];
    $_SESSION['last_xml'] = htmlspecialchars($row['content_to_convert']);
    header("location:../index2.php");
}else{
    $_SESSION['last_emmet'] = $row['content_to_convert'];
    $_SESSION['last_xml'] = htmlspecialchars($row['result_from_conversion']);
    header("location:../index.php");
}

?>