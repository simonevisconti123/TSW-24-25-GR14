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


$result_1 = pg_prepare($db,"check_if_mail_exists"," SELECT email FROM utenti WHERE nome_utente=$1;");
$execution_1 = pg_execute($db, "check_if_mail_exists", array($user));

$returned_row = pg_fetch_assoc($execution_1);

if($execution_1 && $returned_row["email"] == $new_mail){
    $response = array("message" => "Non è possibile inserire la stessa mail");
    echo json_encode($response);
    exit;
}else{
    $result_2 = pg_prepare($db,"change_mail"," UPDATE utenti SET email=$1 WHERE nome_utente=$2;");
    $execution_2 = pg_execute($db, "change_mail", array($new_mail,$user));

    if ($execution_2 && pg_affected_rows($execution_2) > 0) { // Verifica se la query ha restituito un risultato
        $response = array("message" => "Mail modificata con successo");
        echo json_encode($response);
        exit;
    }else{
        $response = array("message" => "ERRORE FATALE");
        echo json_encode($response);
        exit;
    }
}



?>