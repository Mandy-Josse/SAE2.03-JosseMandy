<?php

/** ARCHITECTURE PHP SERVEUR  : Rôle du fichier controller.php
 * 
 *  Dans ce fichier, on va définir les fonctions de contrôle qui vont traiter les requêtes HTTP.
 *  Les requêtes HTTP sont interprétées selon la valeur du paramètre 'todo' de la requête (voir script.php)
 *  Pour chaque valeur différente, on déclarera une fonction de contrôle différente.
 * 
 *  Les fonctions de contrôle vont éventuellement lire les paramètres additionnels de la requête, 
 *  les vérifier, puis appeler les fonctions du modèle (model.php) pour effectuer les opérations
 *  nécessaires sur la base de données.
 *  
 *  Si la fonction échoue à traiter la requête, elle retourne false (mauvais paramètres, erreur de connexion à la BDD, etc.)
 *  Sinon elle retourne le résultat de l'opération (des données ou un message) à includre dans la réponse HTTP.
 */

/** Inclusion du fichier model.php
 *  Pour pouvoir utiliser les fonctions qui y sont déclarées et qui permettent
 *  de faire des opérations sur les données stockées en base de données.
 */
require("model.php");





////APP//////////////////APP/////////////////APP///////////////////////////////////APP/////////////////APP//////////////////APP//////////////////APP/////////////////APP//////////////

function readMoviesController() { 
    if (isset($_REQUEST['age'])) {
        $age = $_REQUEST['age'];
        $movies = getAllMovies($age);
        // var_dump($movies);
        return $movies;
    } else {
        echo json_encode(['error' => 'Missing age parameter']);
        http_response_code(400); // Bad Request
        exit();
    }
}
function getMovieDetailsController () {
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id']; // Get ID
        $movies = getMovieDetails($id); // Pass ID to function
        return $movies;
    } else {
        echo json_encode(['error' => 'Missing id parameter']);
        http_response_code(400); // Bad Request
        exit();
    }
}
function readMoviesGroupedController() {
    return getMoviesGroupedByCategory();
}



function readProfilesController() {
    $profiles = getAllProfiles();
    return $profiles;
}








function getFavController() {
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $favorites = getFavByProfile($id);
        return $favorites;
        
    } else {
        echo json_encode(['error' => 'Missing id parameter']);
        http_response_code(400); // Bad Request
        exit();
    }
}
function addFavController() {
    $id_profile = (int) $_REQUEST['id_profile'];
    $id_film = (int) $_REQUEST['id_film'];

    $ok = addFav($id_profile, $id_film);

    if ($ok === 1) {
        return ["success" => true, "message" => "Le film a bien été ajouté aux favoris."];
    } else if ($ok === -1) {
        return ["success" => false, "message" => "Le film est déjà dans les favoris."];
    } else {
        return ["success" => false, "message" => "Une erreur est survenue lors de l’ajout du favori."];
    }
}

function delFavController() {
    $id_fav = $_REQUEST['id_fav'];

    $ok = delFav($id_fav);
    if ($ok === 1) {
        return ["success" => true, "message" => "Le film a bien été retiré des favoris."];
    } else {
        return ["success" => false, "message" => "le film n'est pas dans les favoris"];
    }

}



/////ADMIN///////////ADMIN///////////////ADMIN///////////////ADMIN////////////////ADMIN///////////////ADMIN///////////////ADMIN////////////////ADMIN///////////////ADMIN///////////////ADMIN

function addMovieController() {
    $titre = $_REQUEST['title'];
    $annee = $_REQUEST['annee'];
    $duree = $_REQUEST['duree'];
    $description = $_REQUEST['description'];
    $realisateur = $_REQUEST['realisateur'];
    $id_category = $_REQUEST['id_category'];
    $affiche = $_REQUEST['affiche_name'];
    $URLtrailer = $_REQUEST['trailer'];
    $age = $_REQUEST['min_age'];

    $ok = addMovie($titre, $annee, $duree, $description, $realisateur,$id_category, $affiche, $URLtrailer, $age);

    if ($ok != 0) {
     return ["success" => true, "message" => "Le film $titre a bien été ajouté."];
    } else {
        return ["success" => false, "message" => "Erreur lors de l'ajout du film."];
    }
}


function addprofileController() {
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $avatar = $_REQUEST['avatar'];

    $ok = addProfile($name, $age, $avatar);

    if ($ok === 1) {
        return ["success" => true, "message" => "Le profil $name a bien été ajouté."];
    } elseif ($ok === -1) {
        return ["success" => false, "message" => "Ce nom de profil existe déjà."];
    } else {
        return ["success" => false, "message" => "Une erreur technique est survenue."];
    }
}


function updateProfileController() {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $avatar = $_REQUEST['avatar'];


    // Validation rapide
    if (!is_numeric($id)) {
        return ["message" => "Selectionnez un profil à modifier."];
    }
    if (!is_numeric($age) || empty($name) || empty($avatar)) {
        return ["message" => "Données invalides."];
    }

    $ok = updateProfile($id, $name, $age, $avatar);

    if ($ok > 0){
        return ["message" => "Le profil '$name', $id a été modifié avec succès."];
    } else {
        return ["message" => "Erreur lors de la modification du profil '$name', $id."];
    }
}


?>