<?php
/** ARCHITECTURE PHP SERVEUR : Rôle du fichier script.php
 * 
 * Ce fichier est celui à qui on adresse toutes les requêtes HTTP.
 * Pour être valide, on décide que chaque requête doit contenir un paramètre 'todo'.
 * C'est un choix d'implémentation, on aurait pu choisir un autre nom de paramètre.
 * L'interprétation de la requête se fait en fonction de la valeur du paramètre 'todo'.
 * Selon cette valeur, on fait appelle à la fonction de contrôleur (voir controller.php)
 * appropriée pour traiter la requête HTTP et produire la réponse HTTP attendue..
 * 
 * Pourquoi faire comme ça ?
 * 
 *  En ajoutant un paramètre 'todo' dans la requête, on a un seul paramètre à regarder pour déterminer l'action à effectuer.
 *  Sinon il faudrait toujours analyser tous les paramètres de la requête pour déterminer l'action à effectuer.
 *  Et dans une véritable application il peut y avoir énormément de paramètres, ce qui deviendrait compliqué et illisible.
 * 
 */

/**
 * Inclusion du fichier controller.php.
 * 
 * Il contient les fonctions nécessaires pour traiter chaque type de requête
 * et définir la réponnse à renvoyer au client.
 */
require("controller.php");

/**
 * Vérifie si la variable 'todo' est définie dans la requête.
 * 
 * Cette condition permet de déterminer si un paramètre 'todo' a été envoyé
 * via une requête HTTP. 
 * Si ce paramètre est présent, le code à l'intérieur du bloc conditionnel sera exécuté.
 */
if ( isset($_REQUEST['todo']) ){

  /**
   * La fonction PHP header permet de définir l'en-tête HTTP de la réponse.
   * 
   * A ce stade on sait qu'on va répondre à la requête HTTP avec du contenu JSON (même pour signaler une erreur).
   * Donc on définit de suite l'en-tête de la réponse HTTP pour indiquer que le contenu sera de type JSON.
   * Ce n'est pas obligatoire, mais c'est une bonne pratique pour indiquer clairement le type de contenu.
   */
  header('Content-Type: application/json');
  $todo = $_REQUEST['todo'];
  switch ($todo) {

    case 'getAllMovies':
      $data = readMoviesController();
      break;

    case 'addMovie':
      $data = addMovieController();
      break;

    case 'addProfile':
      $data = addprofileController();
      break;
    case 'updateProfile':
      $data = updateProfileController();
      break;

    case 'getMovieDetails':
      $data = getMovieDetailsController();
      break;

    case 'readMoviesGrouped':
    $data = readMoviesGroupedController();
    break;

    case 'readProfiles':
    $data = readProfilesController();
    break;

      
    default:
      echo json_decode('[error] unknown todo value');
      http_response_code(400);
      exit();
  }

  if ($data === false) {
    echo json_encode('[error] Controller returns false');
    http_response_code(500);
    exit();
  }

  echo json_encode($data);
  http_response_code(200);
  exit();
}

http_response_code(404);

?>