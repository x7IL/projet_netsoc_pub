<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>LOG_IN</title>

</head>

<?php


header('Centent-Type: text/html; charset=utf-8');
if (isset($_POST["myparam1"]) || isset($_POST["myparam2"]) || isset($_POST["titre"])) {?>
    <script type="application/javascript"> alert("Recu") </script>
    <h1>Receptionné</h1>
<?php
}


if (isset($_POST["myparam1"])) {
    $value = $_POST["myparam1"];
    echo "myparam1 : ";
    print_r($value);
}


if (isset($_POST["myparam2"])){
    $prenom = $_POST["myparam2"];
    echo "myparam2 : ";
    print_r($prenom);
}

if (isset($_POST["titre"])){
    echo "titre : ";
    print_r($_POST["titre"]);
}
?>
</html>
