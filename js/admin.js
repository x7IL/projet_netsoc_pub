


document.onkeydown = function(e) {
    // var key_press = e.key;
    // document.getElementById('kp').innerHTML = key_press;
    if(e.key === 'F7'){
        location.replace('index.php?variable=secret_login.php');
    }
    else if(e.key === 'F8'){
        location.replace('index.php?variable=poke.php');

    }

}
