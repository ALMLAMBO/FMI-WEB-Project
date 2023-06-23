<?php
session_start();
include ("../config/Config.php");
include ("../src/saveConversion.php");
$xml_string = $_POST['input_box'];
echo $xml_string;
$output = $_POST['emmet_output'];

$xml = new SimpleXMLElement($xml_string);

function xml_to_emmet($xml) {
    $emmet = '';

    $root_tag = $xml->getName();
    $value = trim((string)$xml);

    $emmet .= $root_tag;

    $attributes = $xml->attributes();

    if ($attributes) {
        foreach ($attributes as $attrName => $attrValue) {
            $emmet .= '[' . $attrName . '=' . $attrValue . ']';
        }
    }

    if ($value !== '') {
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
saveConversion("2","xml", "emmet", $xml_string, $emmet_str, $_SESSION['id']);