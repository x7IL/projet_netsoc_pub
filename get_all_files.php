<?php
function get_all_files(){
    $tab = scandir('page');
    return $tab;
}
?>
