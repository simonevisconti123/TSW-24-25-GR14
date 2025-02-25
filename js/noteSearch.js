document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector(".inputSearchBar"); // Seleziona la barra di ricerca
    const gridItems = document.querySelectorAll(".grid-item"); // Seleziona tutti gli elementi della griglia

    //TASTO INVIO
    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase(); // Converte il testo in minuscolo per una ricerca case-insensitive

        gridItems.forEach(item => {
            const itemName = item.querySelector("span").textContent.toLowerCase(); // Prende il testo del nome

            // Controlla se il nome contiene il testo cercato
            if (itemName.includes(searchTerm)) {
                item.style.display = "flex"; // Mostra l'elemento se corrisponde
            } else {
                item.style.display = "none"; // Nasconde l'elemento se non corrisponde
            }
        });
    });
});
