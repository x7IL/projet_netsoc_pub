<?php
$mysqli = NULL;

function join_database() {
    global $mysqli;

    $dbinfo = file_get_contents("join_data.json");
    $dbinfo = json_decode($dbinfo, true);
    $mysqli = new mysqli($dbinfo["domain"], $dbinfo["login"], $dbinfo["password"],$dbinfo["database"]);

    if ($mysqli->connect_error) {
        die("<br>Connection failed: " . $mysqli->connect_error);
    }
    return $mysqli;
}

?>
