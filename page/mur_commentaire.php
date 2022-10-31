<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <title>Liste commentaires</title>
    </head>
    <body>
        <h1>Accueil</h1>
        <div id="post_message_accueil">
            <form action="#" method="post" id="post_messages">

                <?php
                include "function_used.php";
                if (isset($_COOKIE["email"]) && isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
                    ?>
                    <div>
                        <input type="hidden" value="">
                        <label for="message"></label><input type="text" id="message" name="message" placeholder="What's happening">
                    </div>
                    <input type="submit" name="post_message" id="post_message" value="Post">
                    <?php
                    if (isset($_POST["post_message"])) {

                        $mysqli = join_database();
                        $email = $_COOKIE["email"];
                        $id_user = $mysqli->query("SELECT id FROM user WHERE `email` = '$email'");
                        $id_user = $id_user->fetch_assoc();
                        $id_user = implode(",", $id_user);
                        insert_fields('post', ["ID_user" => $id_user, "post" => $_POST["message"]]);  //mettre l'id user dans la requets
                    }
                }
                else {
                    echo "pas connecté";
                }

                ?>
            </form>
        </div>

        <div>
            <?php

            global $mysqli;
            $coms = [];
            $result = $mysqli->query("SELECT * FROM `post` ORDER BY post_date DESC");
            while (($line = $result->fetch_assoc()))
                $coms[] = $line;
            ?>
            <?php
            foreach ($coms as $com){
                $ID_user = $com["ID_user"];
                if ($ID_user!=NULL) {
                    $username = $mysqli->query("SELECT username FROM profile WHERE id_user = '$ID_user'");
                    $username = $username->fetch_assoc();
                    $username = implode(",", $username);
                    ?>
                    <hr/>
                    <p>De <b><?=$username; ?> :</b><br><?=$com["post"]; ?> <br><?=$com["post_date"]; ?> <br> <?=$com["id"]; ?> </p>

                    <?php

                    if(isset($_COOKIE["login"])){
                        if ($_COOKIE["login"] == $com["login"]){
                            ?><form action="" class="form_delete_list_comment" method="post"><?php
                            ?><input type="hidden" name="supp" value="<?php echo $com['id']?>"/>
                            <input id="delete" name="delete" type="submit" value="Delete message"><br><?php

                        }
                    }
                    ?></form>
                    <?php
                }
            }
            if(isset($_POST["delete"])) {
                delete_fields('post', 'id', $_POST['supp']);//verification_db('comment', "id",  "message", $com['message'], $_COOKIE['idmessage'])
            }
            ?>
        </div>



        <?php /*

 va faloir boucler sur la table post donc faire une nouvelle fonction

        $coms = select_com('comment');
        ?>
        <?php foreach ($coms as $com){?>
                <hr/>
                <p>Id : <b><?=$com["id"]; ?> :</b><br><?=$com["message"]; ?> :<br><?=$com["post_date"]; ?></p>
            <?php
        }
        */ ?>
    </body>
</html>
