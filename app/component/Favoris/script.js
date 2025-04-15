let templateFile = await fetch("./component/Favoris/template.html");
let template = await templateFile.text();
let templateFile2 = await fetch("./component/Favoris/templatefav.html");
let template2 = await templateFile2.text();


let Favoris = {};

// Fonction qui génère la page avec les cartes
Favoris.format = function (data) {
  console.log("Données reçues pour format des favoris:", data);
  // Si pas de favoris, affiche un message
  if (data.length === 0) {
    content.innerHTML = '<p class="nofilm">Aucun Favoris pour le moment.</p>';
    return "";
  }

  // On génère toutes les cartes pour les favoris
  let fav = "";
  for (let e of data) {
    fav += fav.formatOneCard(e);
  }
  html = template.replace("{{favoris}}", fav)
  html = template.replace("{{Nom_profile}}", data.Nom_profile);


  return html;
};

// Fonction qui génère une seule carte pour un favoris
Favoris.formatOneCard = function (data) {
  let html = template2; // Template d'une carte

  // Remplace les tags dynamiques avec les données du film favoris
  html = html.replace("{{image_name}}", data.image);
  html = html.replace("{{title}}", data.name);
  html = html.replace("{{handler}}", `C.handlerDetail(${data.id})`);
  html = html.replace("{{handlerdelete}}", `C.handlerAddFav(${data.id_fav}, ${data.id_profile})`);

  return html; // Retourne la carte générée
};

export { Favoris };
