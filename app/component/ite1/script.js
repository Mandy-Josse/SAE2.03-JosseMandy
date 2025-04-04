let templateFile = await fetch("./component/ite1/template.html");
let template = await templateFile.text();
let templateFile2 = await fetch("./component/ite1/templatecard.html");
let template2 = await templateFile2.text();

let List_ite1 = {};

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

  let truncated_name =
    data.name.length > 15 ? data.name.substring(0, 15) + "..." : data.name;
  html = html.replace("{{image_name}}", data.image_name);
  html = html.replace("{{title}}", truncated_name);
  return html;
};

export { List_ite1 };
