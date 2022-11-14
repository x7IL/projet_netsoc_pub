<div class="wrapper">
    <div class="typing-demo" style="">
        Vous venez d'entrer dans une zone interdite!
    </div>
</div>

<?php
include "function_used.php";
?>
<div id="post_message_accueil">
    <form action="#" method="post" id="post_messages" style="margin-top: 3%; margin-bottom: 2%; f">

        <?php
        if ($result_can) {
            form_post();
        }
        ?>
    </form>
</div>

<div style="width: 100%" >
    <?php

    $coms = [];

    $result = $mysqli->query("SELECT * FROM post WHERE comment_id_destinataire IS NULL ORDER BY post_date DESC");
    while (($line = $result->fetch_assoc()))
        $coms[] = $line;
    ?>
    <?php


    //    afffichage
    foreach ($coms as $com){

        $ID_user = $com["ID_user"];
        if ($ID_user!=NULL) {
            $username_proprio = $mysqli->query("SELECT username FROM profile WHERE ID_user = '$ID_user'");
            $username_proprio = $username_proprio->fetch_assoc();
            $username_proprio = implode(",", $username_proprio);
            ?>
            <div style="margin-top: 4%; margin-right: 2%; padding-bottom: 1%;" class='control block-cube block-input'>
            <?php
            if ($com["username_destinataire"] and $com["username_destinataire"] != $com["username_source"]){
                ?>
                <post style="position : relative; z-index: 10">
                    <b style=" max-width: 99%; word-wrap: break-word;  "><?=$username_proprio; ?><i style="opacity: 0.5;"> pour </i><?=$com["username_destinataire"]; ?> </b> <i style="opacity: 0.5;"><?=$com["post_date"]; ?></i><p style="font-size: 1.2em; margin-bottom: 0 ; max-width: 99%; word-wrap: break-word; "><?=$com["post"]; ?></p>
                </post>
                <?php
            }
            else{
                ?>
                <post style="position : relative; z-index: 10">
                    <b style=" max-width: 99%; word-wrap: break-word; "><?=$username_proprio; ?> </b> <i style="opacity: 0.5;"><?=$com["post_date"]; ?></i><p style="font-size: 1.2em; margin-bottom: 0 ; max-width: 99%; word-wrap: break-word; "><?=$com["post"]; ?></p>
                </post>
                <?php
            }
            ?>
            <div style="background-color: #2f2f2f;">
                <?php if($result_can){
                    like_button();
                } ?>
            </div>

            <?php
            if($result_can && $com['ID_user'] == $result_can['id']){
                ?>
                <form action="" class="form_delete_list_comment" method="post">
                    <div class='control block-cube block-input' style="position: relative;z-index: 11 ; display: inline-block; margin-bottom: 1%; margin-left: 1%;">
                        <label>
                            <input type="hidden" name="supp" value="<?php echo $com['id']?>"/>
                            <input id="delete" name="delete" type="submit" value="Delete message" style=" background-color: #212121; color: #fff;">
                        </label>
                        <?php useless_div(); ?>
                    </div>
                </form> <?php
            }
            ?>
            <?php
        }
        $res = $mysqli->query("SELECT * FROM post WHERE comment_id_destinataire = '{$com['id']}'");
        if ($res) {
            // output data of each row
            while ($row = $res->fetch_assoc()) { ?>
                <div style="background-color: #212121; margin-top: 5%; margin-left: 5%;margin-bottom: 2%; margin-right: 2%; position: relative; z-index: 10;"  class='control block-cube block-input'>
                    <b style=" max-width: 99%; word-wrap: break-word; position: relative; z-index: 11;"><?=$row["username_destinataire"]?> </b>
                    <i style="opacity: 0.5;position: relative; z-index: 11;"><?=$row["post_date"]; ?></i>
                    <p style="font-size: 1.2em; margin-bottom: 0; max-width: 99%; word-wrap: break-word;position: relative; z-index: 11; "><?=$row["post"]; ?></p>
                    <?php if($result_can){
                        like_button();
                    } ?>
                    <?php if($result_can!=NULL && $row['ID_user'] == $result_can['id']){
                        ?>
                        <form action="" class="form_delete_list_comment" method="post">
                            <div class='control block-cube block-input' style="position: relative;z-index: 11 ; display: inline-block; margin-bottom: 1%; margin-left: 1%;">
                                <label>
                                    <input type="hidden" name="supp" value="<?php echo $row['id']?>"/>
                                    <input id="delete" name="delete" type="submit" value="Delete message" style=" background-color: #212121; color: #fff;">
                                </label>
                                <?php useless_div(); ?>
                            </div>
                        </form> <?php
                    }
                    useless_div();
                    ?>
                </div>
                <?php
            }
            if($result_can){
                commenter($com);
            }
        }
        useless_div();
        ?>
        </div>
        <?php

    }
    ////

    //actionnement des formulaires
    if(isset($_POST["delete"])) {
        echo '<h1>miam?</h1>';

        if ($mysqli->query("DELETE FROM post WHERE comment_id_destinataire= '{$_POST['supp']}'") === TRUE) {
            echo "\nsupprimé";
        } else {
            echo "Error deleting record: " . $mysqli->error;
        }
        $mysqli->query("DELETE FROM post WHERE id = {$_POST['supp']}");
        ?>
        <meta http-equiv="refresh" content="0">
        <?php
    }
    if (isset($_POST["post_message"])) {
        $message_replace = str_replace("'","\'",$_POST["message"]);
        insert_fields('post', ["ID_user" => $result_can['id'], "post" => $message_replace,"username_source" => $result_can['username'], "username_destinataire" => NULL]);  //mettre l'id user dans la requets
        echo'<meta http-equiv="refresh" content="0">';
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
    ?>

</div>
