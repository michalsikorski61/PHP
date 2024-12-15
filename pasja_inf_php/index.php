<?php
    session_start();
    if(isset($_SESSION['logged'])){
        header('Location: game.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Osadnicy - browser game</title>
</head>
<body>
    <blockquote>
        Tylko martwi ujrzeli koniec wojny - Platon
    </blockquote>

    <form action="login.php" method="POST">
        <div>
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required>
        </div>

        <div>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit">Log in</button>
    </form>
    <?php
        if(isset($_SESSION['error'])){
           echo $_SESSION['error'];
        }
    ?>
</body>
</html>