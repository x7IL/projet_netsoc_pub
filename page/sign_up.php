<?php


if($result_can){
    echo "<script> location.replace('index.php'); </script>";
}

?>
<h1 style="font-size: 2em">Sign Up</h1>

<form class="formulaire_inscription" action="" method="POST" style="word-spacing: 2px;">
    <label><b>Nom d'utilisateur</b></label>
    <label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
    </label>
    <br>
    <label><b>Adresse e-mail</b></label>
    <label>
        <input type="email" placeholder="Entrer votre adresse nail" name="email" required>
    </label>
    <br>
    <label><b>Mot de passe</b></label>
    <label>
        <input  type="password" placeholder="Entrer le mot de passe" name="password" required>
    </label>
    <br>
    <label><b>Verification de mot de passe</b></label>
    <label>
        <input  type="password" placeholder="Re entrer le mot de passe" name="repassword" required>
    </label>
    <br>
    <label><b>Genre</b></label>
    <label>
        <input  type="radio" name="genre" value="Homme" checked>
    </label>
    <label for="H">Homme</label>
    <label>
        <input  type="radio" name="genre" value="Femme">
    </label>
    <label for="F">Female</label>
    <br>
    <label><b>Age</b></label>
    <label>
        <input  type="number" placeholder="Entrer votre age" name="age" min="18" max="100" required>
    </label>
    <br>
    <input  type="submit" id='submit' value='valider' >
    <br>
    <!--    <button onclick ="window.location='index.php?name=login.php'">Se connecter</button>-->
</form>


