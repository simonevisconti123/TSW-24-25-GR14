// Gamma di colori personalizzabili (puoi aggiungerne altri)
const customColors = [
  '#FF514D', '#81D4FA', '#AED581', '#FF9800', '#9FFFF8',
  '#BABFFF', '#F07AFF', '#FCFF56', '#F7CAC9', '#D4A373',
  '#00C9A7', '#8D6E63', '#7986CB', '#E57373', '#64B5F6'
];

// Mappa per tenere traccia dei colori assegnati
const assignedColors = new Map();

// Funzione di hashing per assegnare un colore fisso a un tag
function getColorForTag(tagName) {
  if (assignedColors.has(tagName)) {
    return assignedColors.get(tagName); // Se il tag ha già un colore, usa quello
  }

  let hash = 0;
  for (let i = 0; i < tagName.length; i++) {
    hash = tagName.charCodeAt(i) + ((hash << 5) - hash);
  }
  
  let index = Math.abs(hash) % customColors.length; // Genera un indice valido

  // Assicuriamoci che due tag diversi non abbiano lo stesso colore
  while ([...assignedColors.values()].includes(customColors[index])) {
    index = (index + 1) % customColors.length; // Prova il colore successivo
  }

  assignedColors.set(tagName, customColors[index]); // Salva l'assegnazione
  return customColors[index];
}

// Applica sempre lo stesso colore ai tag con lo stesso nome
document.querySelectorAll('.postTag').forEach(tag => {
  const tagName = tag.textContent.trim().toLowerCase(); // Normalizza il nome del tag
  tag.style.backgroundColor = getColorForTag(tagName);
});



//FUNZIONE VECCHIA PER LA GENERAZIONE DEI COLORI DEI TAG
//SE QUELLA NUOVA DA' PROBLEMI, COMMENTARLA E USARE QUESTA
//CULO

/*

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

 */