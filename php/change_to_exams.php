<?php
session_start();

$value = $_POST["value"];

if($value == "exams"){
    $_SESSION["topics"] = "esami";
    echo json_encode(["success" => true]);
    exit;
}

?>