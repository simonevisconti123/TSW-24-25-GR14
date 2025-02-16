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

$user = $_SESSION["username"];
$post_id = $_POST["postID"];
$bookmarkFlag = $_POST["selected"];

$result = pg_prepare($db, "bookmark_post", "SELECT post_salvati FROM utenti WHERE nome_utente = $1;");
$execution = pg_execute($db, "bookmark_post", array($user));

$stringa_post_salvati = pg_fetch_assoc($execution);

$new_post_salvati = $stringa_post_salvati["post_salvati"].",".$post_id;

$result_1 = pg_prepare($db, "insert_post", "UPDATE utenti SET post_salvati = $1 WHERE nome_utente = $2;");
$execution_1 = pg_execute($db, "insert_post", array($new_post_salvati,$user));

echo json_encode(["success" => true]);
exit;

?>