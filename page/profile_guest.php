<?php

//print_r($_GET['profile_guest']);
$username = mysqli_query($mysqli,"SELECT * FROM profile WHERE username = '{$_GET['profile_guest']}'");
$row_cnt = $username->num_rows;
$username = $username->fetch_assoc()
?>

<?php

if($row_cnt==1){
    ?>
    <h1>Profile de <?php echo $_GET['profile_guest'] ?></h1>
        <?php if($result_can){ ?>
            <a href="index.php?variable=message_pv.php&mp_pv=<?php echo $_GET['profile_guest']?>">Contacter</a>
        <?php } ?>
    <div>
        <div id="div_bio" style=" border: 1px solid dodgerblue; background-color: #FAFAFA">
    <?php
    echo '<h3>Biographie:</h3>';
    echo "<p style='font-size: 1.1em'>{$username['biographie']}</p>";
    ?>
    </div>
        <?php
    include('mur_commentaire.php');

}
else{
    echo "erreur";
}?>
