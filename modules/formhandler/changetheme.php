<?php
    session_start();
    $newTheme = $_POST["theme"];
    require __DIR__ . "/../lib/conn.php";
    if (strlen($_SESSION['loginID']) == 6) $sql = "UPDATE citizen SET `theme` = '$_POST[theme]' WHERE citizen.id = $_SESSION[loginID];";
    if (strlen($_SESSION['loginID']) == 4) $sql = "UPDATE enterprise SET `theme` = '$_POST[theme]' WHERE enterprise.id = $_SESSION[loginID];";
    if (strlen($_SESSION['loginID']) == 7) $sql = "UPDATE officer SET `theme` = '$_POST[theme]' WHERE officer.id = $_SESSION[loginID];";

    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    mysqli_close($db_link);
    $_SESSION["theme"] = $newTheme;
    if (strlen($_SESSION['loginID']) == 6) header("Location: /my/dashboard.php");
    if (strlen($_SESSION['loginID']) == 4) header("Location: /ent/dashboard.php");
    if (strlen($_SESSION['loginID']) == 7) header("Location: /gov/dashboard.php");
