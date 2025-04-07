-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 01 mars 2022 à 10:49
-- Version du serveur :  10.1.48-MariaDB-0+deb9u2
-- Version de PHP : 7.2.14-1+0~20190113100742.14+stretch~1.gbpd83c69

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `morap01`
--

-- --------------------------------------------------------

--
-- Structure de la table `Repas`
--

CREATE TABLE `Repas` (
  `jour` varchar(25) NOT NULL,
  `entree` varchar(256) NOT NULL,
  `plat` varchar(256) NOT NULL,
  `dessert` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Repas`
--

INSERT INTO `Repas` (`jour`, `entree`, `plat`, `dessert`) VALUES
('dimanche', 'Velouté aux cèpes', 'Côtes d\'agneau et poêlée forestière', 'Glace colonel'),
('jeudi', 'Oeuf mimosa', 'escalope de veau et gratin de courgettes', 'Fromage'),
('lundi', 'Radis beurre', 'Pintade et jardinière de légumes', 'Duo de mousses café chocolat'),
('mardi', 'Asperges sauce blanche', 'Filet de flétan et riz basmati', 'Ile flottante'),
('mercredi', 'Rosette de Lyon et radis noir', 'Filet de boeuf et frites', 'Crême brulée'),
('samedi', 'Carottes rapées', 'Petit salé aux lentilles', 'Salade de fruits'),
('vendredi', 'Avocat surimi', 'Magret de canard sauce foie gras et patates grasses', 'Indigeste au chocolat');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Repas`
--
ALTER TABLE `Repas`
  ADD PRIMARY KEY (`jour`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
