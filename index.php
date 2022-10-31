<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="node_modules/aos/dist/aos.css">

        <title>GJK</title>
        <style>

        </style>
    </head>
    <body>
    <?php
        include "get_all_files.php";
        require "join_db.php";
        $mysqli = join_database();
        ?>

        <nav class="navbar navbar-expand-sm navbar-light fixed-top">
                <div class="logo_nom" onclick="location.href='index.php'">
                    <img id="image_logo" src="image/reseau-informatique-icone-cybersecurite-pour-web_116137-3699.png" alt="logo_réseau">
                    <h1>GJK</h1>
                </div>

            <div class="search_bar">
                <form name="formulaire_search" action="#" method="get">
                    <input class="bar_search" type="text" placeholder="Search GJK 🔎" value="">
                </form>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav"></ul>
            </div>
            <div class="log_in_up">
                <?php
                if(isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
                    $result_can = $mysqli->query("SELECT * FROM user WHERE email = '{$_COOKIE['email']}' AND password ='{$_COOKIE['password']}'");
                    $result_can = $result_can->fetch_assoc();
                }
                else {
                    $result_can = null;
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
            </div>
        </nav>

        <div class="contenue">
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
                            require ("page/$title");
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
