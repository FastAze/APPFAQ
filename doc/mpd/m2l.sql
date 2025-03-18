-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 18 mars 2025 à 14:22
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `m2l`
--

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `id_faq` int(11) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `reponse` varchar(255) DEFAULT NULL,
  `dat_question` datetime DEFAULT NULL,
  `dat_reponse` datetime DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`id_faq`, `question`, `reponse`, `dat_question`, `dat_reponse`, `id_user`) VALUES
(1, 'Comment créer un compte ?', 'Pour créer un compte, cliquez sur &quot;S&#039;inscrire&quot; et remplissez les informations demandées.', '2025-02-04 12:37:37', '2025-03-15 04:20:09', 1),
(2, 'Que faire si je perds mon mot de passe ?', 'Vous pouvez réinitialiser votre mot de passe en suivant les instructions sur la page de réinitialisation.', '2025-02-04 12:37:37', '2025-02-04 12:37:37', 2),
(3, 'ca marche ?', NULL, '2025-03-15 15:28:34', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

CREATE TABLE `ligue` (
  `id_ligue` int(11) NOT NULL,
  `lib_ligue` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `ligue`
--

INSERT INTO `ligue` (`id_ligue`, `lib_ligue`) VALUES
(1, 'Ligue de football'),
(2, 'Ligue de basket'),
(3, 'Ligue de volley'),
(4, 'Ligue de handball');

-- --------------------------------------------------------

--
-- Structure de la table `usertype`
--

CREATE TABLE `usertype` (
  `id_usertype` int(11) NOT NULL,
  `lib_usertype` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `usertype`
--

INSERT INTO `usertype` (`id_usertype`, `lib_usertype`, `description`) VALUES
(1, 'Admin', 'Utilisateur ayant un accès complet aux fonctionnalités'),
(2, 'Moderator', 'Utilisateur modérant les interactions'),
(3, 'User', 'Utilisateur ayant un accès limité aux fonctionnalités');

-- --------------------------------------------------------

--
-- Structure de la table `user_`
--

CREATE TABLE `user_` (
  `id_user` int(11) NOT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `id_ligue` int(11) NOT NULL,
  `id_usertype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user_`
--

INSERT INTO `user_` (`id_user`, `pseudo`, `mail`, `mdp`, `id_ligue`, `id_usertype`) VALUES
(1, 'bob', 'bob@example.com', '$2y$10$2K3qjJvq34UQQ5oY3/TSpOcmgw6vsIj1L47IamrvXpnDh7nMmT/Ei', 1, 3),
(2, 'batman', 'batman@example.com', '$2y$10$S.pvIF4/YrfJaR11s4spIen.Zi6rTtLpa9eTHc1.9pfcE.MZJeYhS', 2, 1),
(3, 'spiderman', 'spiderman@example.com', '$2y$10$cDTUm6MwlKFmoDjYWyHfruYUhUjU7NytLui9KfX8i78tEUC9pZDIm', 3, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD PRIMARY KEY (`id_ligue`);

--
-- Index pour la table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id_usertype`);

--
-- Index pour la table `user_`
--
ALTER TABLE `user_`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_ligue` (`id_ligue`),
  ADD KEY `id_usertype` (`id_usertype`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ligue`
--
ALTER TABLE `ligue`
  MODIFY `id_ligue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id_usertype` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user_`
--
ALTER TABLE `user_`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_` (`id_user`);

--
-- Contraintes pour la table `user_`
--
ALTER TABLE `user_`
  ADD CONSTRAINT `user__ibfk_1` FOREIGN KEY (`id_ligue`) REFERENCES `ligue` (`id_ligue`),
  ADD CONSTRAINT `user__ibfk_2` FOREIGN KEY (`id_usertype`) REFERENCES `usertype` (`id_usertype`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
