let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();
let templateFileProfiles = await fetch("./component/NavBar/templateProfile.html");
let templateProfiles = await templateFileProfiles.text();

let NavBar = {};


NavBar.formatOneProfile = function (data) {
  let html = templateProfiles;

  html = html.replace("{{idusers}}", data.idusers);
  html = html.replace("{{profile_name}}", data.name);
  html = html.replace("{{age}}", data.age);

  return html;
};


NavBar.format = function (hAbout, hProfile, hProfileSelectChange, data) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{hProfile}}", hProfile);
  html = html.replace("{{hProfileSelectChange}}", hProfileSelectChange);

  let optionsHTML = "";
  data.forEach((profile) => {
    optionsHTML += NavBar.formatOneProfile(profile);
  });

  html = html.replace("{{profiles}}", optionsHTML);
  return html;
};

export { NavBar };
