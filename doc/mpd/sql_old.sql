-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generated on: Tue Feb 04 2025 at 12:51
-- Server version: 10.4.32-MariaDB
-- PHP version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Set character set and collation
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS `m2l` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `m2l`;

-- Table structure for `faq`
DROP TABLE IF EXISTS `faq`;
CREATE TABLE `faq` (
    `id_faq` int(11) NOT NULL,
    `question` varchar(255) DEFAULT NULL,
    `reponse` varchar(255) DEFAULT NULL,
    `dat_question` datetime DEFAULT NULL,
    `dat_reponse` datetime DEFAULT NULL,
    `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table `faq`
INSERT INTO `faq` (`id_faq`, `question`, `reponse`, `dat_question`, `dat_reponse`, `id_user`) VALUES
(1, 'Comment créer un compte ?', 'Pour créer un compte, cliquez sur \"S\'inscrire\" et remplissez les informations demandées.', '2025-02-04 12:37:37', '2025-02-04 12:37:37', 1),
(2, 'Que faire si je perds mon mot de passe ?', 'Vous pouvez réinitialiser votre mot de passe en suivant les instructions sur la page de réinitialisation.', '2025-02-04 12:37:37', '2025-02-04 12:37:37', 2);

-- Table structure for `ligue`
DROP TABLE IF EXISTS `ligue`;
CREATE TABLE `ligue` (
    `id_ligue` int(11) NOT NULL,
    `lib_ligue` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table `ligue`
INSERT INTO `ligue` (`id_ligue`, `lib_ligue`) VALUES
(1, 'Ligue de football'),
(2, 'Ligue de basket'),
(3, 'Ligue de volley'),
(4, 'Ligue de handball');

-- Table structure for `usertype`
DROP TABLE IF EXISTS `usertype`;
CREATE TABLE `usertype` (
    `id_usertype` int(11) NOT NULL,
    `lib_usertype` varchar(50) DEFAULT NULL,
    `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table `usertype`
INSERT INTO `usertype` (`id_usertype`, `lib_usertype`, `description`) VALUES
(1, 'Admin', 'Utilisateur ayant un accès complet aux fonctionnalités'),
(2, 'Moderator', 'Utilisateur modérant les interactions'),
(3, 'User', 'Utilisateur ayant un accès limité aux fonctionnalités');

-- Table structure for `user_`
DROP TABLE IF EXISTS `user_`;
CREATE TABLE `user_` (
    `id_user` int(11) NOT NULL,
    `pseudo` varchar(50) DEFAULT NULL,
    `mail` varchar(50) DEFAULT NULL,
    `mdp` varchar(255) DEFAULT NULL,
    `id_ligue` int(11) NOT NULL,
    `id_usertype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table `user_`
INSERT INTO `user_` (`id_user`, `pseudo`, `mail`, `mdp`, `id_ligue`, `id_usertype`) VALUES
(1, 'bob', 'bob@example.com', 'password1', 1, 3),
(2, 'batman', 'batman@example.com', 'password2', 2, 1),
(3, 'spiderman', 'spiderman@example.com', 'password3', 3, 2);

-- Indexes for dumped tables

-- Indexes for table `faq`
ALTER TABLE `faq`
    ADD PRIMARY KEY (`id_faq`),
    ADD KEY `id_user` (`id_user`);

-- Indexes for table `ligue`
ALTER TABLE `ligue`
    ADD PRIMARY KEY (`id_ligue`);

-- Indexes for table `usertype`
ALTER TABLE `usertype`
    ADD PRIMARY KEY (`id_usertype`);

-- Indexes for table `user_`
ALTER TABLE `user_`
    ADD PRIMARY KEY (`id_user`),
    ADD KEY `id_ligue` (`id_ligue`),
    ADD KEY `id_usertype` (`id_usertype`);

-- AUTO_INCREMENT for dumped tables

-- AUTO_INCREMENT for table `faq`
ALTER TABLE `faq`
    MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- AUTO_INCREMENT for table `ligue`
ALTER TABLE `ligue`
    MODIFY `id_ligue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

-- AUTO_INCREMENT for table `usertype`
ALTER TABLE `usertype`
    MODIFY `id_usertype` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- AUTO_INCREMENT for table `user_`
ALTER TABLE `user_`
    MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- Constraints for dumped tables

-- Constraints for table `faq`
ALTER TABLE `faq`
    ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_` (`id_user`);

-- Constraints for table `user_`
ALTER TABLE `user_`
    ADD CONSTRAINT `user__ibfk_1` FOREIGN KEY (`id_ligue`) REFERENCES `ligue` (`id_ligue`),
    ADD CONSTRAINT `user__ibfk_2` FOREIGN KEY (`id_usertype`) REFERENCES `usertype` (`id_usertype`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
