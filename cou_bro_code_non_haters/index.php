<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div>
            <label for="login">Login</label>
            <input type="text" name="login" id="login"></div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="passwrod">
        </div>
        <input type="submit" value="Log in">
    </form> -->
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label for="quantity">quantity:</label><br/>
        <input type="text" name="quantity">
        <input type="submit" name="total" id="total">

    </form>
</body>
</html>
<?php
    $item = 'pizza';
    $price = 5.99;
    $quantity = $_POST['quantity'];
    echo "You ordered {$quantity} x {$item}/s. Your total is: \$" . $quantity * $price;

// $_POST, $_POST - special vaiables used to collect ddata from an HTML form
    // data is sent to the file in the action attribute of the form tag
    // <form action="some_file.php" method="post">

// $_POST - data is append to the URL
//     NOT SECURE
//     char limit
//     bookmark is possible w/ values
//     GET requests can be cached
//     better for a search pages


// $_POST - data is packaged inside the body of the HTTP request
//     MORE SECURE
//    no data limitw
//    cannot be bookmarked
//     GET requests cannot be cached
//     better for sensitive data

