<?php
// $_SERVER - sgb that contains headers, paths, and script locations
// the entries in this array are created by the web server
// shows nearly everything you need to konw about the current web page env.
// foreach($_SERVER as $key => $value){
//     echo "{$key} => {$value} <br>";
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SERVER SGB</title>
</head>
<body>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <input type="text" name="username" id="username">
        <input type="submit" value="Log in" name="login">
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            echo "Form sended thanks to post method";
        }
    ?>
</body>
</html>