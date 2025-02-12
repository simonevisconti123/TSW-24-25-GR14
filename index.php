<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHubject</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/index_style.css">

    <!-- connessione a google fonts per i font "Inter" e "Lexend-Mega" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend+Mega:wght@553&display=swap" rel="stylesheet">
    
    <!-- script usato per scegliere un colore randomico come background dei tag dei post-->
    <script src="js/randomColorPicker.js" defer></script>

    <!-- script usato per effettuare lo swap delle icone di interazione dei post-->
    <script src="js/postInteraction.js" defer></script>

    <!-- script usato per permettere la comparsa e scomparsa del form per la creazione di nuovi post-->
    <script src="js/newPostForm.js" defer></script>

    <!-- Connessione a Font Awesome per utilizzare le icone -->
    <script src="https://kit.fontawesome.com/f4d166ff19.js" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">
        <header class="upBar">
            <div class="logo">
                <img src="img/logo_homepage.png" alt="logo">
            </div>
            <div class="searchBar">
                <input type="text" placeholder="cerca tra post e tags">
                <span class="searchIcon"><i class="fa-solid fa-magnifying-glass"></i></span>
            </div>
            <?php if(isset($_SESSION["username"])): ?>
                <span class="loginIcon"><i class="fa-solid fa-user"></i><a id="logoutButton" href="php/logout.php">Logout</a></span>
            <?php else: ?>
                <a href="login.html" class="loginButton">ACCEDI</a>
            <?php endif; ?>
        </header>

        <div class="main">
            <div class="leftBlock">
                <div class="topicsBlock">
                    <span id="topicsTitle">Topics</span>
                    <div class="topicsBox">
                        <ul>
                            <li>Articoli</li>
                            <li>Esami</li>
                            <li>Mezzi di trasporto</li>
                        </ul>
                    </div>
                </div>
                <?php if(isset($_SESSION["username"])): ?>
                <div class="settingsBlock" id="settingsblock">
                <span id="settingsTitle">Settings</span>
                <div class="settingsBox">
                    <ul>
                        <li><a href="settings.php">Il mio account</a></li>
                        <li><a href="leMieNote.php">I miei appunti</a></li>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="centerBlock" id="centerBlock-articoli">
            <!--BANNER DEL TOPIC-->
            <div class="topicBanner">
                <div class="content">
                <h1>Articoli <i class="fa-solid fa-newspaper"></i></h1>
                </div>
            </div>
            
            <!--DIV CHE GESTISCE L'INSERIMENTO DI NUOVI POST NEL TOPIC-->
            <div class="addPostButtonDiv">
                <!--pulsante aggiunta post-->
                <button class="addPostButton"><i class="fa-solid fa-upload"></i> Aggiungi un post</button>
            </div>

            <!--FORM DI AGGIUNTA DI NUOVI POST-->
            <form class="newPostForm newPostForm-hidden">
                <span class="closeButton"><i class="fa-solid fa-x"></i></span>
                <h2>Nuovo Post</h2>

                <label for="title">Titolo</label>
                <input type="text" id="title" placeholder="Inserisci il titolo">

                <label for="tags">Tags</label>
                <div class="tagsBox">
                    <label><input type="checkbox" value="Aiuto">Aiuto</label>
                    <label><input type="checkbox" value="LM-32">LM-32</label>
                    <label><input type="checkbox" value="L-8">L-8</label>
                    <label><input type="checkbox" value="Scritto">Scritto</label>
                    <label><input type="checkbox" value="Orale">Orale</label>
                    <label><input type="checkbox" value="Appunti">Appunti</label>
                    <label><input type="checkbox" value="Orari">Orari</label>
                    <label><input type="checkbox" value="Informatica">Informatica</label>
                    <label><input type="checkbox" value="Matematica">Matematica</label>
                    <label><input type="checkbox" value="Fisica">Fisica</label>
                    <label><input type="checkbox" value="Pullman">Pullman</label>
                    <label><input type="checkbox" value="Treno">Treno</label>
                    <label><input type="checkbox" value="Tratte">Tratte</label>
                </div>

                <input type="hidden" name="tags" id="hidden-tags">
                <p id="error-message" style="color: red; display: none;">Puoi selezionare massimo 12 tag!</p>


                <label for="content">Oggetto</label>
                <textarea id="content" placeholder="Scrivi qui..."></textarea>

                <button class="submit-btn">Post</button>
            </form>

            <!--AGGIUNTA DI NUOVI POST E RELATIVE SEZIONI COMMENTO-->
            <div class="post" id="post-1">
                <div class="postInfoBlock">
                    <span><img class="postUserImage" src="img/profiloAnthony.jpg" id="1"></span>
                    <span class="postUsername">Anthony</span>
                </div>
                <div class="postDataBlock">
                    <div class="postHeaderBox">
                        <div class="postTitle">AIUTO CON GLI SPOSTAMENTI</div>
                        <div class="topicDiAppartenenza">Mezzi di trasporto</div>
                    </div>

                    <div class="postTagsBox">
                        <span class="postTag">Unisa</span>
                        <span class="postTag">Avellino-Fisciano</span>
                        <span class="postTag">Aiuto</span>
                    </div>

                    <div class="postBodyBox">
                        <p>🚍 Aiuto per spostamenti Avellino - Fisciano 🚍</p>
                        <p>Ciao a tutti! Sono uno studente e ho bisogno di aiuto per capire il modo migliore per spostarmi da Avellino al campus di Fisciano (UNISA).</p>
                        <p> So che ci sono autobus AIR Campania, ma vorrei qualche consiglio da chi fa già questa tratta:
                            ✅ Qual è l’orario migliore per evitare traffico e ritardi?
                            ✅ Dove posso acquistare i biglietti più facilmente?
                            ✅ Esistono alternative più veloci o convenienti?</p>
                        
                    
                        <p>Se qualcuno fa lo stesso percorso e ha voglia di condividere esperienze o magari organizzare un carpooling, fatemi sapere! 🚗💨
                        </p>
                        
                        Grazie mille per l’aiuto! 🙌😊
                    </div>

                    <div class="postInteractionBox">
                        <span class="heartIcon"><i class="fa-regular fa-heart"></i></span>
                        <span class="commentIcon"><i class="fa-regular fa-comment"></i></span>
                        <span class="bookmarkIcon"><i class="fa-regular fa-bookmark"></i></span>
                    </div>
                </div>
            </div>
            <div class="postComments" id="comment-1">
                <!--INSERIMENTO COMMENTO-->
                <div class="commentSubmitBlock">
                        <input class="commentInsertionBar" type="text" placeholder="commenta">
                        <button class="commentButton"><i class="fa-solid fa-paper-plane"></i></button>
                </div>
                
                <!--COMMENTO-->
                <div class="commentBlock">
                    <!--Dati utente che commenta-->
                    <div class="commentInfoBox">
                        <img class="commentUserImage" src="img/profiloAnthony.jpg">
                        <span class="commentUsername">Anthony</span>
                    </div>
                    
                    <!--Contenuto del commento-->
                    <div class="commentDataBox">
                        <p>Secondo me devi prendere sita delle 18:45</p>
                    </div>
                </div>

                <!--COMMENTO-->
                <div class="commentBlock">
                    <!--Dati utente che commenta-->
                    <div class="commentInfoBox">
                        <img class="commentUserImage" src="img/profiloAnthony.jpg">
                        <span class="commentUsername">Anthony</span>
                    </div>
                    
                    <!--Contenuto del commento-->
                    <div class="commentDataBox">
                        <p>Secondo me devi prendere sita delle 18:45</p>
                    </div>
                </div>

                <!--COMMENTO-->
                <div class="commentBlock">
                    <!--Dati utente che commenta-->
                    <div class="commentInfoBox">
                        <img class="commentUserImage" src="img/profiloAnthony.jpg">
                        <span class="commentUsername">Anthony</span>
                    </div>
                    
                    <!--Contenuto del commento-->
                    <div class="commentDataBox">
                        <p>Secondo me devi prendere sita delle 18:45</p>
                    </div>
                </div>
            </div>

            <div class="post" id="post-2">
                <div class="postInfoBlock">
                    <span><img class="postUserImage" src="img/profiloAnthony.jpg" id="1"></span>
                    <span class="postUsername">Anthony</span>
                </div>
                <div class="postDataBlock">
                    <div class="postHeaderBox">
                        <div class="postTitle">AIUTO CON GLI SPOSTAMENTI</div>
                        <div class="topicDiAppartenenza">Mezzi di trasporto</div>
                    </div>

                    <div class="postTagsBox">
                        <span class="postTag">Unisa</span>
                        <span class="postTag">Avellino-Fisciano</span>
                        <span class="postTag">Aiuto</span>
                        <span class="postTag">MyAss</span>
                    </div>

                    <div class="postBodyBox">
                        <p>🚍 Aiuto per spostamenti Avellino - Fisciano 🚍</p>
                        <p>Ciao a tutti! Sono uno studente e ho bisogno di aiuto per capire il modo migliore per spostarmi da Avellino al campus di Fisciano (UNISA).</p>
                        <p> So che ci sono autobus AIR Campania, ma vorrei qualche consiglio da chi fa già questa tratta:
                            ✅ Qual è l’orario migliore per evitare traffico e ritardi?
                            ✅ Dove posso acquistare i biglietti più facilmente?
                            ✅ Esistono alternative più veloci o convenienti?</p>
                        
                    
                        <p>Se qualcuno fa lo stesso percorso e ha voglia di condividere esperienze o magari organizzare un carpooling, fatemi sapere! 🚗💨
                        </p>
                        
                        Grazie mille per l’aiuto! 🙌😊
                    </div>

                    <div class="postInteractionBox">
                        <span class="heartIcon"><i class="fa-regular fa-heart"></i></span>
                        <span class="commentIcon"><i class="fa-regular fa-comment"></i></span>
                        <span class="bookmarkIcon"><i class="fa-regular fa-bookmark"></i></span>
                    </div>
                </div>
            </div>
            <div class="postComments" id="comment-2">
                <!--INSERIMENTO COMMENTO-->
                <div class="commentSubmitBlock">
                        <input class="commentInsertionBar" type="text" placeholder="commenta">
                        <button class="commentButton"><i class="fa-solid fa-paper-plane"></i></button>
                </div>
                
                <!--COMMENTO-->
                <div class="commentBlock">
                    <!--Dati utente che commenta-->
                    <div class="commentInfoBox">
                        <img class="commentUserImage" src="img/profiloAnthony.jpg">
                        <span class="commentUsername">Anthony</span>
                    </div>
                    
                    <!--Contenuto del commento-->
                    <div class="commentDataBox">
                        <p>Secondo me devi prendere sita delle 18:45</p>
                    </div>
                </div>

                <!--COMMENTO-->
                <div class="commentBlock">
                    <!--Dati utente che commenta-->
                    <div class="commentInfoBox">
                        <img class="commentUserImage" src="img/profiloAnthony.jpg">
                        <span class="commentUsername">Anthony</span>
                    </div>
                    
                    <!--Contenuto del commento-->
                    <div class="commentDataBox">
                        <p>Secondo me devi prendere sita delle 18:45</p>
                    </div>
                </div>

                <!--COMMENTO-->
                <div class="commentBlock">
                    <!--Dati utente che commenta-->
                    <div class="commentInfoBox">
                        <img class="commentUserImage" src="img/profiloAnthony.jpg">
                        <span class="commentUsername">Anthony</span>
                    </div>
                    
                    <!--Contenuto del commento-->
                    <div class="commentDataBox">
                        <p>Secondo me devi prendere sita delle 18:45</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <span><a href="chiSiamo.html">Chi siamo</a></span>
    </footer>
    </div>
</body>
</html>