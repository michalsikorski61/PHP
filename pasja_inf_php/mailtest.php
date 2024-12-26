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
                    // $from = 'Ebooki uczące sztuki <newsletter@dotpy.pl>';
                    $from = '=?UTF-8?B?'.base64_encode('Ebooki uczące sztuki').'?= <newsletter@dotpy.pl>';
                    // $replyTo = 'Biuro <newsletter@dotpy.pl>';
                    $replyTo = '=?UTF-8?B?'.base64_encode('Biuro').'?= <newsletter@dotpy.pl>';

                    $subject = 'Darmowy, świetny ebook - HTML na przykładach';
                    $subject = '=?UTF-8?B?'.base64_encode($subject).'?=';
                    $message = 'Witaj!'."\r\n\r\n".' Dziękujemy za zapisanie się do newslettera. W załączniku znajdziesz ebooka, który nauczy Cię sztuki programowania.';
                    $message = base64_encode($message);

                    $headers = 'Content-Type: text/plain; charset=utf-8'."\r\n";
                    $headers .= 'Content-Transfer-Encoding: base64'."\r\n";
                    $headers .= 'From: '.$from."\r\n";
                    $headers .= 'Reply-To: '.$replyTo."\r\n";
                    mail($to, $subject, $message, $headers);
                ?>
            </article>
        </main>
    </div>
</body>
</html>