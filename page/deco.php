<?php
    //deconnexion
    session_unset();
    setcookie("username", "",time() - 3600);
    setcookie("email", "",time() - 3600);

    echo "Cookies Not Set";
    header("location: index.php");
?>
