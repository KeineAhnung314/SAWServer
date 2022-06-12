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
    if ($shipping) {
        echo ("<div class=\"logout\">Da es eine nicht abgearbeitete Liste gibt, wird keine neue erstellt!!!</div>");
        header("Refresh: 4, URL=/warehouse/shoppinglist.php");
        exit();
    }

    require __DIR__ . "/../conn.php";
    $filter = mysqli_real_escape_string($db_link, $filter);
    $sql = "UPDATE orders SET state = 'shipping' WHERE state = 'ordered'";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    $count = mysqli_affected_rows($db_link);
    mysqli_free_result($erg);
    mysqli_close($db_link);
    echo ("<div class=\"logout\">Status von $count Bestellung(en) wurde auf \"in Beschaffung\" gesetzt.</div>");
    header("Refresh: 4, URL=/warehouse/shoppinglist.php");
    ?>
</body>

</html>