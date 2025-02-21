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


$result_1 = pg_prepare($db,"Check_if_username_already_exist"," SELECT nome_utente FROM utenti WHERE nome_utente = $1");
$execution_1 = pg_execute($db, "Check_if_username_already_exist", array($new_username));

$returned_row = pg_fetch_assoc($execution_1);
if ($returned_row) { // Verifica se la query ha restituito un risultato
    $response = array("message" => "Username già in uso, scegline un altro");
    echo json_encode($response);
    exit;    
}else{
    $result_2 = pg_prepare($db,"update_username"," UPDATE utenti SET nome_utente=$1 WHERE nome_utente=$2;");
    $execution_2 = pg_execute($db, "update_username", array($new_username,$user));

    $updatePostAuthorQuery = pg_prepare($db,"update_username_nei_post"," UPDATE posts SET autore=$1 WHERE autore=$2;");
    $updatePostAuthorResult = pg_execute($db, "update_username_nei_post", array($new_username,$user));

    $updateCommentAuthorQuery = pg_prepare($db,"update_username_nei_commenti"," UPDATE commenti SET autore=$1 WHERE autore=$2;");
    $updateCommentAuthorResult = pg_execute($db, "update_username_nei_commenti", array($new_username,$user));

    $updateFileOwnerQuery = pg_prepare($db,"update_username_nei_file_salvati"," UPDATE file_utenti SET nome_utente=$1 WHERE nome_utente=$2;");
    $updateFileOwnerResult = pg_execute($db, "update_username_nei_file_salvati", array($new_username,$user));

    if ($execution_2 && pg_affected_rows($execution_2) > 0) { // Verifica se la query ha restituito un risultato
        $response = array("message" => "Username aggiornato con successo",
                           "success" => true
                         );
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