<!DOCTYPE html>
<?php
    session_start();
    if(is_null($_SESSION["topics"])){
        $_SESSION["topics"] = "articoli";
    }
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

    <!-- script pazzo in culo che fa comparire solo i post che contengono la sottostringa cercata nel proprio testo o nei tag -->
     <script src="js/indexSearchBar.js" defer></script>
     <script src="js/utilities.js" defer></script>
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
                            <li>
                                <form id="change_articles">
                                    <button class="selectTopicButton" id="selectTopicButton-articoli">Articoli</button>
                                </form>
                            </li>

                            <li>
                                <form id="change_exams">
                                    <button class="selectTopicButton" id="selectTopicButton-esami">Esami</button>
                                </form>
                            </li>

                            <li>
                                <form id="form_transport">
                                    <button class="selectTopicButton" id="selectTopicButton-mezziDiTrasporto">Mezzi di Trasporto</button>
                                </form>    
                        </li>
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
            <?php
                    
                    if($_SESSION["topics"] == "articoli"){
                        echo "<h1>Articoli <i class='fa-solid fa-newspaper'></i></h1>";
                    }else if($_SESSION["topics"] == "esami"){
                        echo "<h1>Esami <i class='fa-solid fa-pencil'></i></h1>";
                    }else{
                        echo "<h1>Mezzi di trasporto <i class='fa-solid fa-bus'></i></h1>";
                    }
                    
            ?>
                </div>
            </div>
            
            <!--DIV CHE GESTISCE L'INSERIMENTO DI NUOVI POST NEL TOPIC-->
            <?php if(isset($_SESSION["username"])): ?>
            <div class="addPostButtonDiv">
                <!--pulsante aggiunta post-->
                <button class="addPostButton"><i class="fa-solid fa-upload"></i> Aggiungi un post</button>
            </div>

            <!--FORM DI AGGIUNTA DI NUOVI POST-->
            <form onsubmit="return check_post_creations(this)" class="newPostForm newPostForm-hidden" id="form_post">
                <span class="closeButton"><i class="fa-solid fa-x"></i></span>
                <h2>Nuovo Post</h2>

                <label for="title">Titolo</label>
                <input type="text" id="title" name="title" placeholder="Inserisci il titolo">

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
                <p id="error-message" style="color: red; display: none;">Puoi selezionare massimo 13 tag!</p>


                <label for="content">Oggetto</label>
                <textarea id="content" placeholder="Scrivi qui..."></textarea>
                <input type="hidden" id="selected-category" name="selected-category" value="<?php echo $_SESSION["topics"] ?>">
                <button class="submit-btn" id="btn_crea_post">Post</button>
                <p id="topic_output_label"></p>
            </form>
            <?php endif; ?>

            <!--AGGIUNTA DI NUOVI POST E RELATIVE SEZIONI COMMENTO-->
            <!-- creazione post -->
            <?php
            $host = 'localhost';
            $port = '5432';
            $db = 'gruppo14';
            $username = 'www';
            $password = 'tw2024';
            $connection_string = "host=$host dbname=$db user=$username password=$password";
            
            $db = pg_connect($connection_string)
            or die('Impossibile connetersi al database: ' . pg_last_error());

            $topics = $_SESSION["topics"];

            $result = pg_prepare($db,"Retrieve_posts"," SELECT * FROM posts WHERE topic_appartenenza=$1");
            $execution = pg_execute($db, "Retrieve_posts", array($topics));
            
            while ($returned_row = pg_fetch_assoc($execution)) {
                $tags_list = explode(",", $returned_row["tags"]);
                echo "
                <div class='post' id='post-" . $returned_row["id"] . "'>
                        <div class='postInfoBlock'>
                            <span><img class='postUserImage' src='img/profiloAnthony.jpg'></span>
                            <span class='postUsername'>" . $returned_row["autore"] . "</span>
                        </div>
                        <div class='postDataBlock'>
                            <div class='postHeaderBox'>
                                <div class='postTitle'>" . $returned_row["titolo"] . "</div>
                                <div class='topicDiAppartenenza'>" . $returned_row["topic_appartenenza"] . "</div>
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
                            <p>" . $returned_row["corpo"] . "</p>
                        </div>
                
                        <div class='postInteractionBox'>
                            <span class='heartIcon'><i class='fa-regular fa-heart'></i></span>
                            <span class='commentIcon'><i class='fa-regular fa-comment'></i></span>
                            <span class='bookmarkIcon'><i class='fa-regular fa-bookmark'></i></span>
                        </div>
                    </div>
                </div>";

                //creazione sezione commenti
                echo "
                    <div class='postComments' id='comment-".$returned_row["id"]."'>
                    <!--SEZIONE CREAZIONE COMMENTO-->
                        <div class='commentSubmitBlock'>
                                <input class='commentInsertionBar' type='text' placeholder='commenta'>
                                <button class='commentButton'><i class='fa-solid fa-paper-plane'></i></button>
                        </div>

                    <!--SHOW COMMENTI-->

                    </div>
                ";
            }
        ?>
                
                

        </div>
    </div>

    <footer class="footer">
        <span><a href="chiSiamo.html">Chi siamo</a></span>
    </footer>
    </div>
