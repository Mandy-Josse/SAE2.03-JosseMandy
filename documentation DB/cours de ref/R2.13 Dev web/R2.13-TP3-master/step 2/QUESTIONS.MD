## R2.13-TP3 step 2


### I. Refactoring de la partie serveur

_Refactoring_ signifie reformer/re-structurer. 
La partie serveur ne va pas changer en terme de tâches supportées (envoyer / mettre à jour un menu).
Mais l'organisation du code change pour améliorer sa lisibilité, sa maintenabilité et son évolutivité.

Désormais la partie serveur comporte 3 fichiers avec des rôles bien précis :
* **script.php** : c'est le fichier à qui on adresse toutes les requêtes HTTP
    *   on décide d'harmoniser le format des requêtes qui devront comporter un paramètre todo pour être valides.
    *   en fonction de la valeur du paramètre todo, on confie le traitement de la requête à une fonction de contrôle.
  script.php a un rôle d'aiguillage, il "oriente" la requête vers la bonne fonction de contrôle.
* **controller.php** : c'est le fichier qui contient toutes les fonctions de contrôle. Une par valeur possible du paramètre todo
  * une fonction de contrôle va vérifier qu'il est possible de traiter la requête (paramètres valides par exemple)
  * et si oui, elle exécutera l'opération nécessaire sur la BDD en faisant appel à la bonne fonction de model.php.
  * elle retourne le résultat de cette opération, ou bien faux si elle n'a pas pu être réalisée.
* **model.php** : ça ne change pas, c'est le fichier qui contient les fonctions en charges des opérations nécessaires sur le BDD

Ces 3 fichiers sont donc liés : script.php utilise controller.php qui utilise model.php. Chacun répond aux 3 questions suivantes : 
*   Que signifie la requête HTTP, quelle est la demande ? (script.php)
*   La demande est-elle réalisable et/ou bien formée ? (controller.php)
*   Quelle traitement des données (BDD) nécessite la demande ? (model.php)


**Q1.1**
La partie serveur dont vous disposez pour cette seconde étape est basée sur cette organisation. Mais elle est incomplète.
Il manque en effet le code pour renvoyer le menu d'un jour donné.
Testez la partie client en essayant d'afficher un menu (ça ne marchera pas). 
Mais regardez (dans Network) la requête qui est effectuée. Conformément aux explications précédente, elle comporte désormais un paramètre todo.
En vous basant sur le code existant compléter script.php pour répondre correctement aux requêtes HTTP du client.
Les autres fichiers contiennent déjà tout le nécessaire.

**Q1.2**
Vous aurez trouvé dans controller.php la fonction de controle _readMenu_. Le contrôle du paramètre jour est minimal :
On vérifie seulement qu'il est présent et non vide :
```php
if ( isset($_REQUEST['jour'] )==true && empty($_REQUEST['jour'])==false ){...
```
Mais rien n'empêche d'avoir un paramètre jour contenant "janvier" ou "frites", bref, pas un jour de la semaine.
Interroger le serveur de base de données dans un tel cas n'a pas de sens ne donnera aucun résultat.
Pour y remédier, ajouter dans la fonction _readMenu_ le tableau suivant : 
```php
// Tableau des jours de la semaine, va servir à vérifier si le jour spécifié est valide
$days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
```
Si ```$jour```  est contenu dans ```$days```, on sera certain que c'est un jour valide.
En utilisant la fonction native PHP ```in_array``` modifiez la fonction pour garantir que la valeur de ```$jour``` est valide.
N'oubliez pas [la documentation en ligne de PHP](http://php.net) pour comprendre comment utiliser cette fonction.


### II. Evolution du backoffice

Dans l'étape précédente, l'envoi des données de formulaire est à la charge du navigateur. Lorsque l'utilisateur
clique sur le bouton _submit_, c'est le navigateur qui déclenche une requête HTTP (l'url dans la barre d'adresse change)
incluant les données saisies. C'est donc aussi le navigateur qui reçoit et traite la réponse HTTP du 
serveur : "le menu du ... est à jour". Par défaut le navigateur affiche ce message. L'inconvénient est que l'on "perd"
l'interface du backoffice.
Pour changer ce comportement, il ne faut pas confier l'envoi du formulaire au navigateur. Il faut le gérer nous même en JS.

