<?php

$db_server = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'bro_code_for_non_haters';
$conn = '';

try{

    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name, '8111');
}catch(mysqli_sql_exception $e){
    echo 'Connection failed <br/>';
}

