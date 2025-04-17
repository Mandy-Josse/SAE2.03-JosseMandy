Pour chaque itération, expliquez si vous avez dû modifier la base de données en donnant une justification de vos choix
concernant l'organisation des tables, les associations, les types de données, leurs longueurs,
vos choix pour les clés primaires, etc



__________________________________________________________________________________________________________
Table Movie (Ité1): 
#	    Attributs	                                       Type	                        Raisons du type
1	    id (Primaire)                                      int(11)        		        L'identifiant de chaque film, 11 chiffres possible soit 99 999 999 999 films possible à enregistrer
2	    name	                                           varchar(250)	                255 caractères en cas de noms longs de film
3	    year                                               int(4)             	        Années proches à 4 chiffres	
4	    length                                             int(3)            			Le film le plus long faisait 773 min(12 h 53 min),
5	    description	                                       text	                        Text, description sont des textes volumineux
6	    director	                                       varchar(250)                 255 caractères à nouveau en cas de nom long
7	    id_category (clé étrangère: Category)              int(3)                       Permet 999 catégories en cas de dévellopement ultra précis 
8	    image	                                           varchar(250)                 Nom du fichier de l'image, inclu l'extension, .jpg .webp .png etc...  250 caractères et une marge comfortable
9	    trailer	                                           varchar(250)                 Url du trailer en embed de https:// à l'identifiant complet
10	    min_age	                                           int(2)		                Age minimum général de 18, pourrait être dans les 20 pour certains pays,
                                                                                        ne sera jamais plus de 100 donc 2 en taille suffit 

Création d'une table pour stocker les détails complet des films. Premières itérations ne récupèrent que l'id, le nom et l'affiche.
Puis plus tard la table à évolué pour intégrer toutes les infos des films pour l'itération 3 et les infos détaillées



____________________________________________________________________________________________________________
Table Category (Ité 4):
    Nom                     Type		                    Raisons du type
1   id (Primaire)	        int(3)                          L'identifiant de chaque catégorie, 3 chiffres possible soit 999 de catégorie possible à enregistrer
2   name	                varchar(150)                    Si nom de catégorie précis et long, 50 caractères dans le pire des cas, les noms plus long sont plusieurs catégories les unes à la suites des autres dans la plus part des cas


Uniquement l'id et le nom sont nécessaire dans la table Category pour afficher et trier les films selon leurs catégorie.
Join l'id de la catégorie sur l'id de Category correspondant pour récupérer le nom de la catégorie et l'affichée



_____________________________________________________________________________________________________________
Table Users (Ité 5):
	Nom	                    Type			            Raisons du type
1	idusers (Primaire)	    int(2)		                L'identifiant de chaque catégorie, 11 chiffres possible soit 99 999 999 999 de catégorie possible à enregistrer,
                                                        sachant qu'il y a 8Miliard de personnes sur terre, prochainement atteindra 10Miliard au même rythme,
                                                        donc 11 caractères suffisent dans l'éventualité maximale du nombre d'utilisateur au pire cas.
2	name	                varchar(100)	            100 caractères suffisent pour nommé un profil type, si c'était un nom d'utilisateur il
                                                        faudrait augmenter légèrement pour laissez la liberté aux utilisateurs
3	age	                    int(3)		                Age minimum général de 6 pour certains films, minimum 1, maximum 3 pour inclure les rares centenaires            
4	avatar	                varchar(200)	            Nom du fichier de l'avatar du profil, intègre l'extension, 200 caractères et une marge comfortable


Table Users pour stocker les donnée des profils créés. Pas besoin de plus que l'id, le nom du profil, l'âge associé, et optionellement un avatar.



_________________________________________________________________________________________________________
Table Favoris (Ité 9):
	Nom	                       Type                 Raisons	du type
1	id_fav (Primaire)	           int(11)		        Tous les id sont à 11 chiffres, permet un grand nombre de 99 999 999 999favoris par profile pour le même nombre de profile et de film
2	id_profile	               int(11)			    /
3	id_film	                   int(11)	            /

Table regroupant les Favoris selon les profiles, on récupère l'id du film et l'id du profil pour savoir quel film et dans les favoris de quel profil






















-- Base de données : 'SAE203'
--
CREATE DATABSE IF NOT EXISTS 'SAE203' DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE 'SAE203'