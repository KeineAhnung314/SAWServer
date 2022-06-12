<?php
require __DIR__ . "/../../gov/ac.php";
if(!isset($_POST['Anmelden']) AND !isset($_POST['Abmelden'])){
    header("Location: /index.php?err=2");
    die();
}
$id = $_POST["ID"];
$id = str_replace(['+', '-'], '', filter_var($id, FILTER_SANITIZE_NUMBER_INT)); //sanitize input
require __DIR__ . "/../conn.php";
if(strlen($id) != 6){
    header("Location: /gov/tollentrence.php?err=1");
    die();
}
if($id == $_SESSION["user"]){
    header("Location: /gov/tollentrence.php?err=2");
    die();
}
$sql = "SELECT * FROM citizen WHERE id = '$id'";
$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfrage: " . mysqli_error($db_link));
}
while ($zeile = mysqli_fetch_assoc($erg)) {
    $cId = $zeile["id"];
}
mysqli_free_result($erg);
mysqli_close($db_link);
if(!isset($cId)){
    header("Location: /gov/tollentrence.php?err=1");
    die();
}
require __DIR__ . "/../conn.php";
$sql = "SELECT * FROM arrival WHERE cId = '$id'";
$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfragge: " . mysqli_error($db_link));
}
while ($zeile = mysqli_fetch_assoc($erg)) {
    $double = $zeile["id"];
}
mysqli_free_result($erg);
mysqli_close($db_link);
if(isset($double)){
    header("Location: /gov/tollentrence.php?err=3");
    die();
}
require __DIR__ . "/../conn.php";
if(isset($_POST['Anmelden'])) $target = "arrival";
else $target = "departure";
$sql = "INSERT INTO $target (cid,oId) VALUES ('$id','$_SESSION[user]')";
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }else{
            header("Location: /gov/tollentrence.php?err=0");
        }

?>