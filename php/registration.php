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

$result = pg_prepare($db,"Check_if_exists"," SELECT nome_utente, email FROM utenti WHERE nome_utente = $1 OR email = $2;");
$execution = pg_execute($db, "Check_if_exists", array($user,$email));

$returned_row = pg_fetch_assoc($execution);
if ($returned_row) { // Verifica se la query ha restituito un risultato
    if ($returned_row["nome_utente"] === $user) {
        $response = array("message" => "Username già utilizzato");
        echo json_encode($response);
        exit;
    } 
    if ($returned_row["email"] === $email) {
        $response = array("message" => "Email già utilizzata");
        echo json_encode($response);
        exit;
    }
}else{
    $result = pg_prepare($db,"Insertion","INSERT INTO utenti VALUES ($1,'url_pro_pic_here',$2,$3,'23,24,25');");
    $ret = pg_execute($db, "Insertion", array($user,$email,$hashed_pswd));

    if($ret == false){
        $response = array(
            "message" => "Errore nella query"
        );
    echo json_encode($response);
    exit;
    }else{
        $response = array(
            "message" => "Registrazione avvenuta con successo <br><br> <a href='login.html'>Vai al login</a>"
        );
        echo json_encode($response);
        exit;
}
}


?>