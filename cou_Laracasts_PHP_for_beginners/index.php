<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="2"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <h1>Recomended Books</h1>
    <?php
        $books = [
            [
                "title" => "Do Androids Dream of Electric Sheep",
                "author" => "Philip K. Dick",
                "purchaseUrl" => "https://dotpy.pl",
            ],
            [
                "title" => "The Langoliers",
                "author" => "Stephen King",
                "purchaseUrl" => "https://dotpy.pl",
            ],
            [
                "title" => "Hail Mary",
                "author" => "Andy Weir",
                "purchaseUrl" => "https://dotpy.pl",
            ],
        ];

    ?>

    <ul>
        <?php foreach($books as $book): ?>
            <li><a href="<?= $book['purchaseUrl'] ?>">
                <?= $book['title'] ?>
            </a></li>
        <?php endforeach; ?>
    </ul>
    
</body>
</html>