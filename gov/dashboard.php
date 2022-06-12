<!DOCTYPE html>
<html lang="de">
<?php
error_reporting(0);
require __DIR__ . "/../modules/lib/themehelper.php";
require "ac.php";
$_SESSION["rorder"] = NULL;
$theme = getTheme();
$loc = 0;
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beamtenbereich</title>
    <link rel="stylesheet" href="<?php echo ($theme) ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php require "navbar.php"; ?>
    <div class="main" id="main">
        <h1>Dein Arbeitsplatz:</h1>
        <ul>
            <?php if ($_SESSION['perm']['admin']) echo ("<li>Depp vom Dienst (Admin)</li>"); ?>
            <?php if ($_SESSION['perm']['toll']) echo ("<li>Zollbeamter</li>"); ?>
            <?php if ($_SESSION['perm']['bank']) echo("<li>Bänker</li>"); ?>
            <?php if ($_SESSION['perm']['warehouse']) echo("<li>Warenlagermitarbeiter</li>"); ?>

        </ul>
    </div>
</body>

</html>