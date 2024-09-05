<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <!-- x -->
        <label for="x">x</label>
        <input type="text" name="x" id="x"><br>
        <!-- y -->
        <label for="y">y</label>
        <input type="text" name="y" id="y"><br>
        <!-- z -->
        <label for="z">z</label>
        <input type="text" name="z" id="z"><br>
        <input type="submit" value="total">
    </form>
</body>
</html>
<?php
    $x = $_POST['x'] ?? 0;
    $y = $_POST['y'] ?? 0;
    $z = $_POST['z'] ?? 0;
    $total = null;

    // $total = abs($x);
    // $total = round($x);
    // $total = floor($x);
    // $total = ceil($x);
    // pow
    // $total = pow($x, $y);
    // sqrt
    // $total = sqrt($x);
    // $total = max($x, $y, $z);
    // $total = min($x, $y, $z);
    // pi
    // $total = pi();
    //rand
    $total = rand();



    echo $total;