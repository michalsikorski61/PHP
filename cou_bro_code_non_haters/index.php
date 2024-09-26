<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="username">Username:</label><br><input type="text" name="username" id="username"> <br>
        <label for="password">Password:</label><br><input type="password" name="password" id="password"><br>
        <input type="submit" name="login" value="Log in">
   </form>
</body>
</html>
    <?php
        if(isset($_POST['login'])){
            
            if(!empty($_POST['username']) && !empty($_POST['password'])){
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = $_POST['password'];
                // echo $_SESSION['username'] . '<br/>';
                // echo $_SESSION['password'] . '<br/>';
                header('Location: home.php');
                exit();
            }else{
                echo 'Please fill in the fields';
            }
        }
    ?>