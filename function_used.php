<?php
function insert_fields($table, $fields) {
    global $mysqli;
    $tab = array_keys($fields); //ici fields doit etre égale à un tableau ( dans notre cas : le message , l'id et quand le message à été posté)
    $keys = implode(",",$tab);
    $value = implode("','",$fields);

    if(preg_match('/[a-zA-Z_0-9,@!.?] */',$value) == 0){
        print " Mauvaise orthographe ";
        return null;
    }
    $mysqli->query("INSERT INTO $table ($keys) VALUES ('$value')") or die($mysqli->error);

    return 0;
}
function delete_fields($table, $keys, $value) {

    global $mysqli;
    echo $value;
    $sql = "DELETE FROM $table WHERE $keys = $value ";

    if ($mysqli->query($sql) === TRUE) {
        echo "\nsupprimé";
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }
}
function abo_affi($n) {
    // first strip any formatting;
    $n = (0+str_replace(",","",$n));
    // is this a number?
    if(!is_numeric($n)) return false;
    // now filter it;
    if($n>1000000000000) return round(($n/1000000000000),1).' billion';
    else if($n>1000000000) return round(($n/1000000000),1).' milliard';
    else if($n>1000000) return round(($n/1000000),1).' million';


    return number_format($n);
}
?>
