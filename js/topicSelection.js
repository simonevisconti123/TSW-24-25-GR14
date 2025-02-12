/*FUNZIONE CHE GESTISCE LA SELEZIONE DEI TOPIC ED IL RELATIVO 
CAMBIAMENTO DEL BANNER*/

var selectedTopic = "none"; //variabile globale visibile in tutti gli script js

function topicBannerChange(){
    //raggruppo tutti i pulsanti di selzione di tutti i topic
    let selectedTopicButtonList = document.querySelectorAll(".selectTopicButton");

    //scorro i pulsanti
    selectedTopicButtonList.forEach(function(button){

        //aggiungo ad ognuno un event listener
        button.addEventListener("click", function(){
            let buttonID = button.id; //salvo l'id del pulsante cliccato
            selectedTopic = buttonID.split("-")[1]; //estraggo dall'ID il nome del topic selezionato

            let titoloBanner = document.querySelector(".topicBanner .content h1"); //seleziono la parola presente nel "topicBanner"
            titoloBanner.firstChild.textContent = selectedTopic; //modifico la parola inserendo il topic selezionato

            let icona = titoloBanner.querySelector("i"); //seleziono e modifico l'icona presente nel topic banner
            if(selectedTopic == "articoli"){
                icona.className = "fa-solid fa-newspaper"; 
            }else if(selectedTopic == "esami"){
                icona.className = "fa-solid fa-pencil";
            }else if(selectedTopic == "mezziDiTrasporto"){
                icona.className = "fa-solid fa-bus";
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", topicBannerChange);
 