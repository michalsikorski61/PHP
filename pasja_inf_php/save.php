<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//require exception, phpmailer, smtp
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_POST['email'])){
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if(empty($email)){
        //error
        $_SESSION['given_email'] = $_POST['email'];
        $_SESSION['email_error'] = '<span style="color:red">Podany adres email jest nieprawidłowy!</span>';
        header('Location: index.php');
        exit();
    }else{
        require_once 'database.php'; // connect to database only if email is correct
        //is email already in database?
        $query = $db->prepare('SELECT COUNT(*) FROM newsletter_usrs WHERE email = :email');
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchColumn(); // we need only one column from query result so we use fetchColumn method to get it 
        if($result > 0){
            //email already in database
            $_SESSION['email_error'] = '<span style="color:red">Podany adres email jest już zapisany!</span>';
            header('Location: index.php');
            exit();
        }else{

            //email ok
            $query = $db->prepare('INSERT INTO newsletter_usrs VALUES (NULL, :email)'); // prepare query to insert email into database pdo style
            $query->bindValue(':email', $email, PDO::PARAM_STR); // bind value to query with pdo style 
            $query->execute(); // execute query
            //pdo automatically close connection

            //send email thanks to phpmailer
            try{
                //debug on
                $mail = new PHPMailer();
                
                $mail->isSMTP();
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->SMTPAuth = true;
                $mail->Username = 'dawiddowod00@gmail.com';
                $mail->Password = 'bkafqnxdyxyldjjn';

                //utf-8
                $mail->CharSet = 'UTF-8';
                $mail->setFrom('newsletter@dotpy.pl', 'Ebooki uczące sztuki');
                $mail->addAddress($email);
                $mail->addReplyTo('newsletter@dotpy.pl ', 'Biuro');
                $mail->isHTML(true);
                $mail->Subject = 'Darmowy, świetny ebook - HTML na przykładach';
                $mail->Body ="
                    <html>
                        <head>
                            <title>Twój darmowy ebook!</title>
                        </head>
                        <body>
                            <h1>Dzień dobry!</h1>
                            <p>Oto link do naszego świetnego ebooka: <a href='https://domena.pl/ebook.pdf'>POBIERZ EBOOKA</a>
                            </p>
                            <hr>
                            <p>Administratorem Twoich danych osobowych jest:</p>
                            <p>Ebooki uczące sztuki Sp.z.o_O, ul. Wiejska 4/6/8, 00-902 Warszawa</p>
                            <p>Wypisz się z newslettera: <a href='https://domena.pl/unsubscribe'>UNSUB</a>
                            </p>
                        </body>
                    </html>
                ";
                $mail->addAttachment('img/fake-book.jpg');
                $mail->send();


            }catch(Exception $e){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}else{
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Zapisanie się do newslettera</title>
    <meta name="description" content="Używanie PDO - zapis do bazy MySQL">
    <meta name="keywords" content="php, kurs, PDO, połączenie, MySQL">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <header>
            <h1>Hurra! Wysłaliśmy Ci ebooka!</h1>
        </header>

        <main>
            <article>
                <p class="content">
                    Dziękujemy za zapisanie się na listę mailową naszego newslettera! Link do obiecanego, darmowego ebooka znajdziesz w przysłanej przed chwilą wiadomości!
                    W razie problemów z odnalezieniem maila sprawdź koniecznie zawartość folderu "Spam" w swojej skrzynce pocztowej.
                    Owocnej lektury!
                </p>
            </article>
        </main>
    </div>
</body>
</html>
