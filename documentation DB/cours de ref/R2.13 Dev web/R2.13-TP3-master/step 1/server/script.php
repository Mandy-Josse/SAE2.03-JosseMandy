<?php

/**
 * Inclusion du fichier model.php.
 * 
 * Ce fichier est requis pour que le script puisse fonctionner correctement.
 * Un erreur se produirait si le fichier n'était pas trouvé.
 * Il contient les fonctions nécessaires pour interagir avec la base de données.
 */
require("model.php");


/*  [ Contrôle de la mise à jour d'un menu ]

    Si la requête HTTP comprend un paramètre 'todo' valant 'Update', on comprend que la
    requête HTTP à traiter provient du formulaire de notre Back Office.
    Le script doit mettre à jour le menu pour un jour donné. Cela implique de récupérer les valeurs
    des paramètres 'jour', 'entree', 'plat' et 'dessert' et de les utiliser pour mettre à
    jour le menu dans la base de données.
    En guise de réponse, le serveur retournera un message indiquant si la mise à jour a réussi ou non.
*/
if ( isset($_REQUEST['todo']) && ($_REQUEST['todo']=='Update')) {
    $jour = $_REQUEST['jour'];
    $plat = $_REQUEST['plat'];
    $dessert = $_REQUEST['dessert'];
    $entree = $_REQUEST['entree'];
    updateMenu($jour, $entree, $plat, $dessert);
    echo("Menu mit à jour");
    exit()
}


/*  [ Contrôle de la demande d'un menu pour un jour donnée ]

    Si la requête HTTP comprend un paramètre 'jour', on comprend que la requête HTTP à traiter
    provient de notre client. Le script doit renvoyer le menu pour le jour demandé.
*/
if ( isset($_REQUEST['jour'] ) && !empty($_REQUEST['jour']) ){
    $jour = $_REQUEST['jour'];
    $menu = getMenu($jour);
    echo json_encode($menu);
    exit(); // termine le script (ce qui est en dessous ne s'exécutera pas)
}

/* 
    Si on atteint ce point du script, c'est que la requête HTTP ne correspond ni à une
    demande de mise à jour d'un menu, ni à une demande d'un menu pour un jour donné.
    Dans ce cas le script répond par un code 404 par défaut.
*/

http_response_code(404);

?>