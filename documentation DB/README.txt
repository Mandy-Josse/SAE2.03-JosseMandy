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
3	age	                    varchar(3)		                Age minimum général de 6 pour certains films, minimum 1, maximum 3 pour inclure les rares centenaires            
4	avatar	                varchar(200)	            Nom du fichier de l'avatar du profil, intègre l'extension, 200 caractères et une marge comfortable


Table Users pour stocker les donnée des profils créés. Pas besoin de plus que l'id, le nom du profil, l'âge associé, et optionellement un avatar.



_________________________________________________________________________________________________________
Table Favoris (Ité 9):
	Nom	                       Type                 Raisons	du type
1	id_fav (Primaire)	       int		            Tous les id sont à 11 chiffres, permet un grand nombre de 99 999 999 999favoris par profile pour le même nombre de profile et de film
2	id_profile	               int			        /
3	id_film	                   int	                /

Table regroupant les Favoris selon les profiles, on récupère l'id du film et l'id du profil pour savoir quel film et dans les favoris de quel profil


_____________________________________________________
LES FONCTIONS


Récupère l'id, nom, et affiche de tous les films dessous de l'age en paramètre, soit l'âge du profile utilisateur
afin d'afficher uniquement les cartes sans récupérer toutes les informations de tout les films

function getAllMovies($age){
    /* if (!isset($age) || $age === null) {
        $age = 0;
    } */
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "select id, name, image from Movie WHERE :age >= min_age";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':age', $age);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res;
};









Récupère toute les infos d'un seul film selon l'id donnée, ici l'id d'un film. Utilisé lors d'un click sur une carte basique pour afficher plus d'info,
évite le surload d'action et surchargement de donnée

function getMovieDetails($id){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT 
                m.name, 
                m.year, 
                m.length, 
                m.description, 
                m.director, 
                c.name AS category, 
                m.image, 
                m.trailer, 
                m.min_age 
            FROM Movie m
            JOIN Category c ON m.id_category = c.id
            WHERE m.id = :id";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_OBJ);
    return [$res];
}







A partir des infos récupérer par getCategories; selon chaque catrégory
récupère tout les films présent avec uniquement l'id le nom et l'affiche pour un affichage basique en catégorie
Puis tries les films selon les catégories

function getMoviesGroupedByCategory() {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT 
                c.name AS category,
                m.id,
                m.name,
                m.image
            FROM Movie m
            JOIN Category c ON m.id_category = c.id
            ORDER BY c.name, m.name";

    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $grouped = [];

    foreach ($rows as $row) {
        $cat = $row['category'];
        if (!isset($grouped[$cat])) {
            $grouped[$cat] = [];
        }

        $grouped[$cat][] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'image' => $row['image']
        ];
    }

    $result = [];
    foreach ($grouped as $catName => $movies) {
        $result[] = [
            'category' => $catName,
            'movies' => $movies
        ];
    }

    return $result;
}










Récupère toutes les données de tout les profiles pour la selection

function getAllProfiles() {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT * FROM Users";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}










permet l'ajout d'un films dans la BDD

function addMovie($n, $y, $l, $d1, $d2, $c, $i, $t, $a) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "INSERT INTO Movie (name, year, length, description, director, id_category, image, trailer, min_age)
            VALUES (:name, :year, :length, :description, :director, :id_category, :image, :trailer, :min_age)";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':name', $n);
    $stmt->bindParam(':year', $y);
    $stmt->bindParam(':length', $l);
    $stmt->bindParam(':description', $d1);
    $stmt->bindParam(':director', $d2);
    $stmt->bindParam(':id_category', $c);
    $stmt->bindParam(':image', $i);
    $stmt->bindParam(':trailer', $t);
    $stmt->bindParam(':min_age', $a);
    $stmt->execute();
    $res = $stmt->rowCount(); 
    return $res;
}















permet l'ajout d'un profile dans la BDD


function addProfile($n, $y, $a) {
    try {
        $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si le nom existe déjà
        $checkSql = "SELECT COUNT(*) FROM Users WHERE name = :name";
        $checkStmt = $cnx->prepare($checkSql);
        $checkStmt->bindParam(':name', $n);
        $checkStmt->execute();
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            // Le nom existe déjà
            return -1;
        }

        // Insérer le nouveau profil
        $sql = "INSERT INTO Users (name, age, avatar) VALUES (:name, :age, :avatar)";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':name', $n);
        $stmt->bindParam(':age', $y);
        $stmt->bindParam(':avatar', $a);
        $stmt->execute();

        return $stmt->rowCount();
    } catch (PDOException $e) {
        return 0;
    }
}













Récupère tout les favoris d'un profil selon l'id du profil

function getFavByProfile($id_profile) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    
    $sql = "SELECT f.id, f.name, f.image 
            FROM Favoris fav
            JOIN Movie f ON fav.id_film = f.id
            WHERE fav.id_profile = :id_profile";
            
    
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_profile', $id_profile, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}










Permet d'ajouter un favoris à la liste de favoris d'un profil, prend en compte l'id du film ajouté et l'id du profil correspondant

function addFav($id_profile, $id_film) {
    try {
        $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si le favori existe déjà
        $checkSql = "SELECT COUNT(*) FROM Favoris WHERE id_profile = :id_profile AND id_film = :id_film";
        $checkStmt = $cnx->prepare($checkSql);
        $checkStmt->bindParam(':id_profile', $id_profile, PDO::PARAM_INT);
        $checkStmt->bindParam(':id_film', $id_film, PDO::PARAM_INT);
        $checkStmt->execute();

        $count = $checkStmt->fetchColumn(); // récupère le COUNT(*)

        if ($count > 0) {
            return -1; // déjà présent
        }

        // Ajout du favori
        $sql = "INSERT INTO Favoris (id_profile, id_film) VALUES (:id_profile, :id_film)";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id_profile', $id_profile, PDO::PARAM_INT);
        $stmt->bindParam(':id_film', $id_film, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount(); // renvoie 1 si l'insertion a réussi
    } catch (PDOException $e) {
        return 0; // erreur PDO
    }
}













permet de retirer un favoris de la liste de favoris de la BDD

function delFav($id_film, $id_profile) {
    try {        
        $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si le favori existe déjà
        $checkSql = "SELECT COUNT(*) FROM Favoris WHERE id_film = :id_film AND id_profile = :id_profile";
        $checkStmt = $cnx->prepare($checkSql);
        $checkStmt->bindParam(':id_film', $id_film, PDO::PARAM_INT); 
        $checkStmt->bindParam(':id_profile', $id_profile, PDO::PARAM_INT); 
        $checkStmt->execute();

        $count = $checkStmt->fetchColumn(); // récupère le COUNT(*)
        if ($count === 0) {
            return -1; // pas présent
        }

        $sql = "DELETE FROM Favoris WHERE id_film = :id_film AND id_profile = :id_profile";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id_film', $id_film, PDO::PARAM_INT);
        $stmt->bindParam(':id_profile', $id_profile, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->rowCount();
        
    } catch (PDOException $e) {
        return 0; // erreur PDO
    }
}















Permet la mise à jour d'un profil utilisateur

function updateProfile($id, $name, $age, $avatar){
    try {
        $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE Users SET name = :name, age = :age, avatar = :avatar WHERE idusers = :id";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->execute();

        return $stmt->rowCount(); // > 0 si maj réussie
    } catch (PDOException $e) {
        return 0;
    }
}

?>

























































-- Base de données : 'SAE203'
--
CREATE DATABSE IF NOT EXISTS 'SAE203' DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE 'SAE203'