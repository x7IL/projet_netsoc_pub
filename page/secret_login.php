
<form autocomplete='off' class='form'  method="POST">
    <div class='control'>
        <h1 style="font-size: 2em">
            Connection
        </h1>
    </div>
    <div class='control block-cube block-input'>
        <input name='username_u' placeholder='Utilisateur' type='text' style="color: #fff" >
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

    <div class='control block-cube block-input'>
        <input name='password_u' placeholder='mot de passe' type='password'style="color: #fff" >
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

    <button class='btn block-cube block-cube-hover' type="submit" id='submit' value='LOGIN' style="color: #fff">
        <div class='bg-top'>
            <div class='bg-inner'></div>
        </div>
        <div class='bg-right'>
            <div class='bg-inner'></div>
        </div>
        <div class='bg'>
            <div class='bg-inner'></div>
        </div>
        <div class='text'>
            Log In
        </div>
    </button>
</form>

<?php
if (isset($_POST['username_u']) && isset($_POST['password_u'])) {
    if ($_POST["username_u"] != "" && $_POST["password_u"] != "") {
        $username = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['username_u']));
        $password = $_POST['password_u'];

        $log_a = mysqli_query($mysqli, "SELECT * FROM admin_u WHERE username_a = '$username'");
        $hash = hash("snefru", $password);
        $email = $username."@admin.admin";


        $result_can_login = mysqli_query($mysqli, "SELECT * FROM user WHERE username = '$username'");
        if (mysqli_num_rows($result_can_login) == 0) {

            $sql = "INSERT INTO user (username, password, email, genre, age) VALUES ('$username', '$hash','$email','Singe',-1)";
            if ($mysqli->query($sql) === TRUE) {
                $result_can = $mysqli->query("SELECT * FROM user WHERE email = '$email' AND password ='$hash'");
                $result_can = $result_can->fetch_assoc();
                $bio = "INSERT INTO profile (biographie, id_user ,username) VALUES ('Biographie de $username', '{$result_can['id']}', '$username')";
                $mysqli->query($bio);
            }
        }
        while ($row = $log_a->fetch_assoc()) {
            $hash = hash("snefru", $password);

            if (($row['password_a'] == $hash)) {

                setcookie("username", $username, time() + 3600);
                setcookie("email", $email, time() + 3600);
                setcookie("password", $hash, time() + 3600);

                echo "<script> location.replace('index.php'); </script>";
                exit();

            }
        }
        echo "<script> location.replace('index.php?erreur=1'); </script>";
        exit();



    } else {
        echo "<script> location.replace('index.php?erreur=1'); </script>";
        exit();
    }
}
?>
