<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fors</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="counter">enter a number to count down from:</label>
        <input type="number" name="counter" id="counter">
        <input type="submit" value="start">
    </form>
    <?php
        if(!(isset($_POST['counter'])) || empty($_POST['counter'])){
            echo 'please enter a number';
            exit;
        }
        $counter = $_POST['counter'] ?? 0; // null coalescing operator

        for($i = $counter; $i > 0; $i--){
            echo $i . '<br>';
        }
    ?>
</body>
</html>