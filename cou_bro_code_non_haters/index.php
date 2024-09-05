<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="radius">Radius:</label>
        <input type="text" name="radius" id="radius"><br>
        <input type="submit" value="calculate"><br>
    </form>

</body>
</html>
<?php
    $radius = $_POST['radius'] ?? null;
    $circumference = null; //ob
    $area = null; 
    $volume = null;

    $circumference = 2 * pi() * $radius;
    $circumference = round($circumference, 2);
    $area = pi() * pow($radius, 2);
    $area = round($area, 2);

    $volume = 4/3 * pi() * pow($radius, 3);
    $volume = round($volume, 2);
    echo "The circumference of the circle is {$circumference} cm <br>";
    echo "The area of the circle is {$area} cm<sup>2</sup><br>";
    echo "The volume of the circle is {$volume} cm<sup>3</sup>";
