<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Profile</title>
</head>
<body>
<h1>Profile</h1>
<?php
include "function_used.php";
global $mysqli;

$email = $_COOKIE["email"];
$username = $mysqli->query("SELECT username FROM user WHERE email = '$email'");
$username = $username->fetch_assoc();
$username = implode(",", $username);

?>
<h2>Bonjour <?php print_r($username) ?></h2>

<br>

<div id="div_bio" style=" border: 1px solid dodgerblue;">
    <?php

    $mysqli = join_database();
    if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $result_can = $mysqli->query("SELECT * FROM user WHERE email = '{$_COOKIE['email']}' AND password ='{$_COOKIE['password']}'");
    $result_can = $result_can->fetch_assoc();
    $query = "SELECT * FROM profile WHERE id_user = '{$result_can['id']}'";
    $result = $mysqli->query($query);

    if ($result) {
        // output data of each row
        echo '<h3>Biographie:</h3>';
        while ($row = $result->fetch_assoc()) {
            echo "<p style='font-size: 1.1em'>{$row['biographie']}</p>";
        }

        if (isset($_POST['modifier']) && isset($_POST['id'])) {

            $sql = "UPDATE profile SET biographie='{$_POST['modifier']}' WHERE id_user ='{$result_can['id']}'";
            if ($mysqli->query($sql) === TRUE) {
                header("Refresh:0");
            } else {
                echo "Error updating record: " . $mysqli->error;
            }
        }
    }
    else {
        $result_can = null;
        echo "Non connecté";
    }
    ?>
    <form action="" id="modif_bio" method="POST">
        <input type="text" id="modifier" name="modifier" placeholder="Inserez le message à remplacer" style="border-radius: 9999px;"/>
        <input type="hidden" id="modif_bio_submit" name="id"  value="<?php echo $row['ID']?>" /><br>
        <input type="submit" value="modifier la bio" >
    </form>
    <?php
    }
    ?>
</div>
<hr style="color: dodgerblue" >
<div id="post_message_profile" style="margin-top: 5%">
    <form action="#" method="post" id="post_messages">

        <?php

        if (isset($_COOKIE["email"]) && isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
            ?>
            <div>
                <input type="hidden" value="">
                <label for="message"></label><input type="text" id="message" name="message" placeholder="What's happening" style="border-radius: 9999px;">
            </div>
            <input type="submit" name="post_message" id="post_message" value="Post" >
            <?php
            if (isset($_POST["post_message"])) {

                $mysqli = join_database();
                $email = $_COOKIE["email"];
                $id_user = $mysqli->query("SELECT id FROM user WHERE `email` = '$email'");
                $id_user = $id_user->fetch_assoc();
                $id_user = implode(",", $id_user);
                insert_fields('post', ["ID_user" => $id_user, "post" => $_POST["message"]]);  //mettre l'id user dans la requets
            }
        }
        else {
            echo "pas connecté";
        }

        ?>
    </form>
</div>

<div id="list_message">
    <?php

        global $mysqli;
        $coms = [];
        $result = $mysqli->query("SELECT * FROM `post` ORDER BY post_date DESC");
        while (($line = $result->fetch_assoc()))
            $coms[] = $line;
        ?>
    <?php
    foreach ($coms as $com){
        $ID_user = $com["ID_user"];
        if ($ID_user!=NULL) {
            $username = $mysqli->query("SELECT username FROM profile WHERE id_user = '$ID_user'");
            $username = $username->fetch_assoc();
            $username = implode(",", $username);
            ?>
            <hr style="color: dodgerblue"/>
            <div style="border: 1px solid dodgerblue;">
                <p id="contenue_message" >De <b><?=$username; ?> :</b><br><?=$com["post"]; ?> :<br><?=$com["post_date"]; ?></p>

                <?php

                if(isset($_COOKIE["username"])){
                if ($_COOKIE["username"] == $username){
                ?>
                <form action="" class="form_delete_comment" method="post"><?php
                    ?>
                    <input type="hidden" name="supp" value="<?php echo $com['id']?>"/>
                    <input id="delete" name="delete" type="submit" value="Delete message"><br>
                    <?php
                    }
                    }
                    ?>
            </div>

                    </form>
            <?php
        }
    }
    if(isset($_POST["delete"])) {
        delete_fields('post', 'id', $_POST['supp']);//verification_db('comment', "id",  "message", $com['message'], $_COOKIE['idmessage'])
        header("Refresh:0");
    }
    ?>
</div>

</body>
</html>
