

<h1 style="font-size: 2em">Liste des morts : (liste des suivis)</h1>

<div style="width: 100%">
    <?php
    $abo = $mysqli->query("SELECT * FROM abo WHERE id_user = '{$result_can['id']}'");
    $row_cnt = $abo->num_rows;


    if($row_cnt){
        ?>
        <div class='control block-cube block-input' style=" background-color: #212121; color: #fff; margin-top: 3%; margin-right: 3%;position: relative">
            <?php
            while ($row = $abo->fetch_assoc()) {
                $abo2 = $mysqli->query("SELECT * FROM profile WHERE id_user = '{$row['id_follo']}'");
                $abo2 = $abo2->fetch_assoc();
                ?>
                <a href="index.php?variable=profile_guest.php&profile_guest=<?php echo $abo2['username']?>" style="text-decoration: none; font-size: 1.2em; color: #fff; max-width: 99% ; position: relative; z-index: 11"">
                <?php echo $abo2['username']?>
                </a>
                <i style="color: #fff ;opacity: 0.5; position: relative; z-index: 11">
                    <?php echo $abo2['biographie']?>
                </i>
                <br>
                <?php
            }
            useless_div();
            ?>
        </div>
        <?php

    }
    ?>
</div>
