
let templateFile = await fetch('./component/Dialog/template.html');
let template = await templateFile.text();

import {Button} from '../Button/script.js';

let Dialog = {};

/*
    Le paramètre obj est un objet similaire DataDialog (data/dataDialog.js).
*/
Dialog.format = function(obj){
    let html = template;
    console.log(obj);
    html = html.replace("{{description}}", obj.description)

    let buttonsHtml = "";
    for (let porte of obj.portes) {
        buttonsHtml += Button.format(porte);
    }
    html = html.replace("{{directions}}", buttonsHtml)

return html
}

export {Dialog};