<!DOCTYPE html>
<html lang="it">
<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: ../index.php");
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le mie note</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/leMieNote_style.css">
    <script src="js/noteSearch.js"></script>
    <script src="js/utilities.js"></script>

    <!-- Connessione a Font Awesome per utilizzare le icone -->
    <script src="https://kit.fontawesome.com/f4d166ff19.js" crossorigin="anonymous"></script>

    <!-- connessione a google fonts per i font "Inter" e "Lexend-Mega" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend+Mega:wght@553&display=swap" rel="stylesheet">

    <style>


        /* Sfondo sfocato */
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 10;
        }

        /* Finestra di drop */
        #dropZone {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50%;
            height: 30%;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            border: 2px dashed white;
            text-align: center;
            line-height: 30vh;
            font-size: 20px;
            z-index: 11;
            border-radius: 10px;
        }

        /* Bottone chiusura */
        #closeButton {
            position: absolute;
            top: 10px;
            right: 15px;
            background: red;
            color: white;
            border: none;
            font-size: 18px;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 50%;
        }

        #closeButton:hover {
            background: darkred;
        }

    </style>


</head>
<body>
    <div class="leftBlock">
        <div class="mySHubjectBox">
            <h1>My Notes</h1>
        </div>
        <button class="home-button" onclick="returnToHome()">Home</button>
    </div>

    <div class="rightBlock">
        <div class="upbar">
            <input type="text" class="inputSearchBar" placeholder="Cerca tra le tue note">
            <span class="searchIcon"><i class="fa-solid fa-magnifying-glass"></i></span>
            <div class="aggiungiButton" id="addButton">Aggiungi</div>
        </div>

        <div id="overlay"></div>
        <div id="dropZone">
            <button id="closeButton">X</button>
            Rilascia qui un file da caricare
        </div>
        

        <div class="griglia">
            <?php
            $host = 'localhost';
            $port = '5432';
            $db = 'gruppo14';
            $username = 'www';
            $password = 'tw2024';
            $connection_string = "host=$host dbname=$db user=$username password=$password";
            
            $db = pg_connect($connection_string)
            or die('Impossibile connetersi al database: ' . pg_last_error());
            
            $user = $_SESSION["username"];

            $result_1 = pg_prepare($db,"search_files"," SELECT nome_file FROM file_utenti WHERE nome_utente = $1");
            $execution_1 = pg_execute($db, "search_files", array($user));


            $fileIcons = [
                "docx" => "word",
                "pptx" => "powerpoint",
                "xlsx" => "excel",
                "pdf"  => "pdf",
                "txt"  => "alt",
            ];
            

            while ($returned_row = pg_fetch_assoc($execution_1)) {
                $ext = strtolower(pathinfo($returned_row["nome_file"], PATHINFO_EXTENSION));
                $iconClass = isset($fileIcons[$ext]) ? $fileIcons[$ext] : "file";    
                echo "<div class='grid-item'><span class='fileName'>".$returned_row["nome_file"]."</span><i class='fa-solid fa-file-$iconClass iconaFile'></i></div>" ;
            }

            ?>
        </div>
    </div>

</body>



<script>
    const addButton = document.getElementById("addButton");
    const dropZone = document.getElementById("dropZone");
    const overlay = document.getElementById("overlay");
    const closeButton = document.getElementById("closeButton");

    // Mostra overlay e drop zone
    addButton.addEventListener("click", function() {
        overlay.style.display = "block";
        dropZone.style.display = "block";
    });

    // Chiude il drop zone e rimuove l'overlay
    closeButton.addEventListener("click", function() {
        overlay.style.display = "none";
        dropZone.style.display = "none";
    });

    // Drag and drop gestione
    dropZone.addEventListener("dragover", function(event) {
        event.preventDefault();
        dropZone.style.border = "2px solid green";
    });

    dropZone.addEventListener("dragleave", function() {
        dropZone.style.border = "2px dashed white";
    });

    dropZone.addEventListener("drop", function(event) {
        event.preventDefault();
        dropZone.style.border = "2px dashed white";

        let files = event.dataTransfer.files;
        if (files.length > 0) {
            let formData = new FormData();
            formData.append("file", files[0]);

            // Invia il file al server tramite AJAX
            fetch("php/upload_files.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                alert(result); // Mostra il messaggio di risposta dal server
                overlay.style.display = "none";
                dropZone.style.display = "none";
                setTimeout(() => {
                    window.location.reload();
                }, 750);
            })
            .catch(error => {
                console.error("Errore nell'upload:", error);
                alert("Errore durante l'upload.");
            });
        }
        
    });

    // Chiudi overlay se clicchi fuori dal drop zone
    overlay.addEventListener("click", function() {
        overlay.style.display = "none";
        dropZone.style.display = "none";
    });
</script>

</html>
