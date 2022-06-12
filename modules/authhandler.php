
<?php
session_start();
error_reporting(0);
?>

    <?php
    if (!isset($_POST["Anmelden"])) {
        header("Location: /index.php");
        exit;
    }
    $PW = $_POST["PW"];
    $id = $_POST['ID'];
    $hashPassword = hash("sha256", $PW);  //hash value aus Datenbank abfragen
    $id = str_replace(['+', '-'], '', filter_var($id, FILTER_SANITIZE_NUMBER_INT)); //sanitize input
    require "conn.php";

    if (strlen($id) == 6) {
        //Bürger
        $sql = "SELECT * FROM citizen WHERE id = '$id'";
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $password = $zeile["passwd"];
            $fName = $zeile["fName"];
            $lName = $zeile["lName"];
            $kl = $zeile["kl"];
            $theme = $zeile["theme"];
        }

        mysqli_free_result($erg);
        mysqli_close($db_link);

        if ($password == $hashPassword) {
            //Erfolgreich angemeldet 
            $_SESSION["loginID"] = $id;
            $_SESSION["type"] = "citizen";
            $_SESSION["fName"] = $fName;
            $_SESSION["lName"] = $lName;
            $_SESSION["kl"] = $kl;
            $_SESSION["theme"] = $theme;

            header("Location: /my/dashboard.php");
        } else {
            //Fehler bei der Anmeldung 
            header("Location: /index.php/?err=1");
        }
    } else if (strlen($id) == 4) {
        //Betriebe (inklusive zoll, Bank)
        $sql = "SELECT * FROM enterprise WHERE id = '$id'";
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $password = $zeile["pw"];
            $theme = $zeile["theme"];
        }
        mysqli_free_result($erg);
        mysqli_close($db_link);


        if ($password == $hashPassword) {
            //Erfolgreich angemeldet   
            $_SESSION["loginID"] = $id;
            $_SESSION["type"] = "enterprise";
            $_SESSION["theme"] = $theme;
            header("Location: /ent/dashboard.php");
        } else {
            //Fehler bei der Anmeldung 
            header("Location: /index.php/?err=1");
        }
    } else if (strlen($id) == 7) {
        //Betriebe (inklusive zoll, Bank)
        $sql = "SELECT officer.pw,officer.cId,officer.theme,citizen.fName,citizen.lName,warehouse,admin,bank,toll FROM officer JOIN citizen ON citizen.id = officer.cId WHERE officer.id = '$id'";
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $password = $zeile["pw"];
            $user = $zeile["cId"];
            $themeoff = $zeile["theme"];
            $fName = $zeile["fName"];
            $lName = $zeile["lName"];
            $permission = array("warehouse"=> $zeile["warehouse"],"admin"=>$zeile["admin"],"bank"=>$zeile["bank"],"toll"=>$zeile["toll"]);

        }
        mysqli_free_result($erg);
        mysqli_close($db_link);
        require "conn.php";
        $sql = "SELECT oId FROM orders WHERE offid = '$id' AND state = 'ordering'";
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        while ($zeile = mysqli_fetch_assoc($erg)) {
           $_SESSION['order'] = $zeile['oId'];

        }

        mysqli_free_result($erg);
        mysqli_close($db_link);

        if ($password == $hashPassword) {
            //Erfolgreich angemeldet   
            $_SESSION["loginID"] = $id;
            $_SESSION["type"] = "officer";
            $_SESSION["perm"] = $permission;
            $_SESSION["user"] = $user;
            $_SESSION["theme"] = $themeoff;
            $_SESSION["fName"] = $fName;
            $_SESSION["lName"] = $lName;
            
            header("Location: /gov/dashboard.php");
        } else {
            //Fehler bei der Anmeldung 
            header("Location: /index.php/?err=1");
        }
    } else {
        //Fehler bei der Anmeldung
        header("Location: /index.php/?err=1");
    }
    ?>
