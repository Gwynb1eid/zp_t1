<?php

header('Content-Type: text/html; charset=utf-8');

$server="localhost";
$username="root";
$password="";
$database="zpt1db";

$mysqli = new mysqli($server,$username, $password, $database);

$mysqli->set_charset('utf8');

//$address_site = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//echo $address_site;


$address_site = "http://localhost/zptest1/";



?>
