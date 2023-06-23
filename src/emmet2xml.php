<?php
session_start(); 
include ("../config/Config.php");
include ("saveConversion.php");

saveConversion(null,"emmet","xml",$_POST['input_box'],$_POST['xml_output'],$_SESSION['id']);

?>