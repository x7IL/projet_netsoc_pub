<?php


$guest = $_GET['profile_guest'];
$username = mysqli_query($mysqli,"SELECT * FROM profile WHERE username = '{$_GET['profile_guest']}'");
$row_cnt = $username->num_rows;
$username = $username->fetch_assoc();
$username2 = mysqli_query($mysqli,"SELECT * FROM user WHERE username = '{$_GET['profile_guest']}'");
$username2 = $username2->fetch_assoc();
?>
<?php

if($row_cnt==1){
    ?>
    <div class='control block-cube block-input' style="margin-right: 5%; margin-bottom: 5%">
        <h1 style="position: relative ; z-index: 11 ;font-size: 2em; ">Profile de <?php echo $guest; ?></h1>
        <div>
            <div id="div_bio" style="position: relative; z-index: 11">
                <?php
                echo '<h3>Biographie:</h3>';
                echo '<h5>Follower :</h5>'.$username2['follower'];

                if($result_can){
                    $test = $mysqli->query("SELECT * FROM abo WHERE id_follo = '{$username2['id']}'AND id_user = '{$result_can['id']}'");
                    $row_cnt2 = $test->num_rows;
                    ?>

                    <form action="" class="form_delete_list_comment" method="post">
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
                    }
                    $_POST['abo_id'] = NULL;
                }
                echo "<p style='font-size: 1.1em'>{$username['biographie']}</p>";
                ?>
            </div>
        </div>
        <?php useless_div(); ?>
    </div>

    <?php
    include ('mur_commentaire_guest.php');
}
else{
    echo "Le profile n'existe pas.";
}
?>
