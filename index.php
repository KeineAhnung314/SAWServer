<!DOCTYPE html>
<html lang="de">
<?php
session_start();
if(isset($_SESSION['loginID'])){
    if(strlen($_SESSION['loginID'])==4){
        header("Location: /ent/dashboard.php");
    }
    if(strlen($_SESSION['loginID'])==6){
        header("Location: /my/dashboard.php");
    }
    if(strlen($_SESSION['loginID'])==7){
        header("Location: /gov/dashboard.php");
    }
}
error_reporting(0);
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Anmeldung</title>
</head>

<body>

    <center>

        <h1>Ottopia 2021</h1>
        <br>Melden sie sich an, um an ihr Konto zu gelangen</br>
        <br> _____________________________________________ </br>

        <?php
            if($_GET['err'] == 1) echo("<div class=\"loginerr\">Fehler bei der Anmeldung!<br>Überprüfen sie die Anmeldedaten und probieren sie es erneut!</div>");
            if($_GET['err'] == 2) echo("<div class=\"loginerr\">Ungültige Session!<br>Bitte melden sie sich erneut an!</div>");
            if($_GET['err'] == 3) echo("<div class=\"loginerr\">Zugriff verweigert!</div>");
            if($_GET['logout'] == 1) echo("<div class=\"logout\">erfolgreich Abgemeldet!</div>");
        ?>

        <form action="/modules/authhandler.php" method="post" target="">


            <br>ID </br>
            <input type="Text" name="ID" value="" size="" maxlength="20" required>
            <br>

            <br>Passwort </br>
            <input type="password" name="PW" value="" size="" maxlength="20" required>
            <br>

            <br>

            <input type="Submit" name="Anmelden" value="Absenden">

        </form>

    </center>

    

</body>

</html>