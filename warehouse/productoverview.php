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
$loc = 4;
require __DIR__ . "/../modules/lib/themehelper.php";
$theme = getTheme();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ($theme) ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Produkte Verwalten</title>
</head>

<body>
    <?php require __DIR__ . "/../gov/navbar.php"; ?>
    <div class="main" id="main">
        <button class="btn" id="myBtn">Neues Produkt</button>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1>Neues Produkt hinzufügen</h1>
                <form class="transaction" action="/modules/formhandler/newproducthandler.php" method="post">
                    <input type="text" name="pname" required autocomplete="off" placeholder="Name">
                    <input type="float" name="price" step="0.01" required autocomplete="off" placeholder="Preis">
                    <br>
                    <input class="search" type="submit" value="Produkt Hinzufügen">
                    <input class="search abbr" type="clear" value="Abbrechen">
                </form>
            </div>
            <script src="/ressource/js/modalworker.js"></script>
        </div>

        <?php
        if ($_GET['err'] == 10) echo ("<div class=\"loginerr\">Produktname muss zwischen 4 und 40 Zeichen lang sein</div>");
        if ($_GET['err'] == 20) echo ("<div class=\"loginerr\">Preis muss größer als 0 sein</div>");
        if ($_GET['err'] == 30) echo ("<div class=\"loginerr\">Zugriff verweigert!</div>");
        if ($_GET['suc'] == 10) echo ("<div class=\"logout\">\"$_GET[name]\" wurde erfolgreich zum Sortiment hinzugefügt</div>");
        
        if ($_GET['suc'] == 1 and $_GET['rows'] > 0) echo ("<div class=\"loginerr\">Produkt aus dem Sortiment genommen!<br>Dabei wurde(n) $_GET[rows] Bestellung(en) als fehlerhaft markiert!</div>");
        if ($_GET['suc'] == 1 and $_GET['rows'] == 0) echo ("<div class=\"logout\">Produkt aus dem Sortiment genommen</div>");
        ?>
        <div class="dashboard">
            <form action="productoverview.php" method="get" class="transaction">
                <input type="text" name="id" placeholder="Artikelname" autocomplete="off">
                <input type="submit" class="search" value="Suchen">
            </form>
        </div>
        <div class="sales">
            <form action="/modules/formhandler/deleteproducthandler.php" method="post">
                <table>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Name</th>
                        <th>Preis</th>
                    </tr>
                    <?php listallproduct($_GET['id'], 2, 0); ?>
                </table>
            </form>
            <form>
            </form>
        </div>
    </div>
</body>

</html>