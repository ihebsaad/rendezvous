-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 15 déc. 2020 à 15:27
-- Version du serveur :  5.7.32-0ubuntu0.16.04.1
-- Version de PHP :  7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `rendezvous`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnements`
--

CREATE TABLE `abonnements` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `abonnement` int(1) NOT NULL,
  `details` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expire` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `abonnements`
--

INSERT INTO `abonnements` (`id`, `user`, `abonnement`, `details`, `expire`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'N°: 1 | Basique (mensuel)', '2021-01-07 14:56:45', '2020-12-07 14:56:48', '2020-12-07 14:56:48'),
(2, 6, 1, 'N°: 1 | Basique (mensuel)', '2021-01-08 14:47:16', '2020-12-08 14:47:19', '2020-12-08 14:47:19'),
(3, 5, 3, 'N°: 3 | Annuel (annuel)', '2022-01-07 14:56:45', '2020-12-12 10:42:26', '2020-12-12 10:42:26');

-- --------------------------------------------------------

--
-- Structure de la table `alertes`
--

CREATE TABLE `alertes` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `alertes`
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
(35, 3, 'Nouvelle Réservation', 'Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br><b>Service :</b>  xdvxvx  - (33 €)  <br><b>Date :</b> 17/12/2020<b>Heure :</b> 09:30<br><b>Prestatire :</b> Eric Dupond<br><br><b><a href=\"https://prenezunrendezvous.com/\" > prenezunrendezvous.com </a></b>', '2020-12-13 13:59:27', '2020-12-13 13:59:27');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categories`
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
(40, 'coaching sportif', NULL, 14, '2020-12-10 21:48:26', '2020-12-10 21:48:26');

-- --------------------------------------------------------

--
-- Structure de la table `categories_user`
--

CREATE TABLE `categories_user` (
  `categorie` int(8) NOT NULL,
  `user` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categories_user`
--

INSERT INTO `categories_user` (`categorie`, `user`) VALUES
(2, 5),
(3, 5),
(4, 5),
(6, 5),
(6, 6),
(8, 2),
(10, 2),
(16, 2),
(17, 2),
(20, 2),
(29, 2);

-- --------------------------------------------------------

--
-- Structure de la table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reponse` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `faqs`
--

INSERT INTO `faqs` (`id`, `user`, `question`, `reponse`, `created_at`, `updated_at`) VALUES
(1, 5, 'Quel est votre nom', 'Mon nom est iheb SAAD..', '2020-11-13 09:56:09', '2020-11-13 09:56:09');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `client` int(11) NOT NULL,
  `prestataire` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`client`, `prestataire`) VALUES
(1, 5),
(3, 0),
(3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `thumb`, `user`, `created_at`, `updated_at`) VALUES
(10, 'restaurant-mexican-11.jpg', 5, '2020-11-19 08:17:00', '2020-11-19 08:17:00'),
(2, 'image2.jpg', 2, '2020-11-11 10:46:59', '2020-11-11 10:46:59'),
(8, 'restaurant-mexican-10.jpg', 5, '2020-11-19 08:17:00', '2020-11-19 08:17:00'),
(9, 'restaurant-mexican-6.jpg', 5, '2020-11-19 08:17:00', '2020-11-19 08:17:00'),
(11, 'restaurant-mexican-2.jpg', 5, '2020-11-19 08:17:00', '2020-11-19 08:17:00'),
(12, 'restaurant-mexican-5.jpg', 5, '2020-11-19 08:17:00', '2020-11-19 08:17:00'),
(13, 'restaurant-italian-11.jpg', 6, '2020-11-19 08:28:54', '2020-11-19 08:28:54'),
(14, 'restaurant-italian-8.jpg', 6, '2020-11-19 08:28:54', '2020-11-19 08:28:54'),
(15, 'restaurant-italian-16.jpg', 6, '2020-11-19 08:28:54', '2020-11-19 08:28:54');

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE `parametres` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apropos` longtext COLLATE utf8_unicode_ci,
  `apropos_footer` text COLLATE utf8_unicode_ci,
  `contacter` longtext COLLATE utf8_unicode_ci,
  `abonnement1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abonnement2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abonnement3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cout_abonnement1` double DEFAULT NULL,
  `cout_abonnement2` double DEFAULT NULL,
  `cout_abonnement3` double DEFAULT NULL,
  `commission_abonnement1` int(11) DEFAULT NULL,
  `commission_abonnement2` int(11) DEFAULT NULL,
  `commission_abonnement3` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `parametres`
--

