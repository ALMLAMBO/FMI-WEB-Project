<?php
session_start();
include ("../config/Config.php");
include ("../src/saveConversion.php");
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    $loggedIn = true;
} else {
    $loggedIn = false;
}
$xml_string = $_POST['input_box'];
$output = $_POST['emmet_output'];

$xml = new SimpleXMLElement($xml_string);

function xml_to_emmet($xml) {
    $emmet = '';

    $root_tag = $xml->getName();
    $value = trim((string)$xml);

    $emmet .= $root_tag;

    $attributes = $xml->attributes();

    if ($attributes) {
        if(isset($_POST['attributes']) || isset($_POST['attributes_val'])) {
            foreach ($attributes as $attrName => $attrValue) {
                $emmet .= '.' . $attrName;
                if(isset($_POST['attributes_val'])) {
                    $emmet .= '{' . $attrValue . '}';
                }
            }
        }
    }

    if ($value !== '' && isset($_POST['text'])) {
        $emmet .=  '{' . $value . '}';
    }

    $children = $xml->children();

    $groups = array();
    if (count($children) > 0) {
        $emmet = '(' . $emmet;
        foreach ($children as $child) {
            $groups[] = xml_to_emmet($child);
        }

        $emmet .=  '>' . implode('+', $groups) . ')';
    }

    return $emmet;
}

$emmet = xml_to_emmet($xml);
$emmet_str = substr($emmet, 1, -1);
$_SESSION['last_emmet'] = $emmet_str;
$_SESSION['last_xml'] = htmlspecialchars($xml_string);
if($loggedIn === true) {
    saveConversion("2", "xml", "emmet", $xml_string, $emmet_str, $_SESSION['id']);
}
else {
    header("location:../index2.php");
}