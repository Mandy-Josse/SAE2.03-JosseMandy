
let templateFile = await fetch('./component/Dialog/template.html');
let template = await templateFile.text();

import {Button} from '../Button/script.js';

let Dialog = {};

Dialog.format = function(obj){
    let html = template;
    html = html.replace('{{description}}', obj.description);
    let directions = "";
    for(let p of obj.portes){
        directions = directions + Button.format(p);
    }
    html = html.replace('{{directions}}', directions);
    return html;
}

export {Dialog};