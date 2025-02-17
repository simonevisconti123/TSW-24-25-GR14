<?php
//collegamento al db
session_start();
$host = 'localhost';
$port = '5432';
$db = 'gruppo14';
$username = 'www';
$password = 'tw2024';
$connection_string = "host=$host dbname=$db user=$username password=$password";

$db = pg_connect($connection_string)
or die('Impossibile connetersi al database: ' . pg_last_error());

$user = $_SESSION["username"];
$post_id = $_POST["postID"];
$bookmarkFlag = $_POST["selected"];

$postSalvatiQuery = pg_prepare($db, "bookmark_post", "SELECT post_salvati FROM utenti WHERE nome_utente = $1;");
$postSalvatiResult = pg_execute($db, "bookmark_post", array($user));
$stringaPostSalvati = pg_fetch_assoc($postSalvatiResult);
$arrayIdPostSalvati = explode(",", $stringaPostSalvati["post_salvati"]);

//GESTIONE DEL SALVATAGGIO DEI POST LATO SERVER
    //se la bookmarkFlag=false vuol dire che il post era presente tra i post salvati e ora va rimosso
    if($bookmarkFlag == "false"){
        $index = array_search($post_id, $arrayIdPostSalvati);
        unset($arrayIdPostSalvati[$index]); //rimuovo il post dalla lista dei salvati

    //se la bookmarkFlag=true vuol dire che il post non era presente in lista e va aggiunto
    }else if($bookmarkFlag == "true"){
        array_push($arrayIdPostSalvati, $post_id); //aggiungo il post alla lista dei salvati
    }
    $arrayIdPostSalvati = array_values($arrayIdPostSalvati); //risettaggio degli indici che altrimenti sono rotti

    //ricostruzione della stringa degli id dei post salvati aggiornata da pushare sul server
    $stringaPostSalvatiAggiornata = "";
    foreach ($arrayIdPostSalvati as $index => $value) {
        $stringaPostSalvatiAggiornata = $stringaPostSalvatiAggiornata . $value . ",";
    }
    $stringaPostSalvatiAggiornata = ltrim($stringaPostSalvatiAggiornata, ","); //rimuovo la virgola iniziale che è in eccesso
    $stringaPostSalvatiAggiornata = rtrim($stringaPostSalvatiAggiornata, ","); //rimuovo la virgola finale che è in eccesso

//INVIO LISTA DEI POST SALVATI AGGIORNATA AL SERVER
$postSalvatiAggiornataQueryInvio = pg_prepare($db, "update_lista_post_salvati", "UPDATE utenti SET post_salvati = $1 WHERE nome_utente = $2;");
$execution_1 = pg_execute($db, "update_lista_post_salvati", array($stringaPostSalvatiAggiornata,$user));

echo json_encode(["success" => true]);
exit;

?>