**Q2.1 - DataMenu.update**
On utilise _DataMenu_ et plus exactement _DataMenu.request_ pour aller chercher les menus de tel ou tel jour.
A présent on va aussi avoir besoin **d'envoyer** un menu au serveur pour qu'il le mette à jour dans la BDD.
Ouvrez le fichier dataMenu.js et ajouter la fonction suivante : 
```js
/** DataMenu.update
 * 
 * Prend en paramètre un objet FormData (données de formulaire) à envoyer au serveur.
 * Ces données sont incluses dans une requête HTTP en méthode POST.
 * Une requête POST au lieu de GET n'affiche pas les données dans l'URL (plus discret).
 * Les données sont placées dans le corps (body) de la requête HTTP. Elles restent visibles mais
 * en utilisant les outils de développement du navigateur (Network > Payload).
 * La requête comprend aussi un paramètre todo valant update pour indiquer au serveur qu'il
 * s'agit d'une mise à jour (car on a codé le serveur pour qu'il sache quoi faire en fonction de la valeur de todo).
 * 
 * @param {*} fdata un objet FormData contenant les données du formulaire à envoyer au serveur.
 * @returns la réponse du serveur.
 */
DataMenu.update = async function (fdata) {
    // fetch possède un deuxième paramètre (optionnel) qui est un objet de configuration de la requête HTTP:
    //  - method : la méthode HTTP à utiliser (GET, POST...)
    //  - body : les données à envoyer au serveur (sous forme d'objet FormData ou bien d'une chaîne de caractères, par exempe JSON)
    let config = {
        method: "POST", // méthode HTTP à utiliser
        body: fdata // données à envoyer sous forme d'objet FormData
    };
    let answer = await fetch(HOST_URL + "/server/script.php?todo=update", config);
    let data = await answer.json();
    return data;
}
```
Lisez bien les commentaires pour comprendre comment _DataMenu.update_ fonctionne.
A présent _DataMenu_ est capable **d'envoyer** des données au serveur. Reste à voir comment l'utiliser.

**Q2.2 C.handler_update**
Lorsque l'utilisateur va valider le formulaire, il faudra exécuter du code pour récupérer les données saisies
et les envoyer au serveur à l'aide de _DataMenu.update_. Dans le fichier index.html, ajoutez à votre contrôleur C
la fonction suivante : 
```js
C.handlerUpdate = async function(){
    // Sélectionne l'élément possédant la classe `.addMenu__form`
    // il s'agit de l'élément <form> du composant NewMenuForm
    let form = document.querySelector('.addMenu__form');
    /* 
        Il faut comprendre l'instruction "new FormData(form)" ainsi : 
        "créer un nouvel objet FormData à partir du formulaire form"
        Les objets FormData sont des objets natifs du langage Javascript.
        Très pratique, les créer revient à extraire automatiquement les données
        du formulaire sous forme de paires clé/valeur ou la clé est le nom de
        l'élément du formulaire et la valeur est la valeur de l'élément.
        Par exemple : {jour: 'lundi', entree: 'salade', plat: 'steak', dessert: 'tarte'}
        Surtout un FormData peut être placé tel quel dans le corps (body) d'une requête
        HTTP pour être envoyé à un serveur.
     */
    let fd = new FormData(form);
    // Attend la réponse de la fonction `DataMenu.update(fd)`
    let res = await DataMenu.update(fd);
    // Affiche le résultat de la mise à jour dans la console
    console.log(res);
}
```
Là encore toutes les explications sont en commentaires. Au besoin sollicitez votre encadrant.
En complément vous pouvez aussi consulter [la documentation sur les objets FormData](https://developer.mozilla.org/fr/docs/Web/API/XMLHttpRequest_API/Using_FormData_Objects)


**Q2.3 Mise à jour du composant NewFormData**
Ouvrez le template du composant _NewMenuForm_. On constate les changements suivants : 
*   L'élément ```<form>``` ne contient plus de propriété ```method``` et ```action```:
    *   car ces propriétés sont utiles au navigateur pour gérer l'envoi du formulaire
    *   mais l'on ne veut plus qu'il s'en occupe, on veut gérer nous-même

*   Il n'y a plus d'élément ```<input type='submit'>```:
    *   car c'est un click sur cet élément qui déclenche la prise en charge du formulaire par le navigateur
    *   et l'on ne veut plus que ça soit le cas
  
*   A la place on trouve un ```<button onclick={{handler}} ...>```
    *   ce tag va nous permettre d'executer notre propre code en cas de click sur ce bouton.
  
Actuellemennt il ne se passe rien lorsqu'on clique sur ce bouton. Encore que, vérifiez la console.
En inspectant le code HTML avec les outils de développement, trouvez ce par quoi le tag ```{{handler}}``` est remplacé.
Puis modifer index.html pour que le la fonction ```C.handlerUpdate()```soit appelée en cas de validation du formulaire.
Si vous y parvenez, vous constaterez :
*   Que le formulaire est de nouveau fonctionnel et permet la mise à jour d'un menu
*   La réponse du serveur (de type "Le menu du ... est à jour") s'affiche dans la console du navigateur (notre interface n'est plus remplacée)

**Q2.3 Ajout du composant Log**
Au besoin, revoyez la vidéo d'objectif : les messages du serveur ne s'affiche pas dans la console, mais dans une sorte 
de petit terminal inclus en haut de page. Il s'agit du composant Log. Il vous est donné complet, vous n'avez rien à 
modifier dans _./backoffice/component/Log/_. Comme pour les autres composants, Log contient une fonction format et c'est la seule
qui vous sera utile.
1.   Modifiez index.html pour faire apparaître le composant Log dans l'élément ```<section id="log">```.
2.   Modifiez la fonction ```C.handlerUpdate```de sorte à ce que les messages du serveur s'affiche dans le composant Log

