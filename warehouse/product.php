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
if ($_SESSION['order'] < 1) {
    header("Location: /warehouse/newOrder.php");
    die();
}
$loc = 3;
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
    <title>Produkte hinzufügen</title>
</head>

<body>
    <?php require __DIR__ . "/../gov/navbar.php"; ?>

    <div class="main" id="main">
    <a href="/modules/stornoorder.php" class="btn">Bestellung Stornieren</a>
    <a class="btn" href="/warehouse/confirm.php">Bestellung abschließen</a>
        <h1>Produkte hinzufügen</h1>
        <?php if ($_GET['suc'] == 1) echo ("<div class=\"logout\">$_GET[val] Produkt(e) zur Liste hinzugefügt!</div>"); ?>
        <?php if ($_GET['suc'] == 2) echo ("<div class=\"logout\">Produkt zur Liste hinzugefügt!</div>"); ?>
        <div class="dashboard">
            <form action="product.php" method="get" class="transaction">
                <input type="text" placeholder="Artikel" name="ID">
                <input type="submit" value="Suchen" class="search">
            </form>
        </div>
        <form action="/modules/productorder.php" method="post" class="article">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Preis</th>
                    <th>&nbsp;</th>
                </tr>
                <?php listallproduct($_GET['ID'], 1, 1); ?>
            </table>
        </form>
        
    </div>
</body>

</html>