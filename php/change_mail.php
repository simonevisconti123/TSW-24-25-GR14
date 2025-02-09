<?php
session_start();
$host = 'localhost';
$port = '5432';
$db = 'gruppo14';
$username = 'www';
$password = 'tw2024';
$connection_string = "host=$host dbname=$db user=$username password=$password";

$db = pg_connect($connection_string)
or die('Impossibile connetersi al database: ' . pg_last_error());


$new_mail = $_POST["new_mail_conf"];
$user = $_SESSION["username"];

$result_1 = pg_prepare($db,"Check_if_mail_already_exist"," SELECT email FROM utenti WHERE email = $1");
$execution_1 = pg_execute($db, "Check_if_mail_already_exist", array($new_mail));

$returned_row = pg_fetch_assoc($execution_1);
if ($returned_row) { // Verifica se la query ha restituito un risultato
    $response = array("message" => "Email già in uso, scegline un'altra");
    echo json_encode($response);
    exit;    
}else{
    $result_2 = pg_prepare($db,"update_mail"," UPDATE utenti SET email=$1 WHERE nome_utente=$2;");
    $execution_2 = pg_execute($db, "update_mail", array($new_mail,$user));

    if ($execution_2 && pg_affected_rows($execution_2) > 0) { // Verifica se la query ha restituito un risultato
        $response = array("message" => "Mail modificata con successo",
                            "success" => true
                        );
        echo json_encode($response);
        exit;
    }else{
        $response = array("message" => "ERRORE FATALE");
        echo json_encode($response);
        exit;
    }
}



?>