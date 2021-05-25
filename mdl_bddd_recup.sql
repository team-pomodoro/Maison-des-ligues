-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 25 mai 2021 à 15:21
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mdl`
--

-- --------------------------------------------------------

--
-- Structure de la table `atelier`
--

DROP TABLE IF EXISTS `atelier`;
CREATE TABLE IF NOT EXISTS `atelier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `themes_id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_places_maxi` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E1BB182394F4A9D2` (`themes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_chambre`
--

DROP TABLE IF EXISTS `categorie_chambre`;
CREATE TABLE IF NOT EXISTS `categorie_chambre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarifs_id` int(11) NOT NULL,
  `libelle_categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9A8A4A5DF5F3287F` (`tarifs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE IF NOT EXISTS `club` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `club`
--

INSERT INTO `club` (`id`, `nom`, `adresse1`, `adresse2`, `code_postal`, `ville`, `tel`) VALUES
(1, 'club1', 'adresse du club', NULL, '83200', 'Toulon', '0695784123');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_licence` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `url_active` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CFF65260D8A9FCA1` (`num_licence`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id`, `num_licence`, `roles`, `password`, `email`, `active`, `url_active`) VALUES
(1, '501', '[]', '$argon2id$v=19$m=65536,t=4,p=1$RTNJeGpqWHBFZm9ITzQ4Zg$PttakO3+jWu6LbRJPpKQzAlNlUXqM1iEHBHluyJE0ac', 'manon.orsini5@gmail.com', 1, 'pVdJhyghBH0RQz7OVasS'),
(4, '607', '[]', '$argon2id$v=19$m=65536,t=4,p=1$dmVvN1pVcm5zMURuQnV4dA$x4qH/XRQdbu/xM2zEuxp7irtzzMEYZG/dNIo0rFFoBU', 'manon.orsini5@gmail.com', 1, '30HJ4cLueq5077ioKVk2');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210506130718', '2021-05-06 13:07:28', 590);

-- --------------------------------------------------------

--
-- Structure de la table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarifs_id` int(11) NOT NULL,
  `code_hotel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_hotel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_hotel1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_hotel2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3535ED9F5F3287F` (`tarifs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nuites_id` int(11) DEFAULT NULL,
  `date_inscription` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5E90F6D6A9DD7CE0` (`nuites_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `licencie`
--

DROP TABLE IF EXISTS `licencie`;
CREATE TABLE IF NOT EXISTS `licencie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qualite_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `num_licence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_licencie1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_licencie2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_inscrit` datetime NOT NULL,
  `date_enregistrement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cle_wifi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3B755612A6338570` (`qualite_id`),
  KEY `IDX_3B75561261190A32` (`club_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `licencie`
--

INSERT INTO `licencie` (`id`, `qualite_id`, `club_id`, `num_licence`, `nom`, `prenom`, `adresse_licencie1`, `adresse_licencie2`, `code_postal`, `ville`, `tel`, `mail`, `date_inscrit`, `date_enregistrement`, `cle_wifi`) VALUES
(1, 1, 1, '501', '', '', '', NULL, '', '', NULL, NULL, '2021-05-06 15:11:23', NULL, NULL),
(2, 1, 1, '607', 'Dubuc', 'Benoit', 'une adresse', NULL, '83200', 'Toulon', '0678541236', 'manon.orsini5@gmail.com', '2021-05-20 17:28:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `nuite`
--

DROP TABLE IF EXISTS `nuite`;
CREATE TABLE IF NOT EXISTS `nuite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_nuite` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `proposer`
--

DROP TABLE IF EXISTS `proposer`;
CREATE TABLE IF NOT EXISTS `proposer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarif_nuite` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `qualite`
--

DROP TABLE IF EXISTS `qualite`;
CREATE TABLE IF NOT EXISTS `qualite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_qualite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `qualite`
--

INSERT INTO `qualite` (`id`, `libelle_qualite`) VALUES
(1, 'qualite 1');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ateliers_id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9775E708B1409BC9` (`ateliers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vacation`
--

DROP TABLE IF EXISTS `vacation`;
CREATE TABLE IF NOT EXISTS `vacation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_heure_debut` datetime NOT NULL,
  `date_heure_fin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `atelier`
--
ALTER TABLE `atelier`
  ADD CONSTRAINT `FK_E1BB182394F4A9D2` FOREIGN KEY (`themes_id`) REFERENCES `theme` (`id`);

--
-- Contraintes pour la table `categorie_chambre`
--
ALTER TABLE `categorie_chambre`
  ADD CONSTRAINT `FK_9A8A4A5DF5F3287F` FOREIGN KEY (`tarifs_id`) REFERENCES `proposer` (`id`);

--
-- Contraintes pour la table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `FK_3535ED9F5F3287F` FOREIGN KEY (`tarifs_id`) REFERENCES `proposer` (`id`);

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `FK_5E90F6D6A9DD7CE0` FOREIGN KEY (`nuites_id`) REFERENCES `nuite` (`id`);

--
-- Contraintes pour la table `licencie`
--
ALTER TABLE `licencie`
  ADD CONSTRAINT `FK_3B75561261190A32` FOREIGN KEY (`club_id`) REFERENCES `club` (`id`),
  ADD CONSTRAINT `FK_3B755612A6338570` FOREIGN KEY (`qualite_id`) REFERENCES `qualite` (`id`);

--
-- Contraintes pour la table `theme`
--
ALTER TABLE `theme`
  ADD CONSTRAINT `FK_9775E708B1409BC9` FOREIGN KEY (`ateliers_id`) REFERENCES `atelier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
