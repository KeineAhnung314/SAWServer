<?php
    function getpremiumname($id){
        require __DIR__ . "/../conn.php";
    $id = mysqli_real_escape_string($db_link, $id);
    $sql = "SELECT premium,name FROM enterprise;";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $b = $zeile['premium'];
        $n = $zeile['name'];
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
    return array("premium"=>$b,"name"=>$n);
}
?>