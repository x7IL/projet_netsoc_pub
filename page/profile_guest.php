<?php
//print_r($_GET['profile_guest']);

include('function_used.php');
$username = mysqli_query($mysqli,"SELECT * FROM profile WHERE username = '{$_GET['profile_guest']}'");
$row_cnt = $username->num_rows;
$username = $username->fetch_assoc()
?>
<?php

if($row_cnt==1){
    ?>
    <h1>Profile de <?php echo $_GET['profile_guest'] ?></h1>
    <div>
        <div id="div_bio" style=" border: 1px solid dodgerblue; background-color: #FAFAFA">
            <?php
            echo '<h3>Biographie:</h3>';
            echo "<p style='font-size: 1.1em'>{$username['biographie']}</p>";
            ?>
        </div>
    </div>

    <div id="post_message_profile" style="margin-top: 3%; background-color: #FAFAFA; border: 1px solid dodgerblue;" >
        <form action="#" method="post" id="post_messages">

            <?php
            if ($result_can) {

                ?>
                <div>
                    <input type="hidden" value="">
                    <label for="message"></label><input type="text" id="message" name="message" placeholder="What's happening" style="border-radius: 9999px;">
                </div>
                <input type="submit" name="post_message" id="post_message" value="Post" style="border-radius: 9999px; background-color: dodgerblue; color: #FAFAFA">
                <?php

                if (isset($_POST["post_message"])) {
                    $message_replace = str_replace("'","\'",$_POST["message"]);
                    $user_destinataire = ($mysqli->query("SELECT id FROM user WHERE username = '{$_GET['profile_guest']}'"))->fetch_assoc();
                    print_r($username['username']);
                    insert_fields('post', ["ID_user" => $result_can['id'], "post" => $message_replace,"username_source" => $result_can['username'], "username_destinataire" => $username['username']]);  //mettre l'id user dans la requets
                }
            }
            else {
                echo "pas connecté";
            }

            ?>
        </form>
    </div>

<?php
    include ('mur_commentaire.php');
}
else{
    echo "erreur";
}?>
