-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 09 déc. 2021 à 10:17
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cogip`
--

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `vat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `company`
--

INSERT INTO `company` (`id`, `name`, `country`, `vat`) VALUES
(1, 'Jean-Michel Factory ', 'Belgium', 'BE0562025863'),
(2, 'Becode', 'Belgium', 'BE0664802168'),
(3, 'Raviga', 'United States', 'US0456025862'),
(4, 'Dunder', 'United States', 'US0856025862'),
(5, 'Belgalog', 'Belgium', 'BE0696028862'),
(6, 'Proximdrrr', 'France', 'FR0856025862'),
(9, 'aaaaaa', 'aaaaa', 'aaaaa');

-- --------------------------------------------------------

--
-- Structure de la table `companytype`
--

CREATE TABLE `companytype` (
  `id` tinyint(3) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `companytype`
--

INSERT INTO `companytype` (`id`, `name`) VALUES
(1, 'client'),
(2, 'provider');

-- --------------------------------------------------------

--
-- Structure de la table `company_type`
--

CREATE TABLE `company_type` (
  `idcompany` int(11) NOT NULL,
  `idtype` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `company_type`
--

INSERT INTO `company_type` (`idcompany`, `idtype`) VALUES
(1, 2),
(2, 1),
(3, 2),
(4, 2),
(5, 1),
(6, 1),
(7, 2),
(8, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `number` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `content` text NOT NULL,
  `amount` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `invoice`
--

INSERT INTO `invoice` (`id`, `number`, `date`, `content`, `amount`) VALUES
(1, 'FA2021/00001', '2021-11-26', '100 Masque personnalisé', 50.1),
(2, '2021FA/00001', '2021-11-28', '100 masques personnalisé', 250),
(3, '2021FA/00003', '2020-10-10', 'Paires de bass', 600),
(4, '2021FA/00004', '2021-03-05', 'Vélo BMX', 3500);

-- --------------------------------------------------------

--
-- Structure de la table `invoice_company`
--

CREATE TABLE `invoice_company` (
  `idcompany` int(11) NOT NULL,
  `idinvoice` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `invoice_company`
--

INSERT INTO `invoice_company` (`idcompany`, `idinvoice`) VALUES
(1, 1),
(1, 6),
(2, 2),
(2, 5),
(2, 10),
(2, 11),
(2, 12),
(3, 9),
(4, 7),
(5, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `people`
--

INSERT INTO `people` (`id`, `firstname`, `lastname`, `email`, `phone`) VALUES
(1, 'Jean-Michel', 'Ichram', 'ichram@gmail.com', '0459857585'),
(2, 'Arnaud', 'Duchemin', 'arnaud@becode.org', '0485632597'),
(3, 'Pierre', 'Richard', 'Chaussurenoire@grandblond.com', '0475128549'),
(4, 'John', 'Smith', 'johnsmits@hotmail.com', '0486598347'),
(5, 'Vince', 'Partner', 'vp@gmail.com', '0474659834'),
(6, 'Mich', 'Mich', 'MichMich@hotmail.com', '0495458319');

-- --------------------------------------------------------

--
-- Structure de la table `people_company`
--

CREATE TABLE `people_company` (
  `idpeople` int(11) NOT NULL,
  `idcompany` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `people_company`
--

INSERT INTO `people_company` (`idpeople`, `idcompany`) VALUES
(1, 1),
(2, 2),
(3, 4),
(4, 3),
(5, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Structure de la table `people_invoice`
--

CREATE TABLE `people_invoice` (
  `idpeople` int(11) NOT NULL,
  `idinvoice` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `people_invoice`
--

INSERT INTO `people_invoice` (`idpeople`, `idinvoice`) VALUES
(1, 1),
(1, 6),
(2, 2),
(2, 5),
(3, 7),
(5, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `modegod` tinyint(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `login`, `email`, `password`, `modegod`) VALUES
(1, 'Jean-Christian', 'Ranu', 'Jean-Christian', 'jeanchristian@gmail.com', 'f1ae4a0bb3bd77e6eeec82949f50b334c409d4f7', 1),
(2, 'Muriel', 'Perrache', 'Muriel', 'murielperrache@gmail.com', 'ce61487ebde80c774d015152f38f945e73598af9', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `companytype`
--
ALTER TABLE `companytype`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `company_type`
--
ALTER TABLE `company_type`
  ADD PRIMARY KEY (`idcompany`,`idtype`);

--
-- Index pour la table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `invoice_company`
--
ALTER TABLE `invoice_company`
  ADD PRIMARY KEY (`idcompany`,`idinvoice`);

--
-- Index pour la table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `people_company`
--
ALTER TABLE `people_company`
  ADD PRIMARY KEY (`idpeople`,`idcompany`),
  ADD KEY `idcompany` (`idcompany`);

--
-- Index pour la table `people_invoice`
--
ALTER TABLE `people_invoice`
  ADD PRIMARY KEY (`idpeople`,`idinvoice`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `companytype`
--
ALTER TABLE `companytype`
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `people_company`
--
ALTER TABLE `people_company`
  ADD CONSTRAINT `people_company_ibfk_1` FOREIGN KEY (`idpeople`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `people_company_ibfk_2` FOREIGN KEY (`idcompany`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
