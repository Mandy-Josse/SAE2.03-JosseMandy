<?php


require("model.php");



$plats = [];


if ( isset($_REQUEST['jour'] ) )
{
    $jour = $_REQUEST['jour'];

    if ($jour=="lundi"){
        $plats = getMenu("lundi");
    }
    else if ($jour=="mardi"){
        $plats = getMenu("mardi");
    }
    else if ($jour=="mercredi"){
        $plats = getMenu("mercredi");
    }
    else if ($jour=="jeudi"){
      $plats = getMenu("jeudi");
    }
    else if ($jour=="vendredi"){
    $plats = getMenu("vendredi");
    }
    else if ($jour=="samedi"){
    $plats = getMenu("samedi");
    }
    else if ($jour=="dimanche"){
      $plats = getMenu("dimanche");
    }
    else {
      http_response_code(404);
    }
    echo json_encode($plats);
}
// Rappelez-vous que les paramètres des requêtes HTTP sont accessibles
// dans la super globale $_REQUEST (au besoin, un coup d'oeil au TD2)

/*
  Pour testez, requêtez script.php depuis la barre d'adresse du navigateur
  en définissant le paramètre jour. Si cela fonctionne vous devez voir les
  menus des jours correspondant s'afficher au format json.
  */
?>