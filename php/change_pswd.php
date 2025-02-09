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


$new_pswd = $_POST["new_pswd_conf"];
$user = $_SESSION["username"];

$secret_salt = "you_will_never_guess_me";
$new_hashed_pswd = hash('sha256', $secret_salt.$new_pswd);

$result = pg_prepare($db,"change_mail"," UPDATE utenti SET password_utente=$1 WHERE nome_utente=$2;");
$execution = pg_execute($db, "change_mail", array($new_hashed_pswd,$user));

if ($execution && pg_affected_rows($execution) > 0) { // Verifica se la query ha restituito un risultato
    $response = array("message" => "Password modificata con successo");
    echo json_encode($response);
    exit;
}else{
    $response = array("message" => "ERRORE FATALE");
    echo json_encode($response);
    exit;
}


?>