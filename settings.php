<!DOCTYPE html>
<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: ../index.php");
    }
?>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Mio Account</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/settings_style.css">
    <script src="js/utilities.js"></script>

    <!-- SCRIPT PER IL RANDOM COLOR PICKER DEI TAGS-->
    <script src="js/randomColorPicker.js" defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend+Mega:wght@553&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="leftBlock">
            <div class="top-section">
                <div class="ilMioAccountBox">
                    <h2>Il mio account</h2>
                    <ul>
                        <li id="ilMioAccountBoxList"><button class="sezione">I miei dati</button></li>
                        <li id="ilMioAccountBoxList"><button class="sezione">Cambia mail</button></li>
                        <li id="ilMioAccountBoxList"><button class="sezione">Cambia password</button></li>
                        <li id="ilMioAccountBoxList"><button class="sezione">Cambia username</button></li>
                        <li id="ilMioAccountBoxList"><button class="sezione">Cambia foto profilo</button></li>
                    </ul>
                </div>
                <div class="laMiaAttivitàBox">
                    <h2>La mia attività</h2>
                    <ul>
                        <li><button class="sezione">Post salvati</button></li>
                    </ul>
                </div>
            </div>
            <button class="cancelButton" onclick=returnToHome()>Cancel</button>
        </div>
        <div class="contenutiBlock">
            <div id="iMieiDatiBox">
                <h1>I miei dati</h1>
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
                    $result_1 = pg_prepare($db,"Retrieve_data"," SELECT * FROM utenti WHERE nome_utente = $1");
                    $execution_1 = pg_execute($db, "Retrieve_data", array($user));

                    $returned_row = pg_fetch_assoc($execution_1);
                    if ($returned_row) { // Verifica se la query ha restituito un risultato
                        echo "<label>Username:</label><span>".$returned_row["nome_utente"]."</span><br>";
                        echo "<label>Indirizzo e-mail:</label><span>".$returned_row["email"]."</span>";
                    }else{
                        echo "<span>Errore irreparabile</span>";
                    }
                ?>
            </div>

            <div id="cambiaMailBox">
                <h1 id="titolo">Cambia indirizzo e-mail</h1>
                <form onsubmit="return check_mail_change(this)" id="form_change_mail">
                    <input type="text" name="new_mail" placeholder="Nuova email">
                    <input type="text" name="new_mail_conf" id="new_mail_conf" placeholder="Conferma nuova email">
                    <button id="mail_change">Salva modifiche</button>
                </form>
                <p id="label_message_mail"></p>
            </div>
            
            <div id="cambiaPasswordBox">
                <h1 id="titolo">Cambia password</h1>
                <form onsubmit="return check_pswd_change(this)" id="form_change_pswd">
                    <input type="password" name="new_pswd" placeholder="Nuova password">
                    <input type="password" name="new_pswd_conf" id="new_pswd_conf" placeholder="Conferma nuova password">
                    <button id="pswd_change" >Salva modifiche</button>
                </form>
                <p id="label_message_pswd"></p>
            </div>
        
            <div id="cambiaUsernameBox">
                <h1>Cambia username</h1>
                <form onsubmit="return check_username_change(this)" id="form_username_change">
                <input type="text" name="new_username" placeholder="Nuovo username">
                <input type="text" name="new_username_conf" id="new_username_conf" placeholder="Conferma il nuovo username">
                <button id="username_change">Salva modifiche</button>
                </form>
                <p id="label_message_username"></p>
            </div>

            <div id="cambiaFotoProfiloBox">
                <h1>Cambia foto profilo</h1>
                <form id="form_propic_change" enctype="multipart/form-data">
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required>
                <button id="pro_pic_change">Salva modifiche</button>
                </form>
                <p id="label_message_propic"></p>
            </div>

            <div id="postSalvatiBox">

                    <?php
                        $host = 'localhost';
                        $port = '5432';
                        $db = 'gruppo14';
                        $username = 'www';
                        $password = 'tw2024';
                        $connection_string = "host=$host dbname=$db user=$username password=$password";
                                
                        $db = pg_connect($connection_string)
                        or die('Impossibile connettersi al database: ' . pg_last_error());

                        $postAuthorProPicQuery = pg_prepare($db,"Retrieve_postAuthorProPic"," SELECT immagine_profilo FROM utenti WHERE nome_utente=$1");


                        $UsrpostListQuery = pg_prepare($db,"Retrieve_posts_from_usr"," SELECT post_salvati FROM utenti WHERE nome_utente=$1");
                        $UsrpostListResult = pg_execute($db, "Retrieve_posts_from_usr", array($_SESSION["username"]));
                        $DBpostListQuery = pg_prepare($db,"Retrieve_posts_from_DB"," SELECT * FROM posts");
                        $DBpostListResult = pg_execute($db, "Retrieve_posts_from_DB", array());
                        $DBpostListQueryFound = pg_prepare($db,"Retrieve_posts_from_DB_when_match"," SELECT * FROM posts WHERE id = $1");
                        $returned_row = pg_fetch_assoc($UsrpostListResult);
                        $arrayIdPostSalvatiDB = [];
                        while ($row = pg_fetch_assoc($DBpostListResult)) {
                            $arrayIdPostSalvatiDB[] = $row["id"];
                        }
                        $arrayIdPostSalvatiUsr = explode(",", $returned_row["post_salvati"]);
                        foreach ($arrayIdPostSalvatiUsr as $index => $value) {
                            if(in_array($value,$arrayIdPostSalvatiDB) == "1"){
                                $execution_found = pg_execute($db,"Retrieve_posts_from_DB_when_match",array($value));
                                $returned_row_3 = pg_fetch_assoc($execution_found);
                                $postAuthorProPicResult = pg_execute($db, "Retrieve_postAuthorProPic", array($returned_row_3["autore"]));
                                $fetch_postAuthorProPic = pg_fetch_assoc($postAuthorProPicResult);
                                if(!empty($fetch_postAuthorProPic["immagine_profilo"])){
                                    $postAuthorProPic = $fetch_postAuthorProPic["immagine_profilo"];
                                }else{
                                    $postAuthorProPic = "default_pic.jpg";
                                }

                                $tags_list = explode(",", $returned_row_3["tags"]);
                                echo "
                                <div class='post' id='post-" . $returned_row_3["id"] . "'>
                                        <div class='postInfoBlock'>
                                            <span><img class='postUserImage' src='php/usr_imgs/".$postAuthorProPic."'></span>
                                            <span class='postUsername'>" . $returned_row_3["autore"] . "</span>
                                        </div>
                                        <div class='postDataBlock'>
                                            <div class='postHeaderBox'>
                                                <div class='postTitle'>" . $returned_row_3["titolo"] . "</div>
                                                <div class='topicDiAppartenenza'>" . $returned_row_3["topic_appartenenza"] . "</div>
                                            </div>";
                                
                                        // Controllo se ci sono tag validi
                                        if (!empty($tags_list) && count(array_filter($tags_list, 'trim')) > 0) {
                                            echo "<div class='postTagsBox'>";
                                            
                                            // Ciclo `foreach` per aggiungere ogni tag
                                            foreach ($tags_list as $parola) {
                                                $parola = trim($parola); // Rimuove eventuali spazi in eccesso
                                                if (!empty($parola)) { // Stampa solo se il tag non è vuoto
                                                    echo "<span class='postTag'>" . htmlspecialchars($parola) . "</span> ";
                                                }
                                            }
                                            
                                            echo "</div>";
                                        }
            
                                        echo "  
                                        <div class='postBodyBox'>
                                            <p>" . $returned_row_3["corpo"] . "</p>
                                        </div>
                                    </div>
                                </div>
                                        ";
                            }
                        }

                        /*$postAuthorProPicQuery = pg_prepare($db,"Retrieve_postAuthorProPic"," SELECT immagine_profilo FROM utenti WHERE nome_utente=$1");
                        while ($returned_row = pg_fetch_assoc($postListResult)) {
                            $postAuthorProPicResult = pg_execute($db, "Retrieve_postAuthorProPic", array($returned_row["autore"]));
                            $fetch_postAuthorProPic = pg_fetch_assoc($postAuthorProPicResult);
                            if(!empty($fetch_postAuthorProPic["immagine_profilo"])){
                                $postAuthorProPic = $fetch_postAuthorProPic["immagine_profilo"];
                            }else{
                                $postAuthorProPic = "default_pic.jpg";
                                }
                        }*/



                    ?>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    document.getElementById("mail_change").addEventListener("click", function() {
        // Creazione di un oggetto XMLHttpRequest
        event.preventDefault();
        var form = document.getElementById("form_change_mail");
        if (!check_mail_change(form)) {
            return; // Se la validazione fallisce, interrompe l'esecuzione
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/change_mail.php", true); // URL del file PHP
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Impostiamo la proprietà responseType per ricevere la risposta come JSON
        xhr.responseType = 'json';

        // Definisci cosa fare quando la richiesta è completata
        xhr.onload = function() {
            if (xhr.status == 200) {
                // La risposta è automaticamente un oggetto JSON grazie a responseType
                var response = xhr.response;
                document.getElementById("label_message_mail").innerHTML = response.message;
                if(response.success){
                    setTimeout(() => {
                    window.location.reload();
                }, 1500);
                }
            } else {
                document.getElementById("label_message_mail").innerHTML = "Errore nella richiesta.";
            }
        };

        // Gestire eventuali errori
        xhr.onerror = function() {
            document.getElementById("label_message_mail").innerHTML = "Errore di rete.";
        };
        
        // Invio dei dati con POST
        
        var val1 = document.getElementById("new_mail_conf").value;
        var data = "new_mail_conf=".concat(val1);
        xhr.send(data);
    });

    document.getElementById("pswd_change").addEventListener("click", function() {
        // Creazione di un oggetto XMLHttpRequest
        event.preventDefault();
        var form = document.getElementById("form_change_pswd");
        if (!check_pswd_change(form)) {
            return; // Se la validazione fallisce, interrompe l'esecuzione
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/change_pswd.php", true); // URL del file PHP
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Impostiamo la proprietà responseType per ricevere la risposta come JSON
        xhr.responseType = 'json';

        // Definisci cosa fare quando la richiesta è completata
        xhr.onload = function() {
            if (xhr.status == 200) {
                // La risposta è automaticamente un oggetto JSON grazie a responseType
                var response = xhr.response;
                document.getElementById("label_message_pswd").innerHTML = response.message;
            } else {
                document.getElementById("label_message_pswd").innerHTML = "Errore nella richiesta.";
            }
        };

        // Gestire eventuali errori
        xhr.onerror = function() {
            document.getElementById("label_message_pswd").innerHTML = "Errore di rete.";
        };
        
        // Invio dei dati con POST
        
        var val1 = document.getElementById("new_pswd_conf").value;
        var data = "new_pswd_conf=".concat(val1);
        xhr.send(data);
    });

    document.getElementById("username_change").addEventListener("click", function() {
        // Creazione di un oggetto XMLHttpRequest
        event.preventDefault();
        var form = document.getElementById("form_username_change");
        if (!check_username_change(form)) {
            return; // Se la validazione fallisce, interrompe l'esecuzione
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/change_username.php", true); // URL del file PHP
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Impostiamo la proprietà responseType per ricevere la risposta come JSON
        xhr.responseType = 'json';

        // Definisci cosa fare quando la richiesta è completata
        xhr.onload = function() {
            if (xhr.status == 200) {
                // La risposta è automaticamente un oggetto JSON grazie a responseType
                var response = xhr.response;
                document.getElementById("label_message_username").innerHTML = response.message;
                if(response.success){
                    setTimeout(() => {
                    window.location.reload();
                }, 1500);
                }
            } else {
                document.getElementById("label_message_username").innerHTML = "Errore nella richiesta.";
            }
        };

        // Gestire eventuali errori
        xhr.onerror = function() {
            document.getElementById("label_message_username").innerHTML = "Errore di rete.";
        };
        
        // Invio dei dati con POST
        
        var val1 = document.getElementById("new_username_conf").value;
        var data = "new_username_conf=".concat(val1);
        xhr.send(data);
    });


    document.getElementById("pro_pic_change").addEventListener("click", function() {
        // Creazione di un oggetto XMLHttpRequest
        event.preventDefault();

        var fileInput = document.getElementById("profile_picture");

    if (fileInput.files.length === 0) {
        messageLabel.innerHTML = "Seleziona un file prima di caricare.";
        return;
    }

    var file = fileInput.files[0];
    var formData = new FormData();
    formData.append("profile_picture", file);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/img_uploader.php", true); // URL del file PHP

        xhr.responseType = 'json';

        xhr.onload = function() {
            if (xhr.status == 200) {
                var response = xhr.response;
                document.getElementById("label_message_propic").innerHTML = response.message;
                if(response.success){
                    setTimeout(() => {
                    window.location.reload();
                }, 1500);
                }
            } else {
                document.getElementById("label_message_propic").innerHTML = "Errore nella richiesta.";
            }
        };

        xhr.onerror = function() {
            document.getElementById("label_message_propic").innerHTML = "Errore di rete.";
        };
        
        
        xhr.send(formData);
    });

</script>