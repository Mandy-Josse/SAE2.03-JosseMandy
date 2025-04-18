let templateFile = await fetch("./component/ite1/template.html");
let template = await templateFile.text();
let templateFile2 = await fetch("./component/ite1/templatecard.html");
let template2 = await templateFile2.text();

import { DataMovie } from "./../../data/dataMovie.js";

let List_ite1 = {};

// Fonction qui génère la page avec les cartes
List_ite1.format = async function (data) {
  if (data.length === 0) {
    content.innerHTML = '<p class="nofilm">Aucun film disponible pour le moment.</p>';
    return "";
  }

  let allCards = "";
  for (let movie of data) {
    allCards += await List_ite1.formatOneCard(movie); // Attend chaque carte
  }

  let html = template.replace("{{cards}}", allCards);

  content.innerHTML = html;

  return html;
};

// Fonction qui génère une seule carte pour un film
List_ite1.formatOneCard = async function (data) {
  let html = template2;
  html = html.replace("{{image_name}}", data.image);
  html = html.replace("{{title}}", data.name);
  html = html.replace("{{handler}}", `C.handlerDetail(${data.id})`);
  html = html.replace("{{handleraddfav}}", `C.handlerAddFav(${data.id_profile}, ${data.id})`);

  return html;
};

export { List_ite1 };
