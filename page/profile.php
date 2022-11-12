
<div>
<h1 style="font-size: 2em">Profile</h1>
    <div>
        <?php
        global $mysqli;

        $email = $_COOKIE["email"];
        $username = $mysqli->query("SELECT username FROM user WHERE email = '$email'");
        $username = $username->fetch_assoc();
        $username = implode(",", $username);

        ?>
        <h2>Bonjour <?php print_r($username) ?></h2>

        <div id="div_bio" class='control block-cube block-input' style="margin-right: 5%;">
            <?php

            if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
                $result_can = $mysqli->query("SELECT * FROM user WHERE email = '{$_COOKIE['email']}' AND password ='{$_COOKIE['password']}'");
                $result_can = $result_can->fetch_assoc();
                $query = "SELECT * FROM profile WHERE id_user = '{$result_can['id']}'";
                $result = $mysqli->query($query);

                if ($result) {
                    // output data of each row
                    echo '<h3 style="position: relative;z-index: 11 ;">Biographie:</h3>';
                    while ($row = $result->fetch_assoc()) {
                        echo "<p style='font-size: 1.1em  ; position: relative ;z-index: 11;'>{$row['biographie']}</p>";
                    }
                    if (isset($_POST['modifier']) && isset($_POST['id'])) {
                        $modifier_ver = str_replace("'","\'",$_POST['modifier']);

                        $sql = "UPDATE profile SET biographie='$modifier_ver' WHERE id_user ='{$result_can['id']}'";
                        if ($mysqli->query($sql) === TRUE) {
                            header("Refresh:0");
                        } else {
                            echo "Error updating record: " . $mysqli->error;
                        }
                    }
                }
                else {
                    $result_can = null;
                    echo "Non connecté";
                }
                ?>
                <form action="" id="modif_bio" method="POST" style="margin-left: 1%;">
                    <div class='control block-cube block-input' style="position: relative; z-index: 11; display: inline-block ; margin-bottom: 1%">
                        <label for="">
                            <label for="modifier"></label><input type="text" id="modifier" name="modifier" placeholder="Inserez le message à remplacer"  style="background-color: #212121 ;color: #fff; "/>
                            <input type="hidden" id="modif_bio_submit" name="id"  value="<?php echo $row['ID']?>" /><br>
                            <input type="submit" value="modifier la bio"  style="background-color: #212121 ;color: #fff;">
                            <div class='bg-top'>
                                <div class='bg-inner'></div>
                            </div>
                            <div class='bg-right'>
                                <div class='bg-inner'></div>
                            </div>
                            <div class='bg'>
                                <div class='bg-inner'></div>
                            </div>
                        </label>

                    </div>
                </form>
                <?php
            }
            ?>
            <div class='bg-top'>
                <div class='bg-inner'></div>
            </div>
            <div class='bg-right'>
                <div class='bg-inner'></div>
            </div>
            <div class='bg'>
                <div class='bg-inner'></div>
            </div>
        </div>
        <div id="list_message" ">
        <script src="https://kit.fontawesome.com/2b7511c9f5.js" crossorigin="anonymous"></script>
        <script>function like_button(){

                const likeBtn = document.querySelector(".like_button"); ///
                const iconBtn = document.querySelector('#icon');
                const countBtn = document.querySelector('#count');

                let clicked = false;

                likeBtn.addEventListener("click",() =>{

                    if (!clicked){

                        clicked = true;

                        iconBtn.innerHTML = '<i class="fa-solid fa-thumbs-up"></i>';
                        countBtn.textContent++;

                    }
                    else{

                        clicked = false;
                        iconBtn.innerHTML = '<i class="fa-regular fa-thumbs-up"></i>';
                        countBtn.textContent--;

                    }

                });
            }</script>

        <div id="post_message_accueil">
            <form action="#" method="post" id="post_messages" style="margin-top: 3%; margin-bottom: 2%; f">

                <?php
                include "function_used.php";
                if ($result_can) {
                    ?>
                    <div class='control block-cube block-input' style="margin-right: 5%;">
                        <div style="margin-right: 20px">
                            <input type="hidden" value="">
                            <label for="message"></label><input type="text" id="message" name="message" placeholder="What's happening" style="margin-right: 2%; margin-left: 1%; margin-top: 1%; background-color: #212121; color: #fff">
                            <div class='bg'>
                                <div class='bg-inner'></div>
                            </div>
                        </div>

                        <div class='control block-cube block-input' style="position: relative;z-index: 11 ; display: inline-block; margin-bottom: 1%; margin-left: 1%; margin-top: 3%">
                            <input type="submit" name="post_message" id="post_message" value="Post" style="background-color: #212121 ;color: #fff">
                            <div class='bg-top'>
                                <div class='bg-inner'></div>
                            </div>
                            <div class='bg-right'>
                                <div class='bg-inner'></div>
                            </div>
                            <div class='bg'>
                                <div class='bg-inner'></div>
                            </div>
                        </div>
                        <div class='bg-top'>
                            <div class='bg-inner'></div>
                        </div>
                        <div class='bg-right'>
                            <div class='bg-inner'></div>
                        </div>
                        <div class='bg'>
                            <div class='bg-inner'></div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST["post_message"])) {
                        $email = $result_can['email'];
                        $id_user = implode(",", $mysqli->query("SELECT id FROM user WHERE email = '$email'")->fetch_assoc());
                        $modifier_ver = str_replace("'","\'",$_POST["message"]);
//                insert_fields('post', ["ID_user" => $id_user, "post" => $modifier_ver]);  //mettre l'id user dans la requets

                        if(preg_match('/[a-zA-Z_0-9,@!.?\'] */',$modifier_ver) == 0){
                            print " Mauvaise orthographe ";
                            return null;
                        }
                        $mysqli->query("INSERT INTO post (post,ID_user,username_source) VALUES ('$modifier_ver','{$result_can['id']}','{$result_can['username']}')") or die($mysqli->error);
                    }
                }
                ?>
            </form>
        </div>
    </div>
    </div>


    <div style="width: 100%" >
        <?php

        $coms = [];

        $result = $mysqli->query("SELECT * FROM post ORDER BY post_date DESC");
        while (($line = $result->fetch_assoc()))
            $coms[] = $line;
        ?>
        <?php


        //    afffichage
        foreach ($coms as $com){
        if ($com["username_source"] == $username or $com["username_destinataire"] == $username){

            $ID_user = $com["ID_user"];
            if ($ID_user!=NULL) {
                $username_proprio = $mysqli->query("SELECT username FROM profile WHERE ID_user = '$ID_user'");
                $username_proprio = $username_proprio->fetch_assoc();
                $username_proprio = implode(",", $username_proprio);
                ?>
                <div style="margin-top: 4%; margin-right: 2%; padding-bottom: 1%;" class='control block-cube block-input'>
                <?php
                if ($com["username_destinataire"] and $com["username_destinataire"] != $com["username_source"]){  //style="position : relative; z-index: 10"
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

                    <?php if($result_can){?>
                        <button class='.like_button' style="position: relative; z-index: 11; margin-top: 2%; margin-bottom: 3%; margin-left: 1%">
                            <div class='bg'>
                                <div class='bg-inner'></div>
                            </div>
                            <div style=" position: relative; z-index: 11; color: #fff">
                                <span id ="icon" ><i class="fa-regular fa-thumbs-up"></i></span>
                                <span id = "count">0</span> Likes
                            </div>
                        </button>
                        <script> like_button();</script>

                    <?php } ?>
                </div>

                <?php
                if($result_can && $com['ID_user'] == $result_can['id']){?>

                    <form action="" class="form_delete_list_comment" method="post">
                        <div class='control block-cube block-input' style="position: relative;z-index: 11 ; display: inline-block; margin-bottom: 1%; margin-left: 1%">
                            <label>
                                <input type="hidden" name="supp" value="<?php echo $com['id']?>"/>
                                <input id="delete" name="delete" type="submit" value="Delete message" style="background-color: #212121; color: #fff;">
                            </label>
                            <div class='bg-top'>
                                <div class='bg-inner'></div>
                            </div>
                            <div class='bg-right'>
                                <div class='bg-inner'></div>
                            </div>
                            <div class='bg'>
                                <div class='bg-inner'></div>
                            </div>
                        </div>
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
                    <div style="background-color: #212121; margin-top: 5%; margin-left: 5%;margin-bottom: 2%; margin-right: 2%; position: relative; z-index: 10;"  class='control block-cube block-input'>
                        <b style=" max-width: 99%; word-wrap: break-word; position: relative; z-index: 11;"><?=$row["username_destinataire"]?> </b>
                        <i style="opacity: 0.5;position: relative; z-index: 11;"><?=$row["post_date"]; ?></i>
                        <p style="font-size: 1.2em; margin-bottom: 0; max-width: 99%; word-wrap: break-word;position: relative; z-index: 11; "><?=$row["post"]; ?></p>
                        <?php if($result_can){?>
                            <button class='.like_button' style="position: relative; z-index: 11; margin-top: 2%; margin-bottom: 3%; margin-left: 1%">
                                <div class='bg'>
                                    <div class='bg-inner'></div>
                                </div>
                                <div style=" position: relative; z-index: 11; color: #fff">
                                    <span id ="icon" ><i class="fa-regular fa-thumbs-up"></i></span>
                                    <span id = "count">0</span> Likes
                                </div>
                            </button>
                            <script> like_button();</script>

                        <?php } ?>

                        <?php if($result_can!=NULL && $row['ID_user'] == $result_can['id']){?>
                            <form action="" class="form_delete_list_comment" method="post">
                                <div class='control block-cube block-input' style="position: relative;z-index: 11 ; display: inline-block; margin-bottom: 1%; margin-left: 1%;">
                                    <label>
                                        <input type="hidden" name="supp" value="<?php echo $row['id']?>"/>
                                        <input id="delete" name="delete" type="submit" value="Delete message" style=" background-color: #212121; color: #fff;">
                                    </label>
                                    <div class='bg-top'>
                                        <div class='bg-inner'></div>
                                    </div>
                                    <div class='bg-right'>
                                        <div class='bg-inner'></div>
                                    </div>
                                    <div class='bg'>
                                        <div class='bg-inner'></div>
                                    </div>
                                </div>
                            </form>

                        <?php } ?>
                        <div class='bg-top'>
                            <div class='bg-inner'></div>
                        </div>
                        <div class='bg-right'>
                            <div class='bg-inner'></div>
                        </div>
                        <div class='bg'>
                            <div class='bg-inner'></div>
                        </div>
                    </div>


                    <?php
                }
                if($result_can){?>
                    <form method="POST" style="display: inline-block ; margin-left: 1%; margin-top: 2%">
                        <div class='control block-cube block-input'>
                            <label>
                                <input type="hidden" name="id_dest" value="<?php echo $com['ID_user']?>"/>
                                <input type="hidden" name="comment_id" value="<?php echo $com['id']?>"/>
                                <input type="hidden" name="username_source2" value="<?php echo $com['username_source']?>"/>

                                <div>
                                    <input type="text" id="message" name="comment" placeholder="commenter" style="background-color: #212121; color: #fff; ">
                                    <div class='bg'>
                                        <div class='bg-inner'></div>
                                    </div>
                                </div>

                                <div>
                                    <input type="submit" id='submit' value='valider' style="background-color: #212121; color: #fff; ">
                                    <div class='bg'>
                                        <div class='bg-inner'></div>
                                    </div>
                                </div>
                            </label>


                            <div class='bg-top' style="z-index: 11">
                                <div class='bg-inner'></div>
                            </div>
                            <div class='bg-right' style="z-index: 11">
                                <div class='bg-inner'></div>
                            </div>
                            <div class='bg' style="z-index: 1">
                                <div class='bg-inner'></div>
                            </div>

                        </div>

                    </form>


                    <?php
                }
            }
            ?>
            <div class='bg-top'>
                <div class='bg-inner'></div>
            </div>
            <div class='bg-right'>
                <div class='bg-inner'></div>
            </div>
            <div class='bg'>
                <div class='bg-inner'></div>
            </div>
            </div>
            <?php

        }
        ////


        //actionnement des formulaires
        if(isset($_POST["delete"])) {

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
        ?>

    </div>
</body>
