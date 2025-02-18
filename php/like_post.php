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
$likeFlag = $_POST["selected"];

$postLikedQuery = pg_prepare($db, "liked_post", "SELECT post_liked FROM utenti WHERE nome_utente = $1;");
$postLikedResult = pg_execute($db, "liked_post", array($user));
$stringaPostLiked = pg_fetch_assoc($postLikedResult);
$arrayIdPostLiked = explode(",", $stringaPostLiked["post_liked"]);
$aggiornaLikeNumberQueryInvio = pg_prepare($db, "update_numero_like_del_post", "UPDATE posts SET like_number = $1 WHERE id = $2;");

//GESTIONE DEL SALVATAGGIO DEI LIKE LATO SERVER
    //se la likeFlag=false vuol dire che il post era presente tra i post liked e ora va rimosso
    if($likeFlag == "false"){
        $index = array_search($post_id, $arrayIdPostLiked);
        unset($arrayIdPostLiked[$index]); //rimuovo il post dalla lista dei liked
    
        $aggiornaLikeNumberQuery = pg_prepare($db, "decrementa_numero_like_del_post","UPDATE posts SET like_number = like_number - 1 WHERE id = $1;");
        pg_execute($db, "decrementa_numero_like_del_post", array($post_id)); //modifico il contatore del numero di like del post

    //se la likeFlag=true vuol dire che il post non era presente in lista e va aggiunto
    }else if($likeFlag == "true"){
        array_push($arrayIdPostLiked, $post_id); //aggiungo il post alla lista dei liked

        $aggiornaLikeNumberQuery = pg_prepare($db, "decrementa_numero_like_del_post","UPDATE posts SET like_number = like_number + 1 WHERE id = $1;");
        pg_execute($db, "decrementa_numero_like_del_post", array($post_id));//modifico il contatore del numero di like del post
    }
    $arrayIdPostLiked = array_values($arrayIdPostLiked); //risettaggio degli indici che altrimenti sono rotti

    //ricostruzione della stringa degli id dei post liked aggiornata da pushare sul server
    $stringaPostLikedAggiornata = "";
    foreach ($arrayIdPostLiked as $index => $value) {
        $stringaPostLikedAggiornata = $stringaPostLikedAggiornata . $value . ",";
    }
    $stringaPostLikedAggiornata = ltrim($stringaPostLikedAggiornata, ","); //rimuovo la virgola iniziale che è in eccesso
    $stringaPostLikedAggiornata = rtrim($stringaPostLikedAggiornata, ","); //rimuovo la virgola finale che è in eccesso

//INVIO LISTA DEI POST liked AGGIORNATA AL SERVER
$postLikedAggiornataQueryInvio = pg_prepare($db, "update_lista_post_liked", "UPDATE utenti SET post_liked = $1 WHERE nome_utente = $2;");
$execution_1 = pg_execute($db, "update_lista_post_liked", array($stringaPostLikedAggiornata,$user));


echo json_encode(["success" => true]);
exit;

?>