<?php
session_start();
if ($_SESSION["order"] > 0) {
    require "conn.php";
    $sql = "DELETE FROM orders WHERE oId = '$_SESSION[order]' AND state = 'ordering';";

    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
}
session_destroy();
header("Location: /index.php/?logout=1");
