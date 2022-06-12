<!DOCTYPE html>
<html lang="de">
<?php
error_reporting(0);
require "ac.php";
if (!$_SESSION['perm']['toll']) {
    header("Location: dashboard.php");
    die();
}
$loc = 7;
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
    <title>Ausgang Zoll</title>
</head>

<body>
    <?php require __DIR__ . "/../gov/navbar.php"; ?>
    <div class="main" id="main">
    <?php if($_GET['err'] == 1) echo("<div class=\"loginerr\">Ungültige Bürger ID</div>");?>
    <?php if($_GET['err'] == 2) echo("<div class=\"loginerr\">Du kannst dich nicht selbst an- oder abmelden</div>");?>
    <?php if($_GET['err'] == 3) echo("<div class=\"loginerr\">Bürger wurde nicht am Eingang angemeldet</div>");?>
    <form class="transaction" action="/modules/formhandler/tollexithandler.php" method="post">
    <input type="text" name="ID" maxlength="20" required autofocus placeholder="Bürger ID">
    <input class="search" type="submit" name="Abmelden" value="Absenden">
    </form>
</body>

</html>