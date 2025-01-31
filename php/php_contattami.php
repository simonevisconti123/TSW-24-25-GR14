<?php
    

    header('Content-Type: application/json');
    
    $destinazione = "";
    $oggetto = "Nuovo messaggio da " . $_POST["nome"];
    $messaggio = "Mail inviata da ".$_POST["email"]."\n".$_POST["messaggio"];
    $source = $_POST["source_page"];
    if($source == "simonevisconti"){
        $destinazione = "s.visconti3@studenti.unisa.it";
    }else if($source == "vincenzogoffredo"){
        $destinazione = "v.goffredo@studenti.unisa.it";
    }else if($source == "anthonyvita"){
        $destinazione = "a.vita9@studenti.unisa.it";
    }else if($source == "liviaciasullo"){
        $destinazione = "l.ciasullo1@studenti.unisa.it";
    }else{
        $response = array(
            "message" => "Errore nel mittente"
        );
        echo json_encode($response);
        exit;

    }
    //mail($destinazione,$oggetto,$messaggio);
    $response = array(
        "message" => "La mail è stata inviata correttamente"
    );
    echo json_encode($response);
    exit;