<!DOCTYPE html>
<html lang="en">
<?php
if (!isset($_GET["id"]) or !isset($_GET["value"]) or !isset($_GET["sid"])) {
    die("to few Arguments");
}

require __DIR__ . "/../modules/lib/premiumstate.php";
$rec = getpremiumname($_GET["id"]);
if (!$rec["premium"]) {
    die("goPay gesperrt, da der Empfänger kein premium besitzt!");
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Pay</title>
</head>

<body>
    <center>
        <h2>Go Pay</h2>
        <h3>Empfänger: <?php echo ($rec["name"]); ?></h3>
        <h3>Ihre ID: <?php echo($_GET["sid"]); ?></h3>
        <h3><?php echo($_GET["value"]); ?>GC</h3>
        <h3>Mit ihrem Passwort bestätigen</h3>
        <form action="/transaction/verify.php" method="post">
            <input type="password" name="passwd">
            <input type="submit" value="Zahlen">
            <input type="hidden" name="recid" value="<?php echo($_GET["id"]); ?>">
            <input type="hidden" name="sid" value="<?php echo($_GET["sid"]); ?>">
        </form>
    </center>
</body>

</html>