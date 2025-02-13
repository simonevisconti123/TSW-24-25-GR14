<?php
session_start();

$value = $_POST["value"];

if($value == "article"){
    $_SESSION["topics"] = "articoli";
    echo json_encode(["success" => true]);
    exit;
}

?>