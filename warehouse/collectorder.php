<!DOCTYPE html>
<html lang="de">
<?php
error_reporting(0);
require  "ac.php";
require __DIR__ . "/../modules/lib/productlist.php";
require __DIR__ . "/../modules/lib/editorderview.php";
require __DIR__ . "/../modules/lib/orderstate.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
$orderlist = listOrders($_SESSION["rorder"],false);
$loc = 12;
require __DIR__ . "/../modules/lib/themehelper.php";
$theme = getTheme();
?>

<head>
    <title>Bestellübersicht</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ($theme) ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php require __DIR__ . "/../gov/navbar.php"; ?>
    <div class="main" id="main">
        <a href="/warehouse/pickuporder.php" class="back">&#x2190;</a>
        <div class="top">
            <div class="dashboard">
                <h4>Aufgraggeber:</h4>
                <h1><?php echo (getorderer($_SESSION['rorder'])) ?></h1>
            </div>
            <div class="dashboard">
                <h4>Auftragsnummer:</h4>
                <h1><?php echo ($_SESSION['rorder']); ?></h1>
            </div>
            <div class="dashboard">
                <h4>Auftragsstatus:</h4>
                <h1><?php echo (getorderstate($_SESSION['rorder'])); ?></h1>
            </div>
            <div class="dashboard">
                <h4>Summe:</h4>
                <h1><?php echo ($orderlist['sum']); ?></h1>
            </div>
        </div>
        <?php
        if ($_GET['err'] == 1) echo ("<div class=\"loginerr\">Bestellung kann nicht abgeschlossen werden, da sie fehlerhafte Einträge enthält!</div>");

        ?>
        <div class="sales">
            <form action="/modules/formhandler/deleteorderitemhandler.php" method="post">
                <table>
                    <tr>
                        <th>Anzahl</th>
                        <th>Artikelbezeichnung</th>
                        <th>Einzelpreis</th>
                        <th>Gesamtpreis</th>
                    </tr>
                    <?php echo ($orderlist['table']) ?>
                </table>
            </form>
        </div>
        <form class="transaction" action="/modules/formhandler/collectedhandler.php" method="post">
        <button class="search" type="submit">Auftrag als Bearbeitet markieren</button>
        <input type="hidden" name="id" value="<?php $_SESSION["rorder"]?>">
    </form>
    </div>
</body>


</html>