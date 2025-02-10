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


        <div class="centerBlock">
        
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