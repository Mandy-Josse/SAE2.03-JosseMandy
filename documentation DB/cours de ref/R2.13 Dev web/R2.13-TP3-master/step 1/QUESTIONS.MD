## R2.13-TP3

**Q0 - Objectif**
Regardez la vidéo [objectif.mp4](./objectif.mp4) pour comprendre ce que vous devez obtenir au terme de cette étape.


**Q1 - Mise en place**
Héberger l'application ou plutôt les applications : client et backoffice. 
Ces 2 applications sont disjointes du point de vue HTML/CSS/JS. Elles possèdent néanmoins la même architecture.
En revanche les 2 utilisent la même partie serveur. Comprendre : les 2 font des requêtes HTTP à ../server/script.php.
Le rôle de client et backoffice sont les suivants :

* **client** : 
  * c'est la partie publique qui permet de consulter les menus de la semaine comme dans le TP2
  * elle est complète et fonctionnera **sous réserve de mettre à jour HOST_URL dans data/dataMenu.js**

* **backoffice** :
  * c'est la partie privée qui permet l'administration et la maintenance du site
  * son accès devrait être soumis à authentification mais on verra ça plus tard
  * le backoffice va permettre de mettre à jour les données du site (les menus donc)
  * **le backoffice est incomplet c'est sur cette partie que vous allez travailler**.

**Mettre à jour vos identifiants de connexion** à votre BDD dans server/model.php.
Puis tester en l'état de le backoffice pour voir d'où vous partez.


**Q2 - Créer le formulaire du backoffice - select et submit**
Le formulaire du backoffice est vide. Il correspond au composant component/NewMenuForm.
Ouvrez son template :
* en HTML un formulaire est élément ```<form>``` :
  * l'attribut ```method='GET'```indique que les données du formulaire seront transmises au serveur en 
    les ajoutant à la suite de l'url du serveur (selon le format habituel ```?param1=value1&param2=value2...```)
  * l'attribut ```action="?????"```permet de spécifier l'URL du script serveur à qui les données sont à transmettre.
     **Remplacer les ????? par l'url de votre script.php**. C'est à lui que l'on enverra les données du formulaires.


* Ajouter un champ de type ```<select>``` pour choisir l'un des 7 jours de la semaine.
  * au besoin, documentez-vous [ici](https://developer.mozilla.org/fr/docs/Web/HTML/Element/select)
  * la valeur transmise au serveur sera le nom du jour en minuscule
  * on nommera "jour" ce select

Comment vérifier que cela fonctionne ?
Pour pouvoir valider votre formulaire, ajouter dedans un ```<input type="submit" value="Update" name="todo">```.
Les inputs sont des éléments de formulaire. Il en existe de plusieurs type. Le type _submit_ correspond à un 
bouton d'envoi du formulaire **par le navigateur** (nous verrons comment le faire nous-même plus tard). En cliquant
sur ce bouton, le navigateur va envoyer une requête HTTP à l'URL indiquée par la propriété _action_ de l'élément ```<form>```
en y mettant les données saisies par l'utilisateur.

Observez l'onglet Network des outils de développement et cliquez sur votre submit. Regardez la requête et ce qu'elle contient.
A ce stade, il est normal que le serveur ne nous réponde pas correctement car nous ne l'avons pas encore modifié.

**Q3 - Créer le formulaire du backoffice - input**
Ajoutez à votre formulaire l'élément suivant :  ```<input type='text' name='entree' placeholder='Saisir une entrée'>``` .
Note : la propriété _placeholder_ n'est pas indispensable mais bien pratique pour que l'utilisateur sache ce qu'il doit
saisir dans le champ. Le placeholder disparaît automatiquement dès que la saisie débute dans le champ.
Sur le même modèle, ajoutez un champ pour le plat et un champ pour le dessert.
Testez à nouveau l'envoi du formulaire et vérifiez que les données de ces 3 nouveaux champs se trouvent dans la requête HTTP.
**Notez bien la correspondance entre les noms des champs du formulaire et les paramètres de la requête.**


**Q4 - Ajouter des vérifications quant à la validité des données de formulaire**
Lorsqu'on envoit les données d'un formulaire, on doit préalablement vérifier qu'elles sont valides. En l'état vous constaterez que :
*   il est possible d'envoyer le formulaire sans remplir tous les champs
*   il est possible d'envoyer des nombres comme nom d'entrée/plat/dessert
  
HTML permet différentes vérifications des données de formulaire :
*   ajoutez une propriété _required_ à tous les champs et vérifier qu'il n'est plus possible de ne pas les compléter.
*   ajoutez à vous input de type _text_ les propriétés suivantes ```pattern="[^0-9]+" title="Numbers are not allowed"```
    et vérifiez qu'il n'est plus possible de saisir un chiffre à la place d'un plat

La propriété _pattern_ permet de définir une _expression régulière_ qui exprime le format que doit respecter la saisie.
Dans notre cas ```[^0-9]+```est une expression régulière qui signifie "tout sauf des nombres".
On ne fait que toucher du doigt le vaste sujet des expressions régulières. Sans approfondir, sachez que vous trouverez
aisément des expressions régulières pour valider des saisies courantes telles qu'une adresse email, un numéro de téléphone, 
un code postal etc...
Notons enfin qu'une vérification n'est jamais fiable à 100%. Ici je ne peux plus saisir de chiffre pour un plat, mais je peux
saisir 'ajkv?dd++/#!' qui sera valide sur la forme, mais évidemment par sur le fond. Une expression régulière ne vérifie que la forme.

**Q5 - Modification serveur pour la prise en charge des requête HTTP de type 'mise à jour d'un menu'**
Le formulaire de notre backoffice est désormais fonctionnel. Sa validaton provoque une requête HTTP de la part du navigateur qui
contient les données saisies par l'utilisateur. 
La requête HTTP est donc bonne, reste à faire en sorte que la réponse HTTP du serveur le soit aussi.
La partie serveur est à moitié faite : 
*   dans server/model.php, vous trouverez une fonction ```updateMenu``` capable de mettre à jour un menu de votre BDD
    Prenez le temps de regarder le code et les commentaires pour comprendre comment l'utiliser.
*   dans server/script.php, lisez le commentaire "[ Contrôle de la mise à jour d'un menu ]" et remplacer TODO par le code adapté.
  