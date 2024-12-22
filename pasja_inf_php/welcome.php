<?php
    session_start();
    if(!isset($_SESSION['register_success'])){
        header('Location: index.php');
        exit();
    }else{
        unset($_SESSION['register_success']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Osadnicy - browser game</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    Dziękujemy za rejestrację w serwisie! Możesz już zalogować się na swoje konto!<br><br>
    <a href="index.php">Zaloguj się na swoje konto!</a>
</body>
</html>