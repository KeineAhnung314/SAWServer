<!DOCTYPE html>
<html lang="de">
<?php
require __DIR__ . "/../modules/ac.php";
require __DIR__ . "/../modules/lib/officerlib.php";
if (!$_SESSION['perm']['admin']) {
    header("Location: /gov/dashboard.php");
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
    <title>Beamtenverwaltung</title>
</head>

<body>
    <?php require __DIR__ . "/../gov/navbar.php"; ?>

    <div class="main" id="main">
        <form id="searchf" action="/admin/presence.php" method="get">
            <button type="button" class="btn" id="myBtn">Beamten hinzufügen</button>
        </form>


        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1>Beamten hinzufügen</h1>
                <form class="transaction" action="/modules/addofficer.php" method="post">
                    <input type="text" name="cId" id="" placeholder='BürgerID'  onfocus="this.value = ''">
                    
                    <input type="password" name="pw1" id="" placeholder='Passwort'  onfocus="this.value = ''">
                    <input type="password" name="pw2" id="" placeholder='Passwort wiederholen'  onfocus="this.value = ''">

                    <br> 
                    <h2> Berechtigungen </h2>
                    <span>Admin</span>
                    <input class="checkbox" style="size: 30px;" class="ascending" type="checkbox" name="admin" >
                    <span>Zoll</span>
                    <input class="checkbox" style="size: 30px;" class="ascending" type="checkbox" name="zoll" >
                    <span>Bank</span>
                    <input class="checkbox" style="size: 30px;" class="ascending" type="checkbox" name="bank" >
                    <span>Warenlager</span>
                    <input class="checkbox" style="size: 30px;" class="ascending" type="checkbox" name="warehouse" >
                    
                    <br> 
                    <input class="search" type="submit" value="Hinzufügen">
            </div>
            <script src="/ressource/js/modalworker.js"></script>
        </div>


    <div class="main" id="main">
        <div class="sales">
            <table>
                <tr>
                    <th>BeamtenID</th>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Klasse</th>
                    <th>Rechte
                        <table>
                            <tr>
                                <th>Warenlager</th>
                                <th>Zoll</th>
                                <th>Zoll</th>
                            </tr>
                        </table>
                    </th>
                </tr>
                <?php echo (listAllOfficers()); ?>
            </table>
        </div>
    </div>
</body>

</html>