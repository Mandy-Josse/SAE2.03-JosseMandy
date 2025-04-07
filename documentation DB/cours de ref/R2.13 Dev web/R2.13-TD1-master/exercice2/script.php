<?php
/*  Zones multiples et document bien formé

    Il est possible d'alterner des zones PHP avec des zones HTML.
    Le serveur remplacera les zones PHP par le résultat de l'exécution de leur contenu.
    Le tout, zones HTML incluses, sera envoyé au client en réponse à sa requête HTTP.

    Cela permet, contrairement au précédent exercice, d'envoyer au client un document HTML
    correctement formé et non pas une simple chaîne de caractère.
*/

/*  Q1

    Après la première zone PHP, ajoutez un document HTML minimaliste, mais propre.
    Dans un élément h4, vous placerez une zone PHP pour y faire apparaître le message "Hey !, Bonjour Georges Abitbol !"
*/
$nom = "Abitbol";
$prenom = "Georges";

?>
<!DOCTYPE html>
<html lang = "fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TD1 EX1</title>
</head>
<body>
    <h4>Hey, 
        <?php echo "$prenom $nom"?>
        !!!
    <h4>
</body>
</html>