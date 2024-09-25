<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanitize/validation</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">
    <label for="username">Age:</label>
    <input type="text" name="age" id="age">
    <label for="username">email:</label>
    <input type="text" name="email" id="email">
    <input type="submit" name="login" value="Login">
    </form>
    <?php
        if(isset($_POST['login'])){
            if(empty($_POST['username'])){
                echo "Username is required";
                return;
            }else{
                //first validate 
                $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
                $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
                echo "Var age: ";
                var_dump($age);
                echo "<br>";
                echo "Var email: ";
                var_dump($email);
                echo "<br>";
                if(empty($age)){
                    echo "Valid age is required <br>";
                    
                }else{
                    echo "You are {$age} years old <br>";
                }
                if(empty($email)){
                    echo "Valid email is required <br>";
                }else{
                    echo "Your email is {$email} <br>";
                }
                $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
                $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                // echo "Hello, {$username}, you are {$age} years old. Your email is {$email}";
            }
            

            
        }
    ?>
</body>
</html>