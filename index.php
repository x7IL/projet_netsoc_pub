<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="node_modules/aos/dist/aos.css">

        <title>GMK</title>

    </head>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            var scrollpos = localStorage.getItem("scrollpos");
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onscroll = function (e) {
            localStorage.setItem("scrollpos", window.scrollY);
        };
    </script>

    <body style="color:white">

    <?php
    session_start();

                                                #avoir les droits admin --> mettre son ip lorsque le site sera en ligne ou laisser en localhost
                            #avoir les droits permet de modifier le profil de quelqu'un ou de le supprimer.mer


################################################################################################################################################
        $full_droit = 0;
        if ($_SERVER['REMOTE_ADDR'] == 'localhost'){
            $full_droit = 1;
        }
################################################################################################################################################

        require "join_db.php";

        join_database();

        if((isset($_COOKIE['email']) && isset($_COOKIE['username']) && isset($_COOKIE['password'])) || (isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password']))) {
            $temp = 1;

            $_SESSION['username'] = !isset($_COOKIE['username']) ? $_SESSION['username'] : $_COOKIE['username'] ;
            $_SESSION['email'] = !isset($_COOKIE['email']) ? $_SESSION['password'] : $_COOKIE['email'] ;
            $_SESSION['password'] = !isset($_COOKIE['password']) ? $_SESSION['password'] : $_COOKIE['password'] ;
            setcookie("password", "", time() - 3600);
            echo "[" . $_SESSION['username'] . "]";
            echo "\n[" . $_SERVER['REMOTE_ADDR'] . "]";
            $result_can = $mysqli->query("SELECT * FROM user WHERE email = '{$_SESSION['email']}' AND password ='{$_SESSION['password']}'");
            $result_can = $result_can->fetch_assoc();

        }
        else{

            $result_can = null;

        }
        include "get_all_files.php";
        require "css_code.php";
        include "function_used.php";


        ?>

        <nav class="navbar navbar-expand-sm navbar-light fixed-top" style="z-index: 100">
                <div class="logo_nom" onclick="location.href='index.php'">
                    <img id="image_logo" src="image/Logo%20ESIEA%20Baseline%20blanc.png" alt="logo_ESIEA">
                    <h1>GMK</h1>
                </div>
            <?php

            ?>
            <div class="search_bar">
                <form name="formulaire_search" method="get">
                    <input type="hidden" name="variable" value="search.php">
                    <label>
                        <input class="bar_search" type="text" placeholder="Search GJK 🔎" name="searchVal" value="" style="color: #fff">
                    </label> <!--onkeyup="searchq()-->
                </form>


            </div>

<!--#####################################################################################################################################-->
            <?php if($result_can) echo"<h3 style='font-family: Teko, sans-serif'>Connecté sous {$result_can["username"]}</h3>";
            ?>
<!--#####################################################################################################################################-->
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav"></ul>
            </div>

            <div class="log_in_up">
                <?php
                if (!$result_can){
                    ?>
                    <div class="sign_up">
                        <a href="index.php?variable=sign_up.php"><input type="button" class="button_sign_up" value="Sign Up" ></a>
                    </div>
                    <div class="log_in">
                        <a href="index.php?variable=log_in.php"><input type="button" class="button_log_in" value="Log In"></a>
                    </div>
                    <?php
                }
                ?>


                <?php
                if($result_can) {
                    ?>
                    <span>
                        <a href="#">Profile</a>
                            <ul class="sous">
                                <li><a href="index.php?variable=profile.php">Profile</a></li>
                                <li><a href="index.php?variable=deco.php" >Log Out</a></li>
                            </ul>
                    </span>
                    <?php
                }
                ?>
                </div>
        </nav>

    <!-- #################################### div pub #################################### -->


        <div class="pub_gauche" >
            test
        </div >

        <div class="pub_droite">
            test2
        </div>


    <!-- #################################### div center #################################### -->

    <div class="contenue">

            <?php
            if(isset($_GET['erreur'])){
                $err = $_GET['erreur'];
                if($err==1)
                    echo "<h3  id='expres' style='color:white;margin-top:10%'>Utilisateur ou mot de passe incorrect</h3>";
                if($err==2)
                    echo "<h1 style='color:white;margin-top:10%'>le nom d'utilisateur existe deja</h1>";
                if($err==3)
                    echo "<h1 style='color:white;margin-top:10%'>les mots de passe ne correspondent pas</h1>";
            }
            ?>

            <div class="center">

                <?php
                if (isset($_GET['variable']) and file_exists('page/'.$_GET['variable'])){
                    $title = $_GET['variable'];
                    include("page/$title");
                }
                elseif(!isset($_GET['variable']) || $_GET['variable']==''){
                    $title = "mur_commentaire.php";
                    echo "<h1 style='font-size: 2em'>Commentaire</h1>";
                    include("page/mur_commentaire.php");
                }
                else{
                    $title = "ERROR 404";
                }
                ?>

            </div>
        </div>
    </body>
</html>

<?php

if($result_can){
    $test = $mysqli->query("SELECT * FROM user WHERE email = '{$result_can['email']}' AND password ='{$result_can['password']}'");
    $row_cnt = $test->num_rows;
}
if (isset($row_cnt) && $row_cnt==1){
    if(isset($_POST["delete"])) {
        $com_delete = [];
        $result = $mysqli->query("SELECT * FROM post WHERE comment_id_destinataire = {$_POST['supp']}");

        while (($line = $result->fetch_assoc()))
            $com_delete[] = $line;
        foreach($com_delete as $row){
            $supp = ("DELETE FROM jaime WHERE id_post = '{$row['id']}'")
            or die($mysqli->error);
            $mysqli->query($supp);
            if ($mysqli->query("DELETE FROM post WHERE comment_id_destinataire= {$_POST['supp']}") === TRUE) {
                echo "\nsuppriméeee";
            } else {
                echo "Error deleting record: " . $mysqli->error;
            }
        }
        $supp = ("DELETE FROM jaime WHERE id_post = '{$_POST['supp']}'")
        or die($mysqli->error);
        $mysqli->query($supp);
        $mysqli->query("DELETE FROM post WHERE id = {$_POST['supp']}");
        ?>
        <meta http-equiv="refresh" content="0">
        <?php
    }
    if (isset($_POST["message"]) && !empty(trim(str_replace("'","\'",$_POST["message"])))) {
        $message_replace = htmlspecialchars(str_replace("'","\'",$_POST["message"]));
        insert_fields('post', ["ID_user" => $result_can['id'], "post" => $message_replace,"username_source" => $result_can['username'], "username_destinataire" => $guest]);  //mettre l'id user dans la requets
        echo '<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['comment']) && !empty(trim(str_replace("'","\'",$_POST["comment"])))){
        $commentaire = htmlspecialchars(str_replace("'","\'",$_POST['comment']));
        $sql = ("INSERT INTO post (ID_user,comment_id_destinataire,post,username_destinataire,username_source)
                VALUES ({$result_can['id']},{$_POST['comment_id']},'$commentaire','{$result_can['username']}','{$_POST['username_source2']}')")
        or die($mysqli->error);

        if ($mysqli->query($sql) === TRUE) {
            echo "envoye ?asdasdasd";
            ?><meta http-equiv="refresh" content="0"><?php
        } else {
            echo "<br>Error: " . $sql . "<br>" . $mysqli->error;
        }
    }


    if(isset($_POST['like'])){
        $test = $mysqli->query("SELECT * FROM jaime WHERE id_user = '{$result_can['id']}'AND id_post = '{$_POST['like_id']}'");
        $row_cnt2 = $test->num_rows;

        $temp= $mysqli->query("SELECT * FROM jaime WHERE id_post = '{$_POST['like_id']}'");
        $row_cnt3 = $temp->num_rows;
        if ($row_cnt2 == 0){
            $sql = "UPDATE post SET likes = $row_cnt3 + 1 WHERE id ='{$_POST['like_id']}'";
            $ajout = ("INSERT INTO jaime (id_user,id_post) VALUES ('{$result_can['id']}','{$_POST['like_id']}')")
            or die($mysqli->error);
            $mysqli->query($sql);
            $mysqli->query($ajout);
        }
        else{
            $sql = "UPDATE post SET likes = likes - 1 WHERE id ='{$_POST['like_id']}'";
            $supp = ("DELETE FROM jaime WHERE id_user = '{$result_can['id']}' AND id_post = '{$_POST['like_id']}'")
            or die($mysqli->error);
            $mysqli->query($sql);
            $mysqli->query($supp);
        }
        ?><meta http-equiv="refresh" content="0"><?php
    }
    $_POST['like'] = NULL;

    if(isset($_POST['like_comment'])){
        $test = $mysqli->query("SELECT * FROM jaime WHERE id_user = '{$result_can['id']}'AND id_post = '{$_POST['like_id']}'");
        $row_cnt2 = $test->num_rows;

        $temp= $mysqli->query("SELECT * FROM jaime WHERE id_post = '{$_POST['like_id']}'");
        $row_cnt3 = $temp->num_rows;
        if ($row_cnt2 == 0){
            $sql = "UPDATE post SET likes = $row_cnt3 + 1 WHERE id ='{$_POST['like_id']}'";
            $ajout = ("INSERT INTO jaime (id_user,id_post) VALUES ('{$result_can['id']}','{$_POST['like_id']}')")
            or die($mysqli->error);
            $mysqli->query($sql);
            $mysqli->query($ajout);
        }
        else{
            $sql = "UPDATE post SET likes = likes - 1 WHERE id ='{$_POST['like_id']}'";
            $supp = ("DELETE FROM jaime WHERE id_user = '{$result_can['id']}' AND id_post = '{$_POST['like_id']}'")
            or die($mysqli->error);
            $mysqli->query($sql);
            $mysqli->query($supp);
        }
        ?><meta http-equiv="refresh" content="0"><?php
    }
    $_POST['like_comment'] = NULL;

    if(isset($_POST['supprime']) && isset($_POST['supp_compte'])) {
        $com_delete = [];
        $result = $mysqli->query("SELECT * FROM post WHERE id_user = {$username2['id']}");
        while (($line = $result->fetch_assoc()))
            $com_delete[] = $line;
        foreach ($com_delete as $row) {
            $supp = ("DELETE FROM jaime WHERE id_user = '{$username2['id']}'")
            or die($mysqli->error);
            $mysqli->query($supp);
            $mysqli->query("DELETE FROM post WHERE id_user= {$username2['id']}");
        }
        $supp = ("DELETE FROM jaime WHERE id_user = '{$username2['id']}'")
        or die($mysqli->error);
        $mysqli->query($supp);
        $mysqli->query("DELETE FROM post WHERE id_user = '{$username2['id']}'");

    //    supprime la biographie
        $supp = ("DELETE FROM profile WHERE id_user = '{$username2['id']}'")
        or die($mysqli->error);
        $mysqli->query($supp);

    //    supprime les abo

        $com_delete = [];
        $result = $mysqli->query("SELECT * FROM abo WHERE id_user = {$username2['id']}");
        while ($line = $result->fetch_assoc()) {
            $result2 = $mysqli->query("UPDATE user SET follower = follower - 1 WHERE id ='{$line['id_follo']}'");
        }
        $supp = ("DELETE FROM abo WHERE id_user = '{$username2['id']}'")
        or die($mysqli->error);
        $mysqli->query($supp);

    //    supprime les likes

        $com_delete = [];
        $result = $mysqli->query("SELECT * FROM jaime WHERE id_user = {$username2['id']}");
        while ($line = $result->fetch_assoc()) {
            $result2 = $mysqli->query("UPDATE post SET likes = likes - 1 WHERE id ='{$line['id_post']}'");
        }

    //    supprime l'user

        $supp = ("DELETE FROM user WHERE id = '{$username2['id']}'")
        or die($mysqli->error);
        $mysqli->query($supp);
        echo "<script> location.replace('index.php'); </script>";
    }

    if (isset($_POST['modifier']) && isset($_POST['idz'])) {
        $modifier_ver = htmlspecialchars(str_replace("'","\'",$_POST['modifier']));
        $sql = "UPDATE profile SET biographie='$modifier_ver' WHERE id_user ='{$username2['id']}'";
        if ($mysqli->query($sql) === TRUE) {
        } else {
            echo "Error updating record: " . $mysqli->error;
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }
}

if (!$result_can) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        if ($_POST["email"] != "" && $_POST["password"] != "") {
            $email = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['email']));
            $password = $_POST['password'];

            $result_can = mysqli_query($mysqli, "SELECT * FROM user WHERE email = '$email'");

            while ($row = $result_can->fetch_assoc()) {
                $hash = hash("whirlpool", $password);

                if (($row['password'] == $hash)) {

                    setcookie("username", $row['username'], time() + 3600);
                    setcookie("email", $_POST['email'], time() + 3600);
                    setcookie("password", $hash, time() + 3600);

                    $ip = htmlspecialchars($_SERVER['REMOTE_ADDR']);
                    $ajout = "INSERT INTO ip_ad (id_user,email_user,username_user,ip) VALUES ('{$row['id']}','{$row['email']}','{$row['username']}','$ip')"
                    or die($mysqli->error);
                    $mysqli->query($ajout);
                    echo "<script> location.replace('index.php'); </script>";
                    exit();
                }
            }
            echo "<script> location.replace('index.php?erreur=1'); </script>";
            exit();

        } else {
            echo "<script> location.replace('index.php?erreur=1'); </script>";
            exit();
        }
    }

    if (isset($_POST["password"]) && isset($_POST["username"]) && isset($_POST["repassword"]) && isset($_POST["email"])) {
        $mysqli = join_database();
        $user = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $repassword = htmlspecialchars($_POST["repassword"]);
        $email = htmlspecialchars($_POST["email"]);
        $genre = htmlspecialchars($_POST["genre"]);
        $age = htmlspecialchars($_POST["age"]);

        $result_can = mysqli_query($mysqli, "SELECT email FROM user WHERE email = '$email'");
        $result_can_login = mysqli_query($mysqli, "SELECT username FROM user WHERE username = '$user'");


        if (mysqli_num_rows($result_can) == 0 and mysqli_num_rows($result_can_login) == 0) {
            if ($repassword == $password) {
                global $mysqli;
                $message = "ok";
                $hash = hash("whirlpool", $password);
                // Password Hashing is used here.
                $sql = "INSERT INTO user (username, password, email, genre, age) VALUES ('$user', '$hash','$email','$genre','$age')";
                if ($mysqli->query($sql) === TRUE) {

                    setcookie("username", $user, time() + 3600);
                    setcookie("email", $_POST['email'], time() + 3600);
                    setcookie("password", $hash, time() + 3600);

                    $result_can = $mysqli->query("SELECT * FROM user WHERE email = '$email' AND password ='$hash'");
                    $result_can = $result_can->fetch_assoc();
                    $bio = "INSERT INTO profile (biographie, id_user ,username) VALUES ('Biographie de $user', '{$result_can['id']}', '$user')";
                    $mysqli->query($bio);
                    $ip = htmlspecialchars($_SERVER['REMOTE_ADDR']);
                    $ajout = "INSERT INTO ip_ad (id_user,email_user,username_user,ip) VALUES ('{$sql['id']}','{$sql['email']}','{$sql['username']}','$ip')"
                    or die($mysqli->error);
                    $mysqli->query($ajout);
                } else {
                    echo "<br>Error: " . $sql . "<br>" . $mysqli->error;
                }
                echo "<script> location.replace('index.php'); </script>";
                exit();
            } else {
                echo "<script> location.replace('index.php?erreur=3'); </script>";
                exit();
            }
        } else {
            echo "<script> location.replace('index.php?erreur=2'); </script>";
            exit();
        }
    }
}
?>
