<!DOCTYPE html>
<html lang="de">
<?php
require __DIR__ . "/../modules/ac.php";
require __DIR__ . "/../modules/lib/presence.php";
if (!$_SESSION['perm']['admin']) {
    header("Location: /gov/dashboard.php");
    die();
}
$loc = 10;
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
    <title>Anwesenheitskontrolle</title>
</head>

<body>
    <?php require __DIR__ . "/../gov/navbar.php"; ?>

    <div class="main" id="main">
        <form id="searchf" action="/admin/presence.php" method="get">
            <input class="btn" type="submit" value="Filter zurücksetzen">
            <button type="button" class="btn" id="myBtn">Suche Filtern</button>
        </form>


        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1>Suche Filtern</h1>
                <form class="transaction" action="/admin/presence.php" method="get">
                    <input class="date" type="date" name="date" id="" value="<?php echo ($_GET['date']) ?>">
                    <input type="text" name="fName" id="" placeholder='Vorname' value="<?php echo ($_GET['fName']) ?>" onfocus="this.value = ''">
                    <input type="text" name="lName" id="" placeholder='Nachname' value="<?php echo ($_GET['lName']) ?>" onfocus="this.value = ''">
                    <input type="text" name="kl" id="" placeholder='Klasse' value="<?php echo ($_GET['kl']) ?>" onfocus="this.value = ''">
                    <input type="text" name="cId" id="" placeholder="Bürger ID" value="<?php echo ($_get['cId']) ?>" onfocus="this.value = ''">
                    <span>Aufsteigend sortieren</span>
                    <input class="checkbox" style="size: 30px;" class="ascending" type="checkbox" name="asc" <?php if (isset($_GET['asc'])) echo ("checked") ?>>
                    <br>
                    <input class="search" type="submit" value="Filter anwenden">
                    <input class="search" type="button" value="Filter zurücksetzen" onclick="d = document.getElementById('searchf'); d.reset(); d.submit();">
            </div>
            <script src="/ressource/js/modalworker.js"></script>
        </div>

        <div class="sales">
            <br> <br>
            <table>
                <tr>
                    <th>Bürger ID</th>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Klasse</th>
                    <th>Datum</th>
                    <th>Anwesenheitszeit</th>
                </tr>
                <?php global_presencetime($_GET['date'], $_GET['fName'], $_GET['lName'], $_GET['kl'], $_GET['cId'], $_GET['asc']); ?>
            </table>
        </div>
    </div>

</body>

</html>