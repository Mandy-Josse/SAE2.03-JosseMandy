let templateFile = await fetch("./component/ProfileFormUpdate/template.html");
let template = await templateFile.text();

let updateProfileForm = {};

updateProfileForm.format = function (handler) {
  let html = template;
  html = html.replace("{{handler}}", handler);
  return html;
};

export { updateProfileForm };
