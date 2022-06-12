<?php
require "ac.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
if (!$_SESSION['order']) {
    header("Location: /warehouse/newOrder.php");
    die();
}
require "conn.php";
$sql = "DELETE FROM orders WHERE oId = '$_SESSION[order]' AND state = 'ordering';";

$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfrage: " . mysqli_error($db_link));
}
mysqli_free_result($erg);
mysqli_close($db_link);
require "conn.php";
$sql = "DELETE FROM orderItem WHERE oId = '$_SESSION[order]';";

$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfrage: " . mysqli_error($db_link));
}
mysqli_free_result($erg);
mysqli_close($db_link);
$_SESSION["order"] = null;
header("Location: /gov/dashboard.php");