<?php

/*  Traitement des paramètres de requête HTTP

    Une requête HTTP peut inclure des paramètres. Par exemple si l'on fait la requête d'url :
    http://.../script.php?nom=Bob
    Et bien nous avons ajouté le paramètre nom à la requête, et il vaut "Bob"

    Si l'on veut ajouter plusieurs paramètres à une requête, il faut les séparer avec le caractère &.
    Par exemple : http://.../script.php?nom=Bob&prenom=Sponge
    Ici on a ajouté 2 paramètres, nom et prenom qui valent respectivement "Bob" et "Sponge"

    Les paramètres d'une requête sont automatiquement accessibles en PHP via la superglobale $_REQUEST
    $_REQUEST est un tableau associatif. C'est à dire qu'au lieu d'accéder à une valeur par un indice (0, 1, 2...), 
    on y accède par une clef (une chaîne) : https://www.w3schools.com/PHP/php_arrays_associative.asp

    S'agissant de $_REQUEST, les clefs sont les noms des paramètres. Dans notre exemple :
    $_REQUEST['nom'] vaut "Bob" et $_REQUEST['prenom'] vaut "Sponge".

    Pour vérifier si ces données existent, on dispose de la fonction isset : https://www.php.net/manual/fr/function.isset.php

    Et comme elles peuvent exister mais être vides, on dispose aussi de la fonction empty : https://www.php.net/manual/fr/function.empty.php
    
*/
$nom = "Doe";
$prenom = "John";


/*  Q1
    Ajoutez les instructions nécessaires pour que, si la requête HTTP comprend des paramètres nom et/ou prénom
    non vides, alors on utilisera leur valeur à la place de "Doe" et/ou "John"
*/

if ((isset($_REQUEST['nom'])) && (!empty($_REQUEST['nom']))) {
    $nom = $_REQUEST['nom'];
}

if ((isset($_REQUEST['prenom'])) && (!empty($_REQUEST['prenom']))) {
    $nom = $_REQUEST['prenom'];
}


?>
<!DOCTYPE html>
<html lang='fr'>
    <head>
        <title>PHP - Exercice 3</title>
    </head>
    <body>
        <h4>Hey ! <?php echo "Bonjour $prenom $nom" ?> !</h4>
    </body>
</html>