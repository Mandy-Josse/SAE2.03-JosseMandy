let templateFile = await fetch("./component/List_ite1/template.html");
let template = await templateFile.text();

let List_ite1 = {};

List_ite1.format = function (hAbout, hHome) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);
  return html;
};

export { List_ite1 };
