

let templateFile = await fetch('./component/Menu/template.html');
let template = await templateFile.text();


let Menu = {};

List_ite1.formatMany = function (data) {
    let container = document.createElement("div");
    data.forEach((movie) => {
      container.innerHTML += List_ite1.formatOneCard(movie);
    });
    return template.replace("{{cards}}", container.innerHTML);
  };

Menu.formatMany = function(menus){
    let html = '';
    for (const menu of menus) {
        html += Menu.format(menu);
    }
    return html;
}

export {Menu};

