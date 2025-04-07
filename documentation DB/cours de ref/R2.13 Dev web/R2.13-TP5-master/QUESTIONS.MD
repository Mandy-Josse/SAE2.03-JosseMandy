## R2.13-TP5 Supprimer un menu

Regardez la vidéo d'objectif.

Il s'agit d'ajouter un nouvelle fonctionnalité au backoffice : permettre la suppression d'un menu

Ainsi le backoffice proposera désormais 2 fonctionnalités : 
- ajouter ou mettre à jour un menu
- supprimer un menu

Si l'on se donne (un peu) de mal pour organiser le code de nos applications c'est pour pouvoir
ajouter des fonctionnnalités sans remettre en cause l'existant et sans que cela devienne de plus
en plus compliqué, jusqu'à ne plus y arriver.

Si vous avez bien compris comment fonctionne la première fonctionnnalité (ajouter un menu), alors 
supprimer un menu ne doit vous poser aucun problème. C'est très, très, très similaire. Et la bonne 
nouvelle est qu'il en serait de même pour tout type de fonctionnalité.

Donc les questions ci-dessous vous guident dans votre travail mais pas trop non plus. Car c'est un 
travail que vous avez finalement déjà fait (à 90%).

### 0. Ré-importer la base de données
Si ce n'est déjà fait, importez dans votre BDD le fichier Repas.sql pour restaurer la table Repas.
Elle a la même structure qu'avant mais elle est plus complète : Des menus sont présents pour tous
les jours des 20 premières semaines.

### 1. Modification de la partie server 

**Q1.1 server\\model.php : Ajouter une fonction _deleteMenu_**
Pour rappel, _model.php_ est le fichier où l'on "range" les fonctions en charge du dialogue avec
la base de données. La fonction _deleteMenu_ est celle qui va permettre d'effacer un menu de la table
Repas pour une semaine et un jour donnés. 
Copiez/coller l'entête de cette fonction et complétez son code :

```php
/**
 * Supprime le menu pour un jour spécifique dans la base de données.
 *
 * @param int $s La semaine  (numéro) pour laquelle le menu est supprimé.
 * @param string $j Le jour pour lequel le menu est supprimé.
 * @return int Le nombre de lignes affectées par la requête de suppression.
 * 
 * A SAVOIR: une requête SQL de type delete retourne le nombre de lignes affectées par la requête.
 * Si la requête a réussi, le nombre de lignes affectées sera 1.
 * Si la requête a échoué, le nombre de lignes affectées sera 0.
 */
function deleteMenu($s, $j){
    // etc...
```

**Q1.2 server\\controller.php : Ajouter une fonction _deleteController_**
Pour rappel, _controller.php_ est le fichier où l'on "range" les fonctions en charge du contrôle des paramètres de la requête HTTP au serveur pour être certain qu'on a les bonnes informations pour appeler les fonctions dans _model.php_.
Copiez/coller l'entête de cette fonction et complétez son code :
```php
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
function deleteController(){
    // etc...
```
Note : vous remarquerez que les contrôles à faire dans _deleteController_ sont les mêmes que dans
_updateController_...

**Q1.3 server\\script.php : Prise en charge d'une valeur supplémentaire pour le paramtre _todo_**
Pour rappel, _script.php_ est le fichier cible des requêtes HTTP. Par convention nous avons décider que
toutes requêtes devaient posséder un paramètre _todo_. La valeur de _todo_ nous sert à interpréter la signification de la requête afin d'en confier le traitement au bon contrôleur de _controller.php_. Actuellement, nous prenons en charge les valeurs suivantes :
- "read" : requête en lecture d'un menu. Traitée par _readController_. 
- "update" : requête en ajout/mise à jour d'un nenu. Traitée par _updateController_.
Et à présent il faut ajouter : 
- "delete" : requête en suppression d'un nenu. Traitée par _deleteController_.
  
