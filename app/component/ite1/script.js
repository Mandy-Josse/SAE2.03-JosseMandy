let templateFile = await fetch("./component/ite1/template.html");
let template = await templateFile.text();
let templateFile2 = await fetch("./component/ite1/templatecard.html");
let template2 = await templateFile2.text();

let List_ite1 = {};

// Fonction qui génère la page avec les cartes
List_ite1.format = function (data) {
  console.log("Données reçues pour format:", data);
  // Si pas de films, affiche un message
  if (data.length === 0) {
    content.innerHTML = '<p class="nofilm">Aucun film disponible pour le moment.</p>';
    return "";
  }

  // On génère toutes les cartes pour les films
  let allCards = "";
  for (let movie of data) {
    allCards += List_ite1.formatOneCard(movie); // Ajoute chaque carte à la liste
  }

  // Remplace {{cards}} dans le template par les cartes générées
  let html = template.replace("{{cards}}", allCards);

  return html;
};

// Fonction qui génère une seule carte pour un film
List_ite1.formatOneCard = function (data) {
  let html = template2; // Template d'une carte

  // Remplace les tags dynamiques avec les données du film
  html = html.replace("{{image_name}}", data.image);
  html = html.replace("{{title}}", data.name);
  html = html.replace("{{handler}}", `C.handlerDetail(${data.id})`);

  return html; // Retourne la carte générée
};

export { List_ite1 };
