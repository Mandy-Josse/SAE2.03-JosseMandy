<?php


/*  Indications

    1. En vous basant sur votre compréhension de ce script serveur.
    Faites des requêtes HTTP depuis la barre d'adresse de votre navigateur
    pour interroger correctement ce script.

    2. Selon la valeur du paramètre collection, le script n'utilise pas la même fonction
    pour obtenir les données à renvoyer au client.
    Où sont définies ces fonctions ? Quel fichier faut-il ouvrir pour les consulter ?
    Qu'en déduisez-vous sur le rôle de l'instruction require("model.php") ?
*/ 

require("model.php");

$legos = [];

if ( isset($_REQUEST['collection'] ) ){

    $collec = $_REQUEST['collection'];

    if ($collec=="creator"){
        $legos = getLegoCreator();
    }
    else if ($collec=="creator expert"){
        $legos = getLegoCreatorExpert();
    }
    else if ($collec=="star wars"){
        $legos = getLegoStarWars();
    }
}

echo json_encode($legos);

?>