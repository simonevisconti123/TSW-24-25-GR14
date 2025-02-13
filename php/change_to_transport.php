<?php
session_start();

$value = $_POST["value"];

if($value == "transport"){
    $_SESSION["topics"] = "transporto";
    echo json_encode(["success" => true]);
    exit;
}

?>