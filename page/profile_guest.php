<?php
include "function_used.php";

global $mysqli;
$username = mysqli_query($mysqli,"SELECT * FROM profile WHERE username = '{$_GET['profile_guest']}'");
$row_cnt = $username->num_rows;
$username = $username->fetch_assoc()
?>

<?php

if($row_cnt==1){
    ?>
    <h1>Profile de <?php echo $_GET['profile_guest'] ?></h1>
    <div>
        <div id="div_bio" style=" border: 1px solid dodgerblue; background-color: #FAFAFA">
    <?php
    echo '<h3>Biographie:</h3>';
    echo "<p style='font-size: 1.1em'>{$username['biographie']}</p>";
    ?>
        </div>
    </div>

    <div id="post_message_profile" style="margin-top: 3%; background-color: #FAFAFA; border: 1px solid dodgerblue;" >
        <form action="#" method="post" id="post_messages">

            <?php

            if (isset($_COOKIE["email"]) && isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
                ?>
            <div>
                <input type="hidden" value="">
                <label for="message"></label><input type="text" id="message" name="message" placeholder="What's happening" style="border-radius: 9999px;">
            </div>
            <input type="submit" name="post_message" id="post_message" value="Post" style="border-radius: 9999px; background-color: dodgerblue; color: #FAFAFA">
            <?php
            if (isset($_POST["post_message"])) {

                $mysqli = join_database();
                $email = $_COOKIE["email"];
                $id_user = $mysqli->query("SELECT id FROM user WHERE `email` = '$email'");
                $id_user = $id_user->fetch_assoc();
                $id_user = implode(",", $id_user);
                $user_destinataire = ($mysqli->query("SELECT id FROM user WHERE username = '{$_GET['profile_guest']}'"))->fetch_assoc();
                insert_fields('post', ["ID_user" => $id_user, "post" => $_POST["message"], "id_profile_destinataire" => $username['id_user']]);  //mettre l'id user dans la requets
            }
            }
            else {
                echo "pas connecté";
            }

            ?>
            </form>
        </div>

    <div id="list_message_profile_recherche" ">
    <?php
    $coms = [];
    $result = $mysqli->query("SELECT * FROM `post` ORDER BY post_date DESC");
    while (($line = $result->fetch_assoc()))
        $coms[] = $line;
    ?>
    <?php
    foreach ($coms as $com){
        $ID_user = $com["ID_user"];
        if ($ID_user!=NULL) {
            $username_proprio = $mysqli->query("SELECT username FROM profile WHERE id_user = '$ID_user'");
            $username_proprio = $username_proprio->fetch_assoc();
            $username_proprio = implode(",", $username_proprio);
            ?>
            <div style=" border: solid 1px dodgerblue; background-color: #FAFAFA; margin-top: 1%;">
                <div style="">
                    <?php
                    $requete_verif_destinataire = $mysqli->query("SELECT id_profile_destinataire FROM post WHERE id_profile_destinataire IS NOT NULL")->fetch_assoc();
                    if ($requete_verif_destinataire){?>
                        <b style=" max-width: 99%; word-wrap: break-word; "><?=$username_proprio; ?><i style="opacity: 0.5;"> pour </i><?=$username["username"]; ?> </b> <i style="opacity: 0.5;"><?=$com["post_date"]; ?></i><p style="font-size: 1.2em; margin-bottom: 0  max-width: 99%; word-wrap: break-word; "><?=$com["post"]; ?></p>
                        <?php
                    }
                    else{
                        ?>
                    <b style=" max-width: 99%; word-wrap: break-word; "><?=$username_proprio; ?> </b> <i style="opacity: 0.5;"><?=$com["post_date"]; ?></i><p style="font-size: 1.2em; margin-bottom: 0  max-width: 99%; word-wrap: break-word; "><?=$com["post"]; ?></p>
                        <?php
                    }
                    ?>
                </div>
                <div>
                    <div style="background-color: #E3E9EF; display: block">
                        <input type="button" id="like" value="like" style="background-color: dodgerblue;color: #FAFAFA;">
                        <input type="button" value="comment" style="background-color: dodgerblue;color: #FAFAFA;">
                    </div>
                    <?php

                    if(isset($_COOKIE["username"])){
                    if ($_COOKIE["username"] == $username){
                    ?>
                    <form action="#" class="form_delete_comment" method="post" ><?php
                        ?>
                        <input type="hidden" name="supp" value="<?php echo $com['id']?>"/>
                        <input id="delete" name="delete" type="submit" value="Delete message" style="border-radius: 9999px; background-color: dodgerblue; color: #FAFAFA; float:right; margin-top: -28px">
                        <?php
                        }
                        }
                        ?>
                    </form>
                </div>
            </div>
            <?php
        }
    }
    if(isset($_POST["delete"])){
        delete_fields('post', 'id', $_POST['supp']);//verification_db('comment', "id",  "message", $com['message'], $_COOKIE['idmessage'])
        //header("Refresh:0"); //message d'erreur
        ?>
        <meta http-equiv="refresh" content="0">
        <?php
    }
    ?>
    </div>
    </div>
            <?php

}
else{
    echo "erreur";
}?>

