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
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="container">
    <blockquote>
            Tylko martwi ujrzeli koniec wojny - Platon
        </blockquote>

        <div class="register_link">
        <a href="register.php">Rejestracja - załóż darmowe konto!</a>
        </div>

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

        <!-- newsletter form -->
        <div class="newsletter-container">
            <form action="save.php" method="post">
                <div><label>Adres email:</label>
                    <input type="text" name="email" value="<?= isset($_SESSION['given_email'])? $_SESSION['given_email'] : '' ?> "></div>
                <input type="submit" value="Sing in for newsletter">
                <?php
                    if(isset($_SESSION['email_error'])){
                        echo $_SESSION['email_error'];
                        unset($_SESSION['email_error']);
                    }
                ?>
            </form>
            <a href="newsletter_adm.php">Newsletter admin</a>
        </div>
   </div>
</body>
</html>