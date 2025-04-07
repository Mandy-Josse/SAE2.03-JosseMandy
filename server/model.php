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
    define("DBNAME", "josse10");
    define("DBLOGIN", "josse10");
    define("DBPWD", "josse10");


    function getAllMovies(){
        $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
        $sql = "select id, name, image from Movie";
        $stmt = $cnx->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    };

    
    function getMovieDetails($id){
        $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
        $sql = "SELECT name, year, length, description, director, id_category, image, trailer, min_age FROM Movie WHERE id = $id";
        $stmt = $cnx->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return [$res];
    };



    function addMovie($n, $y, $l, $d1, $d2, $c, $i, $t, $a) {
        $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
        $sql = "INSERT INTO Movie (name, year, length, description, director, id_category, image, trailer, min_age)
                VALUES (:name, :year, :length, :description, :director, :id_categorie, :image, :trailer, :min_age)";
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
?>