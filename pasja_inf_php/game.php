<?php
session_start();
if(!isset($_SESSION['logged'])){
    header('Location: index.php');
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
    <?php
        echo '<p>Hello, '. $_SESSION['usr_name'].' | [<a href="logout.php">Logout</a>]</p>';
        echo "<p><b>Drewno</b>: ".$_SESSION['drewno'];
        echo " | <b>Kamień</b>:".$_SESSION['kamien'];
        echo " | <b>Zboże</b>: ".$_SESSION['zboze']."</p>";
        
        echo "<p><b>E-mail</b>: ".$_SESSION['email'];
        echo "<br/><b>Dni premium</b>: ".$_SESSION['dnipremium']."</p>";
    ?>
</body>
</html>