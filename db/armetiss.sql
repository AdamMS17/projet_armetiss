-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 28 mars 2022 à 11:19
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `armetiss`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE `activite` (
  `identifiant_Activite` int(11) NOT NULL,
  `nom_Activite` varchar(40) NOT NULL,
  `jour_Activite` varchar(8) NOT NULL,
  `heureDebut_Activite` time NOT NULL,
  `heureFin_Activite` time NOT NULL,
  `identifiant_Personne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `estpresent`
--

CREATE TABLE `estpresent` (
  `identifiant_Activite` int(11) NOT NULL,
  `identifiant_Personne` int(11) NOT NULL,
  `date_Sceance` date NOT NULL,
  `estPresent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `identifiant_Evenement` int(11) NOT NULL,
  `nom_Evenement` varchar(40) NOT NULL,
  `date_Evenement` date NOT NULL,
  `heureDebut_Evenement` time NOT NULL,
  `heureFin_Evenement` time NOT NULL,
  `cout_Evenement` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

CREATE TABLE `inscrit` (
  `identifiant_Activite` int(11) NOT NULL,
  `identifiant_Personne` int(11) NOT NULL,
  `montant` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `identifiant_Personne` int(11) NOT NULL,
  `numeroTel2_Membre` varchar(13) NOT NULL,
  `commentaire_Membre` varchar(500) NOT NULL,
  `actif_Membre` tinyint(1) NOT NULL,
  `inscriptionPaye_Membre` tinyint(1) NOT NULL,
  `montantCalculer_Membre` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `identifiant_Personne` int(11) NOT NULL,
  `date_Paiement` date NOT NULL,
  `montant_Paiement` int(5) NOT NULL,
  `identifiant_Activite` int(11) DEFAULT NULL,
  `identifiant_Evenement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `identifiant_Personne` int(11) NOT NULL,
  `identifiant_Evenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `identifiant_Personne` int(11) NOT NULL,
  `login_Personne` varchar(40) NOT NULL,
  `nom_Personne` varchar(40) NOT NULL,
  `prenom_Personne` varchar(40) NOT NULL,
  `motDePasse_Personne` varchar(40) NOT NULL,
  `ville_Personne` varchar(40) NOT NULL,
  `rue_Personne` varchar(40) NOT NULL,
  `numero_Personne` int(3) NOT NULL,
  `numeroTel_Personne` varchar(13) NOT NULL,
  `dateNaiss_Personne` date NOT NULL,
  `email_Personne` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `identifiant_Personne` int(11) NOT NULL,
  `identifiant_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `identifiant_Role` int(11) NOT NULL,
  `nom_Role` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE `seance` (
  `identifiant_Activite` int(11) NOT NULL,
  `date_Sceance` date NOT NULL,
  `identifiant_Personne` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`identifiant_Activite`),
  ADD KEY `identifiant_Personne` (`identifiant_Personne`);

--
-- Index pour la table `estpresent`
--
ALTER TABLE `estpresent`
  ADD KEY `identifiant_Activite` (`identifiant_Activite`),
  ADD KEY `identifiant_Personne` (`identifiant_Personne`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`identifiant_Evenement`);

--
-- Index pour la table `inscrit`
--
ALTER TABLE `inscrit`
  ADD KEY `identifiant_Activite` (`identifiant_Activite`),
  ADD KEY `identifiant_Personne` (`identifiant_Personne`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD KEY `identifiant_Personne` (`identifiant_Personne`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD KEY `identifiant_Activite` (`identifiant_Activite`),
  ADD KEY `identifiant_Evenement` (`identifiant_Evenement`),
  ADD KEY `identifiant_Personne` (`identifiant_Personne`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD KEY `identifiant_Evenement` (`identifiant_Evenement`),
  ADD KEY `identifiant_Personne` (`identifiant_Personne`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`identifiant_Personne`);

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD KEY `identifiant_Personne` (`identifiant_Personne`),
  ADD KEY `identifiant_role` (`identifiant_role`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`identifiant_Role`);

--
-- Index pour la table `seance`
--
ALTER TABLE `seance`
  ADD KEY `identifiant_Activite` (`identifiant_Activite`),
  ADD KEY `identifiant_Personne` (`identifiant_Personne`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activite`
--
ALTER TABLE `activite`
  MODIFY `identifiant_Activite` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `identifiant_Evenement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `identifiant_Personne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `identifiant_Role` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activite`
--
ALTER TABLE `activite`
  ADD CONSTRAINT `activite_ibfk_1` FOREIGN KEY (`identifiant_Personne`) REFERENCES `personne` (`identifiant_Personne`);

--
-- Contraintes pour la table `estpresent`
--
ALTER TABLE `estpresent`
  ADD CONSTRAINT `estpresent_ibfk_1` FOREIGN KEY (`identifiant_Activite`) REFERENCES `activite` (`identifiant_Activite`),
  ADD CONSTRAINT `estpresent_ibfk_2` FOREIGN KEY (`identifiant_Personne`) REFERENCES `personne` (`identifiant_Personne`);

--
-- Contraintes pour la table `inscrit`
--
ALTER TABLE `inscrit`
  ADD CONSTRAINT `inscrit_ibfk_1` FOREIGN KEY (`identifiant_Activite`) REFERENCES `activite` (`identifiant_Activite`),
  ADD CONSTRAINT `inscrit_ibfk_2` FOREIGN KEY (`identifiant_Personne`) REFERENCES `personne` (`identifiant_Personne`);

--
-- Contraintes pour la table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `membre_ibfk_1` FOREIGN KEY (`identifiant_Personne`) REFERENCES `personne` (`identifiant_Personne`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`identifiant_Activite`) REFERENCES `activite` (`identifiant_Activite`),
  ADD CONSTRAINT `paiement_ibfk_2` FOREIGN KEY (`identifiant_Evenement`) REFERENCES `evenement` (`identifiant_Evenement`),
  ADD CONSTRAINT `paiement_ibfk_3` FOREIGN KEY (`identifiant_Personne`) REFERENCES `personne` (`identifiant_Personne`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `participe_ibfk_1` FOREIGN KEY (`identifiant_Evenement`) REFERENCES `evenement` (`identifiant_Evenement`),
  ADD CONSTRAINT `participe_ibfk_2` FOREIGN KEY (`identifiant_Personne`) REFERENCES `personne` (`identifiant_Personne`);

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `personnel_ibfk_1` FOREIGN KEY (`identifiant_Personne`) REFERENCES `personne` (`identifiant_Personne`),
  ADD CONSTRAINT `personnel_ibfk_2` FOREIGN KEY (`identifiant_role`) REFERENCES `role` (`identifiant_Role`);

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `seance_ibfk_1` FOREIGN KEY (`identifiant_Activite`) REFERENCES `activite` (`identifiant_Activite`),
  ADD CONSTRAINT `seance_ibfk_2` FOREIGN KEY (`identifiant_Personne`) REFERENCES `personne` (`identifiant_Personne`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
