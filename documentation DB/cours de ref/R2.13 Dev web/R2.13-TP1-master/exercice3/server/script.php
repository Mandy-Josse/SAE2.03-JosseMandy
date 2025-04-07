<?php

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
?>