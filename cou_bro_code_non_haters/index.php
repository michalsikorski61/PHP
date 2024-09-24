<?php
$username = "Michalski9";
$username = strtolower($username);

echo $username . "<br>";

$username = strtoupper($username);
echo $username . "<br>";

$username = str_pad($username, 20, "*");
echo $username . "<br>";

$phone_number = "343-323-231";
$phone_number = str_replace("-", "/", $phone_number);
echo $phone_number . "<br>";
$username = strrev($username);
$username = str_replace("*", "", $username);
$username = str_repeat($username, 2);
echo $username . "<br>";
$username = str_shuffle($username);
echo $username . "<br>";
$equals = strcmp($username, "Michalski9");
echo $equals . "<br>";
$lenght = strlen($username);
echo $lenght . "<br>";
$pos = strpos($username, "9");
echo $pos . "<br>";
$substr = substr($username, 0, 5);
echo $substr . "<br>";
//substr all after 5
$substr = substr($username, 5);
echo $substr . "<br>";
//insert spaces 
$substr = substr($username, 0, 5) . " " . substr($username, 5,8) . " " . substr($username, 8);
echo $substr . "<br>";
$tabstr = explode(" ", $substr);
var_dump($tabstr);
echo "<br>";
$str = implode("; ", $tabstr);
echo $str . "<br>";