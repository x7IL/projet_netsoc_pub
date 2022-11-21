<div id="post_message_profile" style="margin-top: 3%" >
    <form action="#" method="post" id="post_messages">
        <?php
        if ($result_can) {
            form_post();
        }
        ?>
    </form>
</div>

<div id="list_message_profile_recherche" style=" width: 100% ">

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
            <div style="margin-top: 4%; margin-right: 2%; padding-bottom: 4%; padding-left: 2px" class='control block-cube block-input'>
                <?php
                affi_pour($com);
                ?>
                <div style="background-color: #2f2f2f;">
                    <?php if($result_can){
                        like_button("like",$com);
                    } ?>
                </div>
                <?php

                if($result_can && $com['ID_user'] == $result_can['id']){
                    delete_comment($com);
                }
                // output data of each row
                foreach($coms2 as $row){
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
                }
                useless_div();
                ?> </div> <?php
        }
    }
    ?>
</div>
