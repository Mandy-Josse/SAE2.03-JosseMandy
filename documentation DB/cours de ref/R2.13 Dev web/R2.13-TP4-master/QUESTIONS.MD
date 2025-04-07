## R2.13-TP4 Gestion des semaines

Regardez la vidéo d'objectif. 
Il s'agit de prendre en compte les numéros des semaines (de 1 à 52 donc).
Il ne s'agit plus du menu du jour J, mais du menu du jour J de la semaine S.
On avait au plus 7 menus à gérer, on va passer à un potentiel de 7 x 52 = 364 menus.

Cette évolution nécessite des modifications à tous les niveaux : BDD, serveur, client, backoffice.
Vous allez vite vous rendre compte si vous avez compris (ou pas) l'architecture de ce projet.

### 0. Modification de la base de données
À l'aide de _phpMyAdmin_, ajoutez une colonne _semaine_ à la table _Repas_.
Donnez un numéro de semaine valide (1-52) à chaque repas (par exemple 1 pour lundi, 2 pour mardi, etc.).

### 1. Modification de la consultation des menus
On se concentre en premier lieu sur la fonction "consulter les menus". Les questions suivantes sont 
uniquement liées à cette fonction, on s'occupera plus tard de la fonction "mettre à jour les menus".

**Q1.1 server\\model.php : Modification de la fonction _getMenu_**
Pour rappel, _model.php_ est le fichier où l'on "range" les fonctions en charge du dialogue avec
la base de données. La fonction _getMenu_ est celle qui permet de récupérer un menu selon un jour
précisé en paramètre :

```php
/**
 * Récupère le menu pour un jour spécifique dans la base de données.
 *
 * @param string $j Le jour pour lequel le menu est récupéré.
 * @return array Un tableau d'objets contenant l'entrée, le plat principal et le dessert pour le jour spécifié.
 */
function getMenu($j){
    // etc...
```

Le nom d'un jour n'est plus suffisant pour désigner un menu. Il faut aussi indiquer le numéro
de la semaine concernée. L'entête de _getMenu_ doit donc devenir :

```php
/**
 * Récupère le menu pour un jour spécifique dans la base de données.
 *
 * @param string $w La semaine pour laquelle le menu est récupéré.
 * @param string $j Le jour pour lequel le menu est récupéré.
 * @return array Un tableau d'objets contenant l'entrée, le plat principal et le dessert pour le jour spécifié.
 */
function getMenu($w, $j){
    // etc...
```

Modifiez ensuite le code de la fonction pour prendre en compte le paramètre ```$w```.
Au besoin, vous pouvez utiliser phpMyAdmin et sa console SQL pour tester la requête si vous avez un doute.

**Q1.2 server\\controller.php : modification de la fonction _readController_**
Pour rappel, _controller.php_ est le fichier où l'on "range" les fonctions en charge du contrôle des paramètres de la requête HTTP au
serveur pour être certain qu'on a les bonnes informations pour appeler les fonctions dans _model.php_. Donc on remonte la "chaîne de
commandement" en mettant à jour _readController_ qui doit vérifier que la requête s'accompagne bien d'un paramètre 'jour' valide et 
désormais d'un paramètre 'semaine' valide aussi : Complétez le code en remplaçant les "TODO" conformément aux commentaires qui les précèdent.

**Q1.3 server\\script.php : test**
Pour rappel, le fichier _script.php_ est en charge d'appeler le bon contrôleur selon la valeur du paramètre 'todo' de la requête HTTP.
Ça ne change pas, ce fichier n'a pas besoin d'être modifié. 
Mais interrogez-le pour vérifier le bon fonctionnement des deux questions précédentes. Par exemple : ```http://mmi.unilim.fr/.../server/script.php?todo=read&jour=lundi&semaine=1```

**Q1.4 client\\data\\dataMenu.js : modification de la fonction DataMenu.request**
On continue de remonter la chaîne de commandement, ce qui nous emporte du côté du navigateur et plus précisément dans _DataMenu.request_
puisqu'il s'agit de la fonction Javascript en charge d'émettre les requêtes HTTP vers la partie serveur pour demander les données sur tel ou tel menu. Il faut désormais ajouter un paramètre 'semaine' aux requêtes :
```js
/**
     * Fetches data from the server based on the specified day.
     *
     * @param {string} week - The week parameter to be sent to the server.
     * @param {string} day - The day parameter to be sent to the server.
     * @returns The response from the server.
     * 
     * DataMenu.request permet de récupérer des données depuis le serveur.
     * Elle prend en paramètre une semaine (1, 2, ..., 52) et un jour (lundi mardi...)
     * renvoie les données contenues dans la réponse du serveur (data).
     */
DataMenu.request = async function(week, day){
    // tec...
```
Modifiez la fonction conformément à la description.


