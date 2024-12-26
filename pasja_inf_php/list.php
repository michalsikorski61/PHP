<?php
session_start();

require_once 'database.php';
if(!isset($_SESSION['logged_adm_id'])){
    if(isset($_POST['login'])){
        $login = filter_input(INPUT_POST, 'login');
        $password = filter_input(INPUT_POST, 'pass');
        
        $usrQuery = $db->prepare('SELECT id,password FROM newsletter_adm WHERE login = :login');
        //password is hashed so we need to use password_verify function to compare it with user input
        $usrQuery->bindValue(':login', $login, PDO::PARAM_STR);
        $usrQuery->execute();
    
        // echo $usrQuery->rowCount();
        // if($usrQuery->rowCount() > 0){
        //     $usr = $usrQuery->fetch();
        //     if(password_verify($password, $usr['password'])){
        //         echo 'Zalogowano';
        //     }
        // }else{
        //     $_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
        //     header('Location: newsletter_adm.php');
        //     exit();
        // }
        $usr = $usrQuery->fetch();
        if($usr && password_verify($password, $usr['password'])){//not empty and pass ok
            $_SESSION['logged_adm_id'] = $usr['id'];
            unset($_SESSION['login_error']);
    
        }else{
            $_SESSION['login_error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
            $_SESSION['given_login'] = $login;
            header('Location: newsletter_adm.php');
            exit();
        }
        
    }else{
        header('Location: newsletter_adm.php');
        exit();
    }
}

$usrsQuery = $db->query('SELECT * FROM newsletter_usrs');
// $usrs = $usrsQuery->fetchAll();
$usrs = $usrsQuery->fetchAll(PDO::FETCH_ASSOC); //fetch all rows as associative array

// print_r($usrs);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Admina</title>
    <meta name="description" content="Używanie PDO - odczyt z bazy MySQL">
    <meta name="keywords" content="php, kurs, PDO, połączenie, MySQL">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Newsletter</h1>
        </header>

        <main>
            <article>
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Łącznie rekordów: <?= $usrsQuery->rowCount() ?></th>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                            </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($usrs as $usr){
                                echo "<tr> <td> {$usr['id']}</td>
                                    <td>{$usr['email']}</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </article>
            <p>
                <a href="logout.php">Logout</a>
            </p>
        </main>
    </div>
</body>
</html>