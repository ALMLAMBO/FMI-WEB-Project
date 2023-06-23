<?php
session_start(); 
include ("../config/Config.php");
include ("saveConversion.php");
$input = $_POST['input_box'];
$output = $_POST['xml_output'];
$_SESSION['last_emmet'] = $input;
$_SESSION['last_xml'] = htmlspecialchars($output);

saveConversion(null,"emmet","xml",$input,$output,$_SESSION['id']);

?>