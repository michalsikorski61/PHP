<?php
    session_start();
  
    if(isset($_POST['email'])){
        //all ok? default true
        $all_ok = true;

        //check nickname 
        $nickname = $_POST['nickname'];

        //check nickname length
        if((strlen($nickname) < 3) || (strlen($nickname) > 20)){
            $all_ok = false;
            $_SESSION['err_nickname'] = "Nickname must have 3-20 characters";
        }

        //check if nickname contains only letters and digits
        if(ctype_alnum($nickname) == false){
            $all_ok = false;
            $_SESSION['err_nickname'] = "Nickname can contain only letters and digits";
        }

        //check email
        $email = $_POST['email'];
        $email_safe = filter_var($email, FILTER_SANITIZE_EMAIL);
        
        //check if email is in valid format
        if((filter_var($email_safe, FILTER_VALIDATE_EMAIL) == false) || ($email_safe != $email)){
            $all_ok = false;
            $_SESSION['err_email'] = "Invalid email";
        }

        //check password
        $password = $_POST['password'];
        $repeatpassword = $_POST['repeatpassword'];
        
        //check password length
        if((strlen($password) < 8) || (strlen($password) > 20)){
            $all_ok = false;
            $_SESSION['err_password'] = "Password must have 8-20 characters";
        }
        
        //check if password and repeat password match
        if($password != $repeatpassword){
            $all_ok = false;
            $_SESSION['err_password'] = "Passwords do not match";
        }

        
        //hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        

        //check if user accepted the rules
        if(!isset($_POST['regulamin'])){
            $all_ok = false;
            $_SESSION['err_regulamin'] = "You have to accept the rules";
        }

        
        // Twój secret key reCAPTCHA v3
        $secretKey = '6LeHPqIqAAAAAMO9OUXKTIbOWg8sfd7rIQSyCUME';

        // Odbieramy token od użytkownika (wysłany w formularzu jako g-recaptcha-response)
        $token = $_POST['g-recaptcha-response'] ?? '';

        // Budujemy zapytanie do Google
        $verifyUrl = "https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$token}";

        // Wysyłamy zapytanie do Google
        $response = file_get_contents($verifyUrl);

        // Dekodujemy otrzymane dane JSON
        $responseData = json_decode($response, true);

        // Sprawdzamy, czy zwrócony został success = true
        if ($responseData['success'] === true) {
            // Opcjonalnie możesz sprawdzić score
            // Przykładowo wymagamy score > 0.5
            if ($responseData['score'] >= 0.6) {
                // reCAPTCHA OK, kontynuujemy rejestrację
                // Tutaj normalnie walidacja pól: nickname, email, itd.
                
                // ... Twój kod rejestracji użytkownika ...
                
                 
                //remember entered data
                $_SESSION['fr_nickname'] = $nickname;
                $_SESSION['fr_email'] = $email;
                $_SESSION['fr_password'] = $password;
                $_SESSION['fr_repeatpassword'] = $repeatpassword;
                if(isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;
                

                
                require_once 'dbconnect.php';
                mysqli_report(MYSQLI_REPORT_STRICT); //instead of warnings it will throw exceptions
                try {
                    $dsn = "mysql:host=$host;dbname=$db_name;charset=utf8";
                    $pdo = new PDO($dsn, $user, $pass, [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]);

                    //check if email is already in db
                    $query = $pdo->prepare('SELECT id FROM uzytkownicy WHERE email = :email');
                    $query->bindParam(':email', $email);
                    $query->execute();
                    $result = $query->fetch();
                    //throw exception if failed 
                    if($result){
                        
                        $all_ok = false;
                        $_SESSION['err_email'] = "Email is already in use";
                        // throw new Exception("Email is already in use");
                    }

                    //check if nickname is already in db
                    $query = $pdo->prepare('SELECT id FROM uzytkownicy WHERE user = :nickname');
                    $query->bindParam(':nickname', $nickname);
                    $query->execute();
                    $result = $query->fetch();
                    //throw exception if failed 
                    if($result){
                        
                        $all_ok = false;
                        $_SESSION['err_nickname'] = "Nickname is already in use";
                        // throw new Exception("Email is already in use");
                    }
                    //premium today + 10 days
                    // $premium = date('Y-m-d H:i:s', strtotime('+10 days'));
                    
                    
                    //if all ok insert user to dd but throw if query failed
                    if($all_ok){
                        $query = $pdo->prepare('INSERT INTO uzytkownicy VALUES (NULL, :nickname, :password, :email,100,100,100, now()+ INTERVAL 14 DAY)');
                        $query->bindParam(':nickname', $nickname);
                        $query->bindParam(':password', $password_hash);
                        $query->bindParam(':email', $email);
                        // $query->bindParam(':premium', now());
                        $query->execute();
                        if($query->rowCount() > 0){
                            $_SESSION['register_success'] = true;
                            header('Location: welcome.php');
                        }else{
                            throw new Exception("User not added");
                        }
                        

                    }

                } catch (Exception $e) {
                    echo '<span class="error">Error: Server error. We apologize for the inconvenience. Please try again later.</span>';
                    echo '<br/> Developer info: '.$e;
                }
                

            } else {
                // Score za niskie – prawdopodobnie bot
                $all_ok = false;
                $_SESSION['err_recaptcha'] = "reCAPTCHA score za niskie";
            }
        } else {
            // reCAPTCHA nie powiodła się
            $all_ok = false;
            $_SESSION['err_recaptcha'] = "reCAPTCHA nie powiodła się";
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Osadnicy - załóż darmowe konto</title>
    <link rel="stylesheet" href="style.css">
    <!-- ... inne meta i linki ... -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LeHPqIqAAAAAEgTZviW1xbbeLZDF3d_SmBbWT0C"></script>
</head>
<body>
    <!-- register form  -->
    <form action="register.php" method="POST">
        <div>
            <label for="nickname">Nickname:</label>
            <input type="text" id="nickname" name="nickname" value="<?php
                if(isset($_SESSION['fr_nickname'])){
                    echo $_SESSION['fr_nickname'];
                    unset($_SESSION['fr_nickname']);
                }
            ?>" required>
            <?php
                if(isset($_SESSION['err_nickname'])){
                    echo '<div class="error">'.$_SESSION['err_nickname'].'</div>';
                    unset($_SESSION['err_nickname']);
                }
            ?>
        </div>

        <div>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php
                if(isset($_SESSION['fr_email'])){
                    echo $_SESSION['fr_email'];
                    unset($_SESSION['fr_email']);
                }
            ?>" required>
            <?php
                if(isset($_SESSION['err_email'])){
                    echo '<div class="error">'.$_SESSION['err_email'].'</div>';
                    unset($_SESSION['err_email']);
                }
            ?>
        </div>

        <div>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" value="<?php
                if(isset($_SESSION['fr_password'])){
                    echo $_SESSION['fr_password'];
                    unset($_SESSION['fr_password']);
                }
            ?>" required>
            <?php
                if(isset($_SESSION['err_password'])){
                    echo '<div class="error">'.$_SESSION['err_password'].'</div>';
                    unset($_SESSION['err_password']);
                }
            ?>
        </div>
        
        <div>
            <label for="repeatpassword">Powtorz hasło:</label>
            <input type="password" id="repeatpassword" name="repeatpassword" value="<?php 
                if(isset($_SESSION['fr_repeatpassword'])){
                    echo $_SESSION['fr_repeatpassword'];
                    unset($_SESSION['fr_repeatpassword']);
                }
            ?>" required>
        </div>

        <div>
            <label>
                <input type="checkbox" name="regulamin" id="regulamin" checked="<?php 
                    if(isset($_SESSION['fr_regulamin'])){
                        echo 'checked';
                        unset($_SESSION['fr_regulamin']);
                    }
                ?>" required>Akceptuję regulamin
                <?php
                    if(isset($_SESSION['err_regulamin'])){
                        echo '<div class="error">'.$_SESSION['err_regulamin'].'</div>';
                        unset($_SESSION['err_regulamin']);
                    }
                ?>
            </label>
        </div>
        <div>
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
            <?php
                if(isset($_SESSION['err_recaptcha'])){
                    echo '<div class="error">'.$_SESSION['err_recaptcha'].'</div>';
                    unset($_SESSION['err_recaptcha']);
                }
            ?>
        </div>
        <button type="submit">Zarejestruj się</button>
    </form>

     <!-- Skrypt do generowania tokena reCAPTCHA v3 -->
     <script>
        // Upewniamy się, że skrypt załadował się poprawnie
        grecaptcha.ready(function() {
            // Teraz wywołujemy reCAPTCHA z Twoim site key i wskazujemy "akcję"
            grecaptcha.execute('6LeHPqIqAAAAAEgTZviW1xbbeLZDF3d_SmBbWT0C', {action: 'submit'}).then(function(token) {
                // Gdy otrzymamy token, wstawiamy go do ukrytego inputa
                document.getElementById('g-recaptcha-response').value = token;
            });
        });
    </script>
</body>
</html>