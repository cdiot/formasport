-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 30 nov. 2020 à 15:31
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `formasports`
--

-- --------------------------------------------------------

--
-- Structure de la table `instructor`
--

DROP TABLE IF EXISTS `instructor`;
CREATE TABLE IF NOT EXISTS `instructor` (
  `instructor_id` int(11) NOT NULL AUTO_INCREMENT,
  `instructor_civility` varchar(3) NOT NULL,
  `instructor_firstname` varchar(30) NOT NULL,
  `instructor_lastname` varchar(30) NOT NULL,
  `instructor_email` varchar(50) NOT NULL,
  `instructor_password` varchar(255) NOT NULL,
  `instructor_type` varchar(3) NOT NULL,
  PRIMARY KEY (`instructor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12704 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `instructor`
--

INSERT INTO `instructor` (`instructor_id`, `instructor_civility`, `instructor_firstname`, `instructor_lastname`, `instructor_email`, `instructor_password`, `instructor_type`) VALUES
(1723, 'Mme', 'Claude', 'Archaoui', 'Archaoui.Claude@formasport.fr', '$2y$10$m9PPrkzeD2UzYxKT7CPn9.vEYpPuDEZjKiCO7xuTYNGOi8dwYyhGC', 'BEN'),
(1876, 'Mme', 'Dominique', 'Delatre', 'Delattre.Dominique@formasport.fr', 'dominiquedela', 'BEN'),
(1882, 'M.', 'Franck', 'Deliege', 'Deliege.Franck@formasport.fr', 'franckdeli', 'BEN'),
(1895, 'Mme', 'kathy', 'Dereuder', 'Dereuder.Kathy@formasport.fr', 'kathydere', 'BEN'),
(1991, 'Mme', 'Alexandra', 'Goubelle', 'Goubelle.Alexandra@formasport.fr', 'alexandragoub', 'BEN'),
(2045, 'Mme', 'Sophie', 'Lamarche', 'Lamarche.Sophie@formasport.fr', 'sophielama', 'PER'),
(2050, 'M.', 'Vincent', 'Laoust', 'Laoust.Vincent@formasport.fr', 'vincentlaou', 'PER'),
(2082, 'Mme', 'Sylvie', 'Lenfant', 'Lenfant.Sylvie@formasport.fr', 'sylvielenf', 'PER'),
(2128, 'Mme', 'Francoise', 'Monparo', 'Monparo.Francoise@formasport.fr', 'francoisemonp', 'PER'),
(2148, 'Mme', 'Patricia', 'Penel', 'Penel.Patricia@formasport.fr', 'patriciapene', 'PER'),
(2735, 'M.', 'Benoit', 'Neveux', 'Neveux.Benoit@formasport.fr', 'benoitneve', 'PER'),
(5927, 'Mme', 'Camille', 'Somarto', 'Somarto.Camille@formasport.fr', 'camillesoma', 'PER'),
(7927, 'Mme', 'Carole', 'Cierpres', 'Cierpres.Carole@formasport.fr', 'carolecier', 'PER'),
(8165, 'Mme', 'Murielle', 'Vanooren', 'Vanooren.Murielle@formasport.fr', 'muriellevano', 'PER'),
(8340, 'Mme', 'Sabine', 'Ciranat', 'Cirana.Sabine@formasport.fr', 'sabinecira', 'PER'),
(8737, 'M.', 'Eric', 'Calteray', 'Calteray.Eric@formasport.fr', 'ericcalt', 'VAC'),
(9365, 'Mme', 'Florence', 'Maison', 'Maison.Florence@formasport.fr', 'florencemais', 'VAC'),
(10136, 'Mme', 'Muriel', 'Salhi', 'Salhi.Muriel@formasport.fr', 'murielsalh', 'VAC'),
(10747, 'M.', 'Philippe', 'Frazier', 'Frazier.Philippe@formasport.fr', 'philippefraz', 'VAC'),
(10972, 'M.', 'Rene', 'Guiot', 'Guiot.rene@formasport.fr', 'reneguio', 'VAC'),
(11469, 'Mme', 'Julie', 'Levaux', 'Levaux.Julie@formasport.fr', 'julieleva', 'VAC'),
(12042, 'Mme', 'Patricia', 'Morice ', 'Morice.Patricia@formasport.fr', 'patriciamori', 'VAC'),
(12473, 'Mme', 'Marie', 'Delebecque', 'Delebecque.Maire@formasport.fr', 'mariedele', 'VAC'),
(12493, 'Mme', 'Pascale', 'Fournier', 'Fournier.Pascale@formasport.fr', 'pascalefour', 'VAC'),
(12702, 'M.', 'Jean', 'Dessort', 'Dessort.Jean@formasport.fr', 'jeandess', 'VAC');

-- --------------------------------------------------------

--
-- Structure de la table `instructor_type`
--

DROP TABLE IF EXISTS `instructor_type`;
CREATE TABLE IF NOT EXISTS `instructor_type` (
  `instructor_type_id` varchar(3) NOT NULL,
  `instructor_libelle` varchar(30) NOT NULL,
  PRIMARY KEY (`instructor_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `instructor_type`
--

INSERT INTO `instructor_type` (`instructor_type_id`, `instructor_libelle`) VALUES
('BEN', 'Bénévole'),
('PER', 'Permanent'),
('VAC', 'Vacataire');

-- --------------------------------------------------------

--
-- Structure de la table `meeting`
--

DROP TABLE IF EXISTS `meeting`;
CREATE TABLE IF NOT EXISTS `meeting` (
  `meeting_id` int(11) NOT NULL AUTO_INCREMENT,
  `meeting_organizer_id` int(11) NOT NULL,
  `meeting_object` varchar(150) NOT NULL,
  `meeting_location` varchar(30) NOT NULL,
  `meeting_description` text NOT NULL,
  PRIMARY KEY (`meeting_id`),
  KEY `meeting_organizer_id` (`meeting_organizer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `meeting`
--

INSERT INTO `meeting` (`meeting_id`, `meeting_organizer_id`, `meeting_object`, `meeting_location`, `meeting_description`) VALUES
(1, 1723, 'Conseille des formateurs', 'M2L', 'Débat sur l\'éventuelle ouverture d\'une nouvelle formation.'),
(2, 1723, 'Inventaire des fournitures', 'Formasport', 'Ont fais le point sur le stock concernant les fournitures manquantes.'),
(3, 1876, 'Bilan des résultats du premier semestre', 'Formasport', 'Bilan sur l\'organisation du premier semestre concernant notamment le déroulement des stages, les notes des élèves et leurs assiduité. '),
(4, 1876, 'Problème concernant une formation', 'M2L', 'La formations dont vous êtes les formateurs, va subir une réforme, vous aller devoir suivre une remise à niveau.'),
(5, 1882, 'Présentation nouvelle outils.', 'M2L', 'Mise en service de notre nouvelle outils.'),
(6, 1882, 'Organisation des stages', 'Formasport', 'Dernier point sur concernant l\'organisation des stages particulièrement les élèves sans stage.'),
(9, 1876, 'Préparation de la rentrée', 'M2L', 'Préparatif concernant la réunions.'),
(10, 1876, 'festival de noël', 'Formasport', 'Vous êtes invité à l&#39;organisation du festival de noël.');

-- --------------------------------------------------------

--
-- Structure de la table `meeting_guest`
--

DROP TABLE IF EXISTS `meeting_guest`;
CREATE TABLE IF NOT EXISTS `meeting_guest` (
  `meeting_guest_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_instructor_id` int(11) NOT NULL,
  `fk_meeting_id` int(11) NOT NULL,
  PRIMARY KEY (`meeting_guest_id`),
  KEY `fk_instructor_id` (`fk_instructor_id`),
  KEY `fk_meeting_id` (`fk_meeting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `meeting_guest`
--

INSERT INTO `meeting_guest` (`meeting_guest_id`, `fk_instructor_id`, `fk_meeting_id`) VALUES
(1, 1876, 1),
(2, 2735, 1),
(3, 2082, 1),
(4, 10747, 1),
(5, 8165, 2),
(6, 2148, 2),
(7, 10972, 2),
(8, 12702, 2),
(9, 1723, 3),
(10, 12473, 3),
(11, 12493, 3),
(12, 2045, 3),
(13, 1723, 4),
(14, 1895, 4),
(15, 5927, 4),
(16, 1882, 4),
(17, 2128, 5),
(18, 9365, 5),
(19, 10747, 5),
(20, 2050, 6),
(21, 10972, 6);

-- --------------------------------------------------------

--
-- Structure de la table `meeting_guest_presence`
--

DROP TABLE IF EXISTS `meeting_guest_presence`;
CREATE TABLE IF NOT EXISTS `meeting_guest_presence` (
  `meeting_guest_presence_id` int(11) NOT NULL AUTO_INCREMENT,
  `meeting_guest_presence_response` tinyint(1) NOT NULL,
  `fk_instructor_id` int(11) NOT NULL,
  `fk_meeting_time_slot_id` int(11) NOT NULL,
  PRIMARY KEY (`meeting_guest_presence_id`),
  KEY `fk_instructor_id` (`fk_instructor_id`),
  KEY `fk_meeting_time_slot_id` (`fk_meeting_time_slot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `meeting_guest_presence`
--

INSERT INTO `meeting_guest_presence` (`meeting_guest_presence_id`, `meeting_guest_presence_response`, `fk_instructor_id`, `fk_meeting_time_slot_id`) VALUES
(10, 1, 1723, 5);

-- --------------------------------------------------------

--
-- Structure de la table `meeting_time_slot`
--

DROP TABLE IF EXISTS `meeting_time_slot`;
CREATE TABLE IF NOT EXISTS `meeting_time_slot` (
  `meeting_time_slot_id` int(11) NOT NULL AUTO_INCREMENT,
  `meeting_time_slot_start` datetime NOT NULL,
  `meeting_time_slot_end` datetime NOT NULL,
  `fk_meeting_id` int(11) NOT NULL,
  PRIMARY KEY (`meeting_time_slot_id`),
  KEY `fk_meeting_id` (`fk_meeting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `meeting_time_slot`
--

INSERT INTO `meeting_time_slot` (`meeting_time_slot_id`, `meeting_time_slot_start`, `meeting_time_slot_end`, `fk_meeting_id`) VALUES
(1, '2021-03-30 08:00:00', '2021-03-30 12:00:00', 1),
(2, '2021-03-30 14:00:00', '2021-03-30 18:00:00', 1),
(3, '2021-06-15 08:00:00', '2021-06-15 12:00:00', 2),
(4, '2021-06-15 14:00:00', '2021-06-15 18:00:00', 2),
(5, '2021-04-07 08:30:00', '2021-04-07 12:30:00', 3),
(6, '2021-01-15 08:00:00', '2021-01-15 12:00:00', 4),
(7, '2021-01-15 14:30:00', '2021-01-15 18:30:00', 4),
(8, '2021-10-30 08:55:00', '2021-10-30 12:55:00', 5),
(9, '2021-05-20 14:00:00', '2021-05-20 18:00:00', 6),
(10, '2021-05-20 08:00:00', '2021-05-20 12:00:00', 6),
(11, '2021-02-20 12:00:00', '2021-02-20 18:00:00', 9),
(12, '2021-02-20 08:00:00', '2021-02-20 12:00:00', 10),
(13, '2021-02-20 14:00:00', '2021-02-20 18:00:00', 10);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `messages_id` int(11) NOT NULL AUTO_INCREMENT,
  `messages_content` text NOT NULL,
  `messages_created_at` datetime NOT NULL,
  `fk_instructor_id` int(11) NOT NULL,
  `fk_meeting_id` int(11) NOT NULL,
  PRIMARY KEY (`messages_id`),
  KEY `messages_ibfk_1` (`fk_instructor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`messages_id`, `messages_content`, `messages_created_at`, `fk_instructor_id`, `fk_meeting_id`) VALUES
(1, 'Pouvez-vous indiquer votre disponibilité ? merci d\'avance à tous!', '2020-11-10 10:11:34', 1723, 1),
(2, 'Bonjour je suis disponible pour cette réunion si besoin!', '2020-11-10 10:12:24', 1876, 2),
(3, 'Oui si tes disponibles tu peux venir, la réunion est ouvertes à tous il n\'y a pas de soucis.', '2020-11-14 10:14:46', 10972, 2),
(4, 'Qui est disponible ?', '2020-11-14 10:15:49', 1876, 3),
(5, 'Désoler, je ne suis pas disponible ce matin la.', '2020-11-14 10:16:05', 12473, 3),
(6, 'Je viens d\'indiquer ma disponibilité.', '2020-11-14 10:16:35', 1723, 4),
(7, 'Je te remercie.', '2020-11-14 10:16:37', 1876, 4),
(8, 'Ce samedi la ça va être difficile.', '2020-11-14 10:17:14', 10747, 5),
(9, 'Désoler.', '2020-11-14 10:17:26', 10747, 5),
(10, 'Je ne suis pas disponible désoler. ', '2020-11-14 10:18:49', 10972, 6),
(11, 'Moi il y a pas de souci je suis disponible le matin et l\'après midi.', '2020-11-14 10:19:04', 2050, 6),
(12, 'D\'accord je vous remercie.', '2020-11-14 10:20:07', 1882, 6),
(52, 'Désoler, s\'il y a du changement je vous tiens au courant.', '2020-11-17 22:32:24', 10972, 6);

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `token_id` int(11) NOT NULL AUTO_INCREMENT,
  `token_code` varchar(12) NOT NULL,
  `token_creation_date` datetime NOT NULL,
  `fk_instructor_email` varchar(50) NOT NULL,
  PRIMARY KEY (`token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `trainings`
--

DROP TABLE IF EXISTS `trainings`;
CREATE TABLE IF NOT EXISTS `trainings` (
  `forming_id` int(11) NOT NULL AUTO_INCREMENT,
  `forming_title` varchar(35) NOT NULL,
  `forming_duration` varchar(15) NOT NULL,
  `forming_description` text NOT NULL,
  PRIMARY KEY (`forming_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `trainings`
--

INSERT INTO `trainings` (`forming_id`, `forming_title`, `forming_duration`, `forming_description`) VALUES
(1, 'BPJEPS APT', '1 ans', 'Permet d\'évoluer en tant qu\'animateur et éducateur des Activités Physiques pour Tous, au sein de structures privées, de la fonction publique ou au titre de travailleur indépendant.'),
(2, 'BPJEPS AGFF', '1 ans', 'Permet d\'évoluer en tant qu\'animateur et éducateur des Activités de la Forme, au sein de structures privées ou associatives ou au titre de travailleur indépendant.'),
(3, 'BPJEPS ANN', '1 ans', 'Permet d\'évoluer en tant qu\'animateur des Activités de la Natation et autres activités Aquatiques, intervient au niveau pédagogique, pour tous les publics.'),
(4, 'DS2PS', '200 heures', 'Animée par des intervenants professionnels, orientée vers la préparation physique des athlètes de haut-niveau et intégrée dans une dimension santé et nutrition.'),
(5, 'PERF', '1 jour', 'Ensemble de séminaires courts sur le perfectionnement et la performance, dans le domaine de la préparation physique et de l\'entraînement sportif.'),
(6, 'PREPA', '2 ans', 'Seulement 30% des candidats présents aux sélections accèdent à l\'entrée en BPJEPS. C\'est pourquoi nous avons con\\u00e7u un cycle de classes de préparation.');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_guest`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `view_guest`;
CREATE TABLE IF NOT EXISTS `view_guest` (
`instructor_id` int(11)
,`instructor_civility` varchar(3)
,`instructor_firstname` varchar(30)
,`instructor_lastname` varchar(30)
,`meeting_id` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_meeting`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `view_meeting`;
CREATE TABLE IF NOT EXISTS `view_meeting` (
`organizer_id` int(11)
,`instructor_civility` varchar(3)
,`instructor_firstname` varchar(30)
,`instructor_lastname` varchar(30)
,`meeting_id` int(11)
,`meeting_object` varchar(150)
,`meeting_location` varchar(30)
,`meeting_description` text
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_time_slot`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `view_time_slot`;
CREATE TABLE IF NOT EXISTS `view_time_slot` (
`time_slot_id` int(11)
,`meeting_id` int(11)
,`meeting_date` varchar(137)
,`meeting_start` time
,`meeting_end` time
);

-- --------------------------------------------------------

--
-- Structure de la vue `view_guest`
--
DROP TABLE IF EXISTS `view_guest`;

DROP VIEW IF EXISTS `view_guest`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_guest`  AS  select `i`.`instructor_id` AS `instructor_id`,`i`.`instructor_civility` AS `instructor_civility`,`i`.`instructor_firstname` AS `instructor_firstname`,`i`.`instructor_lastname` AS `instructor_lastname`,`m`.`meeting_id` AS `meeting_id` from ((`meeting` `m` join `meeting_guest` `g` on((`m`.`meeting_id` = `g`.`fk_meeting_id`))) join `instructor` `i` on((`g`.`fk_instructor_id` = `i`.`instructor_id`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `view_meeting`
--
DROP TABLE IF EXISTS `view_meeting`;

DROP VIEW IF EXISTS `view_meeting`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_meeting`  AS  select `m`.`meeting_organizer_id` AS `organizer_id`,`i`.`instructor_civility` AS `instructor_civility`,`i`.`instructor_firstname` AS `instructor_firstname`,`i`.`instructor_lastname` AS `instructor_lastname`,`m`.`meeting_id` AS `meeting_id`,`m`.`meeting_object` AS `meeting_object`,`m`.`meeting_location` AS `meeting_location`,`m`.`meeting_description` AS `meeting_description` from ((`meeting` `m` join `instructor` `i` on((`m`.`meeting_organizer_id` = `i`.`instructor_id`))) join `meeting_time_slot` `ts` on((`m`.`meeting_id` = `ts`.`fk_meeting_id`))) where (`ts`.`meeting_time_slot_start` >= now()) group by `m`.`meeting_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `view_time_slot`
--
DROP TABLE IF EXISTS `view_time_slot`;

DROP VIEW IF EXISTS `view_time_slot`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_time_slot`  AS  select `ts`.`meeting_time_slot_id` AS `time_slot_id`,`m`.`meeting_id` AS `meeting_id`,date_format(`ts`.`meeting_time_slot_start`,'%W %e %M %Y') AS `meeting_date`,cast(`ts`.`meeting_time_slot_start` as time) AS `meeting_start`,cast(`ts`.`meeting_time_slot_end` as time) AS `meeting_end` from (`meeting` `m` join `meeting_time_slot` `ts` on((`m`.`meeting_id` = `ts`.`fk_meeting_id`))) ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `meeting`
--
ALTER TABLE `meeting`
  ADD CONSTRAINT `meeting_ibfk_1` FOREIGN KEY (`meeting_organizer_id`) REFERENCES `instructor` (`instructor_id`);

--
-- Contraintes pour la table `meeting_guest`
--
ALTER TABLE `meeting_guest`
  ADD CONSTRAINT `meeting_guest_ibfk_1` FOREIGN KEY (`fk_instructor_id`) REFERENCES `instructor` (`instructor_id`),
  ADD CONSTRAINT `meeting_guest_ibfk_2` FOREIGN KEY (`fk_meeting_id`) REFERENCES `meeting` (`meeting_id`);

--
-- Contraintes pour la table `meeting_guest_presence`
--
ALTER TABLE `meeting_guest_presence`
  ADD CONSTRAINT `meeting_guest_presence_ibfk_1` FOREIGN KEY (`fk_instructor_id`) REFERENCES `instructor` (`instructor_id`),
  ADD CONSTRAINT `meeting_guest_presence_ibfk_2` FOREIGN KEY (`fk_meeting_time_slot_id`) REFERENCES `meeting_time_slot` (`meeting_time_slot_id`);

--
-- Contraintes pour la table `meeting_time_slot`
--
ALTER TABLE `meeting_time_slot`
  ADD CONSTRAINT `meeting_time_slot_ibfk_1` FOREIGN KEY (`fk_meeting_id`) REFERENCES `meeting` (`meeting_id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`fk_instructor_id`) REFERENCES `instructor` (`instructor_id`);

DELIMITER $$
--
-- Évènements
--
DROP EVENT `clean_token`$$
CREATE DEFINER=`root`@`localhost` EVENT `clean_token` ON SCHEDULE EVERY 1 DAY STARTS '2020-11-26 08:00:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Vide les jetons dépassent heure.' DO DELETE FROM token$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
