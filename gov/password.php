<!DOCTYPE html>
<?php
require "ac.php";
$loc = 1;
require __DIR__ . "/../modules/lib/themehelper.php";
$theme = getTheme();
?>
<html lang="de">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passwort ändern</title>
    <link rel="stylesheet" href="<?php echo ($theme) ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php require "navbar.php"; ?>

    <div class="main" id="main">
        <h1>Passwort ändern</h1>
        <?php
        if ($_GET['err'] == 1) echo ("<div class=\"loginerr\">Die neuen Passwörter stimmen nicht überein!</div>");
        if ($_GET['err'] == 2) echo ("<div class=\"loginerr\">Das neue Passwort muss zwischen 6 und 20 Zeichen lang sein!</div>");
        if ($_GET['err'] == 3) echo ("<div class=\"loginerr\">Altes Passwort ist falsch!</div>");
        if ($_GET['sucess'] == 1) {
            echo ("<div class=\"logout\">Passwort erfolgreich geändert!</div>");
            header("Refresh: 1.5, URL=dashboard.php");
        }
        ?>
        <form action="pwhandler.php" method="post" target="" class="transaction">
            <input placeholder="altes Passwort" type="password" name="PWOld" value="" size="" maxlength="20" required>
            <br>
            <input placeholder="neues Passwort" type="password" name="PWNew" value="" size="" maxlength="20" required>
            <br>
            <input placeholder="Passwort wiederholen" type="password" name="PWRep" value="" size="" maxlength="20" required>
            <br>
            <br>

            <input class="submit" type="Submit" name="change" value="Passwort ändern">

        </form>
    </div>
</body>

</html>