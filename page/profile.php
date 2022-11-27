
<?php
$guest = $result_can['username'];
$username = mysqli_query($mysqli,"SELECT * FROM profile WHERE username = '$guest'");
$username = $username->fetch_assoc();
$username2 = mysqli_query($mysqli,"SELECT * FROM user WHERE username = '$guest'");
$username2 = $username2->fetch_assoc();

echo $_SESSION['username'];

if(!$result_can){
    echo "<script> location.replace('index.php'); </script>";
}
?>


<style>
    .typing-demo {
        width: <?php echo strlen($username['biographie'])/2/2+1 ?>em;
        animation: typing 2s steps(50), blink 0.5s step-end infinite alternate;
        white-space: nowrap;
        overflow: hidden;
        border-right: 3px solid;
        font-family: monospace;
        font-size: 2em;
    }

    @keyframes typing {
        from {
            width: 0
        }
    }

    @keyframes blink {
        100% {
            border-color: transparent
        }
    }
</style>
<h1 style="font-size: 2em">Profile</h1>

<br>
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

<div>
    <div class='control block-cube block-input' style="margin-right: 5%; margin-bottom: 5%">
        <h1 style="position: relative ; z-index: 11 ;font-size: 2em; ">Profile de <?php echo $guest; ?></h1>
        <div>
            <div id="div_bio" style="position: relative; z-index: 11; margin-left: 2px">

                <?php

                echo '<h3 style="position: relative;z-index: 5 ;">Biographie:</h3>';
                ?>
                <div>
                    <div class="typing-demo" style="">
                        <?php echo "<h1>{$username['biographie']}</h1>" ?>
                    </div>
                </div>
                <a href="" id="follower" style="text-decoration: none; color: #fff">Follower : <?=$username2['follower'] ;?></a>
                <br>
                <?php
                $abo = [];
                $requestabo = $mysqli->query("SELECT id_follo FROM abo WHERE id_user = {$result_can['id']}");
                while (($lineabo = $requestabo->fetch_assoc()))
                    $abo[]=$lineabo;

                $nb_abo = count($abo);
                ?>
                <a href="index.php?variable=message_suivis.php" id="suivie" style="text-decoration: none; color: #fff">Suivis : <?=$nb_abo ?></a>
                <br>
                <a href="index.php?variable=liste_following.php" id="suivie" style="text-decoration: none; color: #fff">Following</a>
                <br>
                <a href="index.php?variable=liste_follower.php" id="suivie" style="text-decoration: none; color: #fff">Follower</a>
                <br>

            </div>
        </div>

        <form action="" id="modif_bio" method="POST" style="margin-left: 1%; margin-top: 3%" onsubmit="return confirm('Etes vous sur de modifier la bio ?');">
            <div class='control block-cube block-input' style="position: relative; z-index: 11; display: inline-block ; margin-bottom: 1%">
                <label for="">
                    <label for="modifier"></label><input type="text" id="modifier" name="modifier" placeholder="Inserez le message à remplacer"  style="background-color: #212121 ;color: #fff; "/>
                    <input type="hidden" id="modif_bio_submit" name="idz"  value="<?php echo $username['id']?>" /><br>
                    <input type="submit" value="modifier la bio"  style="background-color: #212121 ;color: #fff;" autocomplete="off">
                    <?php
                    useless_div();
                    ?>
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

</div>


<a href="index.php?variable=log_ip.php" id="suivie" style="text-decoration: none; color: #fff">ip log</a>




