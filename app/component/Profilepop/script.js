let templateFile = await fetch("./component/Profilepop/template.html");
let template = await templateFile.text();
let templateFileProfiles = await fetch("./component/Profilepop/templateProfile.html");
let templateProfiles = await templateFileProfiles.text();

let Profilepop = {};


Profilepop.formatOneProfile = function (i, data) {
  let html = templateProfiles;

  html = html.replace("{{idusers}}", i);
  html = html.replace("{{profile_name}}", data.name);
  html = html.replace("{{age}}", data.age);

  return html;
};


Profilepop.formatProfileSelector = function (hProfileSelectChange, data) {
  console.log("Données reçues pour formatProfileSelector:", data);

  let html = template;
  html = html.replace("{{hProfileSelectChange}}", hProfileSelectChange);

  let optionsHTML = "";
  for (let i = 0; i < data.length; i++) {
    let profile = data[i];
    optionsHTML += Profilepop.formatOneProfile(i, profile);
  }
  console.log("data = ", data);

  html = html.replace("{{profiles}}", optionsHTML);
  return html;
};

export { Profilepop };
