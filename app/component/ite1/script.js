let templateFile = await fetch("./component/ite1/template.html");
let template = await templateFile.text();
let templateFile2 = await fetch("./component/ite1/templatecard.html");
let template2 = await templateFile2.text();

let List_ite1 = {};

List_ite1.format = function (data) {
  let html = template;
  List_ite1.formatOneCard (data)
  return html;
};




List_ite1.formatOneCard = function (data) {
  let html = template2;

  let truncated_name = data.Name.length > 15 ? Name.substring(0,15) + "..." : Name;
  html = html.replace("{{Affiche}}", data.affiche);
  html = html.replace("{{Name}}", truncated_name);
  return html;
};


export { List_ite1 };
