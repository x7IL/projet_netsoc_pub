<?php
global $mysqli;
global $result_can;

include('function_used.php');
$guest = $_GET['profile_guest'];
$username = mysqli_query($mysqli,"SELECT * FROM profile WHERE username = '{$_GET['profile_guest']}'");
$row_cnt = $username->num_rows;
$username = $username->fetch_assoc()
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

