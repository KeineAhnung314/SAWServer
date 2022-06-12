<!DOCTYPE html>
<html lang="de">
<?php
require "ac.php";
require __DIR__ . "/../modules/bankdisplay.php";
require __DIR__ . "/../modules/lib/presence.php";
require __DIR__ . "/../modules/lib/themehelper.php";
$theme = getTheme();
$loc = 0;
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo ($theme) ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>


<body>

    <?php require "navbar.php"; ?>



    <div class="main" id="main">
    
        <div class="top">
            <div class="balance dashboard">
                <h4>Dein Kontostand:</h4>
                <h1><?php getBal(); ?></h1>
            </div>
            <div class="time dashboard">
                <h4>Anwesenheitszeit:</h4>
                <h1><?php echo (presencetime($_SESSION['loginID'])) ?></h1>
            </div>
        </div>



        <div class="salesDisplay">
            <button class="tablink" onclick="openPage('rec', this, '#1a2b79')" id="defaultOpen">Gutschriften</button>
            <button class="tablink" onclick="openPage('send', this, '#1a2b79')">Lastschriften</button>
            <button class="tablink" onclick="openPage('transrec', this, '#1a2b79')">Gesamtübersicht</button>
            <div id="rec" class="sales">
                <?php transrec() ?>
            </div>
            <div id="send" class="sales">
                <?php transsend() ?>
            </div>
            <div id="transrec" class="sales">
                <?php transall() ?>
            </div>

        </div>
    </div>
</body>
<script>
    document.getElementById("defaultOpen").click();
</script>

</html>