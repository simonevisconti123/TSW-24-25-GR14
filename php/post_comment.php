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
$commento = $_POST["comment"];
$id_post = $_POST["post_appart"];

$result = pg_prepare($db, "Insert_comment", "INSERT INTO commenti VALUES ($1,$2,$3);");
$execution = pg_execute($db, "Insert_comment", array($id_post,$user,$commento));

echo json_encode(["success" => true]);
exit;

?>