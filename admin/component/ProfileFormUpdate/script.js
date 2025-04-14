let templateFile = await fetch("./component/ProfileFormUpdate/template.html");
let template = await templateFile.text();
let templateFileProfiles = await fetch("./component/ProfileFormUpdate/templateProfile.html");
let templateProfiles = await templateFileProfiles.text();

let updateProfileForm = {};

updateProfileForm.formatOneProfile = function (i, data) {
  let html = templateProfiles;

  html = html.replace("{{idusers}}", i);
  html = html.replace("{{profile_name}}", data.name);
  html = html.replace("{{age}}", data.age);

  return html;
};



updateProfileForm.format = function (handler, hProfileSelectChange, data) {
  let html = template;
  html = html.replace("{{handler}}", handler);
  html = html.replace("{{hProfileSelectChange}}", hProfileSelectChange);

  let optionsHTML = "";
  for (let i = 0; i < data.length; i++) {
    let profile = data[i];
    optionsHTML += updateProfileForm.formatOneProfile(i+1, profile);
  }
  console.log("data = ", data);

  html = html.replace("{{profiles}}", optionsHTML);


  return html;
};

export { updateProfileForm };
