
<body>
<h1>Log In</h1>

<form class="formulaire_connexion" action="" method="POST">
    <label><b>Nom d'utilisateur</b></label>
    <label for="email"></label><input id="email" type="email" placeholder="Entrer votre adresse mail" name="email" required>
    <br>
    <label><b>Mot de passe</b></label>
    <label for="password"></label><input id="password" type="password" placeholder="Entrer le mot de passe" name="password" required>
    <br>
    <input type="submit" id='submit' value='valider' name="submit_log_in">
    <br>
    <!--    <button onclick ="window.location='index.php?name=inscription.php'">Inscription</button>-->
</form>
<?php

if(isset($_POST['email']) && isset($_POST['password'])) {
    if ($_POST["email"] != "" && $_POST["password"] != "") {
        $email = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['email']));
        $password = $_POST['password'];

        $result_can = mysqli_query($mysqli, "SELECT password,username FROM user WHERE email = '$email'");

        while ($row = $result_can->fetch_assoc()) {
            $hash = hash("whirlpool", $password);

            if (($row['password'] == $hash)) {
                session_start();
                setcookie("username", $row["username"], time() + 3600);
                setcookie("email", $_POST['email'], time() + 3600);
                setcookie("password", $hash, time() + 3600);
                echo "Cookies Set Successfuly";
                header('Location: index.php?user=' . $email);
                exit();
            }

        }
        header('Location: index.php?erreur=1');
    }
    else {
        header('Location: index.php?erreur=1');
    }
}
//gestion des messages d'erreurs
mysqli_close($mysqli); // fermer la connexion
?>

</body>
