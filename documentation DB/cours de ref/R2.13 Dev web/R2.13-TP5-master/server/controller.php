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
 * Il contient les fonctions nécessaires pour interagir avec la base de données.
 * Si le fichier n'est pas trouvé, un erreur se produira.
 */
require("model.php");


/** updateController
 * 
 * Cette fonction est en charge du traitement des requêtes HTTP pour lesquelles le paramètre 'todo' vaut 'Update'.
 * Elle récupère les valeurs des paramètres 'jour', 'entree', 'plat' et 'dessert' et utilise la fonction updateMenu
 * déclarée dans model.php pour mettre à jour le menu dans la base de données.
 * en fonctiondu résultat de la mise à jour, elle retourne un message indiquant si la mise à jour a réussi ou non.
 */
function updateController(){
  /* Lecture des données de formulaire
    On ne vérifie pas si les données sont valides, on suppose (faudra pas toujours...) que le client les a déjà
    vérifiées avant de les envoyer 
  */
  $semaine = $_REQUEST['semaine'];
  $jour = $_REQUEST['jour'];
  $entree = $_REQUEST['entree'];
  $plat = $_REQUEST['plat'];
  $dessert = $_REQUEST['dessert'];
  // Mise à jour du menu à l'aide de la fonction updateMenu décrite dans model.php
  $ok = updateMenu($semaine, $jour, $entree, $plat, $dessert);
  // $ok est le nombre de ligne affecté par l'opération de mise à jour dans la BDD (voir model.php)
  if ($ok!=0){
    return "Le menu du $jour semaine $semaine est à jour";
  }
  else{
    return false;
  }
}


/** readControler
 * 
 * Cette fonction est en charge du traitement des requêtes HTTP pour lesquelles le paramètre 'todo' vaut 'read'.
 * Elle vérifie si le paramètre 'jour' est défini et non vide dans la requête et s'il est valide (un jour de la semaine).
 * Si le paramètre 'jour' est présent, elle appelle la fonction getMenu avec le jour spécifié
 * et retourne le menu. Si le paramètre 'jour' n'est pas présent, vide ou invalide, elle retourne false.
 * 
 * @return mixed Le menu pour le jour spécifié si 'jour' est défini, valide et non vide, sinon false.
 */
function readController(){
 
    // PREMIERE VERIFICATION : LES PARAMETRES EXISTENT ET SONT NON VIDES
    // Vérification du paramètre 'semaine' 
    if ( isset($_REQUEST['semaine'])==false || empty($_REQUEST['semaine'])==true ){
        return false;
    }
    // Vérification du paramètre 'jour'
    if ( isset($_REQUEST['jour'])==false || empty($_REQUEST['jour'])==true ){
        return false;
    }

    // DEUXIEME VERIFICATION : LES PARAMETRES EXISTENT MAIS LEUR VALEURS SONT-ELLES VALIDES ?
    $semaine = $_REQUEST['semaine'];
    // $ semaine doit être un entier entre 1 et 52
    if ($semaine<1 || $semaine>52){
        return false;
    }
    $jour = $_REQUEST['jour'];
    // $jour doit être un jour de la semaine
    // Tableau des jours de la semaine, va servir à vérifier si le jour spécifié est valide
    $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
    // in_array retourne true si $jour est dans $days, false sinon. C'est une fonction native PHP.
    if ( in_array($jour, $days)==false ){ // $jour n'est pas un jour de la semaine
       return false;
    }
    
    // si on arrive ici c'est que les paramètres existent et sont valides, on peut interroger la BDD
    // Appel de la fonction getMenu déclarée dans model.php pour extraire de la BDD le menu du jour spécifié
    $menu = getMenu($semaine, $jour);
    return $menu;
}


/** deleteController
 * 
 * Supprime un menu pour une semaine et un jour spécifiques.
 *
 * Cette fonction vérifie la validité des paramètres 'semaine' et 'jour'
 * de la requête, les valide, puis appelle la fonction deleteMenu du modèle
 * pour supprimer le menu.
 *
 * @return mixed Retourne un message de succès si le menu est supprimé avec succès,
 *               ou false si une validation échoue ou si la suppression échoue.
 */
function deleteController() {
  // PREMIERE VERIFICATION : LES PARAMETRES EXISTENT ET SONT NON VIDES
  // Vérification du paramètre 'semaine' 
  if ( isset($_REQUEST['semaine'])==false || empty($_REQUEST['semaine'])==true ){
    return false;
  }
  // Vérification du paramètre 'jour'
  if ( isset($_REQUEST['jour'])==false || empty($_REQUEST['jour'])==true ){
    return false;
  }
  // DEUXIEME VERIFICATION : LES PARAMETRES EXISTENT MAIS LEUR VALEURS SONT-ELLES VALIDES ?
  $semaine = $_REQUEST['semaine'];
  // $ semaine doit être un entier entre 1 et 52
  if ($semaine<1 || $semaine>52){
    return false;
  }
  $jour = $_REQUEST['jour'];
  // $jour doit être un jour de la semaine
  // Tableau des jours de la semaine, va servir à vérifier si le jour spécifié est valide
  $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
  // in_array retourne true si $jour est dans $days, false sinon. C'est une fonction native PHP.
  if ( in_array($jour, $days)==false ){ // $jour n'est pas un jour de la semaine
    return false;
  }

  // si on arrive ici c'est que les paramètres existent et sont valides, on peut interroger la BDD
  // Appel de la fonction getMenu déclarée dans model.php pour extraire de la BDD le menu du jour spécifié
  $menu = deleteMenu($semaine, $jour);
  if ($menu != 0) {
    return true;
  }
  return false;



}