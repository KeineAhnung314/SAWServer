<!DOCTYPE html>
<html lang="de">
<?php

require "ac.php";
$ID = $_SESSION['loginID']; 


$amount = $_POST["amount"];
$recId = $_POST['recId'];
$txtL = $_POST["txtL"];
$txtR = $_POST['txtR'];
$sendId = $_POST["sendId"];
$PW = $_POST["PW"];
 

//Authentifizierung des Kunden 
$PW = hash("sha256", $PW); 
$sendId = str_replace(['+', '-'], '', filter_var($sendId, FILTER_SANITIZE_NUMBER_INT)); //sanitize input
 

require __DIR__ . "/../modules/conn.php";

$sql = "SELECT * FROM citizen WHERE id = '$sendId'";
$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfrage: " . mysqli_error($db_link));
    echo "error"; 
}
while ($zeile = mysqli_fetch_assoc($erg)) {
    $password = $zeile["passwd"]; 
}

mysqli_free_result($erg);
mysqli_close($db_link);


if ($password == $PW){
    //Authentifizierung erfolgreich  
    ?> 
    Sie haben sich erfolgreich angemeldet 
    <br> 
    Möchten sie <?php echo $amount ?> GC an <?php echo $recID ?> überweisen? 
    <br> 
    Drücken sie 'Bestätigen', um die Überweisung zu tätigen

    <form action="/modules/transactionhandler.php" method="post" target="">

        <input type="hidden" name="recID" value="<?php echo $_POST["recId"]?>">
        <input type="hidden" name="txtL" value="<?php echo $_POST["txtL"]?>">
        <input type="hidden" name="txtR" value="<?php echo $_POST['txtR']?>">
        <input type="hidden" name="amount" value="<?php echo $_POST["amount"]?>">
        <input type="hidden" name="sendId" value="<?php echo $_POST['sendId']?>">
        <input type="hidden" name="target" value="/ent/dashboard.php">
    
        <input type="Submit" name="transaction" value="Bestätigen">

    </form>

    <?php 


} else {
    //Anmeldefehler
    ?> <a href="/ent/dashboard.php">Zurück</a> <?php 
    echo "Anmeldefehler";  
}



