<div id="post_message_profile" style="margin-top: 3%" >
    <form action="#" method="post" id="post_messages">
        <?php
        if ($result_can) {
            form_post();
        }
        ?>
    </form>
</div>

<div id="list_message_profile_recherche" style=" width: 100%">

    <?php
    $coms = [];
    $result = $mysqli->query("SELECT * FROM post WHERE comment_id_destinataire IS NULL ORDER BY post_date DESC");

    while (($line = $result->fetch_assoc()))
        $coms[] = $line;

    foreach ($coms as $com){

        $ID_user = $com["ID_user"];
        $res = $mysqli->query("SELECT * FROM post WHERE comment_id_destinataire = '{$com['id']}'");
        $coms2 = [];
        $boolean = 0;
        while($row = $res->fetch_assoc()){
            $coms2[] = $row;
            if($row['username_destinataire'] == $guest || $com['username_destinataire'] == $guest){
                $boolean = 1;
            }
        }
        if($boolean == 1 || $com['username_source'] == $guest){
            ?>
            <div style="margin-top: 4%; margin-right: 2%; padding-bottom: 4%;" class='control block-cube block-input'>
                <?php
                affi_pour($com);
                ?>

                <div style="background-color: #2f2f2f;">
                    <?php if($result_can){
                        like_button("like",$com);
                        if(isset($_POST['like'])){
                            $test = $mysqli->query("SELECT * FROM jaime WHERE id_user = '{$result_can['id']}'AND id_post = '{$_POST['like_id']}'");
                            $row_cnt2 = $test->num_rows;
                            if ($row_cnt2 == 0){
                                $sql = "UPDATE post SET likes = likes + 1 WHERE id ='{$_POST['like_id']}'";
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
                        }
                        $_POST['like'] = NULL;
                    } ?>
                </div>
                <?php

                if($result_can && $com['ID_user'] == $result_can['id']){?>
                    <form action="" class="form_delete_list_comment" method="post">
                        <div class='control block-cube block-input' style="position: relative;z-index: 11 ; display: inline-block; margin-bottom: 1%; margin-left: 1%;">
                            <label>
                                <input type="hidden" name="supp" value="<?php echo $com['id']?>"/>
                                <input id="delete" name="delete" type="submit" value="Delete messageee" style=" background-color: #212121; color: #fff;">
                            </label>
                                <?php useless_div(); ?>
                        </div>
                    </form> <?php
                }


                // output data of each row
                foreach($coms2 as $row){
                    affi_sous_comment($row);
                    if(isset($_POST['like_comment'])){
                        if(isset($_POST['like_comment'])){
                            $test = $mysqli->query("SELECT * FROM jaime WHERE id_user = '{$result_can['id']}'AND id_post = '{$_POST['like_id']}'");
                            $row_cnt2 = $test->num_rows;
                            if ($row_cnt2 == 0){
                                $sql = "UPDATE post SET likes = likes + 1 WHERE id ='{$_POST['like_id']}'";
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
                        }
                        $_POST['like_comment'] = NULL;
                    }
                }
                if($result_can){
                    commenter($com);
                }
                useless_div();
                ?> </div> <?php
        }
    }
    ?>
</div>

<?php
//actionnement des formulaires
if(isset($_POST["supp"])) {

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
    $message_replace = str_replace("'","\'",$_POST["message"]);
    insert_fields('post', ["ID_user" => $result_can['id'], "post" => $message_replace,"username_source" => $result_can['username'], "username_destinataire" => $result_can['username']]);  //mettre l'id user dans la requets
    echo '<meta http-equiv="refresh" content="0">';
}
if(isset($_POST['comment']) && !empty(trim(str_replace("'","\'",$_POST["comment"])))){
    $commentaire = str_replace("'","\'",$_POST['comment']);
    $sql = ("INSERT INTO post (ID_user,comment_id_destinataire,post,username_destinataire,username_source) 
            VALUES ({$result_can['id']},{$_POST['comment_id']},'$commentaire','{$result_can['username']}','{$_POST['username_source2']}')")
    or die($mysqli->error);

    if ($mysqli->query($sql) === TRUE) {
        ?><meta http-equiv="refresh" content="0"><?php
    } else {
        echo "<br>Error: " . $sql . "<br>" . $mysqli->error;
    }
}
