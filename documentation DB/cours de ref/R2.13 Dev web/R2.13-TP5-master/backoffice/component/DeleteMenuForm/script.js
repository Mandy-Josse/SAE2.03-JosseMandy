

let templateFile = await fetch('./component/DeleteMenuForm/template.html');
let template = await templateFile.text();


let DeleteMenuForm = {};

DeleteMenuForm.format = function(handler){
    let html= template;
    html = html.replace('{{handler}}', handler);
    return html;
}


export {DeleteMenuForm};

