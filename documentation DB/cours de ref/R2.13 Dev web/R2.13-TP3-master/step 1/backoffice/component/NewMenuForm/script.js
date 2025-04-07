

let templateFile = await fetch('./component/NewMenuForm/template.html');
let template = await templateFile.text();


let NewMenuForm = {};

/** NewMenuForm.format
 * A ce stade, cette fonction se contente de retourner le template en l'état.
 * @returns {String} html
 */
NewMenuForm.format = function(){
    let html= template;
    return html;
}


export {NewMenuForm};

