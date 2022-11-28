

<div id="post_message_profile" style="margin-top: 3%" >
    <form action="#" method="post" id="post_messages">
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
                    <b style=" max-width: 99%; word-wrap: break-word;  "><a href="index.php?variable=profile_guest.php&profile_guest=<?=$username_proprio?>" style="text-decoration: none ; color: white"><?=$username_proprio?></a>
                        <i style="opacity: 0.5;"> pour </i>
                        <a href="index.php?variable=profile_guest.php&profile_guest=<?=$com["username_destinataire"]; ?>" style="text-decoration: none ; color: white"><?=$com["username_destinataire"]; ?></a>
                    </b>
                    <i style="opacity: 0.5;; color: white"><?=$com["post_date"]; ?></i>
                    <br><b style=" max-width: 99%; word-wrap: break-word; color: white "><?= "    ".$com["likes"]." likes"; ?></b>
                    <p style="font-size: 1.2em; margin-bottom: 0 ; max-width: 99%; word-wrap: break-word; ; overflow-wrap: anywhere; color: white"><?=$com["post"]; ?></p>
                </post>
                <?php
            }
            else{
                ?>
                <post style="position : relative; z-index: 10; color: white">
                    <b style=" max-width: 99%; word-wrap: break-word; overflow-wrap: anywhere; color: white"><a href="index.php?variable=profile_guest.php&profile_guest=<?=$username_proprio?>" style="text-decoration: none ; color: white"><?=$username_proprio?></a></b>
                    <i style="opacity: 0.5; color: white"><?=$com["post_date"]; ?></i>
                    <br><b style=" max-width: 99%; word-wrap: break-word; color: white"><?= "   ".$com["likes"]." likes"; ?></b>
                    <p style="font-size: 1.2em; margin-bottom: 0 ; max-width: 99%; word-wrap: break-word; overflow-wrap: anywhere; color: white "><?=$com["post"]; ?></p>
                </post>
                <?php
            }
            ?>
            <div style="background-color: #2f2f2f;">
                <?php if($result_can){
                    like_button("like",$com);

                } ?>
            </div>

            <?php
            if(($result_can && $com['ID_user'] == $result_can['id']) || $log_a){
                delete_comment($com);
            }
            ?>
            <?php
        }
        $res = $mysqli->query("SELECT * FROM post WHERE comment_id_destinataire = '{$com['id']}'");
        if ($res) {
            // output data of each row
            while ($row = $res->fetch_assoc()) { ?>
                <div style="background-color: #212121; margin-top: 5%; margin-left: 5%;margin-bottom: 2%; margin-right: 2%; position: relative; z-index: 10;"  class='control block-cube block-input'>
                    <?php
                    affi_sous_comment($row);
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
    ?>
</div>



