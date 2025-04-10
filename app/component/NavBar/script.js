let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();
let templateFileProfiles = await fetch("./component/NavBar/template.html");
let templateProfiles = await templateFileProfiles.text();

let NavBar = {};

NavBar.formatOneCategory = function (data) {
  html = html.replace("{{category_id}}", data.id);
  html = html.replace("{{category_name}}", data.name);
};

NavBar.formatOneProfile = function (data) {
  return `<option value="${data.id}">${data.name}</option>`;
};



NavBar.format = function (hAbout, hProfile, data) {
  let html = template;

  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{hProfile}}", hProfile);

  let optionsHTML = "";
  data.forEach((profile) => {
    optionsHTML += NavBar.formatOneProfile(profile);
  });

  html = html.replace("{{profiles}}", optionsHTML);

  return html;
};

//
//
let emptyCategories = [];

document.addEventListener("DOMContentLoaded", () => {
  emptyCategories.forEach((cat) => {
    let item = document.querySelector(`.navbar__item[data-category="${cat}"]`);
    if (item) {
      item.classList.add("navbar__item--disabled");
    }
  });
});

export { NavBar };
