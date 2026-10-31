-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 31 oct. 2026 à 19:25
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
-- Base de données : `accordage_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260730135607', '2026-10-30 17:18:42', 149),
('DoctrineMigrations\\Version20260910083601', '2026-10-30 17:18:42', 11),
('DoctrineMigrations\\Version20260910084300', '2026-10-30 17:18:42', 13),
('DoctrineMigrations\\Version20260910091305', '2026-10-30 17:18:42', 124),
('DoctrineMigrations\\Version20260910094143', '2026-10-30 17:18:42', 7),
('DoctrineMigrations\\Version20260910094941', '2026-10-30 17:18:42', 69),
('DoctrineMigrations\\Version20260910095955', '2026-10-30 17:18:42', 171),
('DoctrineMigrations\\Version20260910101340', '2026-10-30 17:18:42', 127),
('DoctrineMigrations\\Version20260910152757', '2026-10-30 17:18:42', 68),
('DoctrineMigrations\\Version20261002094523', '2026-10-30 17:18:42', 53),
('DoctrineMigrations\\Version20261019150149', '2026-10-30 17:18:43', 8),
('DoctrineMigrations\\Version20261019163420', '2026-10-30 17:18:43', 6);

-- --------------------------------------------------------

--
-- Structure de la table `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `lesson_pack_id` int(11) NOT NULL,
  `instrument` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lesson`
--

INSERT INTO `lesson` (`id`, `created_at`, `updated_at`, `title`, `content`, `video_url`, `description`, `price`, `images`, `lesson_pack_id`, `instrument`) VALUES
(1, '2026-10-30 19:10:49', '2026-10-30 19:10:49', 'Enter Sandman - Metallica', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.', 'https://www.youtube.com/embed/UkWd0azv3fQ\r\n', 'Travaille un riff puissant et accessible, ainsi que la précision de la main droite et les changements de cordes.', 10.00, 'test.jpg', 1, 'guitar'),
(2, '2026-10-30 19:13:05', '2026-10-31 18:38:10', 'Symphony of Destruction - Megadeth', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.', 'https://www.youtube.com/embed/UkWd0azv3fQ', 'Travaille les riffs plus rapides, les changements de rythme et la précision du jeu.', 10.00, 'test.jpg', 1, 'guitar'),
(3, '2026-10-30 19:13:48', '2026-10-31 18:38:20', 'Raining Blood - Slayer', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.', 'https://www.youtube.com/embed/UkWd0azv3fQ', 'Passe à la vitesse supérieure avec des riffs agressifs et un jeu rapide.', 10.00, 'test.jpg', 1, 'guitar'),
(4, '2026-10-30 19:17:59', '2026-10-31 18:38:28', 'Another One Bites the Dust - Queen', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.', 'https://www.youtube.com/embed/UkWd0azv3fQ', 'Apprends à jouer une ligne de basse efficace et entraînante, en travaillant la régularité et le placement rythmique.', 10.00, 'test.jpg', 2, 'bass'),
(5, '2026-10-30 19:19:29', '2026-10-31 18:38:40', 'Come Together - The Beatles', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.', 'https://www.youtube.com/embed/UkWd0azv3fQ', 'Découvre une ligne de basse groovy et expressive, idéale pour travailler le rythme et les nuances.', 10.00, 'test.jpg', 2, 'bass'),
(6, '2026-10-30 19:20:30', '2026-10-31 18:38:46', 'Should I Stay or Should I Go - The Clash', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n\r\nLorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.', 'https://www.youtube.com/embed/UkWd0azv3fQ', 'Entraîne-toi à suivre une rythmique rock énergique et à jouer en coordination avec la batterie.', 10.00, 'test.jpg', 2, 'bass'),
(7, '2026-10-31 19:15:36', '2026-10-31 19:15:36', 'Smoke on the Water - Deep Purple', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n', 'https://www.youtube.com/embed/UkWd0azv3fQ', 'Apprends le riff le plus célèbre du rock étape par étape, en travaillant la propreté des notes et le placement des doigts sur le manche.', 10.00, 'test.jpg', 3, 'guitar'),
(8, '2026-10-31 19:16:29', '2026-10-31 19:16:29', 'Back in Black - AC/DC', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n', 'https://www.youtube.com/embed/UkWd0azv3fQ', 'Travaille un riff puissant basé sur les power chords, en maîtrisant le palm mute et la régularité de ton picking main droite.', 10.00, 'test.jpg', 3, 'guitar'),
(9, '2026-10-31 19:17:02', '2026-10-31 19:17:02', 'Seven Nation Army - The White Stripes', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n', 'https://www.youtube.com/embed/UkWd0azv3fQ', 'Apprends à jouer ce riff iconique en entier, en travaillant l\'endurance de la main gauche et la précision rythmique.', 10.00, 'test.jpg', 3, 'guitar'),
(10, '2026-10-31 19:17:36', '2026-10-31 19:17:36', 'For Whom the Bell Tolls - Metallica', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n', 'https://www.youtube.com/embed/UkWd0azv3fQ', 'Apprends une ligne de basse metal puissante et syncopée, en travaillant le galop (alternance rapide index/majeur) et l\'ancrage rythmique', 10.00, 'test.jpg', 4, 'bass'),
(11, '2026-10-31 19:18:15', '2026-10-31 19:18:15', 'Schism - Tool', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n', 'https://www.youtube.com/embed/UkWd0azv3fQ', 'Travaille une ligne de basse complexe en mesures impaires, en développant ta coordination et ta capacité à suivre des rythmes décalés.', 10.00, 'test.jpg', 4, 'bass'),
(12, '2026-10-31 19:18:42', '2026-10-31 19:18:42', 'The Trooper - Iron Maiden', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.\r\n', 'https://www.youtube.com/embed/UkWd0azv3fQ', 'Apprends à jouer cette ligne de basse rapide et mélodique, en travaillant la vitesse de la main gauche et la régularité du doigté.', 10.00, 'test.jpg', 4, 'bass');

-- --------------------------------------------------------

--
-- Structure de la table `lesson_pack`
--

CREATE TABLE `lesson_pack` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `instrument` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lesson_pack`
--

