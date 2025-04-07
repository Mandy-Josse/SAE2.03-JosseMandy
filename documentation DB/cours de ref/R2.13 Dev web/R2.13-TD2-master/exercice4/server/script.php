<?php


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