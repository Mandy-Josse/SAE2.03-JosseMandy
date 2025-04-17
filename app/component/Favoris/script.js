let templateFile = await fetch("./template.html");
let template = await templateFile.text();
let templateFile2 = await fetch("./templatefav.html");
let template2 = await templateFile2.text();


let Favoris = {};

// Fonction qui génère la page avec les cartes


Favoris.format = function (data) {
  let html = template; // Template d'une carte
  console.log("Données reçues pour format des favoris:", data);
  // Si pas de favoris, affiche un message
  if (data.length === 0) {
    fav.innerHTML = '<p class="nofilm">Aucun Favoris pour le moment.</p>';
    return "";
  }

  // On génère toutes les cartes pour les favoris
  let fav = "";
  for (let e of data) {
    fav += Favoris.formatOneCard(e);
  }
  html = html.replace("{{favoris}}", fav)


  return html;
};

// Fonction qui génère une seule carte pour un favoris
Favoris.formatOneCard = function (data) {
  let html = template2; // Template d'une carte

  // Remplace les tags dynamiques avec les données du film favoris
  html = html.replace("{{image_name}}", data.image);
  html = html.replace("{{title}}", data.name);
  html = html.replace("{{handlerdelete}}", `C.handlerRemoveFav(${data.id})`);

  return html; // Retourne la carte générée
};



export { Favoris };
