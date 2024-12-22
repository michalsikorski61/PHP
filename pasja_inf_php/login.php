<?php
session_start();
if(!isset($_POST['login']) && !isset($_POST['password']))
{
    header("Location: index.php");
    exit();  //stop further execution if user is not logged in
}
require_once 'dbconnect.php';

try{
    $connection = new mysqli($host, $user, $pass, $db_name);
}catch(Exception $e){
    echo "Error: we received an error while connecting to the database";
    echo "<a href='index.php'>Back to main page</a>";
    exit();
 }


try{
    if($connection->connect_errno != 0){
        throw new Exception(mysqli_connect_errno());
    }else{
        $login = $_POST['login'];
        $password = $_POST['password'];

        //for security reasons
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        // $password = htmlentities($password, ENT_QUOTES, "UTF-8");
        // echo 'Login: '.$login;
        // echo 'Password: '.$password;
        // $password =  password_hash($password,PASSWORD_DEFAULT);
        
        if($result = @$connection->query(sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",mysqli_real_escape_string($connection,$login)))){
            $how_many_usrs = $result->num_rows;
            if($how_many_usrs > 0){
                //finded in user
                $row = $result->fetch_assoc(); //before use data from database we have to fetch 
                //pass verify
                if(password_verify($password, $row['pass'])==true){

                    //usr's metadata
                    $_SESSION['logged'] = true;
                    $_SESSION['user_id'] = $row['id'];
        
                    //data to show
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
            }else{
                //not finded in user
                $_SESSION['error'] = '<span style="color:red;">Nieprawidłowy login lub hasło</span>';
                header('Location: index.php');
            }
        }
        $connection->close();
    }
}catch(Exception $e){
    echo "Error: we received an error while connecting to the database";
    echo "<a href='index.php'>Back to main page</a>";
    exit();
}
