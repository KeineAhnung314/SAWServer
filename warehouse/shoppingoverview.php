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
$loc = 5;
require __DIR__ . "/../modules/lib/themehelper.php";
$theme = getTheme();
?>

<head>
    <title>Bestellüberblick</title>
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
    
        <form action="/modules/formhandler/setshippedhandler.php" method="post">
        <a class="btn" href="/modules/formhandler/finishshoppinglist.php">Einkäufe als verfügbar markieren</a>
        <a class="btn" href="/warehouse/shoppinglist.php">Druckansicht</a>
            <input class="btn" type="submit" value="Liste erstellen">


        </form>

        <?php
        if ($_GET['err'] == 1) echo ("<div class=\"loginerr\">Es gibt keine Shoppingliste die als verfügbar markiert werden kann!</div>");
        if ($_GET['suc'] == 1 and $_GET['c'] > 0) echo ("<div class=\"logout\">$_GET[c] Bestellungen wurden für die Abholung freigegeben!</div>");
        ?>
        <div class="sales">
        <table>
            <tr>
                <th>Summe</th>
                <th>Name</th>
                <th>Stückpreis</th>
                <th>Gesamtpreis</th>
            </tr>
            <?php listglobalorderview('ordered', 0) ?>
        </table>
        </div>
    </div>
</body>

</html>