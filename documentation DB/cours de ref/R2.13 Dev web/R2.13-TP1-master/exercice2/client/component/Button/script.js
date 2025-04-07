

let templateFile = await fetch('./component/Button/template.html');
let template = await templateFile.text();


let Button = {};

Button.format = function(text){
    let html= template;
    html = html.replace('{{text}}', text);
    return html;
}

export {Button};

