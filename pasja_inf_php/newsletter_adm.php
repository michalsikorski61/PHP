<?php
    session_start();
    if(isset($_SESSION['logged_adm_id'])){
        header('Location: list.php');
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
    <header>
        <h1>Admin</h1>
    </header>
    <main>
        <article>
            <form method="post" action="list.php">
                <div>
                    <label for="login">Login</label>
                    <input type="text" name="login" value="<?= isset($_SESSION['given_login'])? $_SESSION['given_login'] : '' ?>">
                </div>
                <div>
                    <label for="pass">Hasło</label>
                    <input type="password" name="pass">
                </div>
                <div>
                    <input type="submit" value="Zaloguj się!">
                </div>
                <?php
                    if(isset($_SESSION['login_error'])){
                        echo $_SESSION['login_error'];
                        unset($_SESSION['login_error']);
                    }
                ?>
            </form>
        </article>
    </main>
</div>

</body>
</html>