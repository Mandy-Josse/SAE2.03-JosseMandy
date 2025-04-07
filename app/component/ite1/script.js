let templateFile = await fetch("./component/ite1/template.html");
let template = await templateFile.text();
let templateFile2 = await fetch("./component/ite1/templatecard.html");
let template2 = await templateFile2.text();

let List_ite1 = {};
/*
List_ite1.format = function (data) {
  let html = template;
  html += List_ite1.formatOneCard(data);
  if (data.length == 0) {
    content.innerHTML = "<p>Aucun film disponible pour le moment.</p>";
  }
  return html;
};

List_ite1.formatOneCard = function (data) {
  let html = template2;

  /* let truncated_name = data.name.length > 15 ? data.name.substring(0, 15) + "..." : data.name;
  html = html.replace("{{image_name}}", data.image_name);
  html = html.replace("{{title}}", data.name);
  return html;
};

export { List_ite1 }; */

/*List_ite1.format = function (data) {
  if (data.length === 0) {
    content.innerHTML = "<p>Aucun film disponible pour le moment.</p>";
    return "";
  }

  let html = template;

  // Ajoute chaque film avec formatOneCard
  for (let movie of data) {
    html += List_ite1.formatOneCard(movie);
  }

  return html;
};

List_ite1.formatOneCard = function (data) {
  let html = template2;

  html = html.replace("{{image_name}}", data.image);
  html = html.replace("{{title}}", data.name);
  return html;
};
*/

// Fonction qui génère la page avec les cartes
List_ite1.format = function (data) {
  // Si pas de films, affiche un message
  if (data.length === 0) {
    content.innerHTML =
      '<p class="nofilm">Aucun film disponible pour le moment.</p>';
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
  html = html.replace("{{handler}}", C.handlerDetail(data.id)); // Ajoute le handler pour le clic sur la carte

  return html; // Retourne la carte générée
};

export { List_ite1 };
