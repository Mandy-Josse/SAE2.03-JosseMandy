-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 17 avr. 2025 à 08:27
-- Version du serveur : 10.11.11-MariaDB-0+deb12u1
-- Version de PHP : 8.3.19







SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `SAE203`
--
CREATE DATABASE IF NOT EXISTS `SAE203` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `SAE203`;

-- --------------------------------------------------------

--
-- Structure de la table `Category`
--

CREATE TABLE `Category` (
  `id` int(3) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `Category`
--

INSERT INTO `Category` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Comédie'),
(3, 'Drame'),
(4, 'Science-fiction'),
(5, 'Animation'),
(6, 'Thriller'),
(7, 'Horreur'),
(8, 'Aventure'),
(9, 'Fantaisie'),
(10, 'Documentaire');

-- --------------------------------------------------------

--
-- Structure de la table `Favoris`
--

CREATE TABLE `Favoris` (
  `id_fav` int(11) NOT NULL,
  `id_profile` int(11) NOT NULL,
  `id_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Favoris`
--

INSERT INTO `Favoris` (`id_fav`, `id_profile`, `id_film`) VALUES
(76, 5, 46),
(77, 3, 17),
(78, 3, 7),
(79, 3, 33),
(80, 3, 32),
(81, 3, 34),
(82, 3, 45),
(83, 3, 44),
(84, 3, 54),
(85, 3, 53),
(86, 2, 61),
(87, 2, 56),
(88, 2, 53),
(89, 2, 52),
(90, 2, 51),
(91, 2, 41),
(92, 2, 35),
(93, 2, 12),
(97, 3, 0),
(98, 1, 0),
(110, 1, 17),
(111, 1, 27);

-- --------------------------------------------------------

--
-- Structure de la table `Movie`
--

CREATE TABLE `Movie` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `year` int(4) DEFAULT NULL,
  `length` int(3) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `director` varchar(250) DEFAULT NULL,
  `id_category` int(3) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `trailer` varchar(250) DEFAULT NULL,
  `min_age` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `Movie`
--

INSERT INTO `Movie` (`id`, `name`, `year`, `length`, `description`, `director`, `id_category`, `image`, `trailer`, `min_age`) VALUES
(7, 'Interstellar', 2014, 169, 'Un groupe d\'explorateurs voyage à travers un trou de ver pour sauver l\'humanité.', 'Christopher Nolan', 4, 'interstellar.jpg', 'https://www.youtube.com/embed/VaOijhK3CRU?si=76Ke4uw4LYjuLuQ6', 12),
(12, 'La Liste de Schindler', 1993, 195, 'Un industriel allemand sauve des milliers de Juifs pendant l\'Holocauste.', 'Steven Spielberg', 3, 'schindler.webp', 'https://www.youtube.com/embed/ONWtyxzl-GE?si=xC3ASGGPy5Ib-aPn', 16),
(17, 'Your Name', 2016, 107, 'Deux adolescents échangent leurs corps de manière mystérieuse.', 'Makoto Shinkai', 5, 'your_name.jpg', 'https://www.youtube.com/embed/AROOK45LXXg?si=aUQyGk2VMCb_ToUL', 10),
(27, 'Le Bon, la Brute et le Truand', 1966, 161, 'Trois hommes se lancent à la recherche d\'un trésor caché.', 'Sergio Leone', 8, 'bon_brute_truand.jpg', 'https://www.youtube.com/embed/WA1hCZFOPqs?si=TwNZAoM4oj4KpGja', 12),
(28, 'Oppenheimer', 2023, 180, 'L’histoire du physicien J. Robert Oppenheimer et de son rôle dans la création de la bombe atomique.', 'Christopher Nolan', 4, 'oppenheimer.jpg', 'https://www.youtube.com/embed/uYPbbksJxIg', 12),
(30, 'Suzume', 2022, 122, 'Une jeune fille aide un garçon mystérieux à fermer des portes surnaturelles qui causent des catastrophes.', 'Makoto Shinkai', 5, 'suzume.jpg', 'https://www.youtube.com/embed/M2m_6WCybaw?si=m7jcEye5NLJO9SvL', 10),
(31, 'Loin de moi, près de toi', 2020, 104, 'Une fille se transforme en chat pour se rapprocher du garçon qu’elle aime, mais risque d’y rester.', 'Junichi Sato & Tomotaka Shibayama', 5, 'a_whisker_away.jpg', 'https://www.youtube.com/embed/ctM0e1Spg0k?si=tACcaxR-geOoQZ3n', 10),
(32, 'Dragons', 2010, 98, 'Harold, un jeune Viking, devient ami avec un dragon qu’il devait chasser. Ensemble, ils changent l’avenir de leur village.', 'Chris Sanders & Dean DeBlois', 1, 'httyd1.jpg', 'https://www.youtube.com/embed/oKiYuIsPxYk', 6),
(33, 'Dragons 2', 2014, 102, 'Harold découvre sa mère disparue et une armée de dragons menacée par un ennemi puissant.', 'Dean DeBlois', 1, 'httyd2.jpg', 'https://www.youtube.com/embed/Z9a4PvzlqoQ', 6),
(34, 'Dragons 3 : Le Monde caché', 2019, 104, 'Harold et Krokmou découvrent un monde caché et doivent faire un choix entre liberté et loyauté.', 'Dean DeBlois', 1, 'httyd3.jpg', 'https://www.youtube.com/embed/lNYDeG4Qd4k?si=d5jXQmf3wSlK4zw6', 6),
(35, 'Jurassic Park', 1993, 127, 'Des scientifiques visitent un parc d’attractions peuplé de dinosaures clonés, jusqu’à ce que tout parte en vrille.', 'Steven Spielberg', 3, 'jurassic_park.jpg', 'https://www.youtube.com/embed/lc0UehYemQA', 12),
(36, 'Le Monde perdu : Jurassic Park', 1997, 129, 'Un groupe retourne sur une île remplie de dinosaures pour une mission qui tourne au chaos.', 'Steven Spielberg', 3, 'jurassic_park2.jpg', 'https://www.youtube.com/embed/RxrvaneULkE', 12),
(37, 'Jurassic Park III', 2001, 92, 'Un paléontologue est piégé sur une île infestée de dinosaures à cause d’un couple en quête de leur fils.', 'Joe Johnston', 3, 'jurassic_park3.jpg', 'https://www.youtube.com/embed/C7kbVvpOGdQ', 12),
(38, 'Jurassic World', 2015, 124, 'Un nouveau parc de dinosaures ouvre, mais un dinosaure génétiquement modifié menace tout.', 'Colin Trevorrow', 3, 'jurassic_world.jpg', 'https://www.youtube.com/embed/RFinNxS5KN4', 12),
(39, 'Jurassic World: Fallen Kingdom', 2018, 128, 'Les héros tentent de sauver les dinosaures d’une île en éruption... et découvrent un sombre complot.', 'J.A. Bayona', 3, 'jurassic_world2.jpg', 'https://www.youtube.com/embed/vn9mMeWcgoM', 12),
(40, 'Jurassic World: Le Monde d’après', 2022, 146, 'Les dinosaures vivent maintenant parmi les humains, et l’équilibre de la planète est en jeu.', 'Colin Trevorrow', 3, 'jurassic_world3.jpg', 'https://www.youtube.com/embed/fb5ELWi-ekk', 12),
(41, 'A Silent Voice', 2016, 129, 'Un ancien harceleur tente de se racheter auprès d’une camarade sourde qu’il maltraitait au collège.', 'Naoko Yamada', 5, 'silent_voice.jpg', 'https://www.youtube.com/embed/0MelIAXhyLc?si=N-WeEhscgfD7VL9s', 10),
(42, 'Les Enfants du Temps', 2019, 112, 'Un lycéen rencontre une fille capable de contrôler la météo dans un Tokyo frappé par des pluies incessantes.', 'Makoto Shinkai', 5, 'weathering_with_you.jpg', 'https://www.youtube.com/embed/MupePn-BV5I?si=TofLf5z4o3J7NeXH', 10),
(44, 'Le Voyage de Chihiro', 2001, 125, 'Une fillette se retrouve dans un monde d’esprits où ses parents ont été transformés en cochons.', 'Hayao Miyazaki', 5, 'chihiro.jpg', 'https://www.youtube.com/embed/ByXuk9QqQkk', 8),
(45, 'Le Château ambulant', 2004, 119, 'Une jeune fille maudite rencontre un sorcier fantasque vivant dans un château mécanique.', 'Hayao Miyazaki', 5, 'howl.jpg', 'https://www.youtube.com/embed/iwROgK94zcM', 8),
(46, 'Mon voisin Totoro', 1988, 86, 'Deux petites filles découvrent des créatures magiques en s’installant à la campagne.', 'Hayao Miyazaki', 5, 'totoro.jpg', 'https://www.youtube.com/embed/92a7Hj0ijLs', 6),
(51, 'Spider-Man: Into the Spider-Verse', 2018, 117, 'Miles Morales découvre qu’il n’est pas le seul Spider-Man dans un multivers en folie.', 'Bob Persichetti, Peter Ramsey, Rodney Rothman', 4, 'spiderverse.jpg', 'https://www.youtube.com/embed/g4Hbz2jLxvQ', 10),
(52, 'Black Panther', 2018, 134, 'T’Challa retourne au Wakanda pour prendre le trône, mais son règne est menacé.', 'Ryan Coogler', 4, 'black_panther.jpg', 'https://www.youtube.com/embed/xjDjIWPwcPU', 12),
(53, 'Avengers: Endgame', 2019, 181, 'Les survivants du snap de Thanos tentent de restaurer l’univers dans une bataille finale épique.', 'Anthony & Joe Russo', 4, 'endgame.jpg', 'https://www.youtube.com/embed/TcMBFSGVi1c', 12),
(54, 'Avatar', 2009, 162, 'Sur Pandora, un ex-marine prend part à une guerre entre humains et autochtones.', 'James Cameron', 4, 'avatar.jpg', 'https://www.youtube.com/embed/5PSNL1qE6VY', 12),
(55, 'Titanic', 1997, 195, 'Une histoire d’amour tragique à bord du paquebot le plus célèbre de l’histoire.', 'James Cameron', 3, 'titanic.jpg', 'https://www.youtube.com/embed/kVrqfYjkTdQ', 10),
(56, 'Inception', 2010, 148, 'Un voleur spécialisé dans les rêves tente l’ultime mission : implanter une idée.', 'Christopher Nolan', 4, 'inception.jpg', 'https://www.youtube.com/embed/YoHD9XEInc0', 12),
(60, 'Shrek', 2001, 90, 'Un ogre grognon part sauver une princesse pour garder son marais tranquille, mais rien ne se passe comme prévu.', 'Andrew Adamson, Vicky Jenson', 1, 'shrek1.jpg', 'https://www.youtube.com/embed/CwXOrWvPBPk', 6),
(61, 'Shrek 2', 2004, 93, 'Shrek et Fiona visitent les parents de Fiona... qui découvrent que leur fille a épousé un ogre.', 'Andrew Adamson, Kelly Asbury, Conrad Vernon', 1, 'shrek2.jpg', 'https://www.youtube.com/embed/xBgSfhp5Fxo', 6),
(62, 'Shrek le troisième', 2007, 93, 'Shrek doit trouver un héritier au trône de Fort Fort Lointain, mais le jeune Arthur n’est pas prêt à régner.', 'Chris Miller, Raman Hui', 1, 'shrek3.jpg', 'https://www.youtube.com/embed/_MoIr7811Bs?si=4RnrRn5tZONDPX-N', 6),
(63, 'Shrek 4 : Il était une fin', 2010, 93, 'Shrek, nostalgique de sa vie d’ogre terrifiant, conclut un pacte dangereux avec le malicieux Tracassin.', 'Mike Mitchell', 1, 'shrek4.jpg', 'https://www.youtube.com/embed/3tRzdX2lG1o?si=e61QpPQVgg0xaMs3', 6),
(64, 'Le Chat Potté', 2011, 90, 'Avant de rencontrer Shrek, le Chat Potté vivait des aventures épiques pour sauver son honneur et trouver les haricots magiques.', 'Chris Miller', 1, 'chat_potte.jpg', 'https://www.youtube.com/embed/9GRJQrK1ZgM?si=MaVKvjhI9HQpxKSG', 6);

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `idusers` int(2) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `avatar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`idusers`, `name`, `age`, `avatar`) VALUES
(1, 'Adulte', 18, 'adult.jpg'),
(2, 'Pré-adulte', 16, 'pre-adult.jpg'),
(3, 'Ado', 12, 'teen.jpg'),
(4, 'Pré-ado', 10, 'pre-teen.jpg'),
(5, 'Enfant', 6, 'child.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Favoris`
--
ALTER TABLE `Favoris`
  ADD PRIMARY KEY (`id_fav`);

--
-- Index pour la table `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Favoris`
--
ALTER TABLE `Favoris`
  MODIFY `id_fav` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT pour la table `Movie`
--
ALTER TABLE `Movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `idusers` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Movie`
--
ALTER TABLE `Movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `Category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
