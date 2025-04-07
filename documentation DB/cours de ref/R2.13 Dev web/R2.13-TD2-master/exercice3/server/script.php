<?php


require("model.php");// inclusion du fichier model.php qui regroupe les fonctions d'accès à la BDD

/* 
    Complétez le script pour rétablir l'accès aux collections creator expert et  star wars
*/

$legos = [];

if ( isset($_REQUEST['collection'] ) ){

    $collec = $_REQUEST['collection'];

    if ($collec=="creator"){
        $legos = getLegoCreator();
    }
    if ($collec=="creator expert"){
        $legos = getLegoCreatorExpert();
    }
    if ($collec=="star wars"){
        $legos = getLegoStarWars();
    }
    
 
}

echo json_encode($legos);

?>