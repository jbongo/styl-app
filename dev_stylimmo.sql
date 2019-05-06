-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 14 juin 2018 à 12:31
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dev_stylimmo`
--

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('bongojeanphilippe@gmail.com', '$2y$10$DPlZ3da53ciUHfc5d.DMLeUBLEKNXbEb7K2AUiTGq0NLP3D0S6g.O', '2018-06-14 07:44:19');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civilite` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complement_adresse` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Non renseigné',
  `code_postal` int(11) NOT NULL,
  `ville` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','prospect','prospect_plus','personnel','mandataire') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `civilite`, `email`, `password`, `remember_token`, `adresse`, `complement_adresse`, `code_postal`, `ville`, `pays`, `telephone`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin', 'admin', '', 'admin@gmail.com', '$2y$10$ffd5sY9tlP/cFrQURsV7ZOTtcLB3TK.vz8g.NChnUxGbVqNhd/byW', '8RRUg6olIlxFfuFaSebZSsA0puvPcaENkZJ5Ii5kqvcHEZqARcQJFymfTFn2', '', 'Non renseigné', 91478, '', '', '', NULL, NULL, 'admin'),
(2, 'alino', 'Alex', 'Mme', 'alain@gmail.com', '$2y$10$PHinOvr/3Hzj61bov80ZFuw2DvkwNz.3mQrcfiUFKXsbssJs/I2gW', NULL, '5 rue des claviers', 'Non renseigné', 14744, 'martin', 'France', '0478524455', '2018-06-14 06:49:11', '2018-06-14 06:49:11', 'mandataire'),
(3, 'test', 'test', 'Mr', 'test@gmail.comddddd', '$2y$10$0o3W5XWGtU5gPaqklsv19eH8HmCOjfRjj0GCTVVexdlWyeRf4HrJC', NULL, '5 rue des claviers', 'Non renseigné', 14744, 'martin', 'France', '0478524455', '2018-06-14 06:51:45', '2018-06-14 06:51:45', 'prospect'),
(4, 'Vike', 'felix', 'Mr', 'vixk@gmail.com', '$2y$10$wS9Z0Txg2chEN9Ervc3hxuwChvjPmDa7bgxpMogc7IYpCu97Q1LRq', NULL, '5 rue des claviers', 'Rez de chaussé', 14744, 'martin', 'France', '0478524455', '2018-06-14 06:53:19', '2018-06-14 06:53:19', 'personnel'),
(5, 'Camrone', 'Rosalie', 'Mr', 'rosalie@hotmail.fr', '$2y$10$SiazIZZjtMflSGrwbh/ov.z159WpZXsUlxN77KvHelVgdrQnZ4LCy', NULL, '5 rue des claviers', 'Non renseigné', 14744, 'martin', 'France', '0478524455', '2018-06-14 06:53:33', '2018-06-14 06:53:33', 'admin'),
(6, 'Verges', 'willine', 'Mr', 'verges14@gmail.com', '$2y$10$9e3.Dk0YNlxlqVylaiAnNexZXLTWDpyk1iPgchPbhFsqlWlsZKZM.', NULL, '5 rue des claviers', '1 er étage', 14744, 'montpelier', 'France', '0478524455', '2018-06-14 06:53:46', '2018-06-14 06:53:46', 'prospect'),
(7, 'virgine', 'marc', 'Mlle', 'virginie@orange.fr', '$2y$10$AIuz2kN2sk54hEN89p2oUefV7Nrkp10BTE7i1f95qhkFlBe8PHfzi', NULL, '5 rue des claviers', 'Non renseigné', 14744, 'martin', 'France', '0478524455', '2018-06-14 06:53:59', '2018-06-14 06:53:59', 'prospect'),
(8, 'Verges', 'willine', 'Mme', 'willine@gmail.com', '$2y$10$maDWnADRgVdzMBBnlAKM/e1DYNupCbQ9oNDWNzZ94P.2SFWeMxNtq', NULL, '5 rue des claviers', '1 er étage', 14744, 'montpelier', 'France', '0478524455', '2018-06-14 06:54:22', '2018-06-14 06:54:22', 'mandataire'),
(9, 'Gerg', 'roland', 'Mr', 'roland@gmail.fr', '$2y$10$FGqFnt8y2PfeakN5ZzYwLuFLM0dNE5U5tCBkk8qgDewcV/..ow8ge', NULL, '3 avenue martin', 'judd', 14785, 'marseille', 'France', '0478524455', '2018-06-14 06:55:23', '2018-06-14 06:55:23', 'mandataire'),
(11, 'Verges', 'willine', 'Mr', 'verges@gmail.com', '$2y$10$piEjm3yAGeiYEnKmVrGLouUCnTMA3o8MreFaaIDYDfbuAeyMvSh6.', NULL, '5 rue des claviers', '1 er étage', 14744, 'montpelier', 'France', '0478524455', '2018-06-14 06:57:47', '2018-06-14 06:57:47', 'prospect_plus'),
(12, 'setre', 'felix', 'Mme', 'felix@gmail.com', '$2y$10$GMngw6sTLW.W7.ysL31d7ulLvJwenAZ7Stq5VKuHZRhFw8gUqZIxq', NULL, '5 rue des claviers', 'Rez de chaussé', 14744, 'martin', 'France', '0478524455', '2018-06-14 06:58:43', '2018-06-14 06:58:43', 'mandataire'),
(15, 'test', 'test', 'Mme', 'test@gmail.com', '$2y$10$4os0aVYFy5dtQUxjQBR/2.gEcL.sHIE.6dUvncjktJjegYW7cGtIq', NULL, '5 rue des claviers', 'rr', 14744, 'martin', 'France', '0478524455', '2018-06-14 07:53:22', '2018-06-14 07:53:22', 'admin'),
(14, 'Bongo', 'Jean Philippe', 'Mr', 'bongojeanphilippe@gmail.com', '$2y$10$gK9X3ASjEHDfADUmmImx.OD/VICYahBWxAi93MSGNEkKZhaVUPOy2', NULL, '5 rue des claviers', 'Non renseigné', 14744, 'juvisy', 'France', '0478524455', '2018-06-14 07:44:05', '2018-06-14 07:44:05', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
