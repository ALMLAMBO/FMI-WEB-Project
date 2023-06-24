<?php
session_start(); 
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    $loggedIn = true;
} else {
    $loggedIn = false;
}
include ("../config/Config.php");
include ("saveConversion.php");
$input = $_POST['input_box'];
$output = $_POST['xml_output'];
$_SESSION['last_emmet'] = $input;
$_SESSION['last_xml'] = htmlspecialchars($output);
if($loggedIn===true){
saveConversion(null,"emmet","xml",$input,$output,$_SESSION['id']);
}else{
    header("location:../index.php");
}
?>