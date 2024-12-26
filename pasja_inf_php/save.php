<?php
session_start();


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
