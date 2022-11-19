<h1 style="font-size: 2em">Sign Up</h1>

    <form class="formulaire_inscription" action="" method="POST" style="word-spacing: 2px; display: inline-block; padding-right: 2%;">
        <div class='control block-cube block-input' style="">
            <div id="a_remplir">
                <label>
                    <input style="background-color: #212121; color: #fff; " type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
                </label>
                <br>
                <label>
                    <input style="background-color: #212121; color: #fff; " type="email" placeholder="Entrer votre adresse mail" name="email" required>
                </label>
                <br>
                <label>
                    <input style="background-color: #212121; color: #fff; " type="password" placeholder="Entrer le mot de passe" name="password" required>
                </label>
                <br>
                <label>
                    <input style="background-color: #212121; color: #fff; " type="password" placeholder="Re entrer le mot de passe" name="repassword" required>
                </label>
                <br>
                <label>
                    <input style="background-color: #212121; color: #fff; " type="radio" name="genre" value="Homme" checked>
                </label>
                <label for="H" style="position: relative; z-index: 5">Homme</label>
                <label>
                    <input style="background-color: #212121; color: #fff; " type="radio" name="genre" value="Femme">
                </label>
                <label for="F" style="position: relative; z-index: 5">Female</label>
                <br>
                <label>
                    <input style="background-color: #212121; color: #fff; " type="number" placeholder="Entrer votre age" name="age" min="18" max="100" required>
                </label>
            </div>
            <br>
            <div class='btn block-cube block-cube-hover' id="input" style="margin-left: 1%; margin-bottom: 1%; display: inline-block; position: relative ;z-index: 11">
                <input style="background-color: #212121; color: #fff; " type="submit" id='submit' value='valider' >
                <?php useless_div(); ?>
            </div>
            <?php useless_div(); ?>
        </div>

        <!--    <button onclick ="window.location='index.php?name=login.php'">Se connecter</button>-->
    </form>

<?php
    //include "join_db.php";

/**
 * @param $password
 * @param $user
 * @param $email
 * @param $genre
 * @param $age
 * @param mysqli $mysqli
 * @return void
 */
function extracted($password, $user, $email, $genre, $age, mysqli $mysqli)
{
    global $mysqli;
    $hash = hash("whirlpool", $password);
    // Password Hashing is used here.
    session_start();
    $sql = "INSERT INTO user (username, password, email, genre, age) VALUES ('$user', '$hash','$email','$genre','$age')";
    if ($mysqli->query($sql) === TRUE) {
        setcookie("username", $_POST["username"], time() + 3600);
        setcookie("email", $_POST["email"], time() + 3600);
        setcookie("password", $hash, time() + 3600);
        $result_canf = $mysqli->query("SELECT * FROM user WHERE email = '$email' AND password ='$hash'");
        $result_canf = $result_canf->fetch_assoc();
        $bio = "INSERT INTO profile (biographie, id_user ,username) VALUES ('Biographie de $user', '{$result_canf['id']}', '$user')";
        $mysqli->query($bio);
    } else {
        echo "<br>Error: " . $sql . "<br>" . $mysqli->error;
    }
}

if (isset($_POST["password"]) && isset($_POST["username"]) && isset($_POST["repassword"]) && isset($_POST["email"])) {
        $user = $_POST["username"];
        $password = $_POST["password"];
        $repassword = $_POST["repassword"];
        $email = $_POST["email"];
        $genre = $_POST["genre"];
        $age = $_POST["age"];

        $result_can = mysqli_query($mysqli, "SELECT * FROM user WHERE email = '$email' AND username = '$user'");
        $result_can = $result_can->fetch_assoc();
        echo "test";

        if (!$result_can) {
            echo "test";
            if ($repassword == $password) {
                extracted($password, $user, $email, $genre, $age, $mysqli);
                echo "<script> location.replace('index.php'); </script>";
                exit();
            } else {
                echo "<script> location.replace('index.php?erreur=3'); </script>";
                exit();
            }
        } else {
            echo "<script> location.replace('index.php?erreur=2'); </script>";
        }
    }
    //gestion des messages d'erreurs
?>

