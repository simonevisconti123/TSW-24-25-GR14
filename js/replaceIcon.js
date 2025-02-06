/*funzione che gestisce lo swap delle icone
varia a seconda dell'icona che dobbiamo scambiare*/

function iconReplace() {
    // Seleziona le icone all'interno di un tag span con la classe "heartIcon"
    let heartIconList = document.querySelectorAll(".heartIcon .fa-heart");
    console.log(heartIconList);
    let commentIconList = document.querySelectorAll(".commentIcon .fa-comment");
    let bookmarkIconList = document.querySelectorAll(".bookmarkIcon .fa-bookmark");

    // Gestione delle icone heart
    heartIconList.forEach(function(icon) {
        icon.addEventListener("mouseenter", function() {
            icon.classList.remove("fa-regular");
            icon.classList.add("fa-solid");
        });

        icon.addEventListener("mouseleave", function() {
            icon.classList.remove("fa-solid");
            icon.classList.add("fa-regular");
        });
    });

    // Gestione delle icone comment
    commentIconList.forEach(function(icon) {
        icon.addEventListener("mouseenter", function() {
            icon.classList.remove("fa-regular");
            icon.classList.add("fa-solid");
        });

        icon.addEventListener("mouseleave", function() {
            icon.classList.remove("fa-solid");
            icon.classList.add("fa-regular");
        });
    });

    // Gestione delle icone bookmark
    bookmarkIconList.forEach(function(icon) {
        icon.addEventListener("mouseenter", function() {
            icon.classList.remove("fa-regular");
            icon.classList.add("fa-solid");
        });

        icon.addEventListener("mouseleave", function() {
            icon.classList.remove("fa-solid");
            icon.classList.add("fa-regular");
        });
    });
}
