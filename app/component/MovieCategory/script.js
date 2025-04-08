let templateFile = await fetch("./component/MovieCategory/template.html");
let template = await templateFile.text();
let templateFile2 = await fetch("./component/MovieCategory/templatecard.html");
let template2 = await templateFile2.text();

let list_category = {};

// Fonction pour générer un bloc complet de catégorie avec ses films
list_category.formatCategoryBlock = function (categoryName, movieList) {
  if (!movieList || movieList.length === 0) {
    content.innerHTML =
      '<p class="nofilm">Aucun film disponible pour le moment.</p>';
    return "";
  }

  let cardsHTML = "";
  for (let movie of movieList) {
    cardsHTML += list_category.formatOneCard(movie);
  }
  let idCategory = categoryName.toLowerCase().replace(/\s+/g, "-");

  let categoryHTML = template;
  categoryHTML = categoryHTML.replace("{{title_category}}", categoryName);
  categoryHTML = categoryHTML.replace("{{cards}}", cardsHTML);
  categoryHTML = categoryHTML.replace("{{id_category}}", idCategory);
  return categoryHTML;
};

list_category.formatOneCard = function (data) {
  let html = template2;

  html = html.replace("{{image_name}}", data.image);
  html = html.replace("{{title}}", data.name);
  html = html.replace("{{handler}}", `C.handlerDetail(${data.id})`);

  return html;
};

export { list_category };
