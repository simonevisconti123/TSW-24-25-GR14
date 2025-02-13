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
// Configura la cartella di destinazione
$uploadDir = "uploads/";

// Assicurati che la cartella esista
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Controlla se è stato ricevuto un file
if (isset($_FILES["file"])) {

    $fileTmpPath = $_FILES["file"]["tmp_name"];
    $fileName = basename($_FILES["file"]["name"]);
    $destination = $uploadDir . $fileName;

    $regex_files = '/^.*\.(docx|pptx|xlsx|pdf|txt)$/i';
    $regexFilename = '/^.{1,255}$/';

    // Verifica che il nome del file rispetti la regex sulla lunghezza
    if (!preg_match($regexFilename, $fileName)) {
        echo "ERRORE! Il nome del file deve essere lungo tra 1 e 255 caratteri.";
        exit;
    }

    if(preg_match($regex_files,$fileName)){

        $result_1 = pg_prepare($db,"check_if_file_exists"," SELECT nome_file FROM file_utenti WHERE nome_utente=$1");
        $execution_1 = pg_execute($db, "check_if_file_exists", array($user));
        
        $returned_row = pg_fetch_assoc($execution_1);
        if($returned_row && $returned_row["nome_file"] == $fileName){
            echo "Il file è già presente tra quelli caricati";
        }else{
            if (move_uploaded_file($fileTmpPath, $destination)) {
                $result_2 = pg_prepare($db,"upload_files"," INSERT INTO file_utenti VALUES ($1,$2)");
                $execution_2 = pg_execute($db, "upload_files", array($user,$fileName));
        
                echo "File caricato correttamente: " . $fileName;
        
            } else {
                echo "Errore durante il caricamento del file.";
            }
        }
    }else{
        echo "ERRORE! Le estensioni ammesse sono: pdf, docx, txt, xlsx e pptx";
    }
} else {
    echo "Nessun file ricevuto.";
}
?>