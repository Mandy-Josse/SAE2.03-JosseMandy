<?php
/*  Question

    Note : 
    Ce script PHP ne dialogue pas avec un serveur de base de données.
    Il charge directement des fichiers au format JSON en retourne leur contenu dans la réponse HTTP
    
    Qu'est-ce que le format JSON ?
    Le JavaScript Object Notation (JSON) est un format standard utilisé pour représenter des données
    structurées de façon semblable aux objets Javascript. Il est habituellement utilisé pour structurer
    et transmettre des données sur des sites web (par exemple, envoyer des données depuis un serveur
    vers un client afin de les afficher sur une page web ou vice versa).
    En savoir plus : https://developer.mozilla.org/fr/docs/Learn/JavaScript/Objects/JSON

    Q1:
    Ecrire ce script de sorte à ce que :
    Si l'on fait une requête HTTP ciblant script.php incluant un paramètre direction ayant pour
    valeur le nom d'une pièce (entree, salon, couloir, grenier...), le script répond en renvoyant
    au client le contenu du fichier json correspondant.
    Par exemple, si l'on fait une requête HTTP ciblant http://.../script.php?direction=salon, 
    le script devra renvoyer le contenu du fichier "data-salon.json".

    Par défaut, si jamais la valeur du paramètre direction ne devait correspondre à aucune pièce 
    connue, le script devra retourner les données "data-entree.json"

    Vous testerez le bon comportement de ce script en effectuant vos requêtes "à la main" depuis la
    barre d'adresse de votre navigateur ou bien en utilisant l'extension Thunder Client de VS Code.

    Indication :
    Alternativement à la structure if/else if vous pouvez également utiliser la structure switch/case
    (https://www.php.net/manual/fr/control-structures.switch.php).
    Ces 2 écritures sont équivalentes en terme de logique. La second peut présenter l'avantage d'être
    un peu plus lisible.
*/

$filename = "data-entree.json";

if (isset($_REQUEST["direction"])) 
{
    $direction = $_REQUEST["direction"];
    /*
    if ($direction == "balcon")
    {
        $filename ="data-balcon.json":
    }
    else if ($direction == "bureau")
    {
        $filename ="data-bureau.json":
    }
        */

    switch ($direction) {
        case "balcon":
            $filename ="data-balcon.json";
            break;
        case "bureau":
            $filename ="data-bureau.json";
            break;
        case "cellier":
            $filename ="data-cellier.json";
            break;
        case "chambre":
            $filename ="data-chambre.json";
            break;
        case "couloir":
            $filename ="data-couloir.json";
            break;
        case "cuisine":
            $filename ="data-cuisine.json";
            break;
        case "death":
            $filename ="data-death.json";
            break;
        case "entree":
            $filename ="data-entree.json";
            break;
        case "escalier":
            $filename ="data-escalier.json";
            break;
        case "grenier":
            $filename ="data-grenier.json";
            break;
        case "salon":
            $filename ="data-salon.json";
            break;
        case "sortie":
            $filename ="data-sortie.json";
            break;
        case "terrasse":
            $filename ="data-terrasse.json";
            break;
        case "velux":
            $filename ="data-velux.json";
            break;
    }
}

$data = file_get_contents($filename);
echo $data;