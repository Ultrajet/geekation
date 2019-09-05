-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 05, 2019 at 07:09 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `geekation`
--

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `montant` double NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  `membre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `montant`, `date_enregistrement`, `membre_id`) VALUES
(1, 19.9, '2019-09-04 00:00:00', 2),
(2, 9.45, '2019-09-05 07:05:17', 2);

-- --------------------------------------------------------

--
-- Table structure for table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `username` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_de_naissance` date NOT NULL,
  `telephone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scan_cni` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rib` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membres`
--

INSERT INTO `membres` (`id`, `username`, `password`, `prenom`, `nom`, `email`, `adresse`, `code_postal`, `ville`, `date_de_naissance`, `telephone`, `scan_cni`, `rib`, `sexe`, `salt`, `role`) VALUES
(1, 'Admin', '$argon2id$v=19$m=65536,t=4,p=1$aR6q/O2ub81/lRR8n9zgPQ$K/LrlVpRR6D245JeayUrKoot3mn2dB7r5cAkllLPm3U', 'Alan', 'Allcorn', 'admin@geekation.com', '78 rue Taitbout', 75009, 'Paris', '1972-11-29', '0607080910', 'CNI', 'RIB', 'h', NULL, 'ROLE_ADMIN'),
(2, 'Marine', '$argon2id$v=19$m=65536,t=4,p=1$tYpmeqQbgfaFaBOSMBXFjA$gWtg9TBWYUsxyoKdOljKNY5gxyQiBexG9BvJOrIEQBM', 'Marine', 'Pelletier', 'marine@geekation.com', 'Chemin du Parc', 78770, 'Villiers le Mahieu', '1991-09-27', '0123456789', 'CNI', 'RIB', 'f', NULL, 'ROLE_USER');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190828081152', '2019-08-28 08:12:10'),
('20190828082227', '2019-08-28 08:22:32'),
('20190828132039', '2019-08-28 13:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `univers` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `prix`, `type`, `univers`, `slug`, `guid`) VALUES
(1, 'Playstation 4', 1.9, 'console', 'sony', 'playstation-4-sony', '3045-146'),
(2, 'Playstation 4', 1.9, 'console', 'sony', 'playstation-4-sony', '3045-146'),
(3, 'Playstation 4', 1.9, 'console', 'sony', 'playstation-4-sony', '3045-146'),
(4, 'XBox One', 1.9, 'console', 'microsoft', 'xbox-one-microsoft', '3045-145'),
(5, 'XBox One', 1.9, 'console', 'microsoft', 'xbox-one-microsoft', '3045-145'),
(6, 'XBox One', 1.9, 'console', 'microsoft', 'xbox-one-microsoft', '3045-145'),
(7, 'Switch', 1.9, 'console', 'nintendo', 'switch-nintendo', '3045-157'),
(8, 'Switch', 1.9, 'console', 'nintendo', 'switch-nintendo', '3045-157'),
(9, 'Switch', 1.9, 'console', 'nintendo', 'switch-nintendo', '3045-157'),
(10, 'FIFA 20', 1.25, 'jeu', 'sony', 'fifa-20-sony', '3030-73601'),
(11, 'FIFA 20', 1.25, 'jeu', 'microsoft', 'fifa-20-microsoft', '3030-73601'),
(12, 'FIFA 20', 1.25, 'jeu', 'nintendo', 'fifa-20-nintendo', '3030-73601'),
(13, 'Dragon Ball FighterZ', 0.99, 'jeu', 'sony', 'dragon-ball-fighterz-sony', '3030-59862'),
(14, 'Dragon Ball FighterZ', 0.99, 'jeu', 'microsoft', 'dragon-ball-fighterz-microsoft', '3030-59862'),
(15, 'Dragon Ball FighterZ', 0.99, 'jeu', 'nintendo', 'dragon-ball-fighterz-nintendo', '3030-59862'),
(16, 'Mario Kart 8', 0.99, 'jeu', 'nintendo', 'mario-kart-8-nintendo', '3030-42929'),
(17, 'Super Mario Party', 0.99, 'jeu', 'nintendo', 'super-mario-party-nintendo', '3030-68947'),
(18, 'Pokémon: Let\'s Go - Pikachu', 0.99, 'jeu', 'nintendo', 'pokemon-lets-go-pikachu-nintendo', '3030-68738'),
(19, 'Pokémon: Let\'s Go - Evoli', 0.99, 'jeu', 'nintendo', 'pokemon-lets-go-evoli-nintendo', '3030-68738'),
(20, 'The Legend of Zelda: Link\'s Awakening', 1.25, 'jeu', 'nintendo', 'the-legend-of-zelda-links-awakening-nintendo', '3030-72148'),
(21, 'Final Fantasy XIV: Shadowbringers', 0.99, 'jeu', 'sony', 'final-fantasy-xiv-shadowbringers-sony', '3030-71550'),
(22, 'Call of Duty: Modern Warfare - Reboot', 1.25, 'jeu', 'sony', 'call-of-duty-modern-warfare-reboot-sony', '3030-73517'),
(23, 'Call of Duty: Modern Warfare - Reboot', 1.25, 'jeu', 'microsoft', 'call-of-duty-modern-warfare-reboot-microsoft', '3030-73517'),
(24, 'Gran Turismo', 0.99, 'jeu', 'sony', 'gran-turismo-sony', '3030-44517'),
(25, 'God of War', 0.99, 'jeu', 'sony', 'god-of-war-sony', '3030-54229'),
(26, 'Shadow of the Tomb Raider', 0.99, 'jeu', 'sony', 'shadow-of-the-tomb-raider-sony', '3030-67214'),
(27, 'Shadow of the Tomb Raider', 0.99, 'jeu', 'microsoft', 'shadow-of-the-tomb-raider-microsoft', '3030-67214'),
(28, 'Forza Motorsport 7', 0.99, 'jeu', 'microsoft', 'forza-motorsport-7-microsoft', '3030-59896'),
(29, 'Halo Wars 2', 0.99, 'jeu', 'microsoft', 'halo-wars-2-microsoft', '3030-50510'),
(30, 'Playstation VR', 4.9, 'accessoire', 'sony', 'playstation-vr-sony', '3000-71'),
(31, 'Joy-Con', 1.9, 'accessoire', 'nintendo', 'joy-con-nintendo', '3000-101'),
(32, 'Joy-Con', 1.9, 'accessoire', 'nintendo', 'joy-con-nintendo', '3000-101'),
(33, 'Joy-Con', 1.9, 'accessoire', 'nintendo', 'joy-con-nintendo', '3000-101'),
(34, 'DualShock', 1.9, 'accessoire', 'sony', 'dualshock-sony', '3000-42'),
(35, 'DualShock', 1.9, 'accessoire', 'sony', 'dualshock-sony', '3000-42'),
(36, 'Playstation Move', 1.9, 'accessoire', 'sony', 'playstation-move-sony', '3000-36'),
(37, 'Playstation Move', 1.9, 'accessoire', 'sony', 'playstation-move-sony', '3000-36'),
(38, 'Xbox Elite Wireless Controller', 1.9, 'accessoire', 'microsoft', 'xbox-elite-wireless-controller-microsoft', '3000-87'),
(39, 'Xbox Elite Wireless Controller', 1.9, 'accessoire', 'microsoft', 'xbox-elite-wireless-controller-microsoft', '3000-87'),
(40, 'Xbox Elite Wireless Controller', 1.9, 'accessoire', 'microsoft', 'xbox-elite-wireless-controller-microsoft', '3000-87');

-- --------------------------------------------------------

--
-- Table structure for table `produits_commandes`
--

CREATE TABLE `produits_commandes` (
  `id` int(11) NOT NULL,
  `date_debut_location` datetime NOT NULL,
  `date_fin_location` datetime NOT NULL,
  `produit_id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produits_commandes`
--

INSERT INTO `produits_commandes` (`id`, `date_debut_location`, `date_fin_location`, `produit_id`, `commande_id`) VALUES
(1, '2019-09-06 07:05:17', '2019-09-09 07:05:17', 10, 2),
(2, '2019-09-06 07:05:17', '2019-09-09 07:05:17', 34, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_35D4282C6A99F74A` (`membre_id`);

--
-- Indexes for table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produits_commandes`
--
ALTER TABLE `produits_commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5DF6AD2CF347EFB` (`produit_id`),
  ADD KEY `IDX_5DF6AD2C82EA2E54` (`commande_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `produits_commandes`
--
ALTER TABLE `produits_commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_35D4282C6A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membres` (`id`);

--
-- Constraints for table `produits_commandes`
--
ALTER TABLE `produits_commandes`
  ADD CONSTRAINT `FK_5DF6AD2C82EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`),
  ADD CONSTRAINT `FK_5DF6AD2CF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`);
