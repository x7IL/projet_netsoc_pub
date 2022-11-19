
<?php
$guest = $result_can['username'];
$username = mysqli_query($mysqli,"SELECT * FROM profile WHERE username = '$guest'");
$username = $username->fetch_assoc();
$username2 = mysqli_query($mysqli,"SELECT * FROM user WHERE username = '$guest'");
$username2 = $username2->fetch_assoc();
?>

<h1 style="font-size: 2em">Profile</h1>
<div>
    <div class='control block-cube block-input' style="margin-right: 5%; margin-bottom: 5%">
        <h1 style="position: relative ; z-index: 11 ;font-size: 2em; ">Profile de <?php echo $guest; ?></h1>
        <div>
            <div id="div_bio" style="position: relative; z-index: 11">
                <?php
                echo '<h3 style="position: relative;z-index: 11 ;">Biographie:</h3>';
                echo "<p style='font-size: 1.1em  ; position: relative ;z-index: 11;'>{$username['biographie']}</p>";
                echo '<h5>Follower :</h5>'.$username2['follower'];

                if (isset($_POST['modifier']) && isset($_POST['id'])) {
                    $modifier_ver = str_replace("'","\'",$_POST['modifier']);
                    $sql = "UPDATE profile SET biographie='$modifier_ver' WHERE id_user ='{$result_can['id']}'";
                    if ($mysqli->query($sql) === TRUE) {
                    } else {
                        echo "Error updating record: " . $mysqli->error;
                    }
                }
                ?>
            </div>
        </div>

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
        <?php useless_div(); ?>

    </div>
    <div id="list_message" ">

        <?php
        include('page/mur_commentaire_profile.php')
        ?>
    </div>
    <form action="" class="form_delete_list_comment" method="post">
        <div class='control block-cube block-input' style="position: relative;z-index: 11 ; display: inline-block; margin-bottom: 1%; margin-left: 1%;">
            <label>
                <input type="hidden" name="supp_compte" value="<?php echo $username2['id']?>"/>
                <input name="supprime" type="submit" value="Supprimer le compte" style=" background-color: #212121; color: #fff;">
            </label>
            <?php useless_div(); ?>
        </div>
    </form>
</div>

<?php

if($result_can && isset($_POST['supp_compte'])){


//    supprime les commentaires
    $com_delete = [];
    $result = $mysqli->query("SELECT * FROM post WHERE id_user = {$username2['id']}");
    while (($line = $result->fetch_assoc()))
        $com_delete[] = $line;
    foreach($com_delete as $row){
        $supp = ("DELETE FROM jaime WHERE id_user = '{$username2['id']}'")
        or die($mysqli->error);
        $mysqli->query($supp);
        $mysqli->query("DELETE FROM post WHERE id_user= {$username2['id']}");
    }
    $supp = ("DELETE FROM jaime WHERE id_user = '{$username2['id']}'")
    or die($mysqli->error);
    $mysqli->query($supp);
    $mysqli->query("DELETE FROM post WHERE id_user = '{$username2['id']}'");

//    supprime la biographie
    $supp = ("DELETE FROM profile WHERE id_user = '{$username2['id']}'")
    or die($mysqli->error);
    $mysqli->query($supp);

//    supprime les abo

    $com_delete = [];
    $result = $mysqli->query("SELECT * FROM abo WHERE id_user = {$username2['id']}");
    while ($line = $result->fetch_assoc()) {
        $result2 = $mysqli->query("UPDATE user SET follower = follower - 1 WHERE id ='{$line['id_follo']}'");
    }
    $supp = ("DELETE FROM abo WHERE id_user = '{$username2['id']}'")
    or die($mysqli->error);
    $mysqli->query($supp);

//    supprime les likes

    $com_delete = [];
    $result = $mysqli->query("SELECT * FROM jaime WHERE id_user = {$username2['id']}");
    while ($line = $result->fetch_assoc()) {
        $result2 = $mysqli->query("UPDATE post SET likes = likes - 1 WHERE id ='{$line['id_post']}'");
    }

//    supprime l'user

    $supp = ("DELETE FROM user WHERE id = '{$username2['id']}'")
    or die($mysqli->error);
    $mysqli->query($supp);
    echo "<script> location.replace('index.php'); </script>";

}

?>

