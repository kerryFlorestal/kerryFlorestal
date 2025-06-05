-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 27 Mai 2025 à 10:16
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

DROP DATABASE IF EXISTS egw;

-- Create the database
CREATE DATABASE egw;

-- Use the newly created database
USE egw;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `egw`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorieevent`
--

CREATE TABLE IF NOT EXISTS `categorieevent` (
  `idCategorieEvent` int(11) NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`idCategorieEvent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `categorieevent`
--

INSERT INTO `categorieevent` (`idCategorieEvent`, `nomCategorie`, `description`) VALUES
(1, 'Parcours', 'incroyable'),
(2, 'FPS', 'Come Play');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `Client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `numeroTel` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role` enum('admin','client','boss') NOT NULL,
  PRIMARY KEY (`idClient`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`idClient`, `nom`, `prenom`, `numeroTel`, `email`, `mdp`, `role`) VALUES
(1, 'Florestal', 'KerryMC', '0625579062', 'kerryflorestal05@gmail.com', '123', 'client'),
(2, 'Dereock', 'na', '0706070432', 'nathan@gmail.fr', '6da286412d0d65c10c15903b89aed6d1d511979a', 'client'),
(3, 'Florestal', 'Kerry', '0625579062', 'kerryflorestal14@gmail.com', '6da286412d0d65c10c15903b89aed6d1d511979a', 'admin'),
(4, 'dorival', 'theo', '0665619016', 'm.dorival.t@gmail.com', '6da286412d0d65c10c15903b89aed6d1d511979a', 'client'),
(5, 'MILLOT', 'Noah', '0638135414', 'noah.millot.m@gmail.com', '44d59cfce21e25a576aa4c2ebd028bc9f865cfb2', 'client');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `Commande` (
  `idCommande` int(11) NOT NULL AUTO_INCREMENT,
  `prixBillet` float NOT NULL,
  `idClient` int(11) NOT NULL,
  `idEvenement` int(11) NOT NULL,
  `etat` enum('Validé','En cours','Refusé') NOT NULL DEFAULT 'En cours',
  PRIMARY KEY (`idCommande`),
  KEY `Commande_Client_FK` (`idClient`),
  KEY `Commande_Evenement_FK` (`idEvenement`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `prixBillet`, `idClient`, `idEvenement`, `etat`) VALUES
(1, 50, 2, 1, 'En cours'),
(2, 10, 2, 3, 'En cours'),
(3, 10, 2, 3, 'En cours'),
(4, 10, 4, 3, 'En cours'),
(6, 10, 5, 3, 'En cours');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `Evenement` (
  `idEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `nomEvent` varchar(50) NOT NULL,
  `dateEvent` date NOT NULL,
  `Heure` time NOT NULL,
  `description` text NOT NULL,
  `prixBillet` float NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `idCategorieEvent` int(11) NOT NULL,
  `idLieu` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `imageKey` varchar(255) NOT NULL,
  PRIMARY KEY (`idEvenement`),
  KEY `Evenement_CategorieEvent_FK` (`idCategorieEvent`),
  KEY `Evenement_Lieu_FK` (`idLieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`idEvenement`, `nomEvent`, `dateEvent`, `Heure`, `description`, `prixBillet`, `disponible`, `idCategorieEvent`, `idLieu`, `image`, `imageKey`) VALUES
(1, 'NanEvent', '2025-05-06', '22:30:00', 'Geometry Dash', 50, 1, 1, 1, 'ge.jpg', '1'),
(2, 'RaphEvent', '2025-10-01', '09:00:00', 'NBA 2K19', 200, 1, 2, 1, '2k19.jpg', '2'),
(3, 'LEvent', '2025-05-06', '21:00:00', 'Minecraft', 10, 1, 2, 1, 'mine.jpg', '3'),
(4, 'kerryEvent', '2025-05-09', '20:40:00', 'WARZONE', 100, 1, 2, 1, 'warzone_2.jpg', '4');

-- --------------------------------------------------------

--
-- Structure de la table `grainsel`
--

CREATE TABLE IF NOT EXISTS `grainsel` (
  `nb` varchar(100) NOT NULL,
  PRIMARY KEY (`nb`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `grainsel`
--

INSERT INTO `grainsel` (`nb`) VALUES
('1234567890');

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE IF NOT EXISTS `Lieu` (
  `idLieu` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `capacite` int(11) NOT NULL,
  `description` text NOT NULL,
  `lieuKey` varchar(50) NOT NULL,
  PRIMARY KEY (`idLieu`),
  UNIQUE KEY `lieuKey` (`lieuKey`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `lieu`
--

INSERT INTO `lieu` (`idLieu`, `nom`, `adresse`, `capacite`, `description`, `lieuKey`) VALUES
(1, 'Accor Arena', '8 Bd de Bercy, 75012 Paris', 800, 'incroyable', '1'),
(2, 'Paris La DÃ©fense Arena', '99 Jard. de l''Arche, 92000 Nanterre', 205, 'incroyable', '2');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `Commande`
  ADD CONSTRAINT `Commande_Client_FK` FOREIGN KEY (`idClient`) REFERENCES `Client` (`idClient`),
  ADD CONSTRAINT `Commande_Evenement_FK` FOREIGN KEY (`idEvenement`) REFERENCES `Evenement` (`idEvenement`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `Evenement`
  ADD CONSTRAINT `Evenement_CategorieEvent_FK` FOREIGN KEY (`idCategorieEvent`) REFERENCES `Categorieevent` (`idCategorieEvent`),
  ADD CONSTRAINT `Evenement_Lieu_FK` FOREIGN KEY (`idLieu`) REFERENCES `Lieu` (`idLieu`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