INSERT INTO `parametres` (`id`, `logo`, `video`, `apropos`, `apropos_footer`, `contacter`, `abonnement1`, `abonnement2`, `abonnement3`, `cout_abonnement1`, `cout_abonnement2`, `cout_abonnement3`, `commission_abonnement1`, `commission_abonnement2`, `commission_abonnement3`) VALUES
(1, 'logo.png', 'search_bg_video.mp4', 'Prenezunrendezvous.com est un site de mise en relation avec la prise de rendez-vous en ligne avec des prestataires de services qui fonctionne uniquement sur rendez-vous.\n Vous pouvez réserver un rendez-vous et payez en toute sécurité la prestation de service en ligne par carte bleau ou paypal', 'Prenezunrendezvous.com est un site de mise en relation avec la prise de rendez-vous en ligne avec des prestataires de services qui fonctionne uniquement sur rendez-vous.\nVous êtes prestataire de service et vous travaillez uniquement sur rendez-vous ? \nContactez notre service commercial au 0696930477 afin d\'être référencé sur notre site et de profiter de notre logiciel de prise de rendez-vous avec paiement en ligne.', 'contact ici', 'Basique', 'Business', 'gold', 29, 49, 89, 20, 15, 0);

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `beneficiaire` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `beneficiaire_id` int(8) DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payer_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `payments`
--

INSERT INTO `payments` (`id`, `user`, `details`, `beneficiaire`, `beneficiaire_id`, `payment_id`, `payer_id`, `created_at`, `updated_at`) VALUES
(1, 5, 'paiement  de l\'abonnement : N°: 2 | Business (mensuel)', 'prenezunrendezvous.com', 1, 'PAYID-L7HDUVA4NY609344F2171328', 'NWWGC9CTSX2MA', '2020-12-07 14:22:00', '2020-12-07 14:22:00'),
(2, 5, 'paiement  de l\'abonnement : N°: 1 | Basique (mensuel)', 'prenezunrendezvous.com', 1, 'PAYID-L7HEE3A0PV91095MK438872U', 'NWWGC9CTSX2MA', '2020-12-07 14:56:48', '2020-12-07 14:56:48'),
(3, 3, 'paiement  de réservation pour : Eric Dupond', 'Eric Dupond', 6, 'PAYID-L7HY7EQ5PP037833L8702933', 'NWWGC9CTSX2MA', '2020-12-08 14:38:20', '2020-12-08 14:38:20'),
(4, 6, 'paiement  de l\'abonnement : N°: 1 | Basique (mensuel)', 'prenezunrendezvous.com', 1, 'PAYID-L7HZDGI07A89096SL394971B', 'NWWGC9CTSX2MA', '2020-12-08 14:47:19', '2020-12-08 14:47:19'),
(5, 3, 'paiement  de réservation pour : Eric Dupond', 'Eric Dupond', 6, 'PAYID-L7JT73Q3JU40211B5332343U', 'NWWGC9CTSX2MA', '2020-12-11 09:47:29', '2020-12-11 09:47:29'),
(6, 5, 'paiement  de l\'abonnement : N°: 3 | Annuel (annuel)', 'prenezunrendezvous.com', 1, 'PAYID-L7KJ4XA7PH20341GU4825823', 'NWWGC9CTSX2MA', '2020-12-12 10:42:26', '2020-12-12 10:42:26');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `date` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `heure` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `prestataire` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `adultes` int(2) DEFAULT NULL,
  `enfants` int(2) DEFAULT NULL,
  `remarques` text COLLATE utf8_unicode_ci,
  `rappel` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statut` int(11) DEFAULT '0',
  `paiement` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `date`, `heure`, `prestataire`, `client`, `service`, `adultes`, `enfants`, `remarques`, `rappel`, `statut`, `paiement`, `created_at`, `updated_at`) VALUES
(2, '17/11/2020', '10:00', 5, 2, 5, 1, 1, NULL, '60', 2, 0, '2020-11-17 12:58:01', '2020-11-30 14:29:29'),
(3, '17/11/2020', '10:00', 5, 2, 24, 1, 2, 'remarques ici', '120', 2, 0, '2020-11-17 12:58:49', '2020-11-30 14:15:46'),
(4, '30/11/2020', '08:00', 5, 3, 8, 1, 0, NULL, '30', 1, 1, '2020-11-30 12:36:01', '2020-11-30 14:11:57'),
(5, '08/12/2020', '10:00', 6, 3, 17, 1, 0, NULL, '30', 1, 1, '2020-12-08 14:35:38', '2020-12-08 14:41:02'),
(6, '11/12/2020', '10:10', 6, 3, 17, 1, 0, 'test', '60', 1, 1, '2020-12-11 09:44:50', '2020-12-11 09:51:11'),
(7, '17/12/2020', '09:30', 6, 3, 20, 2, 0, NULL, '30', 0, 0, '2020-12-13 13:59:24', '2020-12-13 13:59:24');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `prestataire` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `commentaire` text COLLATE utf8_unicode_ci NOT NULL,
  `note` float DEFAULT NULL,
  `note_qualite` float DEFAULT NULL,
  `note_espace` float DEFAULT NULL,
  `note_prix` float DEFAULT NULL,
  `note_service` float DEFAULT NULL,
  `note_emplacement` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id`, `prestataire`, `client`, `commentaire`, `note`, `note_qualite`, `note_espace`, `note_prix`, `note_service`, `note_emplacement`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 'Bonne qualité et services :)\r\nConfort et vaste.\r\nje le recommande !', 4, 4, 5, 3, 5, 2, '2020-11-16 11:39:21', '2020-11-16 11:39:21'),
