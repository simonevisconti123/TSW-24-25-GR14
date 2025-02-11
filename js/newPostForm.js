function newPostFormAppears() {
    let newPostButtonList = document.querySelectorAll(".addPostButton");

    newPostButtonList.forEach(function(button) {
        button.addEventListener("click", function() {
            // Trovo il form legato a quel bottone, rendendolo visibile
            let newPostForm = document.querySelector(".newPostForm");
            newPostForm.classList.remove("newPostForm-hidden");

            // Aggiungo il blur allo sfondo
            let container = document.querySelector(".container");
            
            if (container) {  // Verifica che l'elemento .container esista
                container.classList.add("container-blurred");
            } else {
                console.error("Elemento .container non trovato!");
            }
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
            let container = document.querySelector(".container");
            
            if (container) {  // Verifica che l'elemento .container esista
                container.classList.remove("container-blurred");
            } else {
                console.error("Elemento .container non trovato!");
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", newPostFormAppears());
document.addEventListener("DOMContentLoaded", newPostFormClose());