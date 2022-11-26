<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>titre1</title>

    <script type="text/javascript" src="Like_Bouton.js"></script>

</head>

<body>


<script>
    function test(fichier){
        var index = 0
        var xhr = new XMLHttpRequest();
        var title = document.querySelector('title');
        console.log(title.text)


        while(index == 0){
            xhr.open("GET","websites/"+fichier,true);
            xhr.responseType = "text";
            xhr.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200){

                    title = document.querySelector('title');
                    // Pour envoyer le title (info sur le clien log)
                    /*for (const element in data){
                      query.push(encodeURIComponent(element) + "=" + encodeURIComponent(data[element]));
                    }*/
                }
                else if (this.readyState == 4 && this.status == 404){
                    alert('Error 404');
                }

            };
            xhr.send();
            index = 1;
            //Cet boucle pour récupérer le title
        }
        if (index == 1) {


            var http = new XMLHttpRequest();
            var url = 'http://localhost/site/recep1.php';
            //var params = encodeURIComponent("a") + "=" + encodeURIComponent("ma bite");
            http.open('POST', url, true);

            var params = new Object();
            params.myparam1 = 'baptiste';
            params.myparam2 = "svd";

// Turn the data object into an array of URL-encoded key/value pairs.
            let urlEncodedData = "",
                urlEncodedDataPairs = [],
                names;

            for (names in params) {
                //urlEncodedDataPairs.push(encodeURIComponent(names) + ' : ' + encodeURIComponent(params.names));
            }
            urlEncodedDataPairs.push(encodeURIComponent("titre") + "=" + encodeURIComponent(title.text));


//Send the proper header information along with the request
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


            http.onreadystatechange = function () {//Call a function when the state changes.
                if (http.readyState == 4 && http.status == 200) {
                    alert("envoyé");
                }
            }
            http.send(urlEncodedDataPairs);
        }
    }




    function Info() {

        var variable = 'test';

        $.ajax({
            type: "POST",
            url: "heuresDispo.php",
            data: { voyage:variable },
            contentType: "application/json; charset=utf-8",
            dataType: "txt", //Ton type de retour
            success: function (data)
            {
                alert(data);
                console.log("variable : "+ variable);
            },

            error: function (data)
            {  alert(data[0]);
                console.log('non non non');

            }
        });
    }

    const params = {
        nom : "griffen",
        age : 30,
    }
    // getData(
    //     params,
    //     reponse => console.log(reponse),
    //     (status,statusText) => console.log(`${status} :: ${statusText}`)
    // )



    //
    // postData(
    //     params,
    //     response => console.log(response),
    //     (status,statusText) => console.log(`${status} :: ${statusText}`)
    // )

    test("site00.php")
</script>

</body>


</html>