Le choix de la valeur "delete" est nôtre. C'est en cohérence avec le contrôleur associé.

**Q1.4 server : test**
Nos modifications côté serveur sont terminées. Avant de passer à la partie front côté navigateur, mieux
vaut tester que le serveur est bien en capacité de traiter des requêtes HTTP en suppression.
Interrogez-le pour le vérifier. Par exemple :
```http://mmi.unilim.fr/.../server/script.php?todo=delete&jour=lundi&semaine=1```
Même si la réponse du serveur est bien "le menu du lundi de la semaine 1 est supprimé", assurez-vous en
en vérifiant votre BDD via phpMyAdmin.

### 2. Modification du backoffice (partie front) 

**Q2.1 backoffice\\data\\dataMenu.js : Ajouter une fonction _DataMenu.delete_**
Pour rappel, _DataMenu_ est l'objet qui possède les fonctions nécessaires pour interroger le server à
coup de requêtes HTTP. Actuellement nous avons : 
- _DataMenu.request_ pour faire une requête HTTP en lecture pour un menu donné
- _DataMenu.update_ pour faire une requête HTTP en ajout/mise à jour d'un menu donné
A présent nous avons besoin d'une fonction pour faire des requêtes HTTP en suppression d'un menu donné.
Copiez/coller l'entête de cette fonction et complétez son code :
```js
/** DataMenu.delete
 * 
 *  fait une requête HTTP au serveur pour demander la suppression d'un menu
 *  @param {*} fdata un objet FormData contenant les données du formulaire à envoyer au serveur (semaine et jour)
 *  @returns la réponse du serveur.
*/
DataMenu.delete = async function (fdata) {
    // to complete...
```

**Q2.2 backoffice\\component\\DeleteMenuForm : Ajouter un nouveau composant**
L'interface du backoffice a besoin d'un nouveau composant : un formulaire pour supprimer un menu.
C'est un formulaire simple permettant de saisir un numéro de semaine et un jour de la semaine puis de
valider. En somme, c'est une version simplifiée du composant _NewMenuForm_...
Donc dupliquez le répertoire NewMenuForm et renommez le en DeleteMenuForm.
Editez le template pour supprimer les champs de formulaire qui ne vous sont pas utiles et adaptez le reste.
Je vous recommande de renommer les classes css (idem dans style.css) pour éviter les conflits de nommage entre les 2 composants. N'oubliez pas d'importer le nouveau fichier css dans css/base.css. Adaptez aussi le
contenu de script.js pour renommer le composant et mettre à jour les chemins.

**Q2.3 backoffice\\index.html : Faire apparaître le composant _DeleteMenuForm_**
Dans le corps de la page html, ajouter une section d'identifiant "deleteMenu". C'est là que vous placerez 
votre nouveau composant.
Ajoutez à la vue (V) une fonction _V.renderDeleteMenu_ qui, à l'image de la fonction _V.renderNewMenu_,
formate le composant _DeleteMenuForm_ et le place dans la section d'identfiant "deleteMenu".
Note : pour utiliser le composant _DeleteMenuForm_, n'oubliez pas de l'importer !
Pour tester que ça fonctionne, faites un appel à ```V.renderDeleteMenu("no handler")``` depuis la console
du navigateur. Pour l'instant nous n'avons pas encore écrit de fonction "handler" pour gérer l'envoie des
données de formulaires, mais ça ne doit pas empêcher le composant de s'afficher.

**Q2.4 backoffice\\index.html : Ajouter une fonction 'handler'**
En vous basant sur le handler de l'autre formulaire (_C.handlerUpdate_), écrire une nouvelle fonction
_C.handlerDelete_ qui sera appelée si l'on clique sur le bouton "Delete" du composant DeleteMenuForm.
Mettez ensuite à jour _C.start_ pour que le composant DeleteMenuForm soit correctement formaté et affiché au lancement de l'application. Testez, vérifiez et si besoin... corrigez !
