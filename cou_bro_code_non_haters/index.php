<?php
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Bro form</title>
</head>
<body>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <h2>Welcome to FakeBook</h2>
        <label for="username">Username:</label><br/><input name="username" type="text"><br/>
        <label for="password">Password:</label><br/><input name="password" type="password"><br/>
        <input type="submit" name="register_sent" value="Register">
    </form>
</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    // var_dump($username);
    if(empty($username)){
        echo 'Please fill in the username field';
    }elseif(empty($password)){
        echo 'Please fill in the password field';
    }else{
        // echo 'all ok';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        //query and bind
       try{
        $query = 'INSERT INTO users(user, pass) VALUES(?, ?)';
        $statement = $conn->prepare($query);
        $statement->bind_param('ss', $username, $hash);
        $statement->execute();
        echo 'User registered';
        }catch(mysqli_sql_exception $e){
            echo 'Error: ' . $e->getMessage();
            
        }
        $statement->close();
    }
}
mysqli_close($conn);