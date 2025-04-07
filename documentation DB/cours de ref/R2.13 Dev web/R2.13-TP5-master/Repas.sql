-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 14 mars 2025 à 09:49
-- Version du serveur : 10.11.6-MariaDB-0+deb12u1
-- Version de PHP : 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `crespp01`
--

-- --------------------------------------------------------

--
-- Structure de la table `Repas`
--

CREATE TABLE `Repas` (
  `semaine` int(11) NOT NULL,
  `jour` varchar(25) NOT NULL,
  `entree` varchar(256) NOT NULL,
  `plat` varchar(256) NOT NULL,
  `dessert` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Repas`
--

INSERT INTO `Repas` (`semaine`, `jour`, `entree`, `plat`, `dessert`) VALUES
(1, 'lundi', 'radis beurre', 'steak frites', 'fromage blanc'),
(1, 'mardi', 'salade de quinoa', 'poulet roti', 'fruit'),
(1, 'mercredi', 'soupe de légumes', 'poisson grillé', 'yaourt'),
(1, 'jeudi', 'asperges vinaigrette', 'boeuf bourguignon', 'glace'),
(1, 'vendredi', 'carottes râpées', 'poulet curry', 'tarte aux pommes'),
(1, 'samedi', 'tomates mozzarella', 'pâtes carbonara', 'flan'),
(1, 'dimanche', 'salade niçoise', 'roti de porc', 'fruit de saison'),
(2, 'lundi', 'avocat crevettes', 'steak haché', 'compote de pommes'),
(2, 'mardi', 'taboulé', 'poulet basquaise', 'mousse au chocolat'),
(2, 'mercredi', 'velouté de potiron', 'poisson en papillote', 'crème caramel'),
(2, 'jeudi', 'salade de betteraves', 'boeuf stroganoff', 'tarte aux fraises'),
(2, 'vendredi', 'céleri rémoulade', 'poulet tandoori', 'panna cotta'),
(2, 'samedi', 'salade grecque', 'lasagnes végétariennes', 'clafoutis'),
(2, 'dimanche', 'salade de lentilles', 'roti de veau', 'sorbet'),
(3, 'lundi', 'salade de chou', 'steak de thon', 'fromage blanc'),
(3, 'mardi', 'salade de pommes de terre', 'poulet au citron', 'fruit'),
(3, 'mercredi', 'soupe de courgettes', 'poisson au four', 'yaourt'),
(3, 'jeudi', 'salade de poivrons', 'boeuf aux oignons', 'glace vanille'),
(3, 'vendredi', 'salade de chou-fleur', 'poulet tikka', 'tarte tatin'),
(3, 'samedi', 'salade de haricots verts', 'spaghetti bolognaise', 'flan pâtissier'),
(3, 'dimanche', 'salade de roquette', 'roti d agneau', 'fruit de saison'),
(4, 'lundi', 'salade de céleri', 'steak de saumon', 'compote de poires'),
(4, 'mardi', 'salade de maïs', 'poulet à la moutarde', 'mousse de fruits'),
(4, 'mercredi', 'soupe de poireaux', 'poisson vapeur', 'crème brûlée'),
(4, 'jeudi', 'salade de radis', 'boeuf à la bière', 'tarte aux abricots'),
(4, 'vendredi', 'salade de fenouil', 'poulet au curry vert', 'pudding'),
(4, 'samedi', 'salade de pois gourmands', 'gratin dauphinois', 'clafoutis aux cerises'),
(4, 'dimanche', 'salade de mâche', 'roti de dinde', 'sorbet citron'),
(5, 'lundi', 'salade de chou rouge', 'steak de boeuf', 'fromage blanc'),
(5, 'mardi', 'salade de quinoa', 'poulet à l estragon', 'fruit'),
(5, 'mercredi', 'soupe de champignons', 'poisson frit', 'yaourt'),
(5, 'jeudi', 'salade de courgettes', 'boeuf à la tomate', 'glace pistache'),
(5, 'vendredi', 'salade de brocoli', 'poulet au gingembre', 'tarte aux prunes'),
(5, 'samedi', 'salade de pommes', 'pâtes au pesto', 'flan coco'),
(5, 'dimanche', 'salade de roquette', 'roti de boeuf', 'fruit de saison'),
(6, 'lundi', 'salade de carottes', 'steak de porc', 'compote de pêches'),
(6, 'mardi', 'salade de riz', 'poulet au paprika', 'mousse au citron'),
(6, 'mercredi', 'soupe de potiron', 'poisson grillé', 'crème anglaise'),
(6, 'jeudi', 'salade de tomates', 'boeuf aux carottes', 'tarte aux poires'),
(6, 'vendredi', 'salade de concombre', 'poulet au sésame', 'panna cotta aux fruits rouges'),
(6, 'samedi', 'salade de pâtes', 'lasagnes au saumon', 'clafoutis aux pommes'),
(6, 'dimanche', 'salade de lentilles', 'roti de veau', 'sorbet framboise'),
(7, 'lundi', 'salade de chou', 'steak de thon', 'fromage blanc'),
(7, 'mardi', 'salade de pommes de terre', 'poulet au citron', 'fruit'),
(7, 'mercredi', 'soupe de courgettes', 'poisson au four', 'yaourt'),
(7, 'jeudi', 'salade de poivrons', 'boeuf aux oignons', 'glace vanille'),
(7, 'vendredi', 'salade de chou-fleur', 'poulet tikka', 'tarte tatin'),
(7, 'samedi', 'salade de haricots verts', 'spaghetti bolognaise', 'flan pâtissier'),
(7, 'dimanche', 'salade de roquette', 'roti d agneau', 'fruit de saison'),
(8, 'lundi', 'salade de céleri', 'steak de saumon', 'compote de poires'),
(8, 'mardi', 'salade de maïs', 'poulet à la moutarde', 'mousse de fruits'),
(8, 'mercredi', 'soupe de poireaux', 'poisson vapeur', 'crème brûlée'),
(8, 'jeudi', 'salade de radis', 'boeuf à la bière', 'tarte aux abricots'),
(8, 'vendredi', 'salade de fenouil', 'poulet au curry vert', 'pudding'),
(8, 'samedi', 'salade de pois gourmands', 'gratin dauphinois', 'clafoutis aux cerises'),
(8, 'dimanche', 'salade de mâche', 'roti de dinde', 'sorbet citron'),
(9, 'lundi', 'salade de chou rouge', 'steak de boeuf', 'fromage blanc'),
(9, 'mardi', 'salade de quinoa', 'poulet à l estragon', 'fruit'),
(9, 'mercredi', 'soupe de champignons', 'poisson frit', 'yaourt'),
(9, 'jeudi', 'salade de courgettes', 'boeuf à la tomate', 'glace pistache'),
(9, 'vendredi', 'salade de brocoli', 'poulet au gingembre', 'tarte aux prunes'),
(9, 'samedi', 'salade de pommes', 'pâtes au pesto', 'flan coco'),
(9, 'dimanche', 'salade de roquette', 'roti de boeuf', 'fruit de saison'),
(10, 'lundi', 'salade de carottes', 'steak de porc', 'compote de pêches'),
(10, 'mardi', 'salade de riz', 'poulet au paprika', 'mousse au citron'),
(10, 'mercredi', 'soupe de potiron', 'poisson grillé', 'crème anglaise'),
(10, 'jeudi', 'salade de tomates', 'boeuf aux carottes', 'tarte aux poires'),
(10, 'vendredi', 'salade de concombre', 'poulet au sésame', 'panna cotta aux fruits rouges'),
(10, 'samedi', 'salade de pâtes', 'lasagnes au saumon', 'clafoutis aux pommes'),
(10, 'dimanche', 'salade de lentilles', 'roti de veau', 'sorbet framboise'),
(11, 'lundi', 'salade de chou', 'steak de thon', 'fromage blanc'),
(11, 'mardi', 'salade de pommes de terre', 'poulet au citron', 'fruit'),
(11, 'mercredi', 'soupe de courgettes', 'poisson au four', 'yaourt'),
(11, 'jeudi', 'salade de poivrons', 'boeuf aux oignons', 'glace vanille'),
(11, 'vendredi', 'salade de chou-fleur', 'poulet tikka', 'tarte tatin'),
(11, 'samedi', 'salade de haricots verts', 'spaghetti bolognaise', 'flan pâtissier'),
(11, 'dimanche', 'salade de roquette', 'roti d agneau', 'fruit de saison'),
(12, 'lundi', 'salade de céleri', 'steak de saumon', 'compote de poires'),
(12, 'mardi', 'salade de maïs', 'poulet à la moutarde', 'mousse de fruits'),
(12, 'mercredi', 'soupe de poireaux', 'poisson vapeur', 'crème brûlée'),
(12, 'jeudi', 'salade de radis', 'boeuf à la bière', 'tarte aux abricots'),
(12, 'vendredi', 'salade de fenouil', 'poulet au curry vert', 'pudding'),
(12, 'samedi', 'salade de pois gourmands', 'gratin dauphinois', 'clafoutis aux cerises'),
(12, 'dimanche', 'salade de mâche', 'roti de dinde', 'sorbet citron'),
(13, 'lundi', 'salade de chou rouge', 'steak de boeuf', 'fromage blanc'),
(13, 'mardi', 'salade de quinoa', 'poulet à l estragon', 'fruit'),
(13, 'mercredi', 'soupe de champignons', 'poisson frit', 'yaourt'),
(13, 'jeudi', 'salade de courgettes', 'boeuf à la tomate', 'glace pistache'),
(13, 'vendredi', 'salade de brocoli', 'poulet au gingembre', 'tarte aux prunes'),
(13, 'samedi', 'salade de pommes', 'pâtes au pesto', 'flan coco'),
(13, 'dimanche', 'salade de roquette', 'roti de boeuf', 'fruit de saison'),
(14, 'lundi', 'salade de carottes', 'steak de porc', 'compote de pêches'),
(14, 'mardi', 'salade de riz', 'poulet au paprika', 'mousse au citron'),
(14, 'mercredi', 'soupe de potiron', 'poisson grillé', 'crème anglaise'),
(14, 'jeudi', 'salade de tomates', 'boeuf aux carottes', 'tarte aux poires'),
(14, 'vendredi', 'salade de concombre', 'poulet au sésame', 'panna cotta aux fruits rouges'),
(14, 'samedi', 'salade de pâtes', 'lasagnes au saumon', 'clafoutis aux pommes'),
(14, 'dimanche', 'salade de lentilles', 'roti de veau', 'sorbet framboise'),
(15, 'lundi', 'salade de chou', 'steak de thon', 'fromage blanc'),
(15, 'mardi', 'salade de pommes de terre', 'poulet au citron', 'fruit'),
(15, 'mercredi', 'soupe de courgettes', 'poisson au four', 'yaourt'),
(15, 'jeudi', 'salade de poivrons', 'boeuf aux oignons', 'glace vanille'),
(15, 'vendredi', 'salade de chou-fleur', 'poulet tikka', 'tarte tatin'),
(15, 'samedi', 'salade de haricots verts', 'spaghetti bolognaise', 'flan pâtissier'),
(15, 'dimanche', 'salade de roquette', 'roti d agneau', 'fruit de saison'),
(16, 'lundi', 'salade de céleri', 'steak de saumon', 'compote de poires'),
(16, 'mardi', 'salade de maïs', 'poulet à la moutarde', 'mousse de fruits'),
(16, 'mercredi', 'soupe de poireaux', 'poisson vapeur', 'crème brûlée'),
(16, 'jeudi', 'salade de radis', 'boeuf à la bière', 'tarte aux abricots'),
(16, 'vendredi', 'salade de fenouil', 'poulet au curry vert', 'pudding'),
(16, 'samedi', 'salade de pois gourmands', 'gratin dauphinois', 'clafoutis aux cerises'),
(16, 'dimanche', 'salade de mâche', 'roti de dinde', 'sorbet citron'),
(17, 'lundi', 'salade de chou rouge', 'steak de boeuf', 'fromage blanc'),
(17, 'mardi', 'salade de quinoa', 'poulet à l estragon', 'fruit'),
(17, 'mercredi', 'soupe de champignons', 'poisson frit', 'yaourt'),
(17, 'jeudi', 'salade de courgettes', 'boeuf à la tomate', 'glace pistache'),
(17, 'vendredi', 'salade de brocoli', 'poulet au gingembre', 'tarte aux prunes'),
(17, 'samedi', 'salade de pommes', 'pâtes au pesto', 'flan coco'),
(17, 'dimanche', 'salade de roquette', 'roti de boeuf', 'fruit de saison'),
(18, 'lundi', 'salade de carottes', 'steak de porc', 'compote de pêches'),
(18, 'mardi', 'salade de riz', 'poulet au paprika', 'mousse au citron'),
(18, 'mercredi', 'soupe de potiron', 'poisson grillé', 'crème anglaise'),
(18, 'jeudi', 'salade de tomates', 'boeuf aux carottes', 'tarte aux poires'),
(18, 'vendredi', 'salade de concombre', 'poulet au sésame', 'panna cotta aux fruits rouges'),
(18, 'samedi', 'salade de pâtes', 'lasagnes au saumon', 'clafoutis aux pommes'),
(18, 'dimanche', 'salade de lentilles', 'roti de veau', 'sorbet framboise'),
(19, 'lundi', 'salade de chou', 'steak de thon', 'fromage blanc'),
(19, 'mardi', 'salade de pommes de terre', 'poulet au citron', 'fruit'),
(19, 'mercredi', 'soupe de courgettes', 'poisson au four', 'yaourt'),
(19, 'jeudi', 'salade de poivrons', 'boeuf aux oignons', 'glace vanille'),
(19, 'vendredi', 'salade de chou-fleur', 'poulet tikka', 'tarte tatin'),
(19, 'samedi', 'salade de haricots verts', 'spaghetti bolognaise', 'flan pâtissier'),
(19, 'dimanche', 'salade de roquette', 'roti d agneau', 'fruit de saison'),
(20, 'lundi', 'salade de céleri', 'steak de saumon', 'compote de poires'),
(20, 'mardi', 'salade de maïs', 'poulet à la moutarde', 'mousse de fruits'),
(20, 'mercredi', 'soupe de poireaux', 'poisson vapeur', 'crème brûlée'),
(20, 'jeudi', 'salade de radis', 'boeuf à la bière', 'tarte aux abricots'),
(20, 'vendredi', 'salade de fenouil', 'poulet au curry vert', 'pudding'),
(20, 'samedi', 'salade de pois gourmands', 'gratin dauphinois', 'clafoutis aux cerises'),
(20, 'dimanche', 'salade de mâche', 'roti de dinde', 'sorbet citron');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Repas`
--
ALTER TABLE `Repas`
  ADD PRIMARY KEY (`semaine`,`jour`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
