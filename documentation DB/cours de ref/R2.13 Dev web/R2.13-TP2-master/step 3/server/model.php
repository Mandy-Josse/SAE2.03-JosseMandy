<?php
define('DB', 'josse10');
define('DBLOGIN', 'josse10');
define('DBPWD', 'josse10');
/*  getMenu

    paramètre $j : le nom d'un jour de la semaine (une chaîne de caractères)

    La fonction se connecte à votre BDD, sélectionne le menu du jour $j et
    le retourne.

    Aide : exercice 3 ou 4 du TD2
?>
*/

function getMenu($j)
{
    $cnx = new PDO("mysql:host=localhost;dbname=" . DB, DBLOGIN, DBPWD);
    $sql ="SELECT * FROM Repas WHERE jour='$j'";
    $answer = $cnx->query($sql);
    $res = $answer ->fetchAll(PDO::FETCH_OBJ);
    return $res;
}
/*
    Pour tester le bon fonctionnement de votre fonction getMenu, il faut 
    faire un appel et voir un peu ce que ça donne !
    Pour ce, décommentez la ligne ci après et requêtez (après upload sur le serveur !)
    votre fichier model.php depuis la barre d'adresse du navigateur. Si cela marche, 
    vous devez voir (bien que pas très lisible) le menu du lundi s'afficher.
*/
?>