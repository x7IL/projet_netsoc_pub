<?php
//print_r($_GET['profile_guest']);

include('function_used.php');
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
            if ($result_can) {

                ?>
                <div>
                    <input type="hidden" value="">
                    <label for="message"></label><input type="text" id="message" name="message" placeholder="What's happening" style="border-radius: 9999px;">
                </div>
                <input type="submit" name="post_message" id="post_message" value="Post" style="border-radius: 9999px; background-color: dodgerblue; color: #FAFAFA">
                <?php

                if (isset($_POST["post_message"])) {
                    $message_replace = str_replace("'","\'",$_POST["message"]);
                    $user_destinataire = ($mysqli->query("SELECT id FROM user WHERE username = '{$_GET['profile_guest']}'"))->fetch_assoc();
                    print_r($username['username']);
                    insert_fields('post', ["ID_user" => $result_can['id'], "post" => $message_replace,"username_source" => $result_can['username'], "username_destinataire" => $username['username']]);  //mettre l'id user dans la requets
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
        $result = $mysqli->query("SELECT * FROM post WHERE comment_id_destinataire IS NULL ORDER BY post_date DESC");
        while (($line = $result->fetch_assoc()))
            $coms[] = $line;
        ?>

        <?php
    foreach ($coms as $com){

        $ID_user = $com["ID_user"];
        if ($ID_user!=NULL) {
            $username_proprio = $mysqli->query("SELECT username FROM profile WHERE ID_user = '$ID_user'");
            $username_proprio = $username_proprio->fetch_assoc();
            $username_proprio = implode(",", $username_proprio);
            ?>
            <div style="background-color: #FAFAFA; border: solid 1px dodgerblue; margin-top: 1%;">
            <?php
            if ($com["username_destinataire"]){
                ?>
                <b style=" max-width: 99%; word-wrap: break-word; "><?=$username_proprio; ?><i style="opacity: 0.5;"> pour </i><?=$com["username_destinataire"]; ?> </b> <i style="opacity: 0.5;"><?=$com["post_date"]; ?></i><p style="font-size: 1.2em; margin-bottom: 0 ; max-width: 99%; word-wrap: break-word; "><?=$com["post"]; ?></p>
                <?php
            }
            else{
                ?>
                <b style=" max-width: 99%; word-wrap: break-word; "><?=$username_proprio; ?> </b> <i style="opacity: 0.5;"><?=$com["post_date"]; ?></i><p style="font-size: 1.2em; margin-bottom: 0 ; max-width: 99%; word-wrap: break-word; "><?=$com["post"]; ?></p>
                <?php
            }
            ?>
            <div style="background-color: #E3E9EF;">

                <?php if($result_can){?>
                    <button class="like_button">
                        <span id ="icon"><i class="fa-regular fa-thumbs-up"></i></span>
                        <span id = "count">0</span> Likes
                    </button>
                    <script> like_button();</script>

                <?php } ?>
            </div>

            <?php
            if($result_can && $com['ID_user'] == $result_can['id']){?>

                <form action="" class="form_delete_list_comment" method="post">
                    <input type="hidden" name="supp" value="<?php echo $com['id']?>"/>
                    <input id="delete" name="delete" type="submit" value="Delete message" style="border-radius: 9999px; background-color: dodgerblue; color: #FAFAFA"><br>
                </form>

                <?php
            }
            ?>
            <?php
        }
        $res = $mysqli->query("SELECT * FROM post WHERE comment_id_destinataire = '{$com['id']}'");
        if ($res) {
            // output data of each row
            while ($row = $res->fetch_assoc()) { ?>
                <div style="background-color: #FAFAFA; border: solid 1px dodgerblue; margin-top: 1%; margin-left: 5%;">
                    <b style=" max-width: 99%; word-wrap: break-word; "><?=$row["username_destinataire"]?> </b>
                    <i style="opacity: 0.5;"><?=$row["post_date"]; ?></i>
                    <p style="font-size: 1.2em; margin-bottom: 0; max-width: 99%; word-wrap: break-word; "><?=$row["post"]; ?></p>
                    <?php if($result_can){?>
                        <button class="like_button">
                            <span id ="icon"><i class="fa-regular fa-thumbs-up"></i></span>
                            <span id = "count">0</span> Likes
                        </button>
                    <?php } ?>

                    <?php if($result_can!=NULL && $row['ID_user'] == $result_can['id']){?>
                        <form action="" class="form_delete_list_comment" method="post">
                            <input type="hidden" name="supp" value="<?php echo $row['id']?>"/>
                            <input id="delete" name="delete" type="submit" value="Delete message" style="border-radius: 9999px; background-color: dodgerblue; color: #FAFAFA"><br>
                        </form>
                    <?php } ?>
                </div>


                <?php
            }
            if($result_can){?>
                <form method="POST">
                    <input type="hidden" name="id_dest" value="<?php echo $com['ID_user']?>"/>
                    <input type="hidden" name="comment_id" value="<?php echo $com['id']?>"/>
                    <input type="hidden" name="username_source2" value="<?php echo $com['username_source']?>"/>
                    <input type="text" id="message" name="comment" placeholder="commenter" style="border-radius: 9999px;">
                    <input type="submit" id='submit' value='valider'>
                </form>
                <?php
            }
        }
        ?>
        </div>
        <?php

    }
        ?>
    </div>
    <?php
    //actionnement des formulaires
    if(isset($_POST["delete"])) {
        delete_fields('post', 'id', $_POST['supp']);//verification_db('comment', "id",  "message", $com['message'], $_COOKIE['idmessage'])
        ?>
        <meta http-equiv="refresh" content="0">
        <?php
    }
    if(isset($_POST['comment']) && !empty($_POST['comment'])){
        $commentaire = str_replace("'","\'",$_POST['comment']);

        if(preg_match('/[a-zA-Z_0-9,@!.?] */',$commentaire) == 0){
            print " Mauvaise orthographe ";
            return null;
        }

        $sql = ("INSERT INTO post (ID_user,comment_id_destinataire,post,username_destinataire,username_source) 
            VALUES ({$result_can['id']},{$_POST['comment_id']},'$commentaire','{$result_can['username']}','{$_POST['username_source2']}')")
        or die($mysqli->error);

        if ($mysqli->query($sql) === TRUE) {
            ?><meta http-equiv="refresh" content="0"><?php
        } else {
            echo "<br>Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}
else{
    echo "erreur";
}?>
