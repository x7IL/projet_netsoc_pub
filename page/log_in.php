<h1 style="font-size: 2em">Log In</h1>

<form class="formulaire_connexion" action="" method="POST">
    <div class="control block-cube block-input">
        <div id="a_remplir" >
            <label for="email"></label><input id="email" type="email" placeholder="Entrer votre adresse mail" name="email" style="background-color: #212121; color: #fff; " required>
            <br>
            <label for="password"></label><input id="password" type="password" placeholder="Entrer le mot de passe" name="password" style="background-color: #212121; color: #fff; " required>

        </div>
        <br>
        <div class="btn block-cube block-cube-hover" style="margin-left: 1%; margin-bottom: 1%; position: relative; z-index: 11;  display: inline-block">
            <input type="submit" id='submit' value='valider' name="submit_log_in" style="background-color: #212121; color: #fff; ">
            <?php useless_div(); ?>
        </div>
        <?php useless_div(); ?>
    </div>
    <!--    <button onclick ="window.location='index.php?name=inscription.php'">Inscription</button>-->
</form>
<?php

function log_in($username, $email, $hash){
    session_start();
    setcookie("username", $username, time() + 3600);
    setcookie("email", $email, time() + 3600);
    setcookie("password", $hash, time() + 3600);
    echo "Cookies Set Successfuly";
    echo "<script> location.replace('index.php'); </script>";
    exit();
}

if(isset($_POST['email']) && isset($_POST['password'])) {
    if ($_POST["email"] != "" && $_POST["password"] != "") {
        $email = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['email']));
        $password = $_POST['password'];

        $result_can = mysqli_query($mysqli, "SELECT password,username FROM user WHERE email = '$email'");

        while ($row = $result_can->fetch_assoc()) {
            $hash = hash("whirlpool", $password);

            if (($row['password'] == $hash)) {
                log_in($row["username"], $email, $hash);
            }

        }
        echo "<script> location.replace('index.php?erreur=1'); </script>";

    }
    else {
        echo "<script> location.replace('index.php?erreur=1'); </script>";
    }
}
//gestion des messages d'erreurs
 // fermer la connexion
?>
