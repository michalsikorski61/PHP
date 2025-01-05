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
                "releaseYear" => 1923,
                "purchaseUrl" => "https://dotpy.pl",
            ],
            [
                "title" => "The Langoliers",
                "author" => "Stephen King",
                "releaseYear" => 1723,
                "purchaseUrl" => "https://dotpy.pl",
            ],
            [
                "title" => "Hail Mary",
                "author" => "Andy Weir",
                "releaseYear" => 2009,
                "purchaseUrl" => "https://dotpy.pl",
            ],
        ];

        $filteredBooks = function ($books,$author){
             $filteredBooks = [];

             foreach($books as $book){
                if($book['author'] === $author){
                    $filteredBooks[] = $book;
                }
             }
             return $filteredBooks;
        };

       $filteredBooks = $filteredBooks($books,'Andy Weir');
    ?>
 
    <ul>
        <?php foreach($filteredBooks as $book): ?>
                <li><a href="<?= $book['purchaseUrl'] ?>">
                    <?= "{$book['title']} ({$book['releaseYear']}) - {$book['author']}" ?>
                </a></li>
        <?php endforeach; ?>
    </ul>
    
</body>
</html>