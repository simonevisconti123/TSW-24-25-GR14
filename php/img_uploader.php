<?php
session_start();
header("Content-Type: application/json");
$host = 'localhost';
$port = '5432';
$db = 'gruppo14';
$username = 'www';
$password = 'tw2024';
$connection_string = "host=$host dbname=$db user=$username password=$password";

$db = pg_connect($connection_string)
or die('Impossibile connetersi al database: ' . pg_last_error());

$user = $_SESSION["username"];
$file = $_FILES["profile_picture"];
if (!isset($_FILES["profile_picture"])) {
    echo json_encode(["success" => false, "message" => "Nessun file inviato."]);
    exit;
}


if ($file["error"] !== UPLOAD_ERR_OK) {
    echo json_encode(["success" => false, "message" => "Errore durante l'upload."]);
    exit;
}

$allowedExtensions = ["jpg", "jpeg", "png", "gif"];
$fileExtension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));


$fileName = basename($file["name"]);
$fileTmpPath = $file["tmp_name"];
$uploadDir = "usr_imgs/"; 
$destination = $uploadDir . $fileName;

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (!in_array($fileExtension, $allowedExtensions)) {
    echo json_encode(["success" => false,
                     "message" => "Formato non supportato. Usa JPG, PNG o GIF."
                    ]);
    exit;
}

$result_1 = pg_prepare($db,"check_if_file_exists"," SELECT immagine_profilo FROM utenti WHERE nome_utente=$1");
$execution_1 = pg_execute($db, "check_if_file_exists", array($user));

$returned_row = pg_fetch_assoc($execution_1);
if($returned_row && $file["name"] != "url_pro_pic_here"){
    
    move_uploaded_file($fileTmpPath, $destination);
    $result_2 = pg_prepare($db,"upload_file"," UPDATE utenti SET immagine_profilo = $1 WHERE nome_utente = $2");
    $execution_2 = pg_execute($db, "upload_file", array($file["name"],$user));

    echo json_encode(["success" => true,
                      "message" => "Immagine profilo aggiornata correttamente!"
                    ]);
    exit;

}else if($returned_row["immagine_profilo"] == $file["name"]){
    echo json_encode(["success" => false,
                      "message" => "Non puoi caricare un file con lo stesso nome!"
                    ]);
    exit;
}else{
    echo json_encode(["success" => false,
    "message" => "ERRORE NEL CARICAMENTO"
   ]);
exit;
}


?>