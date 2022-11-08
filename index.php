<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="node_modules/aos/dist/aos.css">

        <title>GJK</title>

    </head>
    <body>
    <?php
        include "get_all_files.php";
        require "join_db.php";
        join_database();


        if(isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
            $result_can = $mysqli->query("SELECT * FROM user WHERE email = '{$_COOKIE['email']}' AND password ='{$_COOKIE['password']}'");
            $result_can = $result_can->fetch_assoc();
        }
        else{
            $result_can = null;
        }

        ?>

        <nav class="navbar navbar-expand-sm navbar-light fixed-top">
                <div class="logo_nom" onclick="location.href='index.php'">
                    <img id="image_logo" src="image/reseau-informatique-icone-cybersecurite-pour-web_116137-3699.png" alt="logo_réseau">
                    <h1>GJK</h1>
                </div>
            <?php

            ?>
            <div class="search_bar">
                <form name="formulaire_search" method="get">
                    <input type="hidden" name="variable" value="search.php">
                    <label>
                        <input class="bar_search" type="text" placeholder="Search GJK 🔎" name="searchVal" value="">
                    </label> <!--onkeyup="searchq()-->
                </form>


            </div>
            <?php if($result_can) echo"<h3>Connecté sous {$result_can["username"]}</h3>";
            ?>
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
                if(isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
                    $result_can = $mysqli->query("SELECT * FROM user WHERE email = '{$_COOKIE['email']}' AND password ='{$_COOKIE['password']}'");
                    $result_can = $result_can->fetch_assoc();

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
        <div class="contenue">

            <?php
            if(isset($_GET['erreur'])){
                $err = $_GET['erreur'];
                if($err==1)
                    echo "<h3  id='expres' style='color:black;margin-top:10%'>Utilisateur ou mot de passe incorrect</h3>";
                if($err==2)
                    echo "<h1 style='color:black;margin-top:10%'>le nom d'utilisateur existe deja</h1>";
                if($err==3)
                    echo "<h1 style='color:black;margin-top:10%'>les mots de passe ne correspondent pas</h1>";
            }
            ?>

            <div class="center">
                <div class="inbox">
                    <div class="centre">
                        <?php
                        if (isset($_GET['variable']) and file_exists('page/'.$_GET['variable'])){
                            $title = $_GET['variable'];
                            require ("page/$title");
                        }
                        elseif(!isset($_GET['variable']) || $_GET['variable']==''){
                            $title = "mur_commentaire.php";
                            echo "<h1>Commentaire</h1>";
                            require("page/mur_commentaire.php");
                        }
                        else{
                            $title = "ERROR 404";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
