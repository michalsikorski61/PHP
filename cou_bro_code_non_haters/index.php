<?php
include 'database.php';
$username = 'John Doe';
$password = 'pass1';
$password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (user, pass) VALUES ('$username', '$password')";//bad passing vars - attack possible

try{
    mysqli_query($conn, $sql);
    echo 'User added';
}catch(mysqli_sql_exception $e){
    echo 'Query failed <br/>';
}



mysqli_close($conn);