</body>



<script>
    <?php if(isset($_SESSION["username"])): ?>
    document.getElementById("btn_crea_post").addEventListener("click", function() {
        event.preventDefault();
        var form = document.getElementById("form_post");
        if (!check_post_creations(form)) {
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/crea_post.php", true); // URL del file PHP
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.responseType = 'json';


        xhr.onload = function() {
            if (xhr.status == 200) {

                var response = xhr.response;
                document.getElementById("topic_output_label").innerHTML = response.message;
                if(response.success){
                    setTimeout(() => {
                    window.location.reload();
                }, 1500);
                }
            } else {
                document.getElementById("topic_output_label").innerHTML = "Errore nella richiesta.";
            }
        };


        xhr.onerror = function() {
            document.getElementById("topic_output_label").innerHTML = "Errore di rete.";
        };
        
        // Invio dei dati con POST
        var title = document.getElementById("title").value;
        var content = document.getElementById("content").value;
        var selectedTags = [];
        var checkboxes = form.querySelectorAll(".tagsBox input[type='checkbox']:checked");
        checkboxes.forEach(function(checkbox) {
            selectedTags.push(checkbox.value);
        });
        var data = "title=" + encodeURIComponent(title) +
           "&content=" + encodeURIComponent(content) +
           "&tags=" + encodeURIComponent(selectedTags.join(",")) +
           "&category=" + encodeURIComponent(document.getElementById("selected-category").value);
        xhr.send(data);
    });
    <?php endif; ?>

    document.getElementById("selectTopicButton-articoli").addEventListener("click", function() {
        event.preventDefault();

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/change_to_articles.php", true); // URL del file PHP
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.responseType = 'json';

        xhr.onload = function() {
            if (xhr.status == 200) {

                var response = xhr.response;
                if(response.success){
                    setTimeout(() => {
                    window.location.reload();
                }, 100);
                }
            }
        };
        data = "value=article";
        xhr.send(data);
    });

    document.getElementById("selectTopicButton-esami").addEventListener("click", function() {
        event.preventDefault();

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/change_to_exams.php", true); // URL del file PHP
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.responseType = 'json';

        xhr.onload = function() {
            if (xhr.status == 200) {

                var response = xhr.response;
                if(response.success){
                    setTimeout(() => {
                    window.location.reload();
                }, 100);
                }
            }
        };
        data = "value=exams";
        xhr.send(data);
    });

    document.getElementById("selectTopicButton-mezziDiTrasporto").addEventListener("click", function() {
        event.preventDefault();

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/change_to_transport.php", true); // URL del file PHP
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.responseType = 'json';

        xhr.onload = function() {
            if (xhr.status == 200) {

                var response = xhr.response;
                if(response.success){
                    setTimeout(() => {
                    window.location.reload();
                }, 100);
                }
            }
        };
        data = "value=transport";
        xhr.send(data);
    });


</script>


</html>