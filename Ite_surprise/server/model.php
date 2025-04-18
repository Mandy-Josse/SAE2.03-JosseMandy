<?php
    /**
     * Ce fichier contient toutes les fonctions qui réalisent des opérations
     * sur la base de données, telles que les requêtes SQL pour insérer, 
     * mettre à jour, supprimer ou récupérer des données.
     */

    /**
     * Définition des constantes de connexion à la base de données.
     *
     * HOST : Nom d'hôte du serveur de base de données, ici "localhost".
     * DBNAME : Nom de la base de données
     * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
     * DBPWD : Mot de passe pour se connecter à la base de données.
     */
    define("HOST", "localhost");
    define("DBNAME", "SAE203");
    define("DBLOGIN", "usersae203");
    define("DBPWD", "miM01*08jOHTy");


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

function getAllProfiles() {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT * FROM Users";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


///////ADMIN///////////////////ADMIN/////////////////////////ADMIN//////////////////////ADMIN

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