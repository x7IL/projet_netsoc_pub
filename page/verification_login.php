<?php

session_start();
if(isset($_POST['email']) && isset($_POST['password'])) {

    require('join_db.php');
    $mysqli = join_database();

    $email = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['email']));
    $password = $_POST['password'];

    $result_can = mysqli_query($mysqli, "SELECT password,username FROM user WHERE email = '$email'");

    while ($row = $result_can->fetch_assoc()) {
        $hash = hash("whirlpool", $password);

        if (($row['password'] == $hash)) {
            setcookie("username", $row["username"], time() + 3600);
            setcookie("email", $_POST['email'], time() + 3600);
            setcookie("password", $hash, time() + 3600);
            echo "Cookies Set Successfuly";
            header('Location: ../index.php?user=' . $email);
            exit();
        }

    }
}
header('Location: ../index.php?erreur=1');
mysqli_close($mysqli); // fermer la connexion
?>
