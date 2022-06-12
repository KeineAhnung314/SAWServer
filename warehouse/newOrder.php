<!DOCTYPE html>
<html lang="de">
<?php
error_reporting(0);
require "ac.php";
require __DIR__ . "/../modules/entlist.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
if ($_SESSION['order']) {
    header("Location: /warehouse/product.php");
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
    <title>Neuer Auftrag</title>
</head>

<body>
    <?php require __DIR__ . "/../gov/navbar.php"; ?>

    <div class="main" id="main">
        <h1>Neuen Auftrag anlegen</h1>
        <div class="dashboard">
            <form action="newOrder.php" method="get" class="transaction">
                <input type="text" placeholder="Firmennamen" name="id">
                <input type="submit" value="Suchen" class="search">
            </form>
        </div>
        <div class="sales">
            <form action="/modules/orderhandler.php" method="post">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Id</th>
                    </tr>
                    <?php listallent($_GET['id'], 1); ?>
                </table>
            </form>
        </div>
    </div>
</body>

</html>