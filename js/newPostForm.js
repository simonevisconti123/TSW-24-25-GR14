function newPostFormAppears() {
    let newPostButtonList = document.querySelectorAll(".addPostButton");

    newPostButtonList.forEach(function(button) {
        button.addEventListener("click", function() {
            // Trovo il form legato a quel bottone, rendendolo visibile
            let newPostForm = document.querySelector(".newPostForm");
            newPostForm.classList.remove("newPostForm-hidden");

            // Aggiungo il blur allo sfondo
            let divSfondo = document.getElementById("overlayBlurDelForm-hidden");
            console.log("divSfondo");
            divSfondo.id = "overlayBlurDelForm";
        });
    });
}

function newPostFormClose() {
    let formClosingButtonList = document.querySelectorAll(".closeButton");

    formClosingButtonList.forEach(function(button) {
        button.addEventListener("click", function() {
                // Trovo il form legato a quel bottone, rendendolo invisibile
                let newPostForm = document.querySelector(".newPostForm");
                newPostForm.classList.add("newPostForm-hidden");
                
                // rimuovo il blur dallo sfondo
                let divSfondo = document.getElementById("overlayBlurDelForm");
                console.log("divSfondoNino");
                divSfondo.id = "overlayBlurDelForm-hidden";
        });
    });
}

document.addEventListener("DOMContentLoaded", newPostFormAppears());
document.addEventListener("DOMContentLoaded", newPostFormClose());