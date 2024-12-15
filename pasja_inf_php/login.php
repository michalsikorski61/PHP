<?php
session_start();

require_once 'dbconnect.php';

try{
    $connection = @new mysqli($host, $user, $pass, $db_name);
}catch(Exception $e){
    echo "Error: ". $e->getMessage();
    exit();
 }


if($connection->connect_errno != 0){
    echo "Error connecting to database";
    exit();
 }
else{
    $login = $_POST['login'];
    $password = $_POST['password'];
    // echo 'Login: '.$login;
    // echo 'Password: '.$password;
    // $password =  password_hash($password,PASSWORD_DEFAULT);
    $sql = "SELECT * FROM uzytkownicy WHERE user='$login' AND pass='$password'";
    if($result = @$connection->query($sql)){
        $how_many_usrs = $result->num_rows;
        if($how_many_usrs > 0){
            //finded in user
            $row = $result->fetch_assoc();
            $_SESSION['usr_name'] =  $row['user'];
            $_SESSION['drewno'] = $row['drewno'];
            $_SESSION['kamien'] = $row['kamien'];
            $_SESSION['zboze'] = $row['zboze'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['dnipremium'] = $row['dnipremium'];

            
            //destory error variable
            unset($_SESSION['error']);
            // zwalniamy pamięć bo nie potrzebujemy
            $result->free_result();
            header('Location: game.php');
        }else{
            //not finded in user
            $_SESSION['error'] = '<span style="color:red;">Nieprawidłowy login lub hasło</span>';
            header('Location: index.php');
        }
    }
    $connection->close();
}