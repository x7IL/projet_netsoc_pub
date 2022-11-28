<?php

    $output = '' ;
    if (isset($_GET['searchVal'])){

        $searchq = $_GET['searchVal'];
        $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
        $query = mysqli_query($mysqli, "SELECT * FROM profile WHERE username LIKE '%".$searchq."%' LIMIT 20 ")or die("Could not search!");
        $count = mysqli_num_rows($query);

        if($count == 0){
            $output = '<div>Pas de resultat !!! :=====></div>';
        }else{
            while($row = mysqli_fetch_array($query)){
                if(isset($_COOKIE["username"])){
                    $username_utilisateur = $_COOKIE["username"];
                }
                else{
                    $username_utilisateur = "";
                }
                if ($row["username"] != $username_utilisateur){
                ?>
                <div class='control block-cube block-input' style=" background-color: #212121; color: black; margin-top: 3%; margin-right: 3%;position: relative">
                    <a href="index.php?variable=profile_guest.php&profile_guest=<?php echo $row['username']?>" style="text-decoration: none; font-size: 1.2em; color: white; max-width: 99% ; position: relative; z-index: 11"">
                        <?php echo $row['username']?>
                    </a>
                    <i style="color: white ;opacity: 0.5; position: relative; z-index: 11">
                        <?php echo $row['biographie']?>
                    </i>
                    <?php
                    useless_div();
                    ?>
                </div>
                <br>
                <?php
                }
            } // while
        } // else
    } // main if
?>
