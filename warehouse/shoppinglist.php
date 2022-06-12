<!DOCTYPE html>
<html lang="de">
<?php
error_reporting(0);
require "ac.php";
require __DIR__ . "/../modules/lib/productlist.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
if ($_SESSION['order']) {
    header("Location: /warehouse/product.php");
    die();
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Einkaufsliste</title>
    <link rel="stylesheet" href="/style.css">
</head>
<style>
    a {
        color: black;
    }

    a:visited {
        color: black;
    }

    table {
        width: 100%;
        text-align: center;
        border-spacing: 0;
        font-size: 18px;
        margin-bottom: 30px;
    }
    th {
        border: 1px solid black;
    }
    td {
        border: 1px solid black;
    }
</style>
<script>
    window.print()
</script>

<body>
    <a href="/warehouse/shoppingoverview.php">Zurück</a>
    <table>
        <tr>
            <th>X</th>
            <th>Anzahl</th>
            <th>Name</th>
            <th>Stückpreis</th>
            <th>Gesamtpreis</th>
        </tr>
        <?php listglobalorderview('shipping', 1) ?>
    </table>
</body>

</html>