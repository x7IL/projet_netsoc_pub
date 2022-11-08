<?php
    global $mysqli;
    $output = '' ;
    if (isset($_GET['searchVal'])){
        $searchq = $_GET['searchVal'];
        $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
        $query = mysqli_query($mysqli, "SELECT * FROM profile WHERE username LIKE '%".$searchq."%' LIMIT 20 ")or die("Could not search!");
        $count = mysqli_num_rows($query);
        if($count == 0){
            $output = '<div>No results!</div>';
        }else{
            while($row = mysqli_fetch_array($query)){
                ?>
                <!--                            <div>--><?php //echo "pseudo : ".$row['username']; ?><!--</div>-->

                <div style="background-color: #FAFAFA; border: solid 1px dodgerblue; background-color: #FAFAFA; margin-top: 1%;">
                    <a href="index.php?variable=profile_guest.php&profile_guest=<?php echo $row['username']?>" style="text-decoration: none; font-size: 1.2em; color: black; max-width: 99%""><?php echo $row['username']?></a><i style="opacity: 0.5;"> <?php echo $row['biographie']?> </i>
                </div>
                <br>
                <?php
            } // while
        } // else
    } // main if
?>
