
// Gamma di colori personalizzabili
const customColors = [
  '#FF514D', // Rosso
  '#81D4FA', // Azzurro
  '#AED581', // Verde
  '#FF9800', // Arancione
  '#9FFFF8', // Verde acqua
  '#BABFFF', // lilla
  '#F07AFF', // Magenta
  '#FCFF56', // Giallo
  '#F7CAC9'  // Rosa tenue
];

// Funzione per ottenere un colore casuale dalla gamma personalizzata
function getRandomColor() {
  const randomIndex = Math.floor(Math.random() * customColors.length); // Seleziona un indice casuale
  return customColors[randomIndex];
}

// Applica un colore casuale a ogni tag
document.querySelectorAll('.postTag').forEach(tag => {
  tag.style.backgroundColor = getRandomColor();
});
