

<h1 style="font-size: 2em">Message Follower</h1>

<div style="width: 100%" >
    <?php
    $abo = $mysqli->query("SELECT * FROM abo WHERE id_user = '{$result_can['id']}'");

    $abo_list = [];
    while ($row = $abo->fetch_assoc()) {
        $abo_list [] = $row['id_follo'];
    }
    $sql = $mysqli->query("SELECT * FROM post WHERE comment_id_destinataire IS NULL ORDER BY post_date DESC");

    while ($row = $sql->fetch_assoc()) {
        if(in_array( $row['ID_user'] ,$abo_list )){
            ?>
            <div style="margin-top: 4%; margin-right: 2%; padding-bottom: 4%; padding-left: 2px" class='control block-cube block-input'>
                <?php
                affi_pour($row);
                ?>
            <div style="background-color: #212121;">
                <?php if($result_can){
                    like_button("like",$row);
                } ?>
            </div>

            <?php
            if($result_can and $row['ID_user'] == $result_can['id']){
                delete_comment($row);
            }
            // output data of each row
            $res5 = $mysqli->query("SELECT * FROM post WHERE comment_id_destinataire = '{$row['id']}'");
            if ($res5) {
                // output data of each row
                while ($row5 = $res5->fetch_assoc()) { ?>
                    <div style="background-color: #212121; margin-top: 5%; margin-left: 5%;margin-bottom: 2%; margin-right: 2%; padding-left: 2px ; position: relative; z-index: 10;"  class='control block-cube block-input'>
                        <?php
                        affi_sous_comment($row5);
                        ?>
                    </div>
                <?php
                }
                if($result_can){
                    commenter($row);
                }
            }
            useless_div();
            ?> </div> <?php
        }
    }

    ?>
</div>
