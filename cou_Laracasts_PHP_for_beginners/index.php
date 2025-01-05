
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

        /**
         * Filters an array of items based on a callback function.
         *
         * This function iterates over each item in the provided array and applies the
         * callback function to determine if the item should be included in the filtered
         * result. If the callback function returns true for an item, that item is added
         * to the filtered result array.
         *
         * @param array $items The array of items to be filtered.
         * @param callable $fn The callback function used to filter items. This function
         *                     should accept a single parameter (an item from the array)
         *                     and return a boolean value. If the function returns true,
         *                     the item will be included in the filtered result.
         * @return array The array of filtered items that passed the callback function's
         *               test.
         */
        function filter($items,$fn){
             $filteredItems = [];
            
             foreach($items as $item){
                if($fn($item)){ 
                    $filteredItems[] = $item;
                }
             }
             return $filteredItems;
        }

       $filteredBooks = array_filter($books, function ($book){
        return $book['releaseYear'] > 2008;
       });
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