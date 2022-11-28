
<?php

if($result_can){
    echo "<script> location.replace('index.php'); </script>";
}

?>
<h1 style="font-size: 2em; color: black">Log In</h1>

<form class="formulaire_connexion" action="" method="POST">
    <label><b style="color: black">Adresse e-mail</b></label>
    <label for="email"></label><input style="background-color: #212121; color: black " id="email" type="email" placeholder="Entrer votre adresse mail" name="email" required>

    <br>
    <label><b style="color: black">Mot de passe</b></label>
    <label for="password"></label><input style="background-color: #212121; color: black " id="password" type="password" placeholder="Entrer le mot de passe" name="password" required>

    <br>
    <input style="background-color: #212121; color: #fff " type="submit" id='submit' value='valider' name="submit">
    <br>
    <!--    <button onclick ="window.location='index.php?name=inscription.php'">Inscription</button>-->
</form>




