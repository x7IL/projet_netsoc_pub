<?php
//deconnexion
session_unset();
setcookie("password", "");
setcookie("email", "");
echo "Cookies Not Set";
header("location: index.php");
?>
