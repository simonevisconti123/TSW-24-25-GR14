/*funzione che gestisce lo swap delle icone e che
varia a seconda dell'icona che dobbiamo scambiare*/
function postInteraction() {
    // Seleziona le icone all'interno di un tag span con la classe "heartIcon"
    let heartIconList = document.querySelectorAll(".heartIcon .fa-heart");
    let commentIconList = document.querySelectorAll(".commentIcon .fa-comment");
    let bookmarkIconList = document.querySelectorAll(".bookmarkIcon .fa-bookmark");

    //GESTIONE ICONE HEART
    heartIconList.forEach(function(icon) {
        let heartFlag=false; //definisce se l'icona è stata selezionata o meno

        //click
        icon.addEventListener("click", function(){
            /*troviamo l'id del post a cui appartiene l'icona*/
            let currentPost = icon.closest(".post");
            let currentPostID = currentPost.id;

            /*quando viene cliccata controllo che l'icona dei commenti sia regular o solid, per
            fare in modo che al click cambi da uno stile all'altro*/
            if(icon.classList.contains("fa-regular")){
                icon.classList.remove("fa-regular");
                icon.classList.add("fa-solid");
                heartFlag=true;
            }else{
                icon.classList.remove("fa-solid");
                icon.classList.add("fa-regular");
                heartFlag=false;
            }
        });
    });

    //GESTIONE ICONE COMMENT
    commentIconList.forEach(function(icon) {
        let commentFlag=false; //definisce se l'icona è stata selezionata o meno

        //click
        icon.addEventListener("click", function(){
            /*troviamo l'id del post a cui appartiene l'icona*/
            let currentPost = icon.closest(".post");
            let currentPostID = currentPost.id;

            /*calcoliamo ora l'id della relativa sezione commenti*/
            let currentCommentsID = currentPostID.replace("post", "comment");
            let currentComments = document.getElementById(currentCommentsID);

            /*quando viene cliccata controllo che l'icona dei commenti sia regular o solid, per
            fare in modo che al click cambi da uno stile all'altro e che la sezione commenti appaia o scompaia*/
            if(icon.classList.contains("fa-regular")){
                icon.classList.remove("fa-regular");
                icon.classList.add("fa-solid");
                commentFlag=true;
                currentComments.setAttribute("style", "display: block;");
            }else{
                icon.classList.remove("fa-solid");
                icon.classList.add("fa-regular");
                commentFlag=false;
                currentComments.setAttribute("style", "display: none;");
            }
        });
    });

    //GESTIONE ICONE BOOKMARK
    bookmarkIconList.forEach(function(icon) {
        var bookmarkFlag=false; //definisce se l'icona è stata selezionata o meno

        //click
        icon.addEventListener("click", function(){
            /*troviamo l'id del post a cui appartiene l'icona*/
            let currentPost = icon.closest(".post");
            let currentPostID = currentPost.id;

            /*quando viene cliccata controllo che l'icona dei commenti sia regular o solid, per
            fare in modo che al click cambi da uno stile all'altro*/
            if(icon.classList.contains("fa-regular")){
                icon.classList.remove("fa-regular");
                icon.classList.add("fa-solid");
                bookmarkFlag=true;
            }else{
                icon.classList.remove("fa-solid");
                icon.classList.add("fa-regular");
                bookmarkFlag=false;
            }

            let exactPostID = currentPostID.replace("post-", "");
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "php/bookmark_post.php", true); // URL del file PHP
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.responseType = 'json';

            xhr.onload = function() {
                if (xhr.status == 200) {
                    var response = xhr.response;
                    if(response.success){
                        setTimeout(() => {
                            window.location.reload();
                        }, 100);
                    }
                }
            };

            let data = "postID=".concat(exactPostID, "&selected=", bookmarkFlag);
            xhr.send(data);
        });
    });
}

/*devo aggiungere un eventListener sull'oggetto document del DOM perchè:
-con il tag script in index.html carico il file replaceIcon.js ma in esso non
viene eseguito nulla, senza che ci sia un trigger a far partire l'esecuzione
(gli event Listener sulle icone non funzionano perchè sono dentro la funzione, 
quindi finchè non parte la funzione non partiranno neanche i listener delle icone)
-il trigger che serve a far partire la funzione è un event Listener sull'oggetto
"document" che come si intuisce, quando Dom è caricato -> fai partire la funzione.
*/
document.addEventListener("DOMContentLoaded", postInteraction());

