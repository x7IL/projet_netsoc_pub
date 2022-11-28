<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>titre2</title>


</head>


<script>
    var urlEncoreData = "",
        urlEncodedDataPairs = [];


    function test2() {
        var xhr = new XMLHttpRequest();
        //let title;
        //let html;
        var index = 0;


        while (index == 0) {



            xhr.open("POST", "websites/site01.php", true);
            xhr.responseType = "text";
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    //alert("connexion a site01 reussite\nrecuperation du titre")
                    const html = xhr.responseText;

                    //title = html.getElementById("titre").textContent;

                    for (const argument of html.split("\n")) {
                        //console.log(argument);
                        if (argument.includes("<title>")) {
                            //console.log(argument);
                            const title = argument;

                            var params = new Object();
                            params.titre = title;

                            //urlEncodedDataPairs.push(encodeURIComponent('titre') + ":" + encodeURIComponent(title));
                            urlEncodedDataPairs.push("'titre" + "':" + title);



                            break;
                        }

                    }
                    //title = document.querySelector('title').text;
                }

            }
            //console.log(title + "\n" + html);
            //urlEncodedDataPairs.push(encodeURIComponent("titre") + "=" + encodeURIComponent(title));
            //console.log(urlEncodedDataPairs);

            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send();
            index = 1
        }
        if (index == 1) {


            var http = new XMLHttpRequest();

            var url = 'http://localhost/site/recep1.php';
            var urlsite = "http://localhost/NetSoc/index.php?variable=log_in.php";
            var urltest = "http://localhost/site/test2.php";
            http.open('POST', url, true);
            //window.open(urlsite);


            http.onreadystatechange = function () {
                if (http.readyState == 4 && http.status == 200) {
                    console.log("data dans la boucle : ",urlEncodedDataPairs);

                    urlEncoreData = urlEncodedDataPairs.join("/");

                    //console.log("la value dans le join() : " + urlEncodedDataPairs.join(""))

                    console.log("data dans la boucle en string: ",urlEncoreData);

                    //alert("connexion à recep1 reussite")
                }
            }
            console.log("data hors de la boucle : ",urlEncodedDataPairs);

            urlEncoreData = urlEncodedDataPairs.join("/");

            console.log("data hors de la boucle en string : ",urlEncoreData);


            http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            http.responseType = "text";

            console.log("test en dessous de onready... : " + urlEncoreData);
            //console.log("data = ", JSON.parse("titre"))

            http.send(urlEncodedDataPairs.join(""));
        }
    }
    //test2();
    //console.log("la valeur apres appel : " + urlEncodedDataPairs.join(""));
</script>
<?php
$titre = "<script> urlEncodedDataPairs.join('') </script>" ;
echo $titre;

if (isset($_POST["titre"])){
    echo "titre" + $_POST["titre"];
}
else{
    echo "titre pas dispo en post";
}
?>

<?php
function create_cookie($titre)
{

//    $texte = nl2br(file_get_contents("http://localhost/site/websites/" + $site));  //Ouverture de la page
//    $baliseDebut = "<title>";
//    $pos1 = strpos($texte, $baliseDebut) + strlen($baliseDebut); //Position <title> + longueur de <title>
//    $baliseFin = "</title>";
//    $pos2 = strpos($texte, $baliseFin);  // Position </title>
//    $titre = substr($texte, $pos1, $pos2 - $pos1); // On récupère le titre
    echo $titre;

    if (isset($_POST["Titre"])) {
        setcookie("Titre", $_COOKIE["Titre"] + $titre);
    } else {
        setcookie("Titre", $titre);
    }
    if (isset($_COOKIE["Titre"])) {
        echo $_COOKIE["Titre"];
    }
}
if (isset($_COOKIE["Titre"])) {
    echo $_COOKIE["Titre"];
}
?>




</html>
