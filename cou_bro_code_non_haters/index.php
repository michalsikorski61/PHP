<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="usrname">Username:</label><br/>
        <input type="text" name="username" value="<?= $_POST['username'] ?? ''?>"> <br/>
        <label for="pass">Passwrod:</label> <br/>
        <input type="password" name="pass" value="<?= $_POST['pass'] ?? ''?>"> <br/>
        <input style="border-radius:10px; width: 10rem; margin-top:.5rem; margin-left:auto; margin-right:auto; background:green; color:white; font-weight:bold; padding: .3rem" type="submit" name="login" value="Log in">
    </form>
</body>
</html>
<?php
    // isset() - returns true if variable is set and not null
    // empty() - returns true if variable is empty, not declared, null, ""
    foreach($_POST as $key => $value){
        echo $key . " : " . $value . "<br/>";
    }
    if(isset($_POST['login'])){
        $usrname = $_POST['username'];
        $pass = $_POST['pass'];

        if(empty($usrname)){
            echo "Username is required";
        }elseif(empty($pass)){
            echo "Password is required";
        }else{
            echo "Username: " . $usrname . "<br/>";
            echo "Password: " . $pass . "<br/>";
        }
        
    }