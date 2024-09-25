<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// include() - copies the content of a file (php/html/txt)
// and includes it in your php file
// sections of our become reusable
// changes only need to be made in one place
include('header.html');
?>
    This is the home page <br>
    Stuff about your home page can go here
    <?php
    include('footer.html');
    ?>
</body>
</html> 