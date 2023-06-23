<?php
$user = "
<user>
    <username>
        Geeks123
    </username>
    <a>
        <b>
            2
        </b>
        <c>
            <d>
                4
            </d>
        </c>
    </a>
    <name>
        GeeksforGeeks
    </name>
    <phone>
        +91-XXXXXXXXXX
    </phone>
    <address font-color=\"blue\" font=\"awesome-fonts\" font-size=\"24px\">
        Noida, UP, India
    </address>
</user>";

//$user = "<library>
//  <book>
//    <title>Harry Potter and the Philosopher's Stone</title>
//    <author>J.K. Rowling</author>
//    <year>1997</year>
//  </book>
//  <book>
//    <title>The Great Gatsby</title>
//    <author>F. Scott Fitzgerald</author>
//    <year>1925</year>
//  </book>
//  <book>
//    <title>To Kill a Mockingbird</title>
//    <author>Harper Lee</author>
//    <year>1960</year>
//  </book>
//</library>";

$xml = new SimpleXMLElement($user);

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
print_r($emmet_str);
