function like_button(){

    const likeBtn = document.querySelector(".like_button");
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
}