INSERT INTO `lesson_pack` (`id`, `created_at`, `updated_at`, `instrument`, `title`, `description`, `price`, `image`) VALUES
(1, '2026-10-30 19:04:47', '2026-10-31 18:37:49', 'guitar', 'Pack Métal - Guitare électrique', 'Apprends la guitare à travers l’énergie du métal ! Découvre les techniques essentielles du style, travaille tes riffs et tes rythmiques, puis progresse à ton rythme avec des leçons pensées pour te faire jouer rapidement.\r\n', 25.00, 'metal.jpg'),
(2, '2026-10-30 19:16:01', '2026-10-30 19:16:01', 'bass', 'Pack Rock - Basse électrique', 'Découvre les bases de la basse rock à travers des morceaux emblématiques. Travaille ton groove, ta régularité et ta coordination avec la batterie, tout en apprenant à poser des lignes de basse qui donnent toute leur énergie aux morceaux.\r\n', 25.00, 'rock.jpg'),
(3, '2026-10-31 19:14:07', '2026-10-31 19:14:07', 'guitar', 'Pack Rock - Guitare électrique', 'Découvre les bases du rock à la guitare à travers des riffs emblématiques. Travaille les power chords, le palm mute et la puissance du son pour jouer des morceaux qui envoient du lourd dès les premières mesures.', 25.00, 'rock.jpg'),
(4, '2026-10-31 19:14:36', '2026-10-31 19:14:36', 'bass', 'Pack Metal - Basse électrique', 'Plonge dans l\'univers du metal à la basse avec des lignes agressives et techniques. Travaille la vitesse, le galop et la précision pour tenir le rythme avec la batterie dans des morceaux intenses.', 25.00, 'metal.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `is_used` tinyint(4) NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`images`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `created_at`, `updated_at`, `name`, `category`, `description`, `price`, `stock`, `is_used`, `images`) VALUES
(1, '2026-10-31 18:54:10', '2026-10-31 18:54:10', 'Guitare 1', 'guitar', 'Une belle guitare ! ', 255.00, 1, 0, '[\"guitar1.jpg\"]'),
(2, '2026-10-31 19:19:46', '2026-10-31 19:19:46', 'Guitare 2', 'guitar', 'Guitare très sympa !', 321.00, 1, 0, '[\"guitar2.jpg\"]'),
(3, '2026-10-31 19:20:30', '2026-10-31 19:20:30', 'bass n1', 'bass', 'une très jolie basse ', 256.00, 5, 0, '[\"bass1.jpg\"]'),
(4, '2026-10-31 19:20:51', '2026-10-31 19:20:51', 'bass 2', 'bass', 'une autre basse ', 158.00, 2, 0, '[\"bass2.jpg\"]'),
(5, '2026-10-31 19:21:57', '2026-10-31 19:21:57', 'cordes 1 ', 'other', 'des cordes ! ', 12.00, 23, 0, '[\"strings1.jpg\"]'),
(6, '2026-10-31 19:22:15', '2026-10-31 19:22:15', 'cordes 2', 'other', 'd\'autres cordes', 11.00, 6, 0, '[\"strings2.jpg\"]'),
(7, '2026-10-31 19:22:48', '2026-10-31 19:22:48', 'guitare occas', 'guitar', 'Une petite guitare de seconde main', 150.00, 1, 1, '[\"ocas1.jpg\"]');

-- --------------------------------------------------------

--
-- Structure de la table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `progress`
--

INSERT INTO `progress` (`id`, `created_at`, `user_id`, `lesson_id`) VALUES
(3, '2026-10-31 17:40:43', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `purchase_lesson`
--

CREATE TABLE `purchase_lesson` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `price_paid` decimal(10,2) NOT NULL,
  `purchase_type` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lesson_pack_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `purchase_lesson`
--

INSERT INTO `purchase_lesson` (`id`, `created_at`, `price_paid`, `purchase_type`, `user_id`, `lesson_pack_id`, `lesson_id`) VALUES
(1, '2026-10-31 16:29:29', 25.00, 'pack', 3, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `purchase_product`
--

CREATE TABLE `purchase_product` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `price_paid` decimal(10,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `selector` varchar(20) NOT NULL,
  `hashed_token` varchar(100) NOT NULL,
  `requested_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reset_password_request`
--

INSERT INTO `reset_password_request` (`id`, `selector`, `hashed_token`, `requested_at`, `expires_at`, `user_id`) VALUES
(2, 'rPqF1Mfyv9ERoatQRpHT', '3Xnh2IJwCwhq32PIbCImKJ829StlGq15D00C6ZWbn34=', '2026-10-31 18:15:32', '2026-10-31 19:15:32', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `verified` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `created_at`, `updated_at`, `name`, `first_name`, `phone`, `verified`) VALUES
(1, 'test1@gmail.com', '[\"ROLE_USER\"]', '$2y$13$CppvHONAQM7X/c9ouu5ih..GgSnmxjFOuBLfUvj2RWc4b6yjRVmde', '2026-10-30 17:22:07', '2026-10-30 17:22:07', 'deb', 'deb', '0102030405', 0),
(2, 'test2@gmail.com', '[\"ROLE_USER\"]', '$2y$13$nlDUB4s3eZ/Cv99SOtQwa.2gaVUAflaMjpifkVn2YWT/RrBoHenqa', '2026-10-30 17:23:00', '2026-10-30 17:23:00', 'deb', 'deb', '0203040506', 1),
(3, 'admin1@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$SJ1Gl0A5E.28m31BYMSraOb2xls215vhD3SaZAuNR.uloRHYAt4Dy', '2026-10-30 17:25:06', '2026-10-30 17:25:06', 'deb', 'deb', '0304050607', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F87474F3EC65E0B0` (`lesson_pack_id`);

--
-- Index pour la table `lesson_pack`
--
ALTER TABLE `lesson_pack`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`,`available_at`,`delivered_at`,`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2201F246A76ED395` (`user_id`),
  ADD KEY `IDX_2201F246CDF80196` (`lesson_id`);

--
-- Index pour la table `purchase_lesson`
--
ALTER TABLE `purchase_lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_231B76A6A76ED395` (`user_id`),
  ADD KEY `IDX_231B76A6EC65E0B0` (`lesson_pack_id`),
  ADD KEY `IDX_231B76A6CDF80196` (`lesson_id`);

--
-- Index pour la table `purchase_product`
--
ALTER TABLE `purchase_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C890CED4A76ED395` (`user_id`),
  ADD KEY `IDX_C890CED44584665A` (`product_id`);

--
-- Index pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `lesson_pack`
--
ALTER TABLE `lesson_pack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `purchase_lesson`
--
ALTER TABLE `purchase_lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `purchase_product`
--
ALTER TABLE `purchase_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_F87474F3EC65E0B0` FOREIGN KEY (`lesson_pack_id`) REFERENCES `lesson_pack` (`id`);

--
-- Contraintes pour la table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `FK_2201F246A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_2201F246CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`);

--
-- Contraintes pour la table `purchase_lesson`
--
ALTER TABLE `purchase_lesson`
  ADD CONSTRAINT `FK_231B76A6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_231B76A6CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`),
  ADD CONSTRAINT `FK_231B76A6EC65E0B0` FOREIGN KEY (`lesson_pack_id`) REFERENCES `lesson_pack` (`id`);

--
-- Contraintes pour la table `purchase_product`
--
ALTER TABLE `purchase_product`
  ADD CONSTRAINT `FK_C890CED44584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_C890CED4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
