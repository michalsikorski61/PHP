<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header_remove</title>
</head>
<body>
    This the home page <br>
    <form action="home.php" method="post">
        <input type="submit" name="logout" value="logout">
    </form>
    <?php
        echo $_SESSION['username'] . '<br>';
        echo $_SESSION['password'] . '<br>'; 

        if(isset($_POST['logout'])){
            $_SESSION = [];
            
            setcookie(session_name(),'',time()-100);
            session_destroy();
            session_unset();
            
            
            header('Location: index.php');
            exit();
        }
    ?>
</body>
</html>