**Q1.5 client\\index.html : choix d'un numéro de semaine**
Il faut à présent permettre à l'utilisateur de sélectionner un numéro de semaine.
Modifiez le fichier index.html afin d'ajouter, comme dans la vidéo, un champ input de type number que vous nommerez 'semaine'.
Utilisez les propriétés _min_ et _max_ pour contraindre la saisie entre 1 et 52. Au besoin aidez-vous de la [documentation](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/number).

**Q1.6 client\\index.html : modification de la fonction _getMenu_**
Quand l'utilisateur clique (```onclick```) sur un des jours de la semaine, la fonction getMenu est appelée pour le jour désiré.
Mais à présent il faut aussi récupérer la valeur de notre input 'semaine'. Ce n'est pas une information que l'on peut
prédéfinir comme c'est le cas pour les jours de la semaine puisqu'un bouton correspond à un jour précis. Sauf à envisager de placer
364 boutons pour tous les jours de toutes les semaines, mais bon, est-ce bien raisonnable ?
En Javascript il est possible de "lire" la valeur d'un élément ```<input>``` à tout moment.
Il suffit de le sélectionner (par exemple ```let input = document.querySelector(...```) et de lire sa propriété value (```input.value```).
Aidez-vous de ces indications pour modifier la fonction _getMenu_ et ainsi passer les bons paramètres à _DataMenu.request_ conformément aux
modifications apportées dans la précédente question.

**Q1.7 client\\index.html : modification de la fonction _getMenu_, suite et fin**
Votre base de données ne contient pas 364 menus mais 7 actuellement. 
La probabilité que l'utilisateur demande un menu non présent en base est donc de (364 - 7) / 364 = 98.08%.
C'est assez élevé pour que l'on veuille traiter ce cas de figure...
Si le menu demandé existe, le serveur le renvoie sous la forme d'un tableau contenant un menu. Par exemple : 
```js
[
    {
        entree: 'Terrine de faisan', 
        plat: 'Gratin de légumes', 
        dessert: 'Clémentines'
    }
]
```
Mais s'il n'existe pas de menu pour le jour demandé, le serveur renvoie un tableau vide ```[]```. C'est la cause des _undefined_ que l'on voit dans ce cas.
Modifiez encore _getMenu_ de sorte à ce qui si le tableau est vide, on affiche le "faux menu" suivant :
```js
[
    {
        entree: 'Soon...', 
        plat: 'Soon...', 
        dessert: 'Soon...'
    }
]
```

### 2. Modification de la mise à jour des menus
Sur la fonctionnalité "consultation des menus" vous avez été guidés étape par étape. 
Sur la fonctionnalité "mise à jour des menus" vous allez devoir être (davantage) autonome histoire de voir si vous avez tout compris !
Il s'agit toujours de "remonter la chaîne de commandement" du server jusqu'au backoffice cette fois, puisque c'est depuis le backoffice que l'on peut faire les mises à jour des menus : 
*   server\\model.php : modifiez _updateMenu_ pour prendre en compte le numéro de semaine du menu
*   server\\controller.php : modifez _updateController_ pour prendre en compte le numéro de semaine du menu 
*   server\\script.php : rien à modifier. Mais vous pouvez tester vos modifications à l'aide d'une requête depuis la barre d'adresse du navigateur. Note : les requêtes de mise à jour sont en POST (paramètres placés dans le corps de la requête) ce qui normalement n'est pas compatible avec des paramètres placés à la suite de l'URL (donc en GET). Sans entrer dans les détails, la façon dont nous avons procédé vous autorise quand même à tester depuis la barre d'adresse du navigateur.
*   backoffice\\component\\template.html : modifier le formulaire pour ajouter un input 'semaine'

Note : A priori il n'y a pas davantage de modifications à prévoir côté backoffice. Le code existant envoie déjà tout le contenu du 
formulaire au serveur. Si on rajoute un champ au formulaire, il sera de fait pris en compte. Vérifiez dans Network que c'est le cas si besoin.