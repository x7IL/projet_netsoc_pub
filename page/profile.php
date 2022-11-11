
<body>
<h1 style="font-size: 2em">Profile</h1>
    <div>
        <?php
        global $mysqli;

        $email = $_COOKIE["email"];
        $username = $mysqli->query("SELECT username FROM user WHERE email = '$email'");
        $username = $username->fetch_assoc();
        $username = implode(",", $username);

        ?>
        <h2>Bonjour <?php print_r($username) ?></h2>

        <div id="div_bio" class='control block-cube block-input' style="margin-right: 5%;">
            <?php

            if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
                $result_can = $mysqli->query("SELECT * FROM user WHERE email = '{$_COOKIE['email']}' AND password ='{$_COOKIE['password']}'");
                $result_can = $result_can->fetch_assoc();
                $query = "SELECT * FROM profile WHERE id_user = '{$result_can['id']}'";
                $result = $mysqli->query($query);

                if ($result) {
                    // output data of each row
                    echo '<h3 style="position: relative;z-index: 11 ;">Biographie:</h3>';
                    while ($row = $result->fetch_assoc()) {
                        echo "<p style='font-size: 1.1em  ; position: relative ;z-index: 11;'>{$row['biographie']}</p>";
                    }
                    if (isset($_POST['modifier']) && isset($_POST['id'])) {
                        $modifier_ver = str_replace("'","\'",$_POST['modifier']);

                        $sql = "UPDATE profile SET biographie='$modifier_ver' WHERE id_user ='{$result_can['id']}'";
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
                <?php
            }
            ?>
            <div class='bg-top'>
                <div class='bg-inner'></div>
            </div>
            <div class='bg-right'>
                <div class='bg-inner'></div>
            </div>
            <div class='bg'>
                <div class='bg-inner'></div>
            </div>
        </div>
        <div id="list_message" ">
            <?php include('page/mur_commentaire.php')?>
        </div>
    </div>
</body>
