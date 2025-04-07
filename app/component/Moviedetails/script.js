let templateFile = await fetch("./component/Moviedetails/template.html");
let template = await templateFile.text();

let MovieDetails = {};

MovieDetails.format = function (data) {
  let html = template;

  html = html.replace("{{image}}", data.image);
  html = html.replace("{{title}}", data.name);
  html = html.replace("{{year}}", data.year);
  html = html.replace("{{description}}", data.description);
  html = html.replace("{{director}}", data.director);
  html = html.replace("{{id_categorie}}", data.id_categorie);
  html = html.replace("{{length}}", data.length);
  html = html.replace("{{trailer}}", data.trailer);
  html = html.replace("{{min_age}}", data.min_age);

  return html;
};

export { MovieDetails };
