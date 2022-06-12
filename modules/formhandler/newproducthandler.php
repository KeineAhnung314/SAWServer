<?php
require __DIR__ . "/../ac.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
$name = $_POST['pname'];
$price = $_POST['price'];
$price = str_replace([','],'.',$price);
$price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); //sanitize input
$name = str_replace(['+', '-'], '', filter_var($name, FILTER_SANITIZE_STRING));

if(strlen($name) < 4 OR strlen($name) > 40) {
    header("Location: /warehouse/productoverview.php?err=10");
    die();
}
if($price < 0.1){
    header("Location: /warehouse/productoverview.php?err=20");
    die();
}
require __DIR__ . "/../conn.php";
$sql = "INSERT INTO article (name,price) VALUES ('$name',$price);";

$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfrage: " . mysqli_error($db_link));
}
mysqli_free_result($erg);
mysqli_close($db_link);
header("Location: /warehouse/productoverview.php?suc=10&name=$name");