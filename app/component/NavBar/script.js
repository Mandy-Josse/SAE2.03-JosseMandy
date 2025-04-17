let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();
let templateFileProfiles = await fetch("./component/NavBar/templateProfile.html");
let templateProfiles = await templateFileProfiles.text();


const burger = document.getElementById('burger');
const navbarMenu = document.getElementById('navbarMenu');

burger.addEventListener('click', () => {
  burger.classList.toggle('active');
  navbarMenu.classList.toggle('active');
});



let NavBar = {};


NavBar.formatOneProfile = function (i, data) {
  let html = templateProfiles;

  html = html.replace("{{idusers}}", i);
  html = html.replace("{{profile_name}}", data.name);
  html = html.replace("{{age}}", data.age);

  return html;
};


NavBar.format = function (hHome, hProfileSelectChange, hFav, data) {
  let html = template;
  html = html.replace("{{hHome}}", hHome);
  html = html.replace("{{hProfileSelectChange}}", hProfileSelectChange);
  html = html.replace("{{hFav}}", hFav);

  
  let optionsHTML = "";
  for (let i = 0; i < data.length; i++) {
    let profile = data[i];
    optionsHTML += NavBar.formatOneProfile(i, profile);
  }
  console.log("data = ", data);

  html = html.replace("{{profiles}}", optionsHTML);
  return html;
};

export { NavBar };


