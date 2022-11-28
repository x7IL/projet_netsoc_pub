
<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 300px;
        margin: auto;
        text-align: center;
        font-family: arial;
        border: 2px solid white;
    }

    .price {
        color: grey;
        font-size: 22px;
    }

    .card button {
        border: none;
        outline: 0;
        padding: 12px;
        color: white;
        background-color: slategray;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    .card button:hover {
        opacity: 0.7;
    }
    body{
        background: linear-gradient(45deg, #2a040f, #2a0a28,#180e2a,#0e1f2a,#1d050e);

    }
</style>


<h2 style="text-align:center">Produit en vente</h2>




<h1 style="position: fixed;color: white">Filtrer par :</h1>
<br>
<br>
<form method="post" style="position: fixed;color: white"">
    <input style="color: white" " type="radio" name="trie" value="prix" > Prix
    <input style="color: white"type="radio" name="trie" value="prixd" > Prix Desc
    <br>
    <input style="color: white"type="radio" name="trie" value="stock" > Stock
    <input style="color: white"type="radio" name="trie" value="stockd" > Stock Desc
    <br>
    <input style="color: white"type="radio" name="trie" value="nom" > Nom
    <input style="color: white"type="radio" name="trie" value="nomd" > Nom Desc
    <br>
    <input style="color: white"type="text" name="recherche" placeholder="recherche" autocomplete="on">
    <br>
    <input style="color: black"type="submit" value="filtrer">
</form>
<?php

if (isset($_POST['trie']) && $_POST['trie'] == "prix") {
    $bb = $mysqli->query("SELECT * FROM bonbons ORDER BY prix");
}
else if(isset($_POST['trie']) && $_POST['trie'] == "prixd"){
    $bb = $mysqli->query("SELECT * FROM bonbons ORDER BY prix DESC");
}
else if(isset($_POST['trie']) && $_POST['trie'] == "stock"){
    $bb = $mysqli->query("SELECT * FROM bonbons ORDER BY stock");
}
else if(isset($_POST['trie']) && $_POST['trie'] == "stockd"){
    $bb = $mysqli->query("SELECT * FROM bonbons ORDER BY stock DESC");
}
else if(isset($_POST['trie']) && $_POST['trie'] == "nom"){
    $bb = $mysqli->query("SELECT * FROM bonbons ORDER BY nom");
}
else if(isset($_POST['trie']) && $_POST['trie'] == "nomd"){
    $bb = $mysqli->query("SELECT * FROM bonbons ORDER BY nom DESC");
}
else if (isset($_POST['recherche']) && $_POST['recherche'] != "n"){
    $searchq = htmlspecialchars($_POST['recherche']);
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
    $bb = mysqli_query($mysqli, "SELECT * FROM bonbons WHERE nom LIKE '%".$searchq."%' LIMIT 20 ")or die("Could not search!");
    $count = mysqli_num_rows($bb);
    if($count ==0){
        echo"aucun resultat";
        $bb = $mysqli->query("SELECT * FROM bonbons");
    }
    else{
        $bb = $mysqli->query("SELECT * FROM bonbons WHERE nom LIKE '%".$searchq."%'");
    }

}
else{
    $bb = $mysqli->query("SELECT * FROM bonbons");
}


?>

<script>function aa(){alert('SITE EN MAINTENANCE');}</script>
<?php
while (($line = $bb->fetch_assoc())){
?>
    <div style="color: white"class="card">
        <img src="image/bonbon/<?php echo $line['img']?>" style="width:100%">
        <h1 style="color: white"><?php echo $line['nom']?></h1>
        <p style="color: white"class="price"><?php echo $line['prix']?> Euros/Kg</p>
        <h5 style="color: white">En stock : <?php echo $line['stock'] ?></h5>
        <p style="color: white"><?php echo $line['description']?></p>
        <p><button onclick="aa()">Commander</button></p>

    </div>
    <br>

<?php
}
?>