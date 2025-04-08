let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (hAbout, hHome) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);
  return html;
};

//
//
let emptyCategories = ["animation", "thriller", "documentaire"]; // à mettre à jour dynamiquement selon ta BDD

document.addEventListener("DOMContentLoaded", () => {
  emptyCategories.forEach((cat) => {
    let item = document.querySelector(`.navbar__item[data-category="${cat}"]`);
    if (item) {
      item.classList.add("navbar__item--disabled");
    }
  });
});

export { NavBar };
