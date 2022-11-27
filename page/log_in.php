
<?php

if($result_can){
    echo "<script> location.replace('index.php'); </script>";
}

?>
<h1 style="font-size: 2em">Log In</h1>

<form class="formulaire_connexion" action="" method="POST">
    <label><b>Adresse e-mail</b></label>
    <label for="email"></label><input style="background-color: #212121; color: #fff " id="email" type="email" placeholder="Entrer votre adresse mail" name="email" required>

    <br>
    <label><b>Mot de passe</b></label>
    <label for="password"></label><input style="background-color: #212121; color: #fff " id="password" type="password" placeholder="Entrer le mot de passe" name="password" required>

    <br>
    <input style="background-color: #212121; color: #fff " type="submit" id='submit' value='valider' name="submit_log_in">
    <br>
    <!--    <button onclick ="window.location='index.php?name=inscription.php'">Inscription</button>-->
</form>
<?php


//gestion des messages d'erreurs
 // fermer la connexion


?>

