<?php
function presencetime($id)
{
    require __DIR__ . "/../conn.php";
    $id = mysqli_real_escape_string($db_link, $id);
    $sql = "SELECT ADDTIME(COALESCE(presence.time,0),COALESCE(TIMEDIFF(CURRENT_TIMESTAMP(),arrival.date),0)) AS 'time' FROM citizen LEFT JOIN presence ON presence.cId = citizen.id AND presence.date = COALESCE(DATE('$date'), CURRENT_DATE) LEFT JOIN arrival ON citizen.id = arrival.cId WHERE citizen.id = $id";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $time = $zeile['time'];
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
    if ($time == "") return "00:00";
    return $time;
}
function global_presencetime($date, $fName, $lName, $klasse, $id, $asc)
{
    require __DIR__ . "/../conn.php";
    $date = mysqli_real_escape_string($db_link, $date);
    $fName = mysqli_real_escape_string($db_link, $fName);
    $lName = mysqli_real_escape_string($db_link, $lName);

    $klasse = mysqli_real_escape_string($db_link, $klasse);
    $klasse = strtoupper($klasse);

    if (!$date or date('Y-m-d') == date('Y-m-d', strtotime($date))) {
        $sql = "SELECT citizen.id,citizen.fName,CURRENT_DATE AS 'date',citizen.lName,citizen.kl, ADDTIME(COALESCE(presence.time,0),COALESCE(TIMEDIFF(CURRENT_TIMESTAMP(),arrival.date),0)) AS 'time' FROM citizen LEFT JOIN presence ON presence.cId = citizen.id AND presence.date = COALESCE(DATE('$date'), CURRENT_DATE) LEFT JOIN arrival ON citizen.id = arrival.cId WHERE 1 = 1";
    } else {
        $sql = "SELECT citizen.id,citizen.fName,COALESCE(presence.date,'$date') AS date ,citizen.lName,citizen.kl, presence.time FROM citizen LEFT JOIN presence ON presence.cId = citizen.id AND presence.date = COALESCE(DATE('$date'), CURRENT_DATE) WHERE 1 = 1";
    }

    //$sql = "SELECT citizen.id,citizen.fName,presence.date,citizen.lName,citizen.kl, ADDTIME(COALESCE(presence.time,0),COALESCE(TIMEDIFF(CURRENT_TIMESTAMP(),arrival.date),0)) AS 'time' FROM citizen LEFT JOIN presence ON presence.cId = citizen.id AND presence.date = COALESCE(DATE('$date'), CURRENT_DATE) LEFT JOIN arrival ON citizen.id = arrival.cId";
    // $sql = "SELECT citizen.id,citizen.fName,citizen.lName,citizen.kl, ADDTIME(presence.time,COALESCE(TIMEDIFF(CURRENT_TIMESTAMP(),arrival.date),0)) AS 'time' FROM citizen LEFT JOIN presence ON presence.cId = citizen.id AND presence.date = COALESCE(DATE('$date'), CURRENT_DATE) LEFT JOIN arrival ON citizen.id = arrival.cId";
    // $sql = "SELECT presence.cId,citizen.fName,citizen.lName,citizen.kl, presence.date, ADDTIME(presence.time,COALESCE(TIMEDIFF(CURRENT_TIMESTAMP(),arrival.date),0)) AS 'time' FROM `presence` LEFT JOIN arrival ON presence.cId = arrival.cId JOIN citizen ON presence.cId = citizen.id WHERE presence.date = COALESCE(DATE('$date'), CURRENT_DATE)";
    if (strlen($fName) > 0) $sql = $sql . " AND citizen.fName LIKE '%$fName%'";
    if (strlen($lName) > 0) $sql = $sql . " AND citizen.lName LIKE '%$lName%'";
    if (strlen($klasse) > 0) $sql = $sql . " AND citizen.kl LIKE '%$klasse%'";
    if (strlen($id) > 0) $sql = $sql . " AND citizen.id = $id ";
    if ($asc) $sql = $sql . " ORDER BY time ASC;";
    else $sql = $sql . " ORDER BY time DESC;";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . $sql . mysqli_error($db_link));
    }
    $even = FALSE;
    while ($zeile = mysqli_fetch_assoc($erg)) {
        if (strlen($zeile["time"]) < 1) {
            $zeile["time"] = "00:00:00";
        }
        $even = !$even;
        echo ("<tr class=\"");
        if ($even == 0) echo ('even');
        else echo ('odd');
        $zeile["date"] = date("d.m.Y", strtotime($zeile["date"]));
        echo ("\">");
        echo ("<td>$zeile[id]</td>");
        echo ("<td>$zeile[fName]</td>");
        echo ("<td>$zeile[lName]</td>");
        echo ("<td>$zeile[kl]</td>");
        echo ("<td>$zeile[date]</td>");
        echo ("<td>$zeile[time]</td>");
        echo ("</tr>");
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
}
