<?php
session_start();
if(!isset($_SESSION['logged'])){
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Osadnicy - browser game</title>
</head>
<body>
    <?php
        echo '<p>Hello, '. $_SESSION['usr_name'].' | [<a href="logout.php">Logout</a>]</p>';
        echo "<p><b>Drewno</b>: ".$_SESSION['drewno'];
        echo " | <b>Kamień</b>:".$_SESSION['kamien'];
        echo " | <b>Zboże</b>: ".$_SESSION['zboze']."</p>";

        echo "<p><b>E-mail</b>: ".$_SESSION['email'];
        echo "<br/><b>End of premium</b>: ".$_SESSION['dnipremium']."</p>";
        

        //premium system
        $datetime1 = new DateTime('2150-05-01 09:33:59'); // now
        echo "Srv datetime: ".$datetime1->format('Y-m-d H:i:s')."<br>";
        $endPremium = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['dnipremium']);

        $diff = $datetime1->diff($endPremium);

        if($datetime1<$endPremium){
            echo "Premium end in: ".$diff->format('%y years %d days %h hours %i minutes %s seconds')."<br>";
        }else{
            echo "Premium has ended ".$diff->format('%y years %d days %h hours %i minutes %s seconds')." ago<br>";
        }
        //time 
        // echo time()."<br>";
        // echo date('Y-m-d')."<br>";
        // echo date('d.m.Y')."<br>";
        // echo date('d')."<br>";
        // echo date('H:i:s')."<br>";
        // $datetime = new DateTime();
        // echo $datetime->format('Y-m-d H:i:s')."<br>";
        // $day = 26;
        // $month = 78;
        // $year = 1875;
        // if(checkdate($month, $day, $year)){
        //     echo "Data jest poprawna<br>";
        // }else{
        //     echo "Data jest niepoprawna<br>";
        // }


    ?>
</body>
</html>