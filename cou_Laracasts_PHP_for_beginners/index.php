<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="2"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: grid;
            place-items: center;
            height: 100vh;
            margin: 0;
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
        <select name="bool" id="bool">
            <option value="true">True</option>
            <option value="false">False</option>
            
        </select>
        <button type="submit">Wyślij</button>
    </form>
    <?php
        $name = "Dark Matter";
       if(isset($_GET['bool'])){
           $read = $_GET['bool'] === "true" ? true : false;
       }else{
            $read = '';
       }
        
        $message = "";

        if($read){
            $message = "You have read $name";
        }else{
            $message = "You haven't read $name";
        }
    ?>
    <h1><?= $message ?></h1>
ss
    
</body>
</html>