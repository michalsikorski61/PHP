<div><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piekarnia</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }
        tr, td, th {
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <?php
        $paczkow = $_POST['paczki'];
        $grzebieni = $_POST['grzebienie'];
        $sum = ($paczkow * 0.99) + ($grzebieni * 1.29);
    ?>
    <h1>Zamówienie online</h1>
    <table>
        <thead>
            <tr>
                <th>Produkt</th>
                <th>Ilość</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Ilość pączków (0.99 PLN/ szt)</td>
                <td><?= $paczkow ?></td>
            </tr>
            <tr>
            <td>Ilość grzebieni (1.29 PLN/ szt)</td>
                <td><?= $grzebieni ?></td>
            </tr>
            <tr>
                <td><strong>SUMA:</strong></td>
                <td><strong><?= $sum ?></strong></td>
            </tr>
            
        </tbody>
    </table>
</body>
</html>