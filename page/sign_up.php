<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
</head>
<body>
<h1>Sign Up</h1>
<form class="formulaire_inscription" action="" method="POST" style="word-spacing: 2px;">
    <label><b>Nom d'utilisateur</b></label>
    <label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
    </label>
    <br>
    <label><b>Adresse e-mail</b></label>
    <label>
        <input type="email" placeholder="Entrer votre adresse nail" name="email" required>
    </label>
    <br>
    <label><b>Mot de passe</b></label>
    <label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>
    </label>
    <br>
    <label><b>Verification de mot de passe</b></label>
    <label>
        <input type="password" placeholder="Re entrer le mot de passe" name="repassword" required>
    </label>
    <br>
    <label><b>Genre</b></label>
    <label>
        <input type="radio" name="genre" value="Homme" checked>
    </label>
    <label for="H">Homme</label>
    <label>
        <input type="radio" name="genre" value="Femme">
    </label>
    <label for="F">Female</label>
    <br>
    <label><b>Age</b></label>
    <label>
        <input type="number" placeholder="Entrer votre age" name="age" min="18" max="100" required>
    </label>
    <br>
    <input type="submit" id='submit' value='valider' >
    <br>
    <!--    <button onclick ="window.location='index.php?name=login.php'">Se connecter</button>-->
</form>

<?php
    //include "join_db.php";

    if (isset($_POST["password"]) && isset($_POST["username"]) && isset($_POST["repassword"]) && isset($_POST["email"])) {
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
                header('Location: index.php');
            } else {
                header('Location: index.php?erreur=3');
            }
        } else {
            $message = "non";
            header('Location: index.php?erreur=2');
        }
    }
    //gestion des messages d'erreurs
    if (isset($_COOKIE)) {
        if (isset($_GET['erreur'])) {
            $err = $_GET['erreur'];
            if ($err == 1)
                echo "<h1>Utilisateur ou mot de passe incorrect</h1>";
            if ($err == 2)
                echo "<h1>le nom d'utilisateur existe deja</h1>";
            if ($err == 3)
                echo "<h1>les mots de passe ne correspondent pas</h1>";
        }
    }
mysqli_close($mysqli);
?>

</body>
</html>
