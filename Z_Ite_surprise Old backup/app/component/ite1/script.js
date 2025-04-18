let templateFile = await fetch("./component/ite1/template.html");
let template = await templateFile.text();
let templateFile2 = await fetch("./component/ite1/templatecard.html");
let template2 = await templateFile2.text();

import { DataMovie } from "./../../data/dataMovie";

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

  // Injecte dans le DOM ici si tu veux que le JS d'après fonctionne
  content.innerHTML = ""; // Vide le contenu AVANT d'ajouter les nouvelles cartes
  content.innerHTML = html;
  
  // Maintenant que les cartes sont dans le DOM, ajoute les events
  document.querySelectorAll('.card').forEach(card => {
    let info = card.querySelector('.card__information');
    let loaded = false;

    card.addEventListener('mouseenter', async () => {
      // Le hover doit TOUJOURS afficher les infos
      info.style.display = "flex";
      info.style.opacity = "1";
      info.style.pointerEvents = "auto";

      if (loaded) return;

      let id = card.getAttribute('data-id');
      let data = await DataMovie.requestMovieDetails(id);

      info.querySelector(".card__information--title").textContent = `${data.name} (${data.year})`;
      info.querySelector(".card__information--director").textContent = `Réalisateur : ${data.director}`;
      info.querySelector(".card__information--description").textContent = `Description : ${data.description}`;
      info.querySelector(".card__information--Length").textContent = `Durée : ${data.length} minutes`;
      info.querySelector(".card__information--min-age").textContent = `Âge minimum : ${data.min_age} ans`;

      loaded = true; // Les données sont chargées une fois, mais le hover fonctionne toujours
    });

    card.addEventListener("mouseleave", () => {
      info.style.display = "none";
      info.style.opacity = "0";
      info.style.pointerEvents = "none";
    });
  });

  return html;
};

// Fonction qui génère une seule carte pour un film
List_ite1.formatOneCard = async function (data) {
  let html = template2;
  html = html.replace("{{image_name}}", data.image);
  html = html.replace("{{title}}", data.name);
  html = html.replace("{{handler}}", `C.handlerDetail(${data.id})`);
  html = html.replace("{{handleraddfav}}", `C.handlerAddFav(${data.id_profile}, ${data.id})`);

  // Placeholder pour les détails (qui seront remplis au hover)
  html = html.replace("{{Name}}", data.name); // fallback
  html = html.replace("{{Year}}", "");
  html = html.replace("{{Category}}", "");
  html = html.replace("{{Director}}", "");
  html = html.replace("{{Length}}", "");
  html = html.replace("{{Min_Age}}", "");
  html = html.replace("{{Description}}", "");
  html = html.replace("{{id}}", data.id);

  return html;
};

export { List_ite1 };