(2, 5, 1, 'Exellent Rapport Qualité/Service. emplacement loin mais l\'espace est très joli et intéresseant. je reviens toujours !', 3, 3, 5, 5, 3, 2, '2020-11-16 12:15:33', '2020-11-16 12:15:33'),
(3, 6, 3, 'Excellent service\r\nmeilleur rapport qualité/ service..', 4, 5, 5, 4, 4, 5, '2020-12-08 14:29:01', '2020-12-08 14:29:01');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `nom` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `user`, `nom`, `description`, `prix`, `thumb`, `created_at`, `updated_at`) VALUES
(1, 1, 'consultation', 'consultation médicale', 100, NULL, NULL, NULL),
(5, 5, 'consultation', 'consultation médicale complète', 120, 'restaurant-mexican-11.jpg', NULL, NULL),
(8, 5, 'pizza', 'livraison pizza', 50, 'restaurant-mexican-11.jpg', '2020-11-05 10:20:50', '2020-11-05 10:20:50'),
(15, 5, 'serivez', 'descE', 20, NULL, '2020-11-05 11:31:42', '2020-11-05 11:31:42'),
(17, 6, 'sdf', 'dfdfd', 22, NULL, '2020-11-05 11:36:45', '2020-11-05 11:36:45'),
(18, 6, 'qsdqsd', 'qsdqsd', 55, NULL, '2020-11-05 11:38:13', '2020-11-05 11:38:13'),
(20, 6, 'xdvxvx', 'xvxvx', 33, 'restaurant-mexican-11.jpg', '2020-11-05 11:47:13', '2020-11-05 11:47:13'),
(21, 6, 'ssds', 'sdfsdfs', 70, NULL, '2020-11-05 11:54:52', '2020-11-05 11:54:52'),
(32, 5, 'makloub', 'makloub mharher', 20, 'restaurant-mexican-11.jpg ', '2020-11-23 12:32:44', '2020-11-23 12:32:44');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `description` longtext COLLATE utf8_unicode_ci,
  `tel` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `couverture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsable` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skype` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lundi_o` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lundi_f` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mardi_o` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mardi_f` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mercredi_o` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mercredi_f` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jeudi_o` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jeudi_f` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendredi_o` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendredi_f` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `samedi_o` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `samedi_f` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dimanche_o` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dimanche_f` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registre` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approved` tinyint(1) DEFAULT '0',
  `featured` tinyint(1) DEFAULT '0',
  `video` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codevideo` text COLLATE utf8_unicode_ci,
  `statut` int(5) DEFAULT '1',
  `expire` datetime DEFAULT NULL,
  `abonnement` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `lastname`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `user_type`, `description`, `tel`, `adresse`, `titre`, `keywords`, `ville`, `longitude`, `latitude`, `logo`, `couverture`, `responsable`, `fb`, `twitter`, `instagram`, `youtube`, `linkedin`, `skype`, `lundi_o`, `lundi_f`, `mardi_o`, `mardi_f`, `mercredi_o`, `mercredi_f`, `jeudi_o`, `jeudi_f`, `vendredi_o`, `vendredi_f`, `samedi_o`, `samedi_f`, `dimanche_o`, `dimanche_f`, `registre`, `status`, `approved`, `featured`, `video`, `codevideo`, `statut`, `expire`, `abonnement`) VALUES
