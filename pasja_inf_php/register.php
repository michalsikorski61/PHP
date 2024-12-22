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
                
                 //if all ok
                if($all_ok == true){
                    // echo "Validation passed!";
                    require_once 'dbconnect.php';
                    try{
                        $connection = new mysqli($host, $user, $pass, $db_name);
                        
                        $stmt = $connection->prepare("INSERT INTO uzytkownicy (user, email, pass) VALUES (?,?,?)");
                        if($stmt === false) {
                            throw new Exception($connection->error);
                        }
                        $stmt->bind_param("sss", $nickname, $email, $password_hash);
                        $stmt->execute();
                        
                    }catch(Exception $e){
                        echo '<span class="error">Error:Serverver error. We apologize for the inconvenience. Please try again later.</span>';
                        echo '<br/> Developer info: '.$e;
                    }
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
            <input type="text" id="nickname" name="nickname" required>
            <?php
                if(isset($_SESSION['err_nickname'])){
                    echo '<div class="error">'.$_SESSION['err_nickname'].'</div>';
                    unset($_SESSION['err_nickname']);
                }
            ?>
        </div>

        <div>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
            <?php
                if(isset($_SESSION['err_email'])){
                    echo '<div class="error">'.$_SESSION['err_email'].'</div>';
                    unset($_SESSION['err_email']);
                }
            ?>
        </div>

        <div>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required>
            <?php
                if(isset($_SESSION['err_password'])){
                    echo '<div class="error">'.$_SESSION['err_password'].'</div>';
                    unset($_SESSION['err_password']);
                }
            ?>
        </div>
        
        <div>
            <label for="repeatpassword">Powtorz hasło:</label>
            <input type="password" id="repeatpassword" name="repeatpassword" required>
        </div>

        <div>
            <label>
                <input type="checkbox" name="regulamin" id="regulamin" required>Akceptuję regulamin
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