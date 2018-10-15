-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 15 oct. 2018 à 02:06
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.31-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `iad_chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `source` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `type`, `source`, `target`, `message`, `date_created`) VALUES
(1, 0, 2, 0, 'fsdfsdfsdf', '2018-10-14 22:49:25'),
(2, 0, 2, 0, 'fsdfsdfsdf', '2018-10-14 22:56:03'),
(3, 0, 2, 0, 'fsdfsdf', '2018-10-14 22:56:17'),
(4, 0, 2, 0, 'qdsqsdsqdqsd', '2018-10-14 22:57:06'),
(5, 0, 2, 0, 'dsqdqsd', '2018-10-14 22:58:34'),
(6, 0, 2, 0, 'fsdfsdfsdf', '2018-10-14 22:59:04'),
(7, 0, 2, 0, 'fsdfsdf', '2018-10-14 23:01:17'),
(8, 0, 2, 0, 'fsdfsdf', '2018-10-14 23:18:06'),
(9, 0, 3, 0, 'ggggggggg', '2018-10-15 01:17:06'),
(10, 0, 2, 0, 'fffffffffff', '2018-10-15 01:43:53'),
(11, 0, 2, 0, 'fhqjdshfj sqdf ', '2018-10-15 01:44:25'),
(12, 0, 2, 0, 'f qs fqsd', '2018-10-15 01:44:26'),
(13, 0, 2, 0, 'f fsqd fdsf', '2018-10-15 01:44:27'),
(14, 0, 4, 0, 'fsqdfdsqfqsdf', '2018-10-15 01:45:13'),
(15, 0, 4, 0, 'fsdqfdsqf', '2018-10-15 01:45:14'),
(16, 0, 2, 0, 'fsdqfdsqf', '2018-10-15 01:45:17'),
(17, 0, 2, 0, 'C\'est moi souvanny', '2018-10-15 01:45:31'),
(18, 0, 2, 0, 'dfdsf', '2018-10-15 01:49:24'),
(19, 0, 2, 0, 'dfsdfdsf', '2018-10-15 01:50:55'),
(20, 0, 2, 0, 'fsdf', '2018-10-15 01:50:56'),
(21, 0, 4, 0, 'C\'est ss', '2018-10-15 01:51:04');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `date_created`) VALUES
(2, 'ssisengrath@hotmail.com', '343b1c4a3ea721b2d640fc8700db0f36', '2018-10-14 22:39:27'),
(3, 'ss1@ss.fr', '74b87337454200d4d33f80c4663dc5e5', '2018-10-15 01:17:00'),
(4, 'ss2@ss.fr', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', '2018-10-15 01:45:08');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
