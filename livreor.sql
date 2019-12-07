-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 07 déc. 2019 à 03:23
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `livreor`
--
CREATE DATABASE IF NOT EXISTS `livreor` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `livreor`;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_utilisateur`, `date`) VALUES
(27, 'Je prie le dieu du php et si il vient pas m\'aider je le bute @Sarah', 2, '2019-12-03'),
(25, 'Continue de rien faire , c\'est parfait ! @Etienne', 2, '2019-12-03'),
(26, 'Je sais pas ce qui vous arrive mais vous Ãªtes trop sÃ©rieux aujourd\'hui @Hugo', 2, '2019-12-03'),
(24, 'En vrai si ton pokemon c\'est un type plante, mais qu\'il mange un champignon c\'est quoi ? @Amar\r\n<br/>\r\nC\'est du cannibalisme ! @Enzo', 2, '2019-12-03'),
(23, 'Un slip pour homme ? Bah ca peut Ãªtre excitant. @Etienne', 2, '2019-12-03'),
(28, 'Non mais Gwen il a un kiki je pense. @Sarah', 2, '2019-12-03'),
(29, 'Son bras on dirait un manche de guitare @Devon', 2, '2019-12-03');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$edNitUQxEFMzxsOYQos6BursmbZDXg6YAm8ZHpMVOFLcQ2r7aO3Su'),
(2, 'Onze', '$2y$10$tqtsiySD/xGoQH2IJ7y6R.EvBDMgOV4TfTuRVw7UDDgQs4iD.RzlC'),
(4, 'Enzo', '$2y$10$2s0mSd3fVSXADxrbsrvErub.FTMfxYy3.2KTP5iG54ixnwMHyg4.K'),
(5, 'test', '$2y$10$jL8nXj84bJ1ILH676AkBBuYdh55lO5JD58UKJJvae566L6vBuN9lS');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
