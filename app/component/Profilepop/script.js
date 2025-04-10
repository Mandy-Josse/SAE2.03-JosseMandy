let templateFile = await fetch("./component/Profilepop/template.html");
let template = await templateFile.text();
let templateFileProfiles = await fetch("./component/Profilepop/templateProfile.html");
let templateProfiles = await templateFileProfiles.text();

let Profilepop = {};


Profilepop.formatOneProfile = function (data) {
  let html = templateProfiles;

  html = html.replace("{{idusers}}", data.idusers);
  html = html.replace("{{profile_name}}", data.name);
  html = html.replace("{{age}}", data.age);

  return html;
};


Profilepop.formatProfileSelector = function (hProfileSelectChange, data) {
  let html = template;
  html = html.replace("{{hProfileSelectChange}}", hProfileSelectChange);

  let optionsHTML = "";
  data.forEach((profile) => {
    optionsHTML += Profilepop.formatOneProfile(profile);
  });
  html = html.replace("{{profiles}}", optionsHTML);
  return html;
};

export { Profilepop };
