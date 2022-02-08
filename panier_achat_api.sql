-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 08 fév. 2022 à 02:01
-- Version du serveur : 8.0.28
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `panier_achat_api`
--

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_TMDb` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `price` float(11,2) NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_TMDb` (`id_TMDb`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `id_TMDb`, `name`, `date_added`, `price`, `quantity`) VALUES
(1, 680, 'Pulp Fiction', '2022-01-30 17:02:52', 19.90, 8),
(2, 438695, 'Tous en scène 2', '2022-01-30 17:03:00', 15.90, 5),
(3, 1903, 'Vanilla Sky', '2022-01-30 17:03:10', 18.99, 2),
(5, 646380, 'Don\'t Look Up', '2022-01-30 17:03:18', 29.99, 7),
(7, 585245, 'Clifford', '2022-01-30 17:04:06', 29.99, 9),
(16, 24, 'Kill Bill : Volume 1', '2022-01-30 17:04:13', 29.99, 4),
(17, 500, 'Reservoir Dogs', '2022-01-30 17:04:19', 17.50, 6),
(18, 68718, 'Django Unchained', '2022-01-30 17:04:27', 18.99, 3),
(20, 16869, 'Inglourious basterds', '2022-01-30 17:00:12', 23.99, 0),
(21, 627, 'Trainspotting', '2022-01-30 17:04:51', 26.99, 6),
(22, 550, 'Fight Club', '2022-01-30 17:05:01', 17.90, 12),
(23, 73, 'American History X', '2022-01-30 17:05:08', 25.98, 8),
(24, 106646, 'Le Loup de Wall Street', '2022-01-30 17:05:17', 22.65, 5),
(25, 4133, 'Blow', '2022-01-30 17:05:24', 14.76, 4),
(26, 9642, 'Astérix et les Vikings', '2022-01-31 10:27:39', 17.50, 6),
(27, 527729, 'Astérix - Le Secret de la Potion Magique', '2022-01-31 10:45:32', 23.40, 8),
(28, 2395, 'Astérix aux Jeux olympiques', '2022-01-31 10:47:33', 12.20, 2),
(29, 170522, 'Astérix : Le Domaine Des Dieux', '2022-01-31 22:36:45', 18.60, 5),
(30, 87827, 'L\'odyssée de Pi', '2022-01-31 22:53:05', 29.99, 12),
(31, 334543, 'Lion', '2022-01-31 22:53:53', 22.20, 5),
(32, 11, 'La Guerre des étoiles', '2022-01-31 23:24:38', 18.99, 7),
(33, 4982, 'American Gangster', '2022-01-31 23:36:28', 17.30, 9),
(34, 14, 'American Beauty', '2022-01-31 23:36:50', 12.20, 2),
(35, 83201, 'Le Chat Potté : Les Trois Diablos', '2022-01-31 23:37:12', 14.99, 5),
(36, 100, 'Arnaques, crimes et botanique', '2022-01-31 23:37:49', 15.80, 7),
(37, 671041, 'L\'Aventure des Marguerite', '2022-01-31 23:38:15', 13.70, 6),
(38, 334304, 'Belle et Sébastien : L\'aventure continue', '2022-01-31 23:38:33', 18.96, 4),
(39, 520725, 'Le prince oublié', '2022-01-31 23:38:47', 12.99, 1),
(40, 767, 'Harry Potter et le Prince de sang-mêlé', '2022-01-31 23:39:06', 17.40, 6),
(41, 309809, 'Le Petit Prince', '2022-01-31 23:39:23', 25.80, 8),
(42, 8367, 'Robin des Bois, prince des voleurs', '2022-01-31 23:39:37', 9.99, 2),
(43, 36557, 'Casino Royale', '2022-01-31 23:39:53', 14.60, 5),
(44, 3176, 'Battle Royale', '2022-01-31 23:40:08', 28.50, 2),
(45, 1368, 'Rambo', '2022-01-31 23:40:31', 19.99, 3),
(46, 218, 'Terminator', '2022-01-31 23:40:52', 17.99, 9),
(47, 796, 'Sexe intentions', '2022-01-31 23:41:07', 14.50, 2),
(48, 497, 'La Ligne verte', '2022-01-31 23:42:57', 25.60, 4),
(49, 13, 'Forrest Gump', '2022-01-31 23:44:07', 23.99, 5),
(50, 10068, '9 Semaines ½', '2022-02-04 05:14:35', 12.20, 4),
(51, 745, 'Sixième sens', '2022-02-04 08:14:33', 18.60, 5),
(52, 11321, 'Sept vies', '2022-02-04 08:14:54', 22.20, 8),
(53, 9494, 'Allô maman, ici bébé', '2022-02-04 08:57:05', 23.40, 6),
(54, 9741, 'Incassable', '2022-02-07 02:52:52', 16.55, 4),
(55, 381288, 'Split', '2022-02-07 02:53:21', 18.75, 5),
(56, 450465, 'Glass', '2022-02-07 02:53:50', 22.60, 6);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int NOT NULL DEFAULT '1',
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `role`, `avatar`) VALUES
(19, 'jbmarini', 'marini_jb@hotmail.fr', '5a85c7ce5b60b746d689d61deb868724', 1, '9647ddac070e2add78d1a6eaef1e58dd.jpg'),
(22, 'admin', 'jbcubana@gmail.com', '5a85c7ce5b60b746d689d61deb868724', 0, 'eba48c99035a661adde3ec12d1dce1a1.jpg'),
(23, 'test', 'test@test.test', '5a85c7ce5b60b746d689d61deb868724', 1, 'default.jpg'),
(21, 'testavatar2', 'azert@azert.de', 'fdf4cfc4d7d06e8f9f04df9e87386e1b', 1, 'default.jpg'),
(20, 'testavatar', 'testavatar@test.test', 'fdf4cfc4d7d06e8f9f04df9e87386e1b', 1, 'default.jpg'),
(18, 'test4', 'test4@test.test', 'fdf4cfc4d7d06e8f9f04df9e87386e1b', 1, 'default.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