(1, 'iheb', 'iheb', 'saad', 'ihebsaad@gmail.com', '$2y$10$PKkdz3DqaLyJveBpXSq/cuaJOiyyqmTLrpADfhoAXvJwCBLwIuq1i', NULL, '2020-11-02 23:00:00', NULL, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', NULL, 1, NULL, 0),
(2, 'esolutions', 'iheb', 'eSolutions', 'ihebsa.ad@gmail.com', '$2y$10$PKkdz3DqaLyJveBpXSq/cuaJOiyyqmTLrpADfhoAXvJwCBLwIuq1i', 'eCeJZtCNeu1j9HHpO9ETKheIHcrMOVck9WhYfCKQpMiKJvJeQQKoo5ZbAMbF', '2020-11-03 14:29:03', '2020-11-19 09:12:42', 'admin', 'description ici', '28825050', 'avenue president Habib Bourguiba', 'titre ici', 'keywords', NULL, 654655000000, 4454650000000, 'eSolutions.png', 'child-home-image-6.png', 'responsable ici', 'fb', 'twitter', 'insta', NULL, 'linked', 'skype', '02:00', '10:00', '01:00', '22:00', '10:00', '22:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '<iframe width=\"500\"  height=\"320\" src=\"https://www.youtube.com/embed/53nwh1aHCU8\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1, NULL, 0),
(3, 'client', 'John', 'Fontaine', 'iheb.saad@gmail.com', '$2y$10$aIL9FSd7Ry9SPgyy8eUE2u/LXWgq/FINMosQdXEIV45DcFCkOuUI6', '5x6gtxD1KGdMNXd50jF4aJfA3kvtHM5SilZWq3ziLIFRuALsmLGXplFW6YMk', '2020-11-09 10:08:26', '2020-11-23 08:48:38', 'client', NULL, '57-554646 6655', 'avenue president Habib Bourguiba', NULL, NULL, NULL, NULL, NULL, 'child-home-image-6.png', 'child-home-image-6.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', NULL, 1, NULL, 0),
(5, 'prestataire', 'Charles', 'Monressieux', 'ih.ebsaad@gmail.com', '$2y$10$0P1FRU07YF0vuMFrYQ8TGuu5ESfKmuWWVi5YpI2reP4gO2AP7/ln6', 'J9mlcRalDR0UNDBHWyHNvqsNtcBIqZxlXPCOGqeHFihwLj2uquenver9RV27', '2020-11-09 10:20:04', '2020-12-12 09:42:23', 'prestataire', 'Michael White, who built a national reputation at Fiamma in New York and Las Vegas, only to see his fledgling empire squashed overnight in a partnership meltdown, returned stronger than he left. The chef strives to continue the comeback that began at Convivio and Alto with the new seafoodcentric Marea, his third and most ambitious venture with partner Chris Cannon.', '415  796-363322', 'sousse farhat hached', 'The Ritz-Carlton, Hong Kong', 'dddfffggg hhh ddd...ddd....d', 'Sousse', 10.6277, 35.8296, 'coop.png', 'restaurant-mexican-15.jpg', 'responsable commercial dd', NULL, 'twitter here', NULL, NULL, 'linkedin here', NULL, '10:00', '23:00', '16:16', '00:00', '10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '', '<iframe width=\"500\"  height=\"320\" src=\"https://www.youtube.com/embed/53nwh1aHCU8\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1, '2022-01-07 14:56:45', 3),
(6, 'prestataire2', 'Eric', 'Dupond', 'i.hebsaad@gmail.com', '$2y$10$Ts49eiN3PCbAJnwdfro.eOokxM8nubIVwG1FqoFYaDq1DIiMoAQP6', 'MxTqaDA00GbyuaHuNqwOklqaPze3oGQ74ZnOat3PxL8AjNEDCzqcDVKkxRnd', '2020-11-09 11:30:52', '2020-12-08 13:47:16', 'prestataire', 'The high prices and opulent dining room—with silver-dipped seashells and rosewood walls cloistered from the street behind gauzy blinds—suggests a restaurant with the loftiest auteur ambitions. While a good chunk of the dishes live up to the setting, many others—the basic iced platters of raw oysters and clams, the la carte whole fish featuring your choice of sauce, cooking method and sides—seem better suited to a far more casual fish shack. White, simply too eager to please, covers all of his bases, with prestarter crostini and fritti (including a delicious snack of lardo and sea urchin on toast), followed by crudo, antipasti, a whole raw bar selection, pastas, risottos, fish, meat and sides.', '548-664-54615', '52 avenue de fontaine 26454 Paris ', 'Restaurant Italien', NULL, 'rome', 12.4964, 41.9028, 'restaurants-logo-png-2.png', 'restaurant-italian-25.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '<iframe width=\"500\"  height=\"320\" src=\"https://www.youtube.com/embed/53nwh1aHCU8\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1, '2021-01-08 14:47:16', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnements`
--
ALTER TABLE `abonnements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `alertes`
--
ALTER TABLE `alertes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories_user`
--
ALTER TABLE `categories_user`
  ADD PRIMARY KEY (`categorie`,`user`),
  ADD UNIQUE KEY `categorie` (`categorie`,`user`);

--
-- Index pour la table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`client`,`prestataire`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parametres`
--
ALTER TABLE `parametres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prestataire` (`prestataire`,`client`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonnements`
--
ALTER TABLE `abonnements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `alertes`
--
ALTER TABLE `alertes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `parametres`
--
ALTER TABLE `parametres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
