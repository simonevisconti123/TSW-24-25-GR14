<?php
    //prepara la stringa di connessione al bd
    $host = 'localhost';
    $port = '5432';
    $dbname = 'gruppo14';
    $username = 'www';
    $password = 'tw2024';
    $connection_string = "host=$host dbname=$dbname user=$username password=$password";

    //tenta la connessione con le info date e se fallisce stampa il messaggio di errore
    $conn = pg_connect($connection_string)
        or die('Impossibile connettersi al database: ' . pg_last_error());

    //controllo se viene passato il nome del file
    if (isset($_GET['file'])) {

        //in caso positivo, salvo il nome del file
        $fileName = basename($_GET['file']); //previene attacchi con percorsi strani
        $filePath = __DIR__ . "/uploads/" . $fileName; //con __DIR__ mi porto nella cartella dove si trova download.php ed entro nella cartella uploads
        $fileMime = mime_content_type($filePath);

        //controlla se il file esiste
        if (file_exists($filePath)) {
            //se esiste, setto gli header per il download
            header('Content-Description: File Transfer');
            header('Content-Type:' . $fileMime);
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            header("Content-Transfer-Encoding: binary");


            flush(); //svuota il buffer di output
            readfile($filePath); //fai partire il download
            exit;
        } else {
            echo "Errore: file non trovato sul server."; //altrimenti stampa l'errore
        }
    } else {
        echo "Errore: nessun file specificato.";
    }
?>
