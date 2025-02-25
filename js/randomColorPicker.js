// creo l'array dinamico customColors che contiene valori predefiniti di colori
const customColors = [
  '#FF514D', '#81D4FA', '#AED581', '#FF9800', '#9FFFF8',
  '#BABFFF', '#F07AFF', '#FCFF56', '#F7CAC9', '#D4A373',
  '#00C9A7', '#8D6E63', '#7986CB', '#E57373', '#64B5F6'
];

// creo una mappa per tenere traccia di quale tag ha quale colore
const assignedColors = new Map();

// Funzione di hashing per assegnare un colore fisso a un tag
function getColorForTag(tagName) {
  //se nella mappa esiste già una entry con quel tag
  if (assignedColors.has(tagName)) {
    //restituisco il colore associato
    return assignedColors.get(tagName);
  }

  //se non esiste quella entry, allora creo una variabile hash settata a 0
  let hash = 0;

  //per ogni lettera del tag, prendo il codice ashii e shifto a sinistra di 5 bit (è come fare hash * (2^5)) e sottraggo il valore attuale di has
  for (let i = 0; i < tagName.length; i++) {
    hash = tagName.charCodeAt(i) + ((hash << 5) - hash);
  }

  //prendiamo il valore assoluto di hash per evitare numeri negativi e prendiamo il resto della divisione tra il hash e la lunghezza dell'array contenente i colori
  //in questo modo ci assicuriamo che index non ci faccia uscire fuori dal limite dell'array
  let index = Math.abs(hash) % customColors.length; // Genera un indice valido

  // Assicuriamoci che due tag diversi non abbiano lo stesso colore
  //Innanzitutto prendiamo tramite spread (...) tutti i valori dell'iteratore della mappa e li mettiamo in un array, poi vediamo se il colore
  //ottenuto è già associato ad un altro tag, e in quel caso ne proviamo un vuovo colore
  while ([...assignedColors.values()].includes(customColors[index])) {
    index = (index + 1) % customColors.length; // Prova il colore successivo
  }

  //superati i controlli, salviamo la nuova associazione nella mappa e lo ritorniamo al chiamante
  assignedColors.set(tagName, customColors[index]);
  return customColors[index];
}

//prendiamo tutti i tag della pagina e per ogni tag richiamiamo la funzione che ne restituisce il colore, per poi aggiungere il background color
//specifico per quel tag al suo css
document.querySelectorAll('.postTag').forEach(tag => {
  const tagName = tag.textContent.trim().toLowerCase();
  tag.style.backgroundColor = getColorForTag(tagName);
});