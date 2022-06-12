<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);
require "ac.php";
require __DIR__ . "/../modules/lib/productlist.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
if (!$_SESSION['order']) {
    header("Location: /warehouse/newOrder.php");
    die();
}
require __DIR__ . "/../modules/lib/themehelper.php";
$theme = getTheme();
$loc = 3;
?>

<hea<meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ($theme) ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Bestellübersicht</title>
    </head>

    <body>
        <?php require __DIR__ . "/../gov/navbar.php"; ?>

        <div class="main" id="main">
            <a class="btn" href="/warehouse/product.php">&#x2190;</a>
            <a class="btn" href="/modules/stornoorder.php">Bestellung Stornieren</a>
            <div class="top">
                <div class="dashboard">
                    <h4>Auftraggeber</h4>
                    <h1><?php echo (getorderer($_SESSION['order'])) ?></h1>
                </div>
                <div class="dashboard">
                    <h4>Auftragsnummer</h4>
                    <h1><?php echo ($_SESSION['order']); ?></h1>
                </div>
            </div>



            <?php
            if ($_GET['err'] == 1) echo ("<div class=\"loginerr\">Bestellung kann nicht abgeschlossen werden, da sie fehlerhafte Einträge enthält!</div>");

            ?>
            <div class="sales">
            <form action="/modules/formhandler/deleteorderitemhandler.php" method="post">
                <table>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Anzahl</th>
                        <th>Artikelbezeichnung</th>
                        <th>Einzelpreis</th>
                        <th>Gesamtpreis</th>
                    </tr>
                    <?php listallorderview($_SESSION["order"], 1) ?>
                </table>
            </form>
            </div>
            <a class="btn" href="/modules/formhandler/finishorderhandler.php">Bestellung abschließen</a>
        </div>
    </body>

</html>