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


$new_username = $_POST["new_username_conf"];
$user = $_SESSION["username"];

if($new_username === $user){
    $response = array("message" => "Non è possibile inserire lo stesso username");
    echo json_encode($response);
    exit;
}else{
    $result = pg_prepare($db,"update_username"," UPDATE utenti SET nome_utente=$1 WHERE nome_utente=$2;");
    $execution = pg_execute($db, "update_username", array($new_username,$user));

    if ($execution && pg_affected_rows($execution) > 0) { // Verifica se la query ha restituito un risultato
        $response = array("message" => "Username aggiornato con successo");
        echo json_encode($response);
        $_SESSION["username"] = $new_username;
        exit;
    }else{
        $response = array("message" => "ERRORE FATALE");
        echo json_encode($response);
        exit;
    }
}




?>