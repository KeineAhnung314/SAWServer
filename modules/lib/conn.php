<?php
    $domaene = "localhost";
    $nutzer = "root";
    $passwort = "?D+L1=:So5kvs6,eJlnv";
    $datenbank = "saw";
    $db_link = mysqli_connect($domaene, $nutzer, $passwort, $datenbank);
    if (mysqli_connect_errno()) {
        echo 'Connection failed. Error Number:' . mysqli_connect_error();
        exit();
    }
    ?>
