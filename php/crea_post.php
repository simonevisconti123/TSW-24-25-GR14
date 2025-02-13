<?php
    session_start();
    $host = 'localhost';
    $port = '5432';
    $db = 'gruppo14';
    $username = 'www';
    $password = 'tw2024';
    $connection_string = "host=$host dbname=$db user=$username password=$password";

    $db = pg_connect($connection_string)
    or die('Impossibile connettersi al database: ' . pg_last_error());

    $title = $_POST["title"];
    $body = $_POST["content"];
    $tags = $_POST["tags"];
    $username = $_SESSION["username"];
    $category = $_POST["category"];

    $id = rand(0, 65535);

    $result = pg_prepare($db, "Insertion", "INSERT INTO posts VALUES ($1,$2,$3,$4,$5,$6);");
    $ret = pg_execute($db, "Insertion", array($id,$username,$title,$body,$category,$tags));
    
    echo json_encode(["success" => true, "message" => "POST CREATO CORRETTAMENTE"]);
    exit;

    ?>