
<?php
$guest = $result_can['username'];
$username = mysqli_query($mysqli,"SELECT * FROM profile WHERE username = '$guest'");
$username = $username->fetch_assoc();
?>

<h1 style="font-size: 2em">Profile</h1>
<div>
    <div class='control block-cube block-input' style="margin-right: 5%; margin-bottom: 5%">
        <h1 style="position: relative ; z-index: 11 ;font-size: 2em; ">Profile de <?php echo $guest; ?></h1>
        <div>
            <div id="div_bio" style="position: relative; z-index: 11">
                <?php
                echo '<h3>Biographie:</h3>';
                echo "<p style='font-size: 1.1em'>{$username['biographie']}</p>";
                ?>
            </div>
        </div>
        <?php useless_div(); ?>
    </div>
    <div id="list_message" ">

        <?php
        include('page/mur_commentaire_profile.php')
        ?>
    </div>
</div>

