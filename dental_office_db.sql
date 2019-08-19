-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 19 août 2019 à 13:28
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dental_office_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `id_appointment` int(8) NOT NULL AUTO_INCREMENT,
  `id_doctor` int(8) NOT NULL,
  `id_patient` int(8) NOT NULL,
  `timestamp_appointment` bigint(20) NOT NULL,
  `message_appointment` text NOT NULL,
  `is_appointment` int(11) NOT NULL,
  PRIMARY KEY (`id_appointment`),
  KEY `id_doctor` (`id_doctor`),
  KEY `id_patient` (`id_patient`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `appointment`
--

INSERT INTO `appointment` (`id_appointment`, `id_doctor`, `id_patient`, `timestamp_appointment`, `message_appointment`, `is_appointment`) VALUES
(13, 1, 1, 1566200700, 'Consultation', 0);

-- --------------------------------------------------------

--
-- Structure de la table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `id_doctor` int(8) NOT NULL AUTO_INCREMENT,
  `full_name_doctor` varchar(128) NOT NULL,
  `gender_doctor` bit(1) NOT NULL,
  `phone_number_doctor` int(12) NOT NULL,
  `username_doctor` varchar(64) NOT NULL,
  `password_doctor` varchar(256) NOT NULL,
  PRIMARY KEY (`id_doctor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `doctors`
--

INSERT INTO `doctors` (`id_doctor`, `full_name_doctor`, `gender_doctor`, `phone_number_doctor`, `username_doctor`, `password_doctor`) VALUES
(1, 'john murphy', b'1', 555555555, 'doc', '123');

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `id_patient` int(8) NOT NULL AUTO_INCREMENT,
  `id_doctor` int(8) NOT NULL,
  `full_name_patient` varchar(128) NOT NULL,
  `birthdate_patient` date NOT NULL,
  `phone_number_patient` varchar(12) NOT NULL,
  `address_patient` varchar(256) NOT NULL,
  `gender_patient` varchar(1) NOT NULL,
  PRIMARY KEY (`id_patient`),
  KEY `id_doctor` (`id_doctor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`id_patient`, `id_doctor`, `full_name_patient`, `birthdate_patient`, `phone_number_patient`, `address_patient`, `gender_patient`) VALUES
(1, 1, 'Abdi karim', '1997-06-17', '0666296904', '5, rue Jacques Callot', '1');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`id_doctor`) REFERENCES `doctors` (`id_doctor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`id_patient`) REFERENCES `patients` (`id_patient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`id_doctor`) REFERENCES `doctors` (`id_doctor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
