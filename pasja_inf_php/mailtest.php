<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test skryptu mailowego</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>test skryptu mailowego</h1>
        </header>
        <main>
            <article>
                <?php
                    $to = 'newsletter@dotpy.pl';
                    $from = 'Ebooki uczące sztuki <newsletter@dotpy.pl>';
                    $replyTo = 'Biuro <newsletter@dotpy.pl>';  
                    $subject = 'Darmowy, świetny ebook - HTML na przykładach';
                    $subject = '=?UTF-8?B?'.base64_encode($subject).'?=';
                    $message = '<html>
                                    <head>
                                    <title>Twój darmowy ebook!</title>
                                    </head>
                                    <body>
                                    <h1>Dzień dobry!</h1>
                                    <p>Oto link do naszego świetnego ebooka: <a href="https://domena.pl/ebook.pdf">POBIERZ EBOOKA</a>
                                    </p>
                                    <hr>
                                    <p>Administratorem Twoich danych osobowych jest:</p>
                                    <p>Ebooki uczące sztuki Sp.z.o_O, ul. Wiejska 4/6/8, 00-902 Warszawa</p>
                                    <p>Wypisz się z newslettera: <a href="https://domena.pl/unsubscribe">UNSUB</a>
                                    </p>
                                    </body>
                                    </html>
                                    ';
                    $headers = 'MIME-Version: 1.0'."\r\n";
                    $headers .= 'Content-Type: text/html; charset=utf-8'."\r\n";
                    $headers .= 'From: '.$from."\r\n";
                    $headers .= 'Reply-To: '.$replyTo."\r\n";
                    mail($to, $subject, $message, $headers);
                ?>
            </article>
        </main>
    </div>
</body>
</html>