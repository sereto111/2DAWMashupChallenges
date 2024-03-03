<?php
$earthquake = simplexml_load_file("http://www.ign.es/ign/RssTools/sismologia.xml");

$cadena = "[";
foreach ($earthquake->channel[0]->item as $eq){
    $pos = explode(" ", $eq->description);
    $clave = array_search('fecha', $pos);
    $clave2 = array_search('localización:', $pos);
    $inicioLoc = strpos($eq->description, 'en ') + strlen('en ');
    $finLoc = strpos($eq->description, ' en', $inicioLoc);
    $loc = substr($eq->description, $inicioLoc, $finLoc - $inicioLoc);
    $cadena .= '{"date": "'.$pos[$clave+1].'", ';
    $cadena .= '"time": "'.$pos[$clave+2].'", ';
    $cadena .= '"link": "'.$eq->link.'", ';
    $cadena .= '"description": "'.$eq->description.'", ';
    $cadena .= '"magnitude": "'.$pos[7].'", ';
    $cadena .= '"location": "'.$loc.'", ';
    $cadena .= '"lat": "'.explode(",", $pos[$clave2+1])[0].'", ';
    $cadena .= '"long": "'.explode(",", $pos[$clave2+1])[1].'"},';

}
$cadena = substr($cadena, 0, -1);
$cadena .= "]";
echo $cadena;