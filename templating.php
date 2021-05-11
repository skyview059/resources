<?php


$html = '<p>Name: %name%</p>';
$html .= '<p>Age: %age%</p>';
$html .= '<p>Gender: %gender%</p>';


$varables = [
    '%name%'      => 'Kanny',
    '%age%'       => '34',
    '%gender%'    => 'Male',
];

$search     = array_keys($varables);
$replace    = array_values($varables);
$body       = str_replace($search, $replace, $html );    


print_r($body);
