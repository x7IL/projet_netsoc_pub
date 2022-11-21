<?php


$guest = $_GET['profile_guest'];
$username = mysqli_query($mysqli,"SELECT * FROM profile WHERE username = '{$_GET['profile_guest']}'");
$row_cnt = $username->num_rows;
$username = $username->fetch_assoc();
$username2 = mysqli_query($mysqli,"SELECT * FROM user WHERE username = '{$_GET['profile_guest']}'");
$username2 = $username2->fetch_assoc();

if($row_cnt==1){
    if($full_droit == 1){
    ?>
        <div>
            <form action="" class="form_delete_list_comment" method="post" onsubmit="return confirm('Etes vous sur de supprimer le compte ?');">
                <div class='control block-cube block-input' style="position: relative;z-index: 11 ; display: inline-block; margin-bottom: 1%; margin-left: 1%;">
                    <label>
                        <input type="hidden" name="supp_compte" value="<?php echo $username2['id']?>"/>
                        <input name="supprime" type="submit" value="Supprimer le compte" style=" background-color: #212121; color: #fff;">
                    </label>
                    <?php useless_div(); ?>
                </div>
            </form>
        </div>
        <br>
        <?php
    }
    ?>




    <div class='control block-cube block-input' style="margin-right: 5%; margin-bottom: 5%">
        <h1 style="position: relative ; z-index: 11 ;font-size: 2em; ">Profile de <?php echo $guest; ?></h1>
        <div>
            <div id="div_bio" style="position: relative; z-index: 11">
                <?php
                echo '<h3>Biographie:</h3>';
                echo "<p style='font-size: 1.1em'>{$username['biographie']}</p> <br>";


                echo "Follower : ".$username2['follower'] ;

                if($result_can && $result_can['id'] != $username2['id']){
                    $test = $mysqli->query("SELECT * FROM abo WHERE id_follo = '{$username2['id']}'AND id_user = '{$result_can['id']}'");
                    $row_cnt2 = $test->num_rows;
                    ?>
                    <form action="" class="form_abo" method="post" style="margin-top: 2%">
                        <div class='control block-cube block-input' style="position: relative;z-index: 11 ; display: inline-block; margin-bottom: 1%; margin-left: 1%;">
                            <label>
                                <input type="hidden" name="abo_id" value="<?php echo $username2['id']?>"/>
                                <input name="sabo" type="submit" value="<?php echo $row_cnt2 ==0 ? 'follow' : 'Unfollow' ?>" style=" background-color: #212121; color: #fff;">
                            </label>
                            <?php useless_div(); ?>
                        </div>
                    </form>

                    <?php
                    if(isset($_POST['sabo'])){

                        $temp = $mysqli->query("SELECT * FROM abo WHERE id_follo = {$username2['id']}");
                        $row_cnt3 = $temp->num_rows;

                        $test = $mysqli->query("SELECT * FROM abo WHERE id_follo = '{$username2['id']}'AND id_user = '{$result_can['id']}'");
                        $row_cnt2 = $test->num_rows;
                        if ($row_cnt2 == 0){

                            $sql = "UPDATE user SET follower = '$row_cnt3' + 1 WHERE id = '{$username2['id']}'";
                            $ajout = ("INSERT INTO abo (id_follo,id_user) VALUES ('{$username2['id']}','{$result_can['id']}')")
                            or die($mysqli->error);
                            $mysqli->query($sql);
                            $mysqli->query($ajout);

                        }
                        else{
                            $sql = "UPDATE user SET follower = follower - 1 WHERE id = '{$username2['id']}'";
                            $supp = ("DELETE FROM abo WHERE id_follo = '{$username2['id']}'AND id_user = '{$result_can['id']}'")
                            or die($mysqli->error);
                            $mysqli->query($sql);
                            $mysqli->query($supp);
                        }
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                    $_POST['abo_id'] = NULL;
                }
                ?>
            </div>
            <?php
            if($full_droit == 1){
            ?>
            <form action="" id="modif_bio" method="POST" style="margin-left: 1%; margin-top: 3%">
                <div class='control block-cube block-input' style="position: relative; z-index: 11; display: inline-block ; margin-bottom: 1%">
                    <label for="">
                        <label for="modifier"></label><input type="text" id="modifier" name="modifier" placeholder="Inserez le message à remplacer"  style="background-color: #212121 ;color: #fff; "/>
                        <input type="hidden" id="modif_bio_submit" name="idz"  value="<?php echo $username2['id']?>" /><br>
                        <input type="submit" value="modifier la bio de l'utilisateur"  style="background-color: #212121 ;color: #fff;" autocomplete="off">
                        <?php
                        useless_div();
                        ?>
                    </label>

                </div>
            </form>
            <?php } ?>
        </div>
        <?php  useless_div(); ?>
    </div>

    <?php
    include ('mur_commentaire_guest.php');
}
else{
    echo "Le profile n'existe pas.";
}
?>
