<?php

// design les carrés css
function useless_div(){
    ?>  <div class='bg-top'>
            <div class='bg-inner'></div>
        </div>
        <div class='bg-right'>
            <div class='bg-inner'></div>
        </div>
        <div class='bg'>
            <div class='bg-inner'></div>
        </div>
    <?php
}

// poster un commentaire ou un message
function form_post(){
    ?>

    <div class='control block-cube block-input' style="margin-right: 5%; margin-bottom: 3%;">
        <div class='control block-cube block-input'>
            <input type="hidden" value="">
            <label for="message"></label><input type="text" id="message" name="message" placeholder="What's happening" style="margin-right: 2%; margin-left: 1%; margin-top: 1%; background-color: #212121; color: #fff" autocomplete="off">
            <div class='bg'>
                <div class='bg-inner'></div>
            </div>
        </div>
        <div class='control block-cube block-input' style="position: relative;z-index: 11 ; display: inline-block; margin-bottom: 1%; margin-left: 1%; margin-top: 3%;">
            <input type="submit" name="post_message" id="post_message" value="Post" style="background-color: #212121 ;color: #fff">
            <?php useless_div(); ?>
        </div>
        <?php useless_div(); ?>
    </div>
<?php
}

// profile, les ... pour ...
function affi_pour($com){
    if ($com["username_destinataire"] and $com["username_destinataire"] != $com["username_source"]){
        ?>
        <post style="position : relative; z-index: 10">
            <b style=" max-width: 99%; word-wrap: break-word;  ">
                <?=$com['username_source'];?>
                <i style="opacity: 0.5;"> pour </i><?=$com["username_destinataire"]; ?>
            </b>
            <i style="opacity: 0.5;"><?=$com["post_date"]; ?></i>
            <p style="font-size: 1.2em; margin-bottom: 0 ; max-width: 99%; word-wrap: break-word; ">
                <?=$com["post"]; ?>
            </p>
        </post>
        <?php
    }
    else{
        ?>
        <post style="position : relative; z-index: 10">
            <b style=" max-width: 99%; word-wrap: break-word; ">
                <?=$com['username_source'];?>
            </b>
            <i style="opacity: 0.5;">
                <?=$com["post_date"]; ?>
            </i>
            <p style="font-size: 1.2em; margin-bottom: 0 ; max-width: 99%; word-wrap: break-word; ">
                <?=$com["post"]; ?>
            </p>
        </post>
        <?php
    }
}

//bouton like
function like_button(){

    ?>
    <script src="https://kit.fontawesome.com/2b7511c9f5.js" crossorigin="anonymous"></script>
    <script>function like_button(){

            const likeBtn = document.querySelector(".like_button"); ///
            const iconBtn = document.querySelector('#icon');
            const countBtn = document.querySelector('#count');

            let clicked = false;

            likeBtn.addEventListener("click",() =>{

                if (!clicked){

                    clicked = true;

                    iconBtn.innerHTML = '<i class="fa-solid fa-thumbs-up"></i>';
                    countBtn.textContent++;

                }
                else{

                    clicked = false;
                    iconBtn.innerHTML = '<i class="fa-regular fa-thumbs-up"></i>';
                    countBtn.textContent--;

                }

            });
        }</script>

    <button class='.like_button' style="position: relative; z-index: 11; margin-top: 2%; margin-bottom: 3%; margin-left: 1%">
        <div class='bg'>
            <div class='bg-inner'></div>
        </div>
        <div style=" position: relative; z-index: 11; color: #fff">
            <span id ="icon" ><i class="fa-regular fa-thumbs-up"></i></span>
            <span id = "count">0</span> Likes
        </div>
    </button>
<?php
}


// guest
function affi_sous_comment($row){
    global $result_can;
    ?>

    <div style="background-color: #212121; margin-top: 5%; margin-left: 5%;margin-bottom: 2%; margin-right: 2%; position: relative; z-index: 10;"  class='control block-cube block-input'>
        <b style=" max-width: 99%; word-wrap: break-word;position: relative; z-index: 11; "><?=$row["username_destinataire"]?> </b>
        <i style="opacity: 0.5;position: relative; z-index: 11;"><?=$row["post_date"]; ?></i>
        <p style="font-size: 1.2em; margin-bottom: 0; max-width: 99%; word-wrap: break-word;position: relative; z-index: 11; "><?=$row["post"]; ?></p>
        <?php
        if ($result_can) {
            like_button();
        }
        if ($result_can != NULL && $row['ID_user'] == $result_can['id']) {?>
            <form action="" class="form_delete_list_comment" method="post">
                <div class='control block-cube block-input' style="position: relative;z-index: 11 ; display: inline-block; margin-bottom: 1%; margin-left: 1%;">
                    <label>
                        <input type="hidden" name="supp" value="<?php echo $row['id']?>"/>
                        <input id="delete" name="delete" type="submit" value="Delete message" style=" background-color: #212121; color: #fff;">
                    </label>
                    <?php useless_div(); ?>
                </div>
            </form>
        <?php
        }
        useless_div();
        ?>
    </div>
<?php
}


function commenter($com){
    ?>
    <form method="POST" style="display: inline-block ; margin-left: 1%; margin-top: 2%">
        <div class='control block-cube block-input' style="position: relative; z-index: 9">
            <label>
                <input type="hidden" name="id_dest" value="<?php echo $com['ID_user']?>"/>
                <input type="hidden" name="comment_id" value="<?php echo $com['id']?>"/>
                <input type="hidden" name="username_source2" value="<?php echo $com['username_source']?>"/>

                <div>
                    <input type="text" id="message" name="comment" placeholder="commenter" style="background-color: #212121; color: #fff; ">
                    <div class='bg'>
                        <div class='bg-inner'></div>
                    </div>
                </div>

                <div>
                    <input type="submit" id='submit' value='valider' style="background-color: #212121; color: #fff; ">
                    <div class='bg'>
                        <div class='bg-inner'></div>
                    </div>
                </div>
            </label>


            <?php useless_div();?>

        </div>

    </form>
<?php
}
?>



