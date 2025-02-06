/*funzione che gestisce lo swap delle icone
varia a seconda dell'icona che dobbiamo scambiare*/

function iconReplaceOver() {
    // Seleziona le icone all'interno di un tag span con la classe "heartIcon"
    let heartIconList = document.querySelectorAll(".heartIcon .fa-heart");
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

function iconReplaceOnclick() {
    
}

/*devo aggiungere un eventListener sull'oggetto document del DOM perchè:
-con il tag script in index.html carico il file replaceIcon.js ma in esso non
viene eseguito nulla, senza che ci sia un trigger a far partire l'esecuzione
(gli event Listener sulle icone non funzionano perchè sono dentro la funzione, 
quindi finchè non parte la funzione non partiranno neanche i listener delle icone)
-il trigger che serve a far partire la funzione è un event Listener sull'oggetto
"document" che come si intuisce, quando Dom è caricato -> fai partire la funzione
*/
document.addEventListener("DOMContentLoaded", iconReplaceOver());

