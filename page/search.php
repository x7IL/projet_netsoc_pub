<?php
    global $mysqli;
    $output = '' ;
    if (isset($_GET['searchVal'])){
        $searchq = $_GET['searchVal'];
        $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
        $query = mysqli_query($mysqli, "SELECT * FROM user WHERE username LIKE '%".$searchq."%' LIMIT 20 ")or die("Could not search!");
        $count = mysqli_num_rows($query);
        if($count == 0){
            $output = '<div>No results!</div>';
        }else{
            while($row = mysqli_fetch_array($query)){
                ?>
                <!--                            <div>--><?php //echo "pseudo : ".$row['username']; ?><!--</div>-->
                <a href="index.php?variable=profile_guest.php&profile_guest=<?php echo $row['username']?>"><?php echo $row['username']?></a>
                <br>
                <?php
            } // while
        } // else
    } // main if
?>
