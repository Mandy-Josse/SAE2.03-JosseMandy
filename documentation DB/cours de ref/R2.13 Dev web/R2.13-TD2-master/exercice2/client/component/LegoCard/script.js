

let templateFile = await fetch('./component/LegoCard/template.html');
let template = await templateFile.text();


let LegoCard = {};

LegoCard.format = function(lego){
    let html= template;
    html = html.replace('{{name}}', lego.name);
    html = html.replace('{{collection}}', lego.collection);
    html = html.replace('{{pieces}}', lego.pieces);
    html = html.replace('{{price}}', lego.price);
    html = html.replace('{{description}}', lego.description);
    html = html.replace('{{image-bg}}', lego.images.bg);
    return html;
}

LegoCard.formatMany = function(legos){
    let html = '';
    for (const lego of legos) {
        html += LegoCard.format(lego);
    }
    return html;
}

export {LegoCard};

