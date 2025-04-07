

let templateFile = await fetch('./component/Menu/template.html');
let template = await templateFile.text();


let Menu = {};

Menu.format = function(menu){
    let html= template;
    html = html.replace('{{entree}}', menu.entree);
    html = html.replace('{{plat}}', menu.plat);
    html = html.replace('{{dessert}}', menu.dessert);
    return html;
}

Menu.formatMany = function(menus){
    let html = '';
    for (const menu of menus) {
        html += Menu.format(menu);
    }
    return html;
}

export {Menu};

