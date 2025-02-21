//lo script viene eseguito solo dopo che l'html di "index.php" è caricato
document.addEventListener("DOMContentLoaded", function () {
    //con questa riga prendiamo come input dello script il campo input del box searchBar nel box upBar, ovvero la barra di ricerca
    const searchInput = document.querySelector(".upBar .searchBar input");
    const searchButton = document.querySelector(".upBar .searchBar .searchIcon");

    //aggiungo un'event listener che esegue la funzione solo quando viene premuto un tasto
    searchInput.addEventListener("keypress", function (event) {
        //il tasto scelto è enter, se viene premuto quel tasto si esegue il codice dentro l'if
        if (event.key === "Enter") {
            //qui prendo il contenuto della barra di ricerca (value), lo porto in minuscolo e toglo eventuali spazi all'inizio e alla fine della stringa restituita
            const searchTerm = searchInput.value.toLowerCase().trim();
            //qui invece prendo tutti gli elementi con classe post e li metto in "posts"
            const posts = document.querySelectorAll(".post");

            //inizio a ciclare per ogni elemento "post" nella nodelist
            posts.forEach(post => {
                //di ogni post salviamo il testo dei tag, corpo e titolo in minuscolo se non è vuoto, se invece è vuoto non viene messo nulla
                const postTitle = post.querySelector(".postTitle")?.textContent.toLowerCase() || "";
                const postText = post.querySelector(".postBodyBox")?.textContent.toLowerCase() || "";
                const postTags = post.querySelector(".postTagsBox")?.textContent.toLowerCase() || "";

                //se il titolo del post, il suo corpo o i tags includono il valore della searchbar, vengono mostrati cambiandone la proprietà display, altrimenti con
                //display:none vengono nascosti
                if (postTitle.includes(searchTerm) || postText.includes(searchTerm) || postTags.includes(searchTerm)) {
                    post.style.display = "block";
                } else {
                    post.style.display = "none";
                }
            });
        }
    });

    searchButton.addEventListener("click", function (event){
            //qui prendo il contenuto della barra di ricerca (value), lo porto in minuscolo e toglo eventuali spazi all'inizio e alla fine della stringa restituita
            const searchTerm = searchInput.value.toLowerCase().trim();
            //qui invece prendo tutti gli elementi con classe post e li metto in "posts"
            const posts = document.querySelectorAll(".post");

            //inizio a ciclare per ogni elemento "post" nella nodelist
            posts.forEach(post => {
                //di ogni post salviamo il testo dei tag, corpo e titolo in minuscolo se non è vuoto, se invece è vuoto non viene messo nulla
                const postTitle = post.querySelector(".postTitle")?.textContent.toLowerCase() || "";
                const postText = post.querySelector(".postBodyBox")?.textContent.toLowerCase() || "";
                const postTags = post.querySelector(".postTagsBox")?.textContent.toLowerCase() || "";

                //se il titolo del post, il suo corpo o i tags includono il valore della searchbar, vengono mostrati cambiandone la proprietà display, altrimenti con
                //display:none vengono nascosti
                if (postTitle.includes(searchTerm) || postText.includes(searchTerm) || postTags.includes(searchTerm)) {
                    post.style.display = "block";
                } else {
                    post.style.display = "none";
                }
            });
    });
});
