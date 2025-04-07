<?php

function getLegoCreator(){
    $data = file_get_contents("data.json");
    $data = json_decode( $data );
    $res = []; // tableau vide
    foreach($data as $item){ // parcours des données
        if ($item->collection == "Creator") { // si c'est la bonne collection
            $res[] = $item; // ajout (à la suite) de $item au tableau
        }
    }
    return $res;
}


function getLegoCreatorExpert(){
    $data = file_get_contents("data.json");
    $data = json_decode( $data );
    $res = []; // tableau vide
    foreach($data as $item){ // parcours des données
        if ($item->collection == "Creator Expert") { // si c'est la bonne collection
            $res[] = $item; // ajout (à la suite) de $item au tableau
        }
    }
    return $res;
}

function getLegoStarWars(){
    $data = file_get_contents("data.json");
    $data = json_decode( $data );
    $res = []; // tableau vide
    foreach($data as $item){ // parcours des données
        if ($item->collection == "Star Wars") { // si c'est la bonne collection
            $res[] = $item; // ajout (à la suite) de $item au tableau
        }
    }
    return $res;
}
?>