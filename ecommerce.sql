-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 11 avr. 2025 à 08:03
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `addresse`
--

DROP TABLE IF EXISTS `addresse`;
CREATE TABLE IF NOT EXISTS `addresse` (
  `id_addresse` int NOT NULL AUTO_INCREMENT,
  `id_client` int NOT NULL,
  `addresse` varchar(255) NOT NULL,
  `ville` varchar(80) NOT NULL,
  `code_postal` varchar(50) NOT NULL,
  PRIMARY KEY (`id_addresse`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `billet`
--

DROP TABLE IF EXISTS `billet`;
CREATE TABLE IF NOT EXISTS `billet` (
  `id_billet` int NOT NULL AUTO_INCREMENT,
  `QuantiteDisponible` int NOT NULL,
  `paysDepart` varchar(100) NOT NULL,
  `paysArrive` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `transport` varchar(80) NOT NULL,
  `prix` decimal(4,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id_billet`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mpd` varchar(255) NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `details_pannier`
--

DROP TABLE IF EXISTS `details_pannier`;
CREATE TABLE IF NOT EXISTS `details_pannier` (
  `id_details_pannier` int NOT NULL AUTO_INCREMENT,
  `id_pannier` int NOT NULL,
  `id_billet` int NOT NULL,
  `quantite` int NOT NULL,
  PRIMARY KEY (`id_details_pannier`),
  KEY `id_pannier` (`id_pannier`),
  KEY `id_billet` (`id_billet`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pannier`
--

DROP TABLE IF EXISTS `pannier`;
CREATE TABLE IF NOT EXISTS `pannier` (
  `id_pannier` int NOT NULL AUTO_INCREMENT,
  `id_client` int NOT NULL,
  PRIMARY KEY (`id_pannier`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `id_client` int NOT NULL,
  `id_billet` int NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `id_client` (`id_client`),
  KEY `id_billet` (`id_billet`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
