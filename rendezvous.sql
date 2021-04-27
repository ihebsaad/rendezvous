-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 27, 2021 at 02:24 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rendezvous`
--

-- --------------------------------------------------------

--
-- Table structure for table `abonnements`
--

DROP TABLE IF EXISTS `abonnements`;
CREATE TABLE IF NOT EXISTS `abonnements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `abonnement` int(1) NOT NULL,
  `details` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `expire` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `abonnements`
--

INSERT INTO `abonnements` (`id`, `user`, `abonnement`, `details`, `expire`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'N°: 1 | Basique (mensuel)', '2021-01-07 14:56:45', '2020-12-07 14:56:48', '2020-12-07 14:56:48'),
(2, 6, 1, 'N°: 1 | Basique (mensuel)', '2021-01-08 14:47:16', '2020-12-08 14:47:19', '2020-12-08 14:47:19'),
(3, 5, 3, 'N°: 3 | Annuel (annuel)', '2022-01-07 14:56:45', '2020-12-12 10:42:26', '2020-12-12 10:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `alertes`
--

DROP TABLE IF EXISTS `alertes`;
CREATE TABLE IF NOT EXISTS `alertes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `titre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `alertes`
--

INSERT INTO `alertes` (`id`, `user`, `titre`, `details`, `created_at`, `updated_at`) VALUES
(1, 5, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation <br>Veillez la confirmer dans votre Tableau de bord.<b>Service :</b>  pizza  - (50 )  <br><b>Date :</b> 30/11/2020Heure : 08:00<br><b>Client :</b> John Fontaine<br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-11-30 12:36:07', '2020-11-30 12:36:07'),
(2, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès. Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  pizza  - (50 )  <br><b>Date :</b> 30/11/2020Heure : 08:00<br><b>Client :</b> John Fontaine<br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-11-30 12:36:11', '2020-11-30 12:36:11'),
(3, 3, 'Réservation validée', 'Votre rendez vous est confirmé par le prestataire.<br><b>Service :</b>  pizza  - (50 )  <br><b>Date :</b> 30/11/2020 - Heure : 08:00<br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-11-30 14:12:03', '2020-11-30 14:12:03'),
(4, 2, 'Réservation annulée', 'Vtre rendez vous est annulée par le prestataire.<br><b>Service :</b>  consultation  - (120 €)  <br><b>Date :</b> 17/11/2020 - <b>Heure :</b> 10:00<br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-11-30 14:18:01', '2020-11-30 14:18:01'),
(5, 2, 'Réservation annulée', 'Vtre rendez vous est annulée par le prestataire.<br><b>Service :</b>  consultation  - (120 €)  <br><b>Date :</b> 17/11/2020 - <b>Heure :</b> 10:00<br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-11-30 14:29:42', '2020-11-30 14:29:42'),
(6, 6, 'Message envoyé', 'Nouveau message envoyé par : iheb SAAD<br>Email : prestataire Tel :965865214<br>Message : Your Message Here<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-01 12:19:03', '2020-12-01 12:19:03'),
(7, 6, 'Message envoyé', 'Nouveau message envoyé par : iheb SAAD<br>Email : prestataire Tel :6465465466<br>Message : Message Here<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-01 12:34:49', '2020-12-01 12:34:49'),
(8, 6, 'Message envoyé', 'Nouveau message envoyé par : iheb SAAD<br>Email : prestataire Tel :65464465<br>Message : Message ici<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-01 12:59:04', '2020-12-01 12:59:04'),
(9, 6, 'Message envoyé', 'Nouveau message envoyé par : iheb SAAD<br>Email : prestataire Tel :6546554<br>Message : Message ici<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-01 13:31:20', '2020-12-01 13:31:20'),
(10, 6, 'Message envoyé', 'Nouveau message envoyé par : iheb SAAD<br>Email : prestataire Tel :6565655<br>Message : qdsfdsfsdfs<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-01 13:31:44', '2020-12-01 13:31:44'),
(11, 1, 'Message envoyé depuis Contact', 'Nouveau message du site :  <br><br><b>Prénom :</b> iheb <b>Nom :</b>SAAD<br><b>Email :</b> saadiheb@gmail.com<br><b>Message :</b> Message Here<br><br><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-03 12:39:46', '2020-12-03 12:39:46'),
(12, 5, 'Abonnement payé', 'Bonjour,<br>Votre abonnement est payé avec succès <br>Abonnement : N°: 2 | Business (mensuel)<br>La date d\'expiration de votre abonnement est :07/01/2021 13:54 <br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-07 13:54:59', '2020-12-07 13:54:59'),
(13, 1, 'Abonnement payé', 'Bonjour,<br>Abonnement payé : N°: 2 | Business (mensuel)<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-07 13:55:00', '2020-12-07 13:55:00'),
(14, 5, 'Abonnement payé', 'Bonjour,<br>Votre abonnement est payé avec succès <br>Abonnement : N°: 2 | Business (mensuel)<br>La date d\'expiration de votre abonnement est :07/01/2021 14:21 <br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-07 14:21:59', '2020-12-07 14:21:59'),
(15, 1, 'Abonnement payé', 'Bonjour,<br>Abonnement payé : N°: 2 | Business (mensuel)<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-07 14:22:00', '2020-12-07 14:22:00'),
(16, 5, 'Abonnement payé', 'Bonjour,<br>Votre abonnement est payé avec succès <br>Abonnement : N°: 1 | Basique (mensuel)<br>La date d\'expiration de votre abonnement est :07/01/2021 14:56 <br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-07 14:56:47', '2020-12-07 14:56:47'),
(17, 1, 'Abonnement payé', 'Bonjour,<br>Abonnement payé : N°: 1 | Basique (mensuel)<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-07 14:56:48', '2020-12-07 14:56:48'),
(18, 6, 'Message envoyé', 'Nouveau message envoyé par : iheb<br>Email : client Tel :4565465465464<br>Message : message ici<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-08 14:30:46', '2020-12-08 14:30:46'),
(19, 6, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  sdf  - (22 €)  <br><b>Date :</b> 08/12/2020 - <b>Heure :</b> 10:00<br><b>Client :</b> John Fontaine<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-08 14:35:40', '2020-12-08 14:35:40'),
(20, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  sdf  - (22 €)  <br><b>Date :</b> 08/12/2020<b>Heure :</b> 10:00<br><b>Client :</b> John Fontaine<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-08 14:35:41', '2020-12-08 14:35:41'),
(21, 3, 'Réservation payée', 'Bonjour,<br>Réservation payée avec succès <br><b>Service :</b>  sdf  - (22 €)  <br><b>Date :</b> 08/12/2020 Heure : 10:00<br><b>Prestatire :</b> Eric Dupond<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-08 14:38:18', '2020-12-08 14:38:18'),
(22, 6, 'Réservation payée', 'Bonjour,<br>Réservation payée<br><b>Service :</b>  sdf  - (22 €)  <br><b>Date :</b> 08/12/2020 Heure : 10:00<br><b>Client :</b> John Fontaine<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-08 14:38:20', '2020-12-08 14:38:20'),
(23, 3, 'Réservation validée', 'Votre rendez vous est confirmé par le prestataire.<br><b>Service :</b>  sdf  - (22 €)  <br><b>Date :</b> 08/12/2020 - <b>Heure :</b> 10:00<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-08 14:41:04', '2020-12-08 14:41:04'),
(24, 6, 'Abonnement payé', 'Bonjour,<br>Votre abonnement est payé avec succès <br>Abonnement : N°: 1 | Basique (mensuel)<br>La date d\'expiration de votre abonnement est : 08/01/2021 14:47 <br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-08 14:47:17', '2020-12-08 14:47:17'),
(25, 1, 'Abonnement payé', 'Bonjour,<br>Abonnement payé : N°: 1 | Basique (mensuel)<br><b>Prestatire :</b> Eric Dupond<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-08 14:47:19', '2020-12-08 14:47:19'),
(26, 1, 'Message envoyé depuis Contact', 'Nouveau message du site :  <br><br><b>Prénom :</b> iheb <b>Nom :</b>SAAD<br><b>Email :</b> saadiheb@gmail.com<br><b>Message :</b> message ici<br><br><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-08 15:12:38', '2020-12-08 15:12:38'),
(27, 6, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  sdf  - (22 €)  <br><b>Date :</b> 11/12/2020 - <b>Heure :</b> 10:10<br><b>Client :</b> John Fontaine<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-11 09:44:52', '2020-12-11 09:44:52'),
(28, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  sdf  - (22 €)  <br><b>Date :</b> 11/12/2020<b>Heure :</b> 10:10<br><b>Prestatire :</b> Eric Dupond<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-11 09:44:53', '2020-12-11 09:44:53'),
(29, 3, 'Réservation payée', 'Bonjour,<br>Réservation payée avec succès <br><b>Service :</b>  sdf  - (22 €)  <br><b>Date :</b> 11/12/2020 Heure : 10:10<br><b>Prestatire :</b> Eric Dupond<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-11 09:47:28', '2020-12-11 09:47:28'),
(30, 6, 'Réservation payée', 'Bonjour,<br>Réservation payée<br><b>Service :</b>  sdf  - (22 €)  <br><b>Date :</b> 11/12/2020 Heure : 10:10<br><b>Client :</b> John Fontaine<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-11 09:47:29', '2020-12-11 09:47:29'),
(31, 3, 'Réservation validée', 'Votre rendez vous est confirmé par le prestataire.<br><b>Service :</b>  sdf  - (22 €)  <br><b>Date :</b> 11/12/2020 - <b>Heure :</b> 10:10<br><br><b>Prestatire :</b> Eric Dupond<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-11 09:51:12', '2020-12-11 09:51:12'),
(32, 5, 'Abonnement payé', 'Bonjour,<br>Votre abonnement est payé avec succès <br>Abonnement : N°: 3 | Annuel (annuel)<br>La date d\'expiration de votre abonnement est : 07/01/2022 14:56 <br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-12 10:42:25', '2020-12-12 10:42:25'),
(33, 1, 'Abonnement payé', 'Bonjour,<br>Abonnement payé : N°: 3 | Annuel (annuel)<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-12 10:42:26', '2020-12-12 10:42:26'),
(34, 6, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  xdvxvx  - (33 €)  <br><b>Date :</b> 17/12/2020 - <b>Heure :</b> 09:30<br><b>Client :</b> John Fontaine<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-13 13:59:25', '2020-12-13 13:59:25'),
(35, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  xdvxvx  - (33 €)  <br><b>Date :</b> 17/12/2020<b>Heure :</b> 09:30<br><b>Prestatire :</b> Eric Dupond<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-13 13:59:27', '2020-12-13 13:59:27'),
(36, 5, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  makloub  - (20 €)  <br><b>Date :</b> 31/12/2020 - <b>Heure :</b> 22:10<br><b>Client :</b> John Fontaine<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-31 17:09:13', '2020-12-31 17:09:13'),
(37, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  makloub  - (20 €)  <br><b>Date :</b> 31/12/2020<b>Heure :</b> 22:10<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-31 17:09:14', '2020-12-31 17:09:14'),
(38, 5, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  makloub  - (20 €)  <br><b>Date :</b> 31/12/2020 - <b>Heure :</b> 22:10<br><b>Client :</b> John Fontaine<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-31 17:09:15', '2020-12-31 17:09:15'),
(39, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  makloub  - (20 €)  <br><b>Date :</b> 31/12/2020<b>Heure :</b> 22:10<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-31 17:09:16', '2020-12-31 17:09:16'),
(40, 6, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  sdf  - (22 €)  <br><b>Date :</b> 04/01/2021 - <b>Heure :</b> 16:30<br><b>Client :</b> John Fontaine<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-03 15:02:44', '2021-01-03 15:02:44'),
(41, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  sdf  - (22 €)  <br><b>Date :</b> 04/01/2021<b>Heure :</b> 16:30<br><b>Prestatire :</b> Eric Dupond<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-03 15:02:45', '2021-01-03 15:02:45'),
(42, 5, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  pizza  - (50 €)  <br><b>Date :</b> 05/01/2021 - <b>Heure :</b> 09:18<br><b>Client :</b> David Maxime<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-05 12:47:01', '2021-01-05 12:47:01'),
(43, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  pizza  - (50 €)  <br><b>Date :</b> 05/01/2021<b>Heure :</b> 09:18<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-05 12:47:03', '2021-01-05 12:47:03'),
(44, 5, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  pizza  - (50 €)  <br><b>Date :</b> 05/01/2021 - <b>Heure :</b> 09:25<br><b>Client :</b> David Maxime<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-05 12:55:12', '2021-01-05 12:55:12'),
(45, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  pizza  - (50 €)  <br><b>Date :</b> 05/01/2021<b>Heure :</b> 09:25<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-05 12:55:14', '2021-01-05 12:55:14'),
(46, 5, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  pizza  - (50 €)  <br><b>Date :</b> 05/01/2021 - <b>Heure :</b> 11:27<br><b>Client :</b> David Maxime<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-05 14:57:09', '2021-01-05 14:57:09'),
(47, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  pizza  - (50 €)  <br><b>Date :</b> 05/01/2021<b>Heure :</b> 11:27<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-05 14:57:10', '2021-01-05 14:57:10'),
(48, 5, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  pizza  - (50 €)  <br><b>Date :</b> 06/01/2021 - <b>Heure :</b> 10:59<br><b>Client :</b> David Maxime<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-05 14:59:14', '2021-01-05 14:59:14'),
(49, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  pizza  - (50 €)  <br><b>Date :</b> 06/01/2021<b>Heure :</b> 10:59<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-05 14:59:15', '2021-01-05 14:59:15'),
(50, 5, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  makloub  - (20 €)  <br><b>Date :</b> 07/01/2021 - <b>Heure :</b> 06:30<br><b>Client :</b> David Maxime<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 10:29:56', '2021-01-06 10:29:56'),
(51, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  makloub  - (20 €)  <br><b>Date :</b> 07/01/2021<b>Heure :</b> 06:30<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 10:29:57', '2021-01-06 10:29:57'),
(52, 3, 'Réservation payée', 'Bonjour,<br>Réservation payée avec succès <br><b>Service :</b>  makloub  - (20 €)  <br><b>Date :</b> 07/01/2021 Heure : 06:30<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 10:59:15', '2021-01-06 10:59:15'),
(53, 5, 'Réservation payée', 'Bonjour,<br>Réservation payée<br><b>Service :</b>  makloub  - (20 €)  <br><b>Date :</b> 07/01/2021 Heure : 06:30<br><b>Client :</b> David Maxime<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 10:59:16', '2021-01-06 10:59:16'),
(54, 6, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  xdvxvx  - (33 €)  <br><b>Date :</b> 07/01/2021 - <b>Heure :</b> 01:57<br><b>Client :</b> David Maxime<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 14:56:57', '2021-01-06 14:56:57'),
(55, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  xdvxvx  - (33 €)  <br><b>Date :</b> 07/01/2021<b>Heure :</b> 01:57<br><b>Prestatire :</b> Eric Dupond<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 14:56:58', '2021-01-06 14:56:58'),
(56, 3, 'Réservation payée', 'Bonjour,<br>Réservation payée avec succès <br><b>Service :</b>  xdvxvx  - (33 €)  <br><b>Date :</b> 07/01/2021 Heure : 01:57<br><b>Prestatire :</b> Eric Dupond<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 14:58:43', '2021-01-06 14:58:43'),
(57, 6, 'Réservation payée', 'Bonjour,<br>Réservation payée<br><b>Service :</b>  xdvxvx  - (33 €)  <br><b>Date :</b> 07/01/2021 Heure : 01:57<br><b>Client :</b> David Maxime<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 14:58:44', '2021-01-06 14:58:44'),
(58, 5, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  consultation  - (120 €)  <br><b>Date :</b> 07/01/2021 - <b>Heure :</b> 11:10<br><b>Client :</b> David Maxime<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 15:10:09', '2021-01-06 15:10:09'),
(59, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  consultation  - (120 €)  <br><b>Date :</b> 07/01/2021<b>Heure :</b> 11:10<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 15:10:10', '2021-01-06 15:10:10'),
(60, 3, 'Réservation payée', 'Bonjour,<br>Réservation payée avec succès <br><b>Service :</b>  consultation  - (120 €)  <br><b>Date :</b> 07/01/2021 Heure : 11:10<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 15:11:02', '2021-01-06 15:11:02'),
(61, 5, 'Réservation payée', 'Bonjour,<br>Réservation payée<br><b>Service :</b>  consultation  - (120 €)  <br><b>Date :</b> 07/01/2021 Heure : 11:10<br><b>Client :</b> David Maxime<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 15:11:03', '2021-01-06 15:11:03'),
(62, 6, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  ssds  - (70 €)  <br><b>Date :</b> 07/01/2021 - <b>Heure :</b> 11:13<br><b>Client :</b> David Maxime<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 15:13:02', '2021-01-06 15:13:02'),
(63, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  ssds  - (70 €)  <br><b>Date :</b> 07/01/2021<b>Heure :</b> 11:13<br><b>Prestatire :</b> Eric Dupond<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 15:13:03', '2021-01-06 15:13:03'),
(64, 3, 'Réservation payée', 'Bonjour,<br>Réservation payée avec succès <br><b>Service :</b>  ssds  - (70 €)  <br><b>Date :</b> 07/01/2021 Heure : 11:13<br><b>Prestatire :</b> Eric Dupond<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 15:15:01', '2021-01-06 15:15:01'),
(65, 6, 'Réservation payée', 'Bonjour,<br>Réservation payée<br><b>Service :</b>  ssds  - (70 €)  <br><b>Date :</b> 07/01/2021 Heure : 11:13<br><b>Client :</b> David Maxime<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-06 15:15:03', '2021-01-06 15:15:03'),
(66, 5, 'Nouvelle Réservation', 'Vous avez une nouvelle réservation.<br>Veillez la confirmer dans votre tableau de bord.<br><b>Service :</b>  coiffure  - (70 €)  <br><b>Date :</b> 14/01/2021 - <b>Heure :</b> 03:49<br><b>Client :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-14 04:48:04', '2021-01-14 04:48:04'),
(67, 5, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  coiffure  - (70 €)  <br><b>Date :</b> 14/01/2021<b>Heure :</b> 03:49<br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-01-14 04:48:06', '2021-01-14 04:48:06'),
(68, 3, 'Réservation validée', 'Votre rendez vous est confirmé par le prestataire.<br><b>Service :</b>  consultation  - (120 €)  <br><b>Date :</b>  - <b>Heure :</b> <br><br><b>Prestatire :</b> Charles Monressieux<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2021-03-26 10:35:48', '2021-03-26 10:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `calendriers`
--

DROP TABLE IF EXISTS `calendriers`;
CREATE TABLE IF NOT EXISTS `calendriers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `prest_id` int(10) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `allDay` int(1) NOT NULL DEFAULT '0',
  `color` varchar(250) DEFAULT NULL,
  `textColor` varchar(250) DEFAULT NULL,
  `type_indisp` varchar(250) DEFAULT NULL,
  `sous_type_indisp` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cartefidelites`
--

DROP TABLE IF EXISTS `cartefidelites`;
CREATE TABLE IF NOT EXISTS `cartefidelites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_prest` int(10) DEFAULT NULL,
  `id_client` int(10) DEFAULT NULL,
  `nbr_reservation` tinyint(1) DEFAULT '1',
  `nbr_fois` int(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cartefidelites`
--

INSERT INTO `cartefidelites` (`id`, `id_prest`, `id_client`, `nbr_reservation`, `nbr_fois`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 3, 5, NULL, NULL),
(2, 6, 3, 9, 6, NULL, NULL),
(3, 15, 14, 1, 0, '2021-03-04 09:17:35', '2021-03-04 09:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `description`, `parent`, `created_at`, `updated_at`) VALUES
(10, 'coiffure', NULL, 8, '2020-12-10 21:04:40', '2020-12-10 21:04:40'),
(9, 'onglerie', NULL, 8, '2020-12-10 21:04:08', '2020-12-10 21:04:08'),
(8, 'prestation beauté', NULL, NULL, '2020-12-10 21:03:38', '2020-12-10 21:03:38'),
(11, 'esthétique', NULL, 8, '2020-12-10 21:04:59', '2020-12-10 21:04:59'),
(12, 'maquillage', NULL, 8, '2020-12-10 21:05:23', '2020-12-10 21:05:23'),
(13, 'conseil en image', NULL, 8, '2020-12-10 21:08:04', '2020-12-10 21:08:04'),
(14, 'Prestation bien-être', NULL, NULL, '2020-12-10 21:08:50', '2020-12-10 21:08:50'),
(16, 'Massage à domicile', NULL, 14, '2020-12-10 21:09:55', '2020-12-10 21:09:55'),
(17, 'Massage à l\'exterieur', NULL, 14, '2020-12-10 21:10:30', '2020-12-10 21:10:30'),
(18, 'SPA', NULL, 14, '2020-12-10 21:11:23', '2020-12-10 21:11:23'),
(20, 'Prestation auto', NULL, NULL, '2020-12-10 21:13:31', '2020-12-10 21:13:31'),
(21, 'Diagnostic électronique auto', NULL, 20, '2020-12-10 21:15:02', '2020-12-10 21:15:02'),
(22, 'Lavage auto', NULL, 20, '2020-12-10 21:15:28', '2020-12-10 21:15:28'),
(23, 'prestation vitre tintées', NULL, 20, '2020-12-10 21:16:24', '2020-12-10 21:16:24'),
(24, 'prestation capitonnage / ciel de toit', NULL, 20, '2020-12-10 21:18:38', '2020-12-10 21:18:38'),
(25, 'prestation marquage de véhicules', NULL, 20, '2020-12-10 21:19:31', '2020-12-10 21:19:31'),
(26, 'Alarme auto', NULL, 20, '2020-12-10 21:20:40', '2020-12-10 21:20:40'),
(27, 'Recharge climatisation auto', NULL, 20, '2020-12-10 21:21:46', '2020-12-10 21:21:46'),
(28, 'reprogrammation moteur', NULL, 20, '2020-12-10 21:25:04', '2020-12-10 21:25:04'),
(29, 'Prestation nettoyage', NULL, NULL, '2020-12-10 21:26:01', '2020-12-10 21:26:01'),
(30, 'Nettoyage extérieur', NULL, 29, '2020-12-10 21:26:55', '2020-12-10 21:26:55'),
(31, 'nettoyage intérieur', NULL, 29, '2020-12-10 21:27:28', '2020-12-10 21:27:28'),
(32, 'Prestation de service occasionnel', NULL, NULL, '2020-12-10 21:42:19', '2020-12-10 21:42:19'),
(33, 'Chef à domicile', NULL, 32, '2020-12-10 21:43:18', '2020-12-10 21:43:18'),
(34, 'Photographe professionnel', NULL, 32, '2020-12-10 21:43:53', '2020-12-10 21:43:53'),
(35, 'préparation de gâteau pour un évènement', NULL, 32, '2020-12-10 21:44:38', '2020-12-10 21:44:38'),
(36, 'Stand de photo pour événement', NULL, 32, '2020-12-10 21:45:25', '2020-12-10 21:45:25'),
(37, 'traiteur', NULL, 32, '2020-12-10 21:46:02', '2020-12-10 21:46:02'),
(38, 'wading planer', NULL, 32, '2020-12-10 21:46:37', '2020-12-10 21:46:37'),
(40, 'coaching sportif', NULL, 14, '2020-12-10 21:48:26', '2020-12-10 21:48:26'),
(41, 'tatouage', NULL, 14, '2020-12-18 22:45:31', '2020-12-18 22:45:31'),
(42, 'Prestation de service sur rdv à domicile', NULL, NULL, '2020-12-23 12:27:25', '2020-12-23 12:27:25'),
(43, 'toilettage canin', NULL, 29, '2021-01-08 05:04:41', '2021-01-08 05:04:41'),
(44, 'Extension de cils', NULL, 8, '2021-01-09 21:12:26', '2021-01-09 21:12:26'),
(45, 'Garde d\'enfants', NULL, 32, '2021-01-09 21:13:41', '2021-01-09 21:13:41'),
(46, 'Service juridique', NULL, 32, '2021-01-09 21:14:32', '2021-01-09 21:14:32'),
(47, 'Avocats', NULL, 32, '2021-01-09 21:15:07', '2021-01-09 21:15:07'),
(48, 'Service de conseil', NULL, 32, '2021-01-09 21:16:15', '2021-01-09 21:16:15'),
(49, 'Consulting', NULL, 32, '2021-01-09 21:16:43', '2021-01-09 21:16:43'),
(50, 'Service pour animaux', NULL, 32, '2021-01-09 21:17:14', '2021-01-09 21:17:14'),
(51, 'Consultant en design', NULL, 32, '2021-01-09 21:17:45', '2021-01-09 21:17:45'),
(52, 'Cours de fitness', NULL, 14, '2021-01-09 21:18:18', '2021-01-09 21:18:18'),
(53, 'Cours de yoga', NULL, 14, '2021-01-09 21:18:42', '2021-01-09 21:18:42'),
(54, 'coach sportif', NULL, 14, '2021-01-09 21:21:14', '2021-01-09 21:21:14'),
(55, 'Prestation bricolage', NULL, NULL, '2021-01-21 01:38:58', '2021-01-21 01:38:58'),
(56, 'Fixation de miroir', NULL, 55, '2021-01-21 01:41:32', '2021-01-21 01:41:32'),
(57, 'Fixation de triangle de rideau', NULL, 55, '2021-01-21 01:42:51', '2021-01-21 01:42:51'),
(58, 'Fixation de ventilateur plafonnier', NULL, 55, '2021-01-21 01:43:51', '2021-01-21 01:43:51'),
(59, 'Etagère', NULL, 55, '2021-01-21 01:45:34', '2021-01-21 01:45:34'),
(60, 'Applique murale et plafonnier', NULL, 55, '2021-01-21 01:46:33', '2021-01-21 01:46:33'),
(61, 'Support TV', NULL, 55, '2021-01-21 01:47:21', '2021-01-21 01:47:21'),
(62, 'Installation chauffe eau électrique', NULL, 55, '2021-01-21 01:48:09', '2021-01-21 01:48:09'),
(63, 'Montage paroi et cabine de douche', NULL, 55, '2021-01-21 01:48:41', '2021-01-21 01:48:41'),
(64, 'Remplacement mécanisme et flotteur WC', NULL, 55, '2021-01-21 01:49:03', '2021-01-21 01:49:03'),
(65, 'Remplacement serrure et poignée de porte', NULL, 55, '2021-01-21 01:49:39', '2021-01-21 01:49:39'),
(66, 'Remplacement interrupteur et prise électrique', NULL, 55, '2021-01-21 01:50:23', '2021-01-21 01:50:23'),
(67, 'Montage et remplacement de fenêtre', NULL, 55, '2021-01-21 01:51:20', '2021-01-21 01:51:20'),
(68, 'Montage et remplacement de porte', NULL, 55, '2021-01-21 01:51:51', '2021-01-21 01:51:51'),
(69, 'Installation de plaque de cuisson', NULL, 55, '2021-01-21 01:52:19', '2021-01-21 01:52:19'),
(70, 'Peinture intérieur et extérieur', NULL, 55, '2021-01-21 01:52:46', '2021-01-21 01:52:46'),
(71, 'Livraison et Montage de meuble', NULL, NULL, '2021-01-21 01:53:09', '2021-01-21 01:53:09'),
(72, 'Prestation Déménagement', NULL, NULL, '2021-01-21 01:53:46', '2021-01-21 01:53:46'),
(73, 'Nettoyage et entretien espace vert', NULL, 32, '2021-01-21 01:54:35', '2021-01-21 01:54:35'),
(74, 'Evacuation d’encombrant', NULL, 32, '2021-01-21 01:55:08', '2021-01-21 01:55:08'),
(75, 'Nettoyage haute pression', NULL, 32, '2021-01-21 01:56:08', '2021-01-21 01:56:08'),
(76, 'prestation climatisation à domicile', NULL, 42, '2021-01-21 02:12:15', '2021-01-21 02:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `categories_user`
--

DROP TABLE IF EXISTS `categories_user`;
CREATE TABLE IF NOT EXISTS `categories_user` (
  `categorie` int(8) NOT NULL,
  `user` int(8) NOT NULL,
  PRIMARY KEY (`categorie`,`user`),
  UNIQUE KEY `categorie` (`categorie`,`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories_user`
--

INSERT INTO `categories_user` (`categorie`, `user`) VALUES
(2, 5),
(3, 5),
(4, 5),
(6, 5),
(6, 6),
(8, 2),
(10, 2),
(10, 5),
(16, 2),
(17, 2),
(20, 2),
(26, 5),
(29, 2),
(38, 5),
(51, 6);

-- --------------------------------------------------------

--
-- Table structure for table `client_products`
--

DROP TABLE IF EXISTS `client_products`;
CREATE TABLE IF NOT EXISTS `client_products` (
  `id_client` int(20) NOT NULL,
  `id_products` int(11) DEFAULT NULL,
  `id_reservation` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_reservation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `codepromos`
--

DROP TABLE IF EXISTS `codepromos`;
CREATE TABLE IF NOT EXISTS `codepromos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_service` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reduction` tinyint(1) DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `codepromos`
--

INSERT INTO `codepromos` (`id`, `id_service`, `user_id`, `reduction`, `code`, `created_at`, `updated_at`) VALUES
(1, 8, 5, 41, 'fds454df', '2021-03-12 15:10:16', '2021-03-12 15:10:16'),
(7, 33, 5, 25, 'sd55ds2', '2021-03-17 19:26:34', '2021-03-17 19:26:34'),
(3, 5, 5, 45, 'dsf655fds', '2021-03-12 15:23:27', '2021-03-12 15:23:27'),
(8, 32, 5, 20, 'kbskhabs', '2021-03-22 13:34:34', '2021-03-22 13:34:34'),
(9, 35, 5, 25, 'aaaabbbb', '2021-03-22 13:53:28', '2021-03-22 13:53:28'),
(10, 33, 5, 50, 'axelle_33', '2021-03-24 16:33:32', '2021-03-24 16:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `question` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reponse` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `user`, `question`, `reponse`, `type`, `created_at`, `updated_at`) VALUES
(1, 5, 'Quel est votre nom', 'Mon nom est iheb SAAD..', NULL, '2020-11-13 09:56:09', '2020-11-13 09:56:09'),
(3, 5, 'test', 'test', NULL, '2021-01-07 09:02:18', '2021-01-07 09:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `client` int(11) NOT NULL,
  `prestataire` int(11) NOT NULL,
  PRIMARY KEY (`client`,`prestataire`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `favoris`
--

INSERT INTO `favoris` (`client`, `prestataire`) VALUES
(1, 5),
(3, 0),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `happyhours`
--

DROP TABLE IF EXISTS `happyhours`;
CREATE TABLE IF NOT EXISTS `happyhours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reduction` tinyint(1) DEFAULT NULL,
  `dateDebut` datetime DEFAULT NULL,
  `dateFin` datetime DEFAULT NULL,
  `places` tinyint(1) DEFAULT NULL,
  `Beneficiaries` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `happyhours`
--

INSERT INTO `happyhours` (`id`, `reduction`, `dateDebut`, `dateFin`, `places`, `Beneficiaries`, `created_at`, `updated_at`, `id_user`) VALUES
(2, 50, '2021-03-03 10:00:00', '2021-03-03 12:00:00', 5, 0, NULL, NULL, 5),
(3, 2, '2021-03-18 15:28:00', '2021-03-18 16:28:00', 2, 0, '2021-03-17 12:28:49', '2021-03-17 12:28:49', 5),
(4, 20, '2021-03-02 17:37:00', '2021-03-02 19:00:00', 6, 0, '2021-03-17 19:36:12', '2021-03-17 19:36:12', 5),
(6, 25, '2021-03-23 14:54:00', '2021-03-23 21:54:00', 5, 0, '2021-03-23 12:54:50', '2021-03-23 12:54:50', 5),
(7, 70, '2021-03-25 13:30:00', '2021-03-27 13:30:00', 10, 0, '2021-03-24 16:35:05', '2021-03-24 16:35:05', 5);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `thumb`, `user`, `created_at`, `updated_at`) VALUES
(10, 'restaurant-mexican-11.jpg', 5, '2020-11-19 08:17:00', '2020-11-19 08:17:00'),
(2, 'image2.jpg', 2, '2020-11-11 10:46:59', '2020-11-11 10:46:59'),
(8, 'restaurant-mexican-10.jpg', 5, '2020-11-19 08:17:00', '2020-11-19 08:17:00'),
(9, 'restaurant-mexican-6.jpg', 5, '2020-11-19 08:17:00', '2020-11-19 08:17:00'),
(11, 'restaurant-mexican-2.jpg', 5, '2020-11-19 08:17:00', '2020-11-19 08:17:00'),
(23, 'Sans titre (94).png', 6, '2021-01-29 15:54:06', '2021-01-29 15:54:06'),
(13, 'restaurant-italian-11.jpg', 6, '2020-11-19 08:28:54', '2020-11-19 08:28:54'),
(14, 'restaurant-italian-8.jpg', 6, '2020-11-19 08:28:54', '2020-11-19 08:28:54'),
(15, 'restaurant-italian-16.jpg', 6, '2020-11-19 08:28:54', '2020-11-19 08:28:54'),
(17, 'Sans titre (92).png', 5, '2021-01-14 04:28:08', '2021-01-14 04:28:08'),
(18, 'plage_fort_de_france_martinique_antoine_petton.jpg', 5, '2021-01-14 04:29:28', '2021-01-14 04:29:28'),
(22, '33.jpg', 6, '2021-01-29 15:52:47', '2021-01-29 15:52:47'),
(20, 'Sans titre (95).png', 5, '2021-01-14 04:30:16', '2021-01-14 04:30:16'),
(21, 'Sans titre (96).png', 5, '2021-01-14 04:31:44', '2021-01-14 04:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `page_faqs`
--

DROP TABLE IF EXISTS `page_faqs`;
CREATE TABLE IF NOT EXISTS `page_faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reponse` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `page_faqs`
--

INSERT INTO `page_faqs` (`id`, `question`, `reponse`, `type`, `created_at`, `updated_at`) VALUES
(8, '(3) Existe-t-il un tarif spécial ?', 'Oui en choisissant l’engagement annuel. Une sacrée économie !', 'prest', NULL, '2021-03-23 15:00:08'),
(9, ' (1) Comment prendre un rendez-vous sur le site ?', 'C\'est très simple : vous choisissez votre prestataire de services près de chez vous ou selon les avis laissés par les clients. Vous choisissez une ou des prestations, le jour et l\'heure du rendez-vous ainsi que le temps de rappel de votre rendez-vous que vous allez recevoir avant le rendez-vous.', 'client', NULL, NULL),
(7, '(2) Y-a-t-il un engagement ?', 'Nos offres mensuelles sont disponibles sans engagement de durée.\nSachez qu\'en prenant un abonnement annuel, cela vous reviendra largement moins cher que les abonnements mensuels qui sont proposés.', 'prest', NULL, '2021-03-24 15:27:30'),
(10, '(2) Comment payer la prestation sur le site ?', 'C\'est très simple : une fois que vous avez choisi votre prestation de service, le site vous amènera à la partie paiement en ligne qui ce fera par paypal ou carte bleu pour payer votre prestation en toute sécurité.', 'client', NULL, NULL),
(11, '(3) Est ce que je vais recevoir un rappel de mon rendez-vous ?', 'Oui une fois choisi votre jour et horaire de prestation vous avez la possibilité de choisir le rappel de votre rendez-vous par sms et mail.', 'client', NULL, NULL),
(12, '(4) Est ce que le prestataire doit valider mon rendez-vous pour chaque rendez-vous ?', 'Chaque prestataire de service recevra automatiquement une notification de validation du rdv par mail, de ce fait nous avons donné la possibilité aux prestataires de service de valider ou non les rendez-vous parce qu\'il y a des prestataires qui ont le temps de valider le rendez-vous et d\'autre non mais en tant que client, vous allez aussi recevoir un mail de confirmation du rendez-vous s\'il accepte le rendez-vous et un sms de rappel de votre rendez-vous', 'client', NULL, '2021-03-24 16:19:45'),
(14, 'Est ce que je peux réduire mon abonnement quand j\'ai envie ou prendre un abonnement plus cher ?', 'Il faut savoir que si vous réduisez votre abonnement, vous réduisez les fonctionnalités qui vont avec chaque abonnement. C\'est-à-dire que chaque abonnement a ses fonctionnalités. Maintenant, si vous avez le plus petit abonnement mensuel, vous allez pouvoir prendre un abonnement plus élevé pour avoir plus de fonctionnalités qui vous donnera plus de libertés et de confort pour vos clients.', 'prest', '2021-03-24 15:15:35', '2021-03-24 16:13:39'),
(15, 'Est-ce que je peux vendre des abonnement mensuel ?', 'Oui, vous pouvez vendre des abonnements journalier, mensuel et annuel à vos clients. Si vous avez l\'abonnement Diamond, vous allez avoir le luxe de vendre des abonnements avec des prélèvements automatiques.', 'prest', '2021-03-24 15:23:01', '2021-03-24 16:15:05'),
(16, 'Que ce passe t\'il si je ne paie pas mon abonnement mensuel ?', 'Si votre abonnement mensuel ne passe pas pour X raisons, Votre page sera caché à la vue de vos futurs clients potentiels et vous n\'aurez pas accès à votre compte. Le site vous invitera à payer votre abonnement mensuel.\r\nUne fois votre abonnement payé, vous allez avoir accès à votre page ainsi que toutes les fonctionnalités pour lesquelles vous payez.', 'prest', '2021-03-24 15:36:22', '2021-03-24 15:36:22'),
(18, 'Est-ce qu\'il faut que je valide mes rendez-vous à chaque fois ?', 'Oui, cela est nécessaire si vous souhaitez que vos rendez-vous apparaissent dans votre calendrier de prestataire si vous avez prix l\'abonnement Diamond, par la suite le client recevra une notification par mail disant que vous acceptez le rendez-vous.\r\n\r\nMaintenant, si vous n\'avez pas l\'abonnement Diamond, nous vous invitons à accepter les rendez-vous pour que les clients reçoivent une notification par mail et si vous n\'avez pas accepté le rendez-vous, il recevra quand même son sms de rappel de son rendez-vous automatiquement qu\'il aura choisi', 'prest', '2021-03-24 16:18:07', '2021-03-24 16:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `parametres`
--

DROP TABLE IF EXISTS `parametres`;
CREATE TABLE IF NOT EXISTS `parametres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `video` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `apropos` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `apropos_footer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `contacter` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `abonnement1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `abonnement2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `abonnement3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cout_abonnement1` double DEFAULT NULL,
  `cout_abonnement2` double DEFAULT NULL,
  `cout_abonnement3` double DEFAULT NULL,
  `commission_abonnement1` int(11) DEFAULT NULL,
  `commission_abonnement2` int(11) DEFAULT NULL,
  `commission_abonnement3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `parametres`
--

INSERT INTO `parametres` (`id`, `logo`, `video`, `apropos`, `apropos_footer`, `contacter`, `abonnement1`, `abonnement2`, `abonnement3`, `cout_abonnement1`, `cout_abonnement2`, `cout_abonnement3`, `commission_abonnement1`, `commission_abonnement2`, `commission_abonnement3`) VALUES
(1, 'logo.png', 'clip-vido-2-site-web-prenezunrendezvous.com-5.mp4.mp4', '<b>Prenezunrendezvous.com</b> est un annuaire qui référence des prestataires de services qui travaillent sur rendez-vous. Cet annuaire permet aux particuliers de prendre rendez-vous avec des prestataires de services prêt de chez eux en quelques clics', 'Prenezunrendezvous.com est une place de marché qui rassemble des prestataires de service qui travaillent uniquement sur rendez-vous et des particuliers à la recherche de prestataire de service qui travaille uniquement sur rendez-vous.', 'contact ici', 'Gold', 'Platine', 'Diamond vip', 49, 69, 119, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `details` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `beneficiaire` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `beneficiaire_id` int(8) DEFAULT NULL,
  `payment_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `payer_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user`, `details`, `beneficiaire`, `beneficiaire_id`, `payment_id`, `payer_id`, `created_at`, `updated_at`) VALUES
(1, 5, 'paiement  de l\'abonnement : N°: 2 | Business (mensuel)', 'prenezunrendezvous.com', 1, 'PAYID-L7HDUVA4NY609344F2171328', 'NWWGC9CTSX2MA', '2020-12-07 14:22:00', '2020-12-07 14:22:00'),
(2, 5, 'paiement  de l\'abonnement : N°: 1 | Basique (mensuel)', 'prenezunrendezvous.com', 1, 'PAYID-L7HEE3A0PV91095MK438872U', 'NWWGC9CTSX2MA', '2020-12-07 14:56:48', '2020-12-07 14:56:48'),
(3, 3, 'paiement  de réservation pour : Eric Dupond', 'Eric Dupond', 6, 'PAYID-L7HY7EQ5PP037833L8702933', 'NWWGC9CTSX2MA', '2020-12-08 14:38:20', '2020-12-08 14:38:20'),
(4, 6, 'paiement  de l\'abonnement : N°: 1 | Basique (mensuel)', 'prenezunrendezvous.com', 1, 'PAYID-L7HZDGI07A89096SL394971B', 'NWWGC9CTSX2MA', '2020-12-08 14:47:19', '2020-12-08 14:47:19'),
(5, 3, 'paiement  de réservation pour : Eric Dupond', 'Eric Dupond', 6, 'PAYID-L7JT73Q3JU40211B5332343U', 'NWWGC9CTSX2MA', '2020-12-11 09:47:29', '2020-12-11 09:47:29'),
(6, 5, 'paiement  de l\'abonnement : N°: 3 | Annuel (annuel)', 'prenezunrendezvous.com', 1, 'PAYID-L7KJ4XA7PH20341GU4825823', 'NWWGC9CTSX2MA', '2020-12-12 10:42:26', '2020-12-12 10:42:26'),
(7, 3, 'paiement  de réservation pour : Charles Monressieux', 'Charles Monressieux', 5, 'PAYID-L72ZPXA07G90998TD118323T', 'BQPMD42ZXTWTA', '2021-01-06 10:59:16', '2021-01-06 10:59:16'),
(8, 3, 'paiement  de réservation pour : Eric Dupond', 'Eric Dupond', 6, 'PAYID-L725AAI9WB98115BG052421G', 'BQPMD42ZXTWTA', '2021-01-06 14:58:44', '2021-01-06 14:58:44'),
(9, 3, 'paiement  de réservation pour : Charles Monressieux', 'Charles Monressieux', 5, 'PAYID-L725F2Y1KD44102YX9857054', 'BQPMD42ZXTWTA', '2021-01-06 15:11:03', '2021-01-06 15:11:03'),
(10, 3, 'paiement  de réservation pour : Eric Dupond', 'Eric Dupond', 6, 'PAYID-L725HXA9JA20432HM289722H', 'BQPMD42ZXTWTA', '2021-01-06 15:15:03', '2021-01-06 15:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `periodes_indisp`
--

DROP TABLE IF EXISTS `periodes_indisp`;
CREATE TABLE IF NOT EXISTS `periodes_indisp` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `prest_id` int(10) DEFAULT NULL,
  `titre` varchar(500) DEFAULT NULL,
  `date_debut` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `couleur` varchar(255) DEFAULT NULL,
  `couleurText` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periodes_indisp`
--

INSERT INTO `periodes_indisp` (`id`, `prest_id`, `titre`, `date_debut`, `date_fin`, `couleur`, `couleurText`, `updated_at`, `created_at`) VALUES
(2, 5, 'congés', '2021-03-24 14:37:00', '2021-03-25 14:37:00', 'red', 'balck', '2021-03-22 13:38:15', '2021-03-22 13:38:15'),
(3, 5, 'maladie', '2021-03-09 14:38:00', '2021-03-11 14:39:00', 'red', 'balck', '2021-03-22 13:39:10', '2021-03-22 13:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `URL_telechargement` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` longtext NOT NULL,
  `Fichier` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user` int(11) NOT NULL,
  `image` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prix_unité` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `service_id` int(40) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_client` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `nom_produit`, `URL_telechargement`, `description`, `Fichier`, `user`, `image`, `prix_unité`, `type`, `service_id`, `updated_at`, `created_at`, `id_client`) VALUES
(5, 'Extraordinary Oil Shampoo', NULL, 'Below is a static modal example (meaning its position and display have been overridden). Included are the modal header, modal body (required for padding), and modal footer (optional). We ask that you include modal headers with dismiss actions whenever possible, or provide another explicit dismiss action.', NULL, 5, 'Capturesfs.JPG-produit-17-04-2021-00-10-55', 30, 'Physique', 5, '2021-04-26 22:48:10', '2021-04-17 00:10:55', 3),
(4, 'Moisture Shampoo', NULL, 'Utilize the Bootstrap grid system within a modal by nesting .container-fluid within the .modal-body. Then, use the normal grid system classes as you would anywhere else.\r\n\r\n', NULL, 5, 'Loreal-Paris-Slideshow-21-Dry-Hair-Products-Your-Parched-Strands-Need-Slide8.jpg-produit-17-04-2021-00-07-57', 45, 'Physique', 8, '2021-04-26 22:00:36', '2021-04-17 00:07:57', NULL),
(6, 'pizza pepperoni', NULL, 'he sensor parameter is no longer required for the Maps JavaScript API. It won\'t prevent the Maps JavaScript API from working correctly, but we recommend that you remove the sensor parameter from the script element.', NULL, 5, 'pizza.jpg-produit-20-04-2021-03-05-27', 10, 'Physique', 33, '2021-04-26 22:00:41', '2021-04-20 03:05:27', NULL),
(7, 'rztgzeg', NULL, 'ezegzg', NULL, 5, 'Capture.PNG-produit-22-04-2021-03-03-40', 56, 'Physique', 32, '2021-04-26 22:48:11', '2021-04-22 03:03:40', 3),
(8, 'ezefez', NULL, 'ezfzf', NULL, 5, 'Capturesfs.JPG-produit-22-04-2021-03-03-58', 455, 'Physique', 5, '2021-04-26 01:37:34', '2021-04-22 03:03:58', NULL),
(9, 'test', NULL, 'test', NULL, 5, 'Loreal-Paris-Slideshow-21-Dry-Hair-Products-Your-Parched-Strands-Need-Slide8.jpg-produit-24-04-2021-01-12-13', 45, 'Physique', 37, '2021-04-26 22:50:01', '2021-04-24 01:12:13', 3),
(10, 'test2', NULL, 'test2', NULL, 5, 'pizza.jpg-produit-24-04-2021-01-12-39', 56, 'Physique', 35, '2021-04-26 22:50:04', '2021-04-24 01:12:39', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_reservation` datetime DEFAULT NULL,
  `date` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `heure` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `prestataire` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `service` int(11) NOT NULL DEFAULT '5',
  `services_reserves` json DEFAULT NULL,
  `nom_serv_res` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `montant_tot` float DEFAULT NULL,
  `adultes` int(2) DEFAULT NULL,
  `enfants` int(2) DEFAULT NULL,
  `remarques` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `rappel` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rappel_statut` tinyint(4) NOT NULL DEFAULT '0',
  `statut` int(11) DEFAULT '0',
  `paiement` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `reductionVal` tinyint(1) NOT NULL DEFAULT '0',
  `id_recc` int(11) DEFAULT NULL,
  `recurrent` tinyint(1) NOT NULL DEFAULT '0',
  `happyhour` tinyint(1) NOT NULL DEFAULT '0',
  `Remise` float DEFAULT NULL,
  `Net` float DEFAULT NULL,
  `listcodepromo` json DEFAULT NULL,
  `reduction` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pas de réduction',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `date_reservation`, `date`, `heure`, `prestataire`, `client`, `service`, `services_reserves`, `nom_serv_res`, `montant_tot`, `adultes`, `enfants`, `remarques`, `rappel`, `rappel_statut`, `statut`, `paiement`, `created_at`, `updated_at`, `reductionVal`, `id_recc`, `recurrent`, `happyhour`, `Remise`, `Net`, `listcodepromo`, `reduction`) VALUES
(2, '2021-03-07 11:15:00', '17/11/2020', '10:00', 5, 2, 5, '[\"5\"]', 'consultation', 121, 1, 1, NULL, '60', 0, 2, 0, '2020-11-17 12:58:01', '2020-11-30 14:29:29', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(3, '2021-03-07 11:15:00', '17/11/2020', '10:00', 5, 2, 24, '[\"24\"]', ' ', 1, 1, 2, 'remarques ici', '120', 0, 2, 0, '2020-11-17 12:58:49', '2020-11-30 14:15:46', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(16, '2021-03-07 11:15:00', '07/01/2021', '01:57', 6, 3, 20, '[\"20\"]', 'xdvxvx', 34, 1, 0, NULL, '1440', 1, 0, 1, '2021-01-06 14:56:55', '2021-01-06 11:08:29', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(15, '2021-03-07 11:15:00', '07/01/2021', '06:30', 5, 3, 32, '[\"32\"]', 'makloub ', 21, 1, 0, NULL, '1440', 1, 0, 1, '2021-01-06 10:29:55', '2021-01-06 10:59:14', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(14, '2021-03-07 11:15:00', '06/01/2021', '10:59', 5, 3, 8, '[\"8\"]', 'pizza', 51, 1, 0, NULL, '1440', 1, 0, 0, '2021-01-05 14:59:12', '2021-01-05 10:59:21', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(8, '2021-03-07 11:15:00', '31/12/2020', '22:10', 5, 3, 32, '[\"32\"]', 'makloub', 21, 2, 0, 'avec supplement frite', '120', 0, 0, 0, '2020-12-31 17:09:11', '2020-12-31 17:09:11', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(13, '2021-03-07 11:15:00', '05/01/2021', '11:27', 5, 3, 8, '[\"8\"]', 'pizza', 51, 1, 0, NULL, '30', 1, 0, 0, '2021-01-05 14:57:07', '2021-01-05 10:57:19', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(12, '2021-03-07 11:15:00', '05/01/2021', '09:25', 5, 3, 8, '[\"8\"]', 'pizza', 51, 1, 0, NULL, '30', 1, 0, 0, '2021-01-05 12:55:11', '2021-01-05 08:55:22', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(11, '2021-03-07 11:15:00', '05/01/2021', '09:18', 5, 3, 8, '[\"8\"]', 'pizza ', 51, 1, 0, NULL, '30', 1, 0, 0, '2021-01-05 12:47:00', '2021-01-05 08:48:08', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(17, '2021-03-07 11:15:00', '07/01/2021', '11:10', 5, 3, 5, '[\"5\"]', 'consultation', 121, 1, 0, NULL, '1440', 1, 0, 1, '2021-01-06 15:10:07', '2021-01-06 11:11:14', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(18, '2021-03-07 11:15:00', '07/01/2021', '11:13', 6, 3, 21, '[\"21\"]', 'ssds', 71, 1, 0, 'test cron', '1440', 1, 0, 1, '2021-01-06 15:13:00', '2021-01-06 11:15:01', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(19, '2021-03-07 11:15:00', '14/01/2021', '03:49', 5, 5, 33, '[\"33\"]', 'coiffure ', 71, 1, 0, NULL, '60', 0, 1, 0, '2021-01-14 04:48:02', '2021-03-25 15:28:26', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(20, '2021-03-07 11:15:00', '08/02/2021', '12:37', 6, 3, 5, '[\"17\", \"18\", \"21\"]', 'sdf, qsdqsd, ssds, ', 148, 1, 0, NULL, '60', 0, 0, 0, '2021-02-08 10:37:46', '2021-02-08 10:37:46', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(21, '2021-03-07 11:15:00', '08/02/2021', '12:44', 6, 3, 5, '[\"18\", \"20\"]', 'qsdqsd, xdvxvx, ', 89, 1, 0, NULL, '60', 0, 0, 0, '2021-02-08 10:44:19', '2021-02-08 10:44:19', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(22, '2021-03-07 11:15:00', '08/02/2021', '01:35', 5, 3, 5, '[\"5\", \"8\", \"33\"]', 'consultation, pizza, coiffure, ', 241, 1, 0, NULL, '60', 0, 0, 0, '2021-02-08 20:35:33', '2021-02-08 20:35:33', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(26, '2021-03-07 11:15:00', '17/02/2021', '08:44', 5, 3, 5, '[\"8\"]', 'pizza, ', 51, 1, 0, NULL, '60', 1, 0, 1, '2021-02-17 13:38:42', '2021-02-17 09:45:02', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(27, '2021-03-07 11:15:00', '17/02/2021', '10:07', 6, 3, 5, '[\"18\", \"20\", \"21\"]', 'qsdqsd, xdvxvx, ssds, ', 159, 1, 0, NULL, '60', 1, 0, 1, '2021-02-17 15:06:28', '2021-02-17 11:08:03', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(31, '2021-03-07 11:15:00', NULL, NULL, 5, 3, 5, '[\"33\"]', 'coiffure, ', 71, 1, 0, NULL, '7200', 0, 0, 0, '2021-03-01 10:14:26', '2021-03-01 10:14:26', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(32, '2021-03-12 05:05:00', NULL, NULL, 5, 3, 5, '[\"8\"]', 'pizza, ', 51, 1, 0, NULL, '7200', 0, 0, 0, '2021-03-01 10:59:54', '2021-03-01 10:59:54', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(33, '2021-03-03 09:45:00', NULL, NULL, 6, 3, 5, '[\"17\"]', 'sdf, ', 23, 1, 0, NULL, '60', 0, 0, 0, '2021-03-01 15:48:51', '2021-03-01 15:48:51', 10, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(34, '2021-03-04 12:12:00', NULL, NULL, 5, 3, 5, '[\"8\", \"32\"]', 'pizza, makloub, ', 71, 1, 0, NULL, '2880', 0, 0, 1, '2021-03-02 11:09:41', '2021-03-02 11:09:41', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(35, '2021-03-05 10:50:00', NULL, NULL, 15, 3, 5, '[\"34\"]', 'M, ', 15, 1, 0, NULL, '60', 0, 0, 0, '2021-03-04 09:11:12', '2021-03-04 09:11:12', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(36, '2021-03-04 09:45:00', NULL, NULL, 15, 3, 5, '[\"34\"]', 'M, ', 15, 1, 0, NULL, '60', 0, 0, 0, '2021-03-04 09:13:15', '2021-03-04 09:13:15', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(37, '2021-03-04 10:13:00', NULL, NULL, 15, 3, 5, '[\"34\"]', 'M, ', 15, 1, 0, NULL, '60', 1, 0, 1, '2021-03-04 09:13:52', '2021-03-04 09:13:04', 0, NULL, 0, 0, NULL, NULL, NULL, 'pas de réduction'),
(38, '2021-03-26 11:35:00', NULL, NULL, 5, 3, 5, '[\"8\", \"33\"]', 'pizza, coiffure, ', 121, 1, 0, NULL, '60', 0, 0, 0, '2021-03-19 08:14:53', '2021-03-19 08:14:53', 0, NULL, 0, 0, 0, 0, NULL, 'pas de réduction'),
(39, '2021-03-22 09:20:00', NULL, NULL, 5, 3, 5, '[\"5\"]', 'consultation, ', 121, 1, 0, NULL, '60', 0, 0, 0, '2021-03-22 08:41:24', '2021-03-22 08:41:24', 0, NULL, 0, 0, 0, 0, NULL, 'pas de réduction'),
(40, '2021-03-22 12:40:00', NULL, NULL, 5, 3, 5, '[\"5\", \"8\", \"33\"]', 'consultation, pizza, coiffure, ', 241, 1, 0, NULL, '60', 0, 0, 0, '2021-03-22 09:03:14', '2021-03-22 09:03:14', 0, NULL, 0, 0, 17.5, 222.5, '[\"sd55ds2\"]', 'pas de réduction'),
(41, '2021-03-22 14:30:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 1, 0, '2021-03-22 14:50:12', '2021-03-26 10:35:46', 0, NULL, 1, 0, 0, 0, NULL, 'pas de réduction'),
(42, '2021-03-23 18:50:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 0, 0, '2021-03-22 14:50:12', '2021-03-22 14:50:12', 0, 41, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(43, '2021-04-19 02:30:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 0, 0, '2021-03-22 14:50:12', '2021-03-22 14:50:12', 0, 41, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(44, '2021-04-20 06:50:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 0, 0, '2021-03-22 14:50:12', '2021-03-22 14:50:12', 0, 41, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(45, '2021-05-17 02:30:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 0, 0, '2021-03-22 14:50:12', '2021-03-22 14:50:12', 0, 41, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(46, '2021-05-18 06:50:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 0, 0, '2021-03-22 14:50:12', '2021-03-22 14:50:12', 0, 41, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(47, '2021-06-14 02:30:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 0, 0, '2021-03-22 14:50:12', '2021-03-22 14:50:12', 0, 41, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(48, '2021-06-15 06:50:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 0, 0, '2021-03-22 14:50:12', '2021-03-22 14:50:12', 0, 41, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(49, '2021-03-23 16:45:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 1, 0, '2021-03-22 15:25:42', '2021-03-26 10:19:43', 0, NULL, 1, 0, 0, 50, NULL, 'pas de réduction'),
(50, '2021-03-24 12:25:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 0, 0, '2021-03-22 15:25:42', '2021-03-22 15:25:42', 0, 49, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(51, '2021-04-20 04:45:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 0, 0, '2021-03-22 15:25:42', '2021-03-22 15:25:42', 0, 49, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(52, '2021-04-21 12:25:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 0, 0, '2021-03-22 15:25:42', '2021-03-22 15:25:42', 0, 49, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(53, '2021-05-18 04:45:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 0, 0, '2021-03-22 15:25:42', '2021-03-22 15:25:42', 0, 49, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(54, '2021-05-19 12:25:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 0, 0, '2021-03-22 15:25:42', '2021-03-22 15:25:42', 0, 49, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(55, '2021-06-15 04:45:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 0, 0, '2021-03-22 15:25:42', '2021-03-22 15:25:42', 0, 49, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(56, '2021-03-26 12:25:00', NULL, NULL, 5, 3, 5, '[\"35\"]', 'abonnement test, ', 51, NULL, NULL, NULL, NULL, 0, 1, 0, '2021-03-22 15:25:42', '2021-03-22 15:25:42', 0, 49, 1, 0, NULL, NULL, NULL, 'pas de réduction'),
(57, '2021-03-26 16:00:00', NULL, NULL, 5, 5, 5, '[\"8\"]', 'pizza, ', 51, 1, 0, NULL, '60', 0, 1, 0, '2021-03-23 13:00:29', '2021-03-23 13:00:29', 0, NULL, 0, 0, 0, 50, NULL, 'pas de réduction'),
(58, '2021-05-06 13:30:00', NULL, NULL, 5, 5, 5, '[\"5\", \"33\"]', 'consultation, coiffure, ', 191, 1, 0, NULL, '60', 0, 0, 0, '2021-04-05 10:09:19', '2021-04-05 10:09:19', 0, NULL, 0, 0, 0, 190, NULL, 'pas de réduction'),
(59, '2021-04-15 14:00:00', NULL, NULL, 5, 3, 5, '[\"8\"]', 'pizza, ', 51, 1, 0, NULL, '120', 0, 0, 0, '2021-04-05 10:11:05', '2021-04-05 10:11:05', 0, NULL, 0, 0, 0, 50, NULL, 'pas de réduction'),
(60, '2021-04-29 14:25:00', NULL, NULL, 5, 3, 5, '[\"8\"]', 'pizza, ', 51, 1, 0, NULL, '60', 0, 0, 0, '2021-04-26 12:28:01', '2021-04-26 12:28:01', 0, NULL, 0, 0, 0, 50, NULL, 'pas de réduction');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prestataire` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `commentaire` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `note` float DEFAULT NULL,
  `note_qualite` float DEFAULT NULL,
  `note_espace` float DEFAULT NULL,
  `note_prix` float DEFAULT NULL,
  `note_service` float DEFAULT NULL,
  `note_emplacement` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prestataire` (`prestataire`,`client`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `prestataire`, `client`, `commentaire`, `note`, `note_qualite`, `note_espace`, `note_prix`, `note_service`, `note_emplacement`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 'Bonne qualité et services :)\r\nConfort et vaste.\r\nje le recommande !', 4, 4, 5, 3, 5, 2, '2020-11-16 11:39:21', '2020-11-16 11:39:21'),
(2, 5, 1, 'Exellent Rapport Qualité/Service. emplacement loin mais l\'espace est très joli et intéresseant. je reviens toujours !', 3, 3, 5, 5, 3, 2, '2020-11-16 12:15:33', '2020-11-16 12:15:33'),
(3, 6, 3, 'Excellent service\r\nmeilleur rapport qualité/ service..', 4, 5, 5, 4, 4, 5, '2020-12-08 14:29:01', '2020-12-08 14:29:01');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `nom` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `recurrent` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'off',
  `Nfois` int(10) DEFAULT NULL,
  `frequence` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `periode` int(10) DEFAULT NULL,
  `nbrService` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `user`, `nom`, `description`, `prix`, `thumb`, `created_at`, `updated_at`, `duree`, `recurrent`, `Nfois`, `frequence`, `periode`, `nbrService`) VALUES
(1, 1, 'consultation', 'consultation médicale', 100, NULL, NULL, NULL, NULL, 'off', NULL, NULL, NULL, 1),
(5, 5, 'consultation', 'consultation médicale complète', 120, 'restaurant-mexican-11.jpg', NULL, '2021-04-26 01:22:11', '01:30:00', 'off', 1, '', NULL, 2),
(8, 5, 'pizza', 'livraison pizza', 50, 'restaurant-mexican-11.jpg', '2020-11-05 10:20:50', '2021-04-17 12:05:37', NULL, 'off', NULL, '', NULL, 1),
(33, 5, 'coiffure', 'tresse', 70, 'Sans titre (95).png-service-14-01-2021-04-46-16', '2021-01-14 04:46:16', '2021-04-18 02:03:49', NULL, 'off', NULL, '', NULL, 1),
(17, 6, 'sdf', 'dfdfd', 22, NULL, '2020-11-05 11:36:45', '2020-11-05 11:36:45', NULL, 'off', NULL, NULL, NULL, 1),
(18, 6, 'qsdqsd', 'qsdqsd', 55, NULL, '2020-11-05 11:38:13', '2020-11-05 11:38:13', NULL, 'off', NULL, NULL, NULL, 1),
(20, 6, 'xdvxvx', 'xvxvx', 33, 'restaurant-mexican-11.jpg', '2020-11-05 11:47:13', '2020-11-05 11:47:13', NULL, 'off', NULL, NULL, NULL, 1),
(21, 6, 'ssds', 'sdfsdfs', 70, NULL, '2020-11-05 11:54:52', '2020-11-05 11:54:52', NULL, 'off', NULL, NULL, NULL, 1),
(32, 5, 'makloub', 'makloub', 20, 'restaurant-mexican-11.jpg ', '2020-11-23 12:32:44', '2021-04-17 12:05:37', NULL, 'off', NULL, '', NULL, 1),
(37, 5, 'test service recc 2', 'description test service recc 2', 120, 'service_client.jpg-service-23-03-2021-11-38-02', '2021-03-23 11:38:02', '2021-04-17 12:05:37', '02:00:00', 'on', 1, 'Journalière', 2, 2),
(35, 5, 'abonnement test', 'test', 50, 'app-1.jpg-service-22-02-2021-09-43-17', '2021-02-22 09:43:17', '2021-04-17 12:05:38', '01:00:00', 'on', 2, 'Hebdomadaire', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_inscription` datetime DEFAULT NULL,
  `type_abonn_essai` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tel` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `titre` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'titre de prestataire',
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ville` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fhoraire` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'America/Martinique',
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `qr_code` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `couverture` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsable` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `skype` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lundi_o` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lundi_f` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mardi_o` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mardi_f` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mercredi_o` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mercredi_f` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `jeudi_o` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `jeudi_f` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendredi_o` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendredi_f` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `samedi_o` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `samedi_f` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dimanche_o` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dimanche_f` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `registre` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `approved` tinyint(1) DEFAULT '0',
  `featured` tinyint(1) DEFAULT '0',
  `video` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `codevideo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `statut` int(5) DEFAULT '1',
  `expire` datetime DEFAULT NULL,
  `abonnement` int(11) DEFAULT '0',
  `reduction` tinyint(1) DEFAULT '10',
  `section_product` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstService` int(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `lastname`, `phone`, `email`, `password`, `remember_token`, `date_inscription`, `type_abonn_essai`, `created_at`, `updated_at`, `user_type`, `description`, `tel`, `adresse`, `titre`, `keywords`, `ville`, `fhoraire`, `longitude`, `latitude`, `logo`, `qr_code`, `couverture`, `responsable`, `fb`, `twitter`, `instagram`, `youtube`, `linkedin`, `skype`, `lundi_o`, `lundi_f`, `mardi_o`, `mardi_f`, `mercredi_o`, `mercredi_f`, `jeudi_o`, `jeudi_f`, `vendredi_o`, `vendredi_f`, `samedi_o`, `samedi_f`, `dimanche_o`, `dimanche_f`, `registre`, `status`, `approved`, `featured`, `video`, `codevideo`, `statut`, `expire`, `abonnement`, `reduction`, `section_product`, `FirstService`) VALUES
(1, 'iheb', 'iheb', 'saad', NULL, 'ihebsaad@gmail.com', '$2y$10$PKkdz3DqaLyJveBpXSq/cuaJOiyyqmTLrpADfhoAXvJwCBLwIuq1i', NULL, '2020-11-03 00:00:00', NULL, '2020-11-02 23:00:00', NULL, 'admin', NULL, NULL, NULL, 'titre de prestataire', NULL, NULL, 'America/Martinique', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', NULL, 1, NULL, 0, 10, NULL, NULL),
(2, 'esolutions', 'iheb', 'eSolutions', NULL, 'ihebsa.ad@gmail.com', '$2y$10$PKkdz3DqaLyJveBpXSq/cuaJOiyyqmTLrpADfhoAXvJwCBLwIuq1i', 'cHLrHbzHiRbGduW1v5zzVJ6sKIev90bfO3HcLOBIzOP6MVgzIoG7Vh7bsggi', '2020-11-03 15:29:03', NULL, '2020-11-03 14:29:03', '2021-01-04 13:56:00', 'admin', 'description ici', '28825050', 'avenue president Habib Bourgui', 'titre de prestataire', 'keywords', NULL, 'America/Martinique', 10.1866, 36.8004, 'eSolutions.png', NULL, 'child-home-image-6.png', 'responsable ici', 'fb', 'twitter', 'insta', NULL, 'linked', 'skype', '02:00', '10:00', '01:00', '22:00', '10:00', '22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '<iframe width=\"500\"  height=\"320\" src=\"https://www.youtube.com/embed/53nwh1aHCU8\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1, NULL, 0, 10, NULL, NULL),
(3, 'client', 'David', 'Maxime', NULL, 'haithemsahlia@gmail.com', '$2y$10$aIL9FSd7Ry9SPgyy8eUE2u/LXWgq/FINMosQdXEIV45DcFCkOuUI6', 'q4hR8jHjpx0NRkZa6wt4TNK6r3Isjk2ks1mkj2K6gGGhgMJCPQIPKuK95Mab', '2020-11-09 11:08:26', NULL, '2020-11-09 10:08:26', '2021-04-27 00:23:05', 'client', NULL, '21622956876', 'avenue president Habib Bourguiba', NULL, NULL, NULL, 'America/Martinique', NULL, NULL, 'child-home-image-6.png', NULL, 'child-home-image-6.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', NULL, 1, NULL, 0, 10, NULL, 5),
(5, 'prestataire', 'Charles', 'Monressieux', NULL, 'ih.ebsaad@gmail.com', '$2y$10$0P1FRU07YF0vuMFrYQ8TGuu5ESfKmuWWVi5YpI2reP4gO2AP7/ln6', 'ldU1oJUKcGS6GXhlNTGaKR1I2wIky8m3RfILUXvlUKEZgHZ7et3Y0rC41eER', '2021-01-09 11:20:04', 'type1', '2020-11-09 10:20:04', '2021-04-26 21:46:51', 'prestataire', 'Michael White, who built a national reputation at Fiamma in New York and Las Vegas, only to see his fledgling empire squashed overnight in a partnership meltdown, returned stronger than he left. The chef strives to continue the comeback that began at Convivio and Alto with the new seafoodcentric Marea, his third and most ambitious venture with partner Chris Cannon.', '415  796-363322', '33 rue lamartine fdf', 'The Ritz-Carlton, Hong Kong', 'dddfffggg hhh ddd...ddd....d', 'Sousse', 'Europe/Paris', -61.0694, 14.6045, 'Prenez un rendez-vous (PNG).png', 'the-ritz-carlton-hong-kong-5.png', 'Sans titre (93).png', 'responsable commercial dd', NULL, NULL, NULL, NULL, NULL, NULL, '10:00', '23:00', '13:16', '23:00', '10:00', '22:00', '08:00', '18:00', '08:00', '18:00', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '', '<iframe width=\"500\"  height=\"320\" src=\"https://www.youtube.com/embed/53nwh1aHCU8\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1, '2022-02-08 14:47:16', 3, 15, 'active', 8),
(6, 'prestataire2', 'Eric', 'Dupond', NULL, 'i.hebsaad@gmail.com', '$2y$10$Ts49eiN3PCbAJnwdfro.eOokxM8nubIVwG1FqoFYaDq1DIiMoAQP6', 'KtWWJFuip0NYOVKX1l3IemItDBybkiwooHLL5pvoHNWoNDxRVMnXPcZk0wBA', '2020-11-09 12:30:52', 'type1', '2020-11-09 11:30:52', '2021-04-24 22:45:53', 'prestataire', 'The high prices and opulent dining room—with silver-dipped seashells and rosewood walls cloistered from the street behind gauzy blinds—suggests a restaurant with the loftiest auteur ambitions. While a good chunk of the dishes live up to the setting, many others—the basic iced platters of raw oysters and clams, the la carte whole fish featuring your choice of sauce, cooking method and sides—seem better suited to a far more casual fish shack. White, simply too eager to please, covers all of his bases, with prestarter crostini and fritti (including a delicious snack of lardo and sea urchin on toast), followed by crudo, antipasti, a whole raw bar selection, pastas, risottos, fish, meat and sides.', '548-664-54615', '52 avenue de fontaine 26454 Paris ', 'Restaurant Italien', NULL, 'rome', 'America/Martinique', 12.4964, 41.9028, 'restaurants-logo-png-2.png', 'restaurant-italien-6.png', 'restaurant-italian-25.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '<iframe width=\"500\"  height=\"320\" src=\"https://www.youtube.com/embed/53nwh1aHCU8\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1, '2022-02-08 14:47:16', 1, 10, 'active', NULL),
(8, 'prestataire3', 'prestataire3', 'prestataire3', '33333333', 'prestataire3@gmail.com', '$2y$10$RVd2PRBD82sxIiLFD7r9sO7dhWC32aTxJYpvmJ7gznO/9CSAWfMvq', 'MVuQ6xVQzGs2pgWRufgaLe8BRUyhZ2gjxgnQWvfXDCKWtWef7sWyDJT8rylI', '2020-01-18 13:13:29', 'type1', '2021-01-18 12:13:30', '2021-01-18 12:13:30', 'prestataire', NULL, NULL, NULL, 'titre de prestataire 3', NULL, NULL, 'America/Martinique', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, 0, 10, NULL, NULL),
(9, 'prestataire4', 'prestataire4', 'prestataire4', '22222222', 'prestataire4@gmail.com', '$2y$10$wWrR9XDyjeA8uAlF8hPXiejlmldJFX1XUts/X5KZNoOy0ZGwovhey', 'dvVlTX36yQC1zYhkMca7czj5yTtl8cndhWiS2TwlR6xHjyHDHtietJRiJUNH', '2020-01-18 13:25:20', 'type1', '2021-01-18 12:25:20', '2021-01-18 12:25:20', 'prestataire', NULL, NULL, NULL, 'titre de prestataire 4', NULL, NULL, 'America/Martinique', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, '2021-01-15 13:25:20', 0, 10, NULL, NULL),
(10, 'prestataire5', 'prestataire5', 'prestataire5', '11111111', 'prestataire5@gmail.com', '$2y$10$ou0ww8yvlE1npd9SeiCSpugd9gJEMWGg5eCXKj5ZQ36jcjsu26c06', 'edXDcvGZ737LQDgRiVsbyYYk4elFlumAEsPMW2a2SHQwv3r2fLuQatyV6XKC', '2020-01-18 13:28:08', 'type1', '2021-01-18 12:28:08', '2021-01-18 12:28:08', 'prestataire', NULL, NULL, NULL, 'titre de prestataire 5', NULL, NULL, 'America/Martinique', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, '2022-01-18 13:28:08', 0, 10, NULL, NULL),
(11, 'prestataire6', 'prestataire6', 'prestataire6', '11111111', 'prestataire6@gmail.com', '$2y$10$ElZqmAy4UzuNwXIOdi6kAuK0FWCCSkAz42gqPr7piR0QC5.gGwpYC', 'mNY4KEO04HBHCE0DEPDUxsZTq3jnvJfwO5xDqF9PQ0udLog3OTlV4kmrnyFu', '2021-02-14 22:23:11', 'type1', '2021-02-14 21:23:11', '2021-02-14 21:28:36', 'prestataire', NULL, NULL, NULL, 'titre de prestataire kbs', NULL, NULL, 'America/Martinique', NULL, NULL, NULL, 'titre-de-prestataire-kbs-11.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, 0, 10, NULL, NULL),
(12, 'popo', 'papa', 'pipi', '0631002746', 'frecon.guillaume@laposte.net', '$2y$10$uiZQIb7tTyXW66nE8G3Mau7RM9zyibgbaP8Rekj2drQZPJEZ8Ug1W', 'uLuO0RVpCY8bF8QDkQH3WRbeH8CMWPh4oDyewyLpkPAHcgMI9u1RpOWLRxk1', '2021-02-15 16:01:44', 'type1', '2021-02-15 15:01:44', '2021-02-15 15:01:44', 'client', NULL, NULL, NULL, 'titre de prestataire', NULL, NULL, 'America/Martinique', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, 0, 10, NULL, NULL),
(13, 'popop', 'papap', 'pipip', '0631002746', 'frecon.guillaume@bee-explorer.com', '$2y$10$T/UfgGRVW8XHUNm98xmyfO5IspgQD7tdMYT9yKxxKW4bv7idO4PBm', 'OQFIWPvYnKo2Fiwls3Y7IEZoxL9xEt4S1yB66ZUJITchXMYSq0yAHapNGBtN', '2021-02-15 16:06:08', 'type1', '2021-02-15 15:06:08', '2021-02-15 15:06:08', 'prestataire', NULL, NULL, NULL, 'titre de prestataire', NULL, NULL, 'America/Martinique', NULL, NULL, NULL, 'titre-de-prestataire-13.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, 0, 10, NULL, NULL),
(14, 'mab', 'Mohamed', 'Besbes', '55895814', 'med.achraf.besbes@hotmail.fr', '$2y$10$U0P.gK/2/bL4cqnuIrWV6OPLjrCxTJTvYhe/VJf39O6I1PbXnHa1m', 'vxR0GIPvFiC16uXudYsGj6W2H34RCXrMDcB9qzndyPMmjfP8odX0O3AK2azz', '2021-02-17 13:44:33', 'type1', '2021-02-17 12:44:33', '2021-02-17 12:44:33', 'client', NULL, NULL, NULL, 'titre de prestataire', NULL, NULL, 'America/Martinique', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, 0, 10, NULL, NULL),
(15, 'admin', 'sd', 'dqs', '94405202', 'Mohamed.Achraf.Besbes@hotmail.com', '$2y$10$QcgAvnRoINeh.8rkEi4g/u4TYrzxt5bMHj6440QQQ9WJzbg7mnUYa', '8fDe61EhpwIh0pneJ8LyfOZumFKkFtoW7Uy7gVT7bUmSC1ED7fj9peK33DAc', '2021-02-17 13:47:58', 'type1', '2021-02-17 12:47:58', '2021-03-04 08:09:19', 'prestataire', NULL, NULL, NULL, 'mab', NULL, NULL, 'America/Martinique', NULL, NULL, NULL, 'mab-15.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, 0, 10, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
