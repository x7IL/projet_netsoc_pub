
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
            if($row['username_destinataire'] == $guest){
                $boolean = 1;
            }
        }
        if($boolean == 1 or $com['username_source'] == $guest or $com['username_destinataire'] == $guest){
            ?>
            <div style="margin-top: 4%; margin-right: 2%; padding-bottom: 4%;" class='control block-cube block-input'>
                <?php
                affi_pour($com);
                ?>
                <div style="background-color: #212121;">
                    <?php if($result_can){
                        like_button("like",$com);
                    } ?>
                </div>

                <?php
                if($result_can and $com['ID_user'] == $result_can['id']){
                    delete_comment($com);
                }
                // output data of each row
                foreach($coms2 as $row){
                    affi_sous_comment($row);
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
