

<h1>Log In</h1>

<form class="formulaire_connexion" action="" method="POST">
    <div class="control block-cube block-input">
        <div id="a_remplir" >
            <label for="email"></label><input id="email" type="email" placeholder="Entrer votre adresse mail" name="email" required>
            <br>
            <label for="password"></label><input id="password" type="password" placeholder="Entrer le mot de passe" name="password" required>

        </div>

        <input type="submit" id='submit' value='valider' name="submit_log_in">
        <br>
        <?php useless_div(); ?>
    </div>
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
                setcookie("username", $row["username"], time() + 3600);
                setcookie("email", $_POST['email'], time() + 3600);
                setcookie("password", $hash, time() + 3600);
                echo "Cookies Set Successfuly";
                echo "<script> location.replace('index.php?user='. $email); </script>";
                exit();
            }

        }
        echo "<script> location.replace('index.php?erreur=1'); </script>";
        exit();

    }
    else {
        echo "<script> location.replace('index.php?erreur=1'); </script>";
        exit();
    }
}
//gestion des messages d'erreurs
 // fermer la connexion
?>

