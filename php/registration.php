<?php
$host = 'localhost';
$port = '5432';
$db = 'tw';
$username = 'www';
$password = 'tw2024';
$connection_string = "host=$host dbname=$db user=$username password=$password";

$db = pg_connect($connection_string)
or die('Impossibile connetersi al database: ' . pg_last_error());

$user = $_POST["inputUserName"];
$email = $_POST["inputMail"];
$pswd = $_POST["inputPassword"];

$secret_salt = "you_will_never_guess_me";
$hashed_pswd = hash('sha256', $secret_salt.$pswd);

$result = pg_prepare($db,"test_prepared","INSERT INTO utenti VALUES ($1,'url_pro_pic_here',$2,$3,'23,24,25');");
$ret = pg_execute($db, "test_prepared", array($user,$email,$hashed_pswd));

if($ret == false){
    $response = array(
        "message" => "Errore nella query"
    );
    echo json_encode($response);
    exit;
}else{
    $response = array(
        "message" => "Inserimento corretto"
    );
    echo json_encode($response);
    exit;
}

?>