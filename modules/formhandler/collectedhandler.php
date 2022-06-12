<?php
error_reporting(0);
require __DIR__ . "/../ac.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
require __DIR__ . "/../conn.php";
$sql = "SELECT * FROM orders WHERE orders.payed = 1 AND orders.state = 'arrived' AND orders.oid = $_SESSION[rorder];";
$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfrage: " . mysqli_error($db_link));
}
if (mysqli_num_rows($erg) == 1) {
    mysqli_free_result($erg);
    mysqli_close($db_link);
    require __DIR__ . "/../conn.php";
    $sql = "UPDATE orders SET orders.state = 'collected' WHERE orders.oid = $_SESSION[rorder];";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
}
mysqli_free_result($erg);
mysqli_close($db_link);
header("Location: /warehouse/pickuporder.php");