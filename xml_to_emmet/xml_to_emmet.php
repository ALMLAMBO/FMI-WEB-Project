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
$xml = new SimpleXMLElement($user);
function xml_to_emmet($xml, $level) {
    $emmet = '';
    $root = $xml->getName();
    $emmet .= $root;
    $inner_element_level = 1;

    //WORKS
    if($xml->attributes()) {
        foreach($xml->attributes() as $attr => $val) {
            $emmet .= '.'.$attr.'{'.$val.'}';
        }
    }

    $children = $xml->children();
    if(count($children) > 0) {
        if($level > 0) {
            $emmet = '('.$emmet;
        }
        $level = $level + 1;
        $emmet .= '>';
        foreach($children as $child) {
            $emmet .= xml_to_emmet($child, $level);
        }
    }
    else {
        $emmet .= '{'.$xml.'}';
        $emmet .= str_repeat(')', ($level - $inner_element_level)).'+';
        return $emmet;
    }

    return $emmet;
}

$emmet = xml_to_emmet($xml, 0);
print_r($emmet);

?>