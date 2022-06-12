<?php
session_start();
if (!isset($_POST["change"])) {
    header("Location: /index.php");
    exit;
}

$pwOld = $_POST['PWOld'];
$pwNew = $_POST['PWNew'];
$pwRep = $_POST['PWRep'];
$id = $_SESSION['loginID'];

//validate pw
if($pwNew != $pwRep) {
    header("Location: password.php?err=1");
    exit;
}
if(strlen($pwNew)>20 or strlen($pwNew) < 6) {
    header("Location: password.php?err=2");
    exit;
}

$pwOld = hash("sha256", $pwOld);
require __DIR__ . "/../modules/conn.php";
$sql = "SELECT * FROM enterprise WHERE id = '$id'";
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $password = $zeile["pw"];
        }

        mysqli_free_result($erg);
        mysqli_close($db_link);
if($password != $pwOld){
    header("Location: password.php?err=3");
    exit;
}

//update passwd
$pwNew = hash("sha256", $pwNew);
require __DIR__ . "/../modules/conn.php";
$sql = "UPDATE enterprise SET pw = '$pwNew' WHERE id = '$id'";
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        mysqli_free_result($erg);
        mysqli_close($db_link);
        header("Location: password.php?sucess=1");

