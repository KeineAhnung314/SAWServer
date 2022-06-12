<?php
function getTheme() {
    $theme = "/ressource/style/";
    if($_SESSION["type"] == "citizen") $theme = $theme . "my";
    if($_SESSION["type"] == "officer") $theme = $theme . "gov";
    if($_SESSION["type"] == "enterprise") $theme = $theme . "ent";

    if($_SESSION["theme"] == "Hell") $theme = $theme . "Light.css";
    if($_SESSION["theme"] == "Dunkel") $theme = $theme . "Dark.css";


    return $theme;
}

?>