<?php

$host = 'localhost';
$port = '5432';
$db = 'gruppo14';
$username = 'www';
$password = 'tw2024';
$connection_string = "host=$host dbname=$db user=$username password=$password";

$db = pg_connect($connection_string)
or die('Impossibile connetersi al database: ' . pg_last_error());

$email = $_POST["inputmail"];
$pswd = $_POST["inputpswd"];

$secret_salt = "you_will_never_guess_me";
$hashed_pswd = hash('sha256', $secret_salt.$pswd);

$result = pg_prepare($db,"Check_if_exists"," SELECT nome_utente FROM utenti WHERE email = $1 AND password_utente = $2;");
$execution = pg_execute($db, "Check_if_exists", array($email,$hashed_pswd));

$returned_row = pg_fetch_assoc($execution);
if ($returned_row) { // Verifica se la query ha restituito un risultato
    session_start();
    $_SESSION['username']=$returned_row["nome_utente"];
    $response = array(
        "success" => true,
        "message" => "Login corretto",
        "redirect" => "../index.php"
    );
    echo json_encode($response);
    exit();
}else{
    $response = array(
        "message" => "Credenziali errate"
    );
    echo json_encode($response);
    exit;
}