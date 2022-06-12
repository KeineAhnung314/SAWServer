<!DOCTYPE html>
<html lang="de">
<?php
require __DIR__ . "/../modules/ac.php";
require __DIR__ . "/../modules/bankdisplay.php";
if (!$_SESSION['perm']['admin']) {
    header("Location: /gov/dashboard.php");
    die();
}
$loc = 9;
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
    <title>Transaktionen</title>
</head>

<body>
    <?php require __DIR__ . "/../gov/navbar.php"; ?>
    <div class="main" id="main">
        <div class="sales">
            <?php transglobal(); ?>
        </div>

    </div>
</body>

</html>