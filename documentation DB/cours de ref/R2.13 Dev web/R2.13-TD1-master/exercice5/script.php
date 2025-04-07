<?php

/*  Q1
    Copier ici votre script du précédent exercice.
    Pas de PHP à produire en plus, juste à l'intégrer pour rendre fonctionnel un menu
    Un menu de navigation a été ajouté dans les pages home/about/portfolio/contact .html
    Faites en sorte de le rendre opérationnel.
*/


$filename = "about.html";

if (isset($_REQUEST['page'])) {
    if ($_REQUEST['page'] == "about") {
        $filename = 'about.html';
    }
    else if ($_REQUEST['page'] == "portfolio") {
        $filename = 'portfolio.html';
    }
    else if ($_REQUEST['page'] == "contact") {
        $filename = 'contact.html';
    }
}


$content = file_get_contents($filename);
echo $content;



?>