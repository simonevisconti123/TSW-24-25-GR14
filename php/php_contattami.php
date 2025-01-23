<?php
    
    
    // Dire agli altri membri di modificare il campo hidden come l'if per forza
    

    $destinazione = "";
    $oggetto = "Nuovo messaggio da " . $_POST["nome"];
    $messaggio = $_POST["messaggio"];
    if($_POST["source_page"] == "simonevisconti"){
        $destinazione = "s.visconti3@studenti.unisa.it";
    }else if($_POST["source_page"] == "vincenzogoffredo"){
        $destinazione = "v.goffredo@studenti.unisa.it";
    }else if($_POST["source_page"] == "anthonyvita"){
        $destinazione = "a.vita9@studenti.unisa.it";
    }else if($_POST["source_page"] == "liviaciasullo"){
        $destinazione = "l.ciasullo1@studenti.unisa.it";
    }else{
        //gestione messaggio errore
    } 

    mail($destinazione,$oggetto,$messaggio);

?>