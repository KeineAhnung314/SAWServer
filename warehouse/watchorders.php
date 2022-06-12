<!DOCTYPE html>
<html lang="de">
<?php
error_reporting(0);
require "ac.php";
require __DIR__ . "/../modules/lib/productlist.php";
require __DIR__ . "/../modules/entlist.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
if ($_SESSION['order']) {
    header("Location: /warehouse/product.php");
    die();
}
$_SESSION["rorder"] = NULL;
$loc = 2;
require __DIR__ . "/../modules/lib/themehelper.php";
$theme = getTheme();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellungen einsehen</title>
    <link rel="stylesheet" href="<?php echo ($theme) ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php require __DIR__ . "/../gov/navbar.php"; ?>

    <div class="main" id="main">
        <?php
        if ($_GET['err'] == 1) echo ("<div class=\"loginerr\">Bestellung gelöscht, da diese leer ist!</div>");
        if ($_GET['suc'] == 1) echo ("<div class=\"logout\">Status der Bestellung geändert</div>");
        ?>
        <h1>Auftrag auswählen</h1>
        <div class="dashboard">
        <form action="watchorders.php" method="get" class="transaction">
            <input autocomplete="off" type="text" name="id" placeholder="Auftragsnr. / Firmennamen">
            <input type="submit" value="Suchen" class="search">
        </form>
        </div>
        <div class="sales">
            <form action="/modules/formhandler/editorderhandler.php" method="post">
                <table >
                    <tr>
                        <th>Auftragsnr.</th>
                        <th>Aufgraggeber</th>
                        <th>Bezahlt</th>
                        <th>Status</th>
                        <th>Aufgegeben am</th>
                    </tr>
                    <?php listglobalorder($_GET['id']); ?>
                </table>
            </form>
        </div>
    </div>
</body>

</html>