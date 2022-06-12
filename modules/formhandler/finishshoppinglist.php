<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erstelle Einkaufsliste</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <?php
    require_once __DIR__ . "/../ac.php";
    if (!$_SESSION['perm']['warehouse']) {
        header("Location: /gov/dashboard.php");
        die();
    }
    require __DIR__ . "/../conn.php";
    $filter = mysqli_real_escape_string($db_link, $filter);
    $sql = "SELECT * FROM orders WHERE state = 'shipping'";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    while ($zeile = mysqli_fetch_assoc($erg)) $shipping = $zeile['oId'];
    mysqli_free_result($erg);
    mysqli_close($db_link);
    if (!$shipping) {
        header("Location: /warehouse/shoppingoverview.php?err=1");
        exit();
    }

    require __DIR__ . "/../conn.php";
    $filter = mysqli_real_escape_string($db_link, $filter);
    $sql = "UPDATE orders SET state = 'arrived' WHERE state = 'shipping'";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    $count = mysqli_affected_rows($db_link);
    mysqli_free_result($erg);
    mysqli_close($db_link);
    header("Location: /warehouse/shoppingoverview.php?suc=1&c=$count");
    ?>
</body>

</html>