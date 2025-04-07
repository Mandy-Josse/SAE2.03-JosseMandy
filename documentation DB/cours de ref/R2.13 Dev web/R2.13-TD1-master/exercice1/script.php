<?php 

/*  Mon premier script php

    Une "zone PHP" est délimitée par <?php ... ?>.
    Le serveur web repère ces zones et sait ainsi que le contenu doit être exécuté.

    En PHP, une variable commence toujours par $.
    Si on utilise une variable dans une chaîne de caractères, elle sera automatiquement remplacée par sa valeur.
*/

/*  Q1
    Uploadez ce script sur le serveur web, sur votre hébergement.
    Ensuite, depuis la barre d'adresse de votre navigateur, faite une requête HTTP le ciblant.
*/

/*  Q2 
    Modifiez le script pour faire apparaître vos nom et prénom
*/

$nom = "Josse";
$prenom = "Mandy";

// note : echo indique d'inclure la chaine "Bonjour ..." dans la réponse à la requête HTTP
echo "Bonjour $prenom $nom";
?>