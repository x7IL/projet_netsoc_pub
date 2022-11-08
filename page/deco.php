<?php
    //deconnexion
    session_unset();
    setcookie("username", "");
    setcookie("password", "");
    setcookie("email", "");
    echo "Cookies Not Set";
    header("location: index.php");
?>
