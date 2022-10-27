<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Liste commentaires</title>
</head>
<body>
<h1>Liste des commentaires</h1>



<?php


$mysqli = join_database();
if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $result_can = $mysqli->query("SELECT * FROM user WHERE email = '{$_COOKIE['email']}' AND password ='{$_COOKIE['password']}'");
    $result_can = $result_can->fetch_assoc();
    $query = "SELECT * FROM profile WHERE id_user = '{$result_can['id']}'";
    $result = $mysqli->query($query);

    if ($result) {
        // output data of each row
        echo '<br><br><br>Biographie:';
        while ($row = $result->fetch_assoc()) {
            echo "<h1>{$row['biographie']}</h1>";
        }

        if (isset($_POST['modifier']) && isset($_POST['id'])) {

            $sql = "UPDATE profile SET biographie='{$_POST['modifier']}' WHERE id_user ='{$result_can['id']}'";
            if ($mysqli->query($sql) === TRUE) {
                header("Refresh:0");
            } else {
                echo "Error updating record: " . $mysqli->error;
            }
        }
} else {
    $result_can = null;
    echo "Non connecté";
}
    ?>


    <form action="" method="POST">
        <input type="text" name="modifier" placeholder="Inserer le message a remplacer"/>
        <input type="hidden" name="id"  value="<?php echo $row['ID']?>" />
        <input type="submit" value="modifier le emssage">
    </form>
    <?php
}
?>

</body>
</html>





