<?php
require __DIR__ . "/../ac.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
$id = $_POST['id'];
$id = str_replace(['+', '-'], '', filter_var($id, FILTER_SANITIZE_NUMBER_INT)); //sanitize input

require __DIR__ . "/../conn.php";
$sql = "UPDATE orders JOIN orderItem ON orderItem.oId = orders.oId JOIN article ON orderItem.aId = article.artId SET state = 'cancelled' WHERE article.artId = '$id' AND orders.state = 'ordered';";
echo($sql);
$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfrage: " . mysqli_error($db_link));
}
$rows = mysqli_affected_rows($db_link);
mysqli_free_result($erg);
mysqli_close($db_link);
require __DIR__ . "/../conn.php";
$sql = "UPDATE orders JOIN orderItem ON orderItem.oId = orders.oId JOIN article ON orderItem.aId = article.artId SET state = 'errored' WHERE article.artId = '$id' AND orders.state = 'shipping';";
echo($sql);
$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfrage: " . mysqli_error($db_link));
}
$rows = $rows + mysqli_affected_rows($db_link);
mysqli_free_result($erg);
mysqli_close($db_link);

require __DIR__ . "/../conn.php";
$sql = "UPDATE article SET available = 0 WHERE artId = '$id'";
echo($sql);
$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfrage: " . mysqli_error($db_link));
}
mysqli_free_result($erg);
mysqli_close($db_link);


header("Location: /warehouse/productoverview.php?suc=1&rows=$rows");