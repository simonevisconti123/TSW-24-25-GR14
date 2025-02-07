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
    <link rel="stylesheet" href="css/settings_style.css">
    <script src="js/utilities.js"></script>

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
                    </ul>
                </div>
                <div class="laMiaAttivitàBox">
                    <h2>La mia attività</h2>
                    <ul>
                        <li><button class="sezione">Topic salvati</button></li>
                    </ul>
                </div>
            </div>
            <button class="cancelButton" onclick=returnToHome()>Cancel</button>
        </div>
        <div class="contenutiBlock">
            <div id="iMieiDatiBox" class="hidden">
                <h1>I miei dati</h1>
                <span><label>Indirizzo e-mail:</label> culo@gmail.com</span><br>
                <span><label>Password:</label> Dark souls remastered</span><br>
                <span><label>Username:</label> peenus</span>
            </div>

            <div id="cambiaMailBox" class="hidden">
                <h1 id="titolo">Cambia indirizzo e-mail</h1>
                <form onsubmit="return check_mail_change(this)" id="form_change_mail">
                    <input type="text" name="new_mail" placeholder="Nuova email">
                    <input type="text" name="new_mail_conf" id="new_mail_conf" placeholder="Conferma nuova email">
                    <button id="mail_change">Salva modifiche</button>
                </form>
                <p id="label_message_mail"></p>
            </div>
            
            <div id="cambiaPasswordBox" class="hidden">
                <h1>Cambia password</h1>
                <form onsubmit="return check_pswd_change(this)" id="form_change_pswd">
                    <input type="password" name="new_pswd" placeholder="Nuova password">
                    <input type="password" name="new_pswd_conf" placeholder="Conferma nuova password">
                    <button id="pswd_change" >Salva modifiche</button>
                </form>
                <p id="label_message_pswd"></p>
            </div>
        
            <div id="cambiaUsernameBox" class="hidden">
                <h1>Cambia username</h1>
                <input type="text" placeholder="Nuovo username">
                <button>Salva</button>
            </div>

            <div id="topicSalvatiBox">
                <h1 id="titolo">Topic salvati</h1>
                <ul id="listaTopic">
                    <li>Come fare soldi velocemente non fake</li>
                    <li>Macchine</li>
                    <li>Suicidi programmati</li>
                    <li>Fortnite battle pass</li>
                </ul>
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


</script>