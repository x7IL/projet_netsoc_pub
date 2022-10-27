<?php

require('join_db.php');
$mysqli = join_database();

$user = $_POST["username"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];
$email = $_POST["email"];
$genre = $_POST["genre"];
$age = $_POST["age"];

$result_can = mysqli_query($mysqli, "SELECT email FROM user WHERE email = '$email'");


if (mysqli_num_rows($result_can) == 0) {
    if ($repassword == $password) {
        global $mysqli;
        $message = "ok";
        $hash = hash("whirlpool", $password);
        // Password Hashing is used here.
        $sql = "INSERT INTO user (username, password, email, genre, age) VALUES ('$user', '$hash','$email','$genre','$age')";
        if ($mysqli->query($sql) === TRUE) {
            setcookie("username", $_POST["username"], time() + 3600);
            setcookie("email", $_POST["email"], time() + 3600);
            setcookie("password", $hash, time() + 3600);
            $result_can = $mysqli->query("SELECT * FROM user WHERE email = '$email' AND password ='$hash'");
            $result_can = $result_can->fetch_assoc();
            $bio = "INSERT INTO profile (biographie, id_user ,username) VALUES ('Biographie de $user', '{$result_can['id']}', '$user')";
            $mysqli->query($bio);
        } else {
            echo "<br>Error: " . $sql . "<br>" . $mysqli->error;
        }
        header('Location: ../index.php');
    }
    else{
        header('Location: ../index.php?erreur=3');
    }
}
else {
    $message = "non";
    header('Location: ../index.php?erreur=2');
}
mysqli_close($mysqli);
?>
