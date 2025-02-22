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

$result_1 = pg_prepare($db,"check_if_pswd_equals"," SELECT password_utente FROM utenti WHERE nome_utente=$1;");
$execution_1 = pg_execute($db, "check_if_pswd_equals", array($user));

$returned_row = pg_fetch_assoc($execution_1);

if($execution_1 && $returned_row["password_utente"] == $new_hashed_pswd){
    $response = array("message" => "Non puoi riutilizzare la stessa password");
    echo json_encode($response);
    exit;
}else{   
    $result_2 = pg_prepare($db,"update_pswd"," UPDATE utenti SET password_utente=$1 WHERE nome_utente=$2;");
    $execution_2 = pg_execute($db, "update_pswd", array($new_hashed_pswd,$user));

if ($execution_2 && pg_affected_rows($execution_2) > 0) { // Verifica se la query ha restituito un risultato
    $response = array("message" => "Password modificata con successo",
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