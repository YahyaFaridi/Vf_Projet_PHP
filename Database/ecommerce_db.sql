-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 17 août 2024 à 03:47
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecommerce_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(15, 'Personnalisé'),
(14, 'Enfant'),
(12, 'Homme'),
(13, 'Femme');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `created_at`, `status`) VALUES
(17, 6, 115.00, '2024-08-08 19:45:08', 'paid'),
(16, 6, 115.00, '2024-08-08 19:44:49', 'paid'),
(15, 6, 32.19, '2024-08-06 23:16:39', 'paid'),
(18, 5, 390.99, '2024-08-10 00:53:08', 'paid'),
(19, 5, 356.49, '2024-08-10 00:59:35', 'paid'),
(20, 5, 356.49, '2024-08-10 02:36:11', 'paid'),
(21, 5, 309.35, '2024-08-10 02:39:49', 'pending'),
(22, 5, 0.00, '2024-08-10 02:44:05', 'paid'),
(23, 5, 309.35, '2024-08-10 02:44:26', 'paid'),
(24, 5, 309.35, '2024-08-10 02:45:58', 'paid');

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 8, 1, 200.00),
(2, 2, 8, 1, 200.00),
(3, 3, 9, 1, 100.00),
(4, 4, 8, 2, 200.00),
(5, 4, 1, 1, 27.99),
(6, 5, 2, 2, 25.00),
(7, 6, 4, 1, 33.99),
(8, 7, 9, 1, 100.00),
(9, 8, 1, 1, 27.99),
(10, 9, 8, 1, 200.00),
(11, 10, 8, 1, 200.00),
(12, 11, 8, 1, 200.00),
(13, 12, 14, 3, 100.00),
(14, 13, 9, 1, 100.00),
(15, 14, 10, 4, 100.00),
(16, 15, 1, 1, 27.99),
(17, 16, 10, 1, 100.00),
(18, 17, 10, 1, 100.00),
(19, 18, 4, 1, 339.99),
(20, 19, 3, 1, 309.99),
(21, 20, 3, 1, 309.99),
(22, 21, 16, 1, 269.00),
(23, 23, 16, 1, 269.00),
(24, 24, 16, 1, 269.00);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `stock` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category_id`, `created_at`, `stock`) VALUES
(1, 'Air Jordan 1 Mid Smoke', 'Air Jordan 1 Mid Smoke', 279.99, 'product1.png', 12, '2024-08-04 00:24:53', 0),
(3, 'Nike SB Dunk Low Pro', 'Nike SB Dunk Low Pro', 309.99, 'product3.png', 15, '2024-08-04 00:24:53', 0),
(4, 'Jordan 1 Low Bred Toe 2.0', 'Jordan 1 Low Bred Toe 2.0', 339.99, 'product4.png', 12, '2024-08-04 00:24:53', 0),
(5, 'Air Jordan 1 Gym Red', 'Air Jordan 1 Gym Red', 249.99, 'product5.png', 12, '2024-08-04 00:24:53', 0),
(16, 'Air Jordan 1 Mid Smoke', 'Air Jordan 1 Mid Smoke', 269.00, 'product1.png', 14, '2024-08-10 00:10:30', 0),
(25, 'Nike Air Jordan 1 Retro', 'Version rétro de la célèbre Nike Air Jordan 1, parfaite pour le style et le confort.', 149.99, 'product1.png', 14, '2024-08-15 23:10:30', 0),
(26, 'Nike Air Jordan 4 OG', 'Chaussure emblématique avec un design classique et une technologie moderne.', 199.99, 'product2.png', 12, '2024-08-15 23:10:30', 0),
(27, 'Nike SB Dunk Low', 'Chaussure basse Nike SB Dunk, idéale pour les skateurs avec un confort supérieur.', 109.99, 'product3.png', 15, '2024-08-15 23:10:30', 0),
(28, 'Nike SB Dunk High', 'Chaussure haute Nike SB Dunk pour une protection accrue et un style unique.', 119.99, 'product4.png', 15, '2024-08-15 23:10:30', 0),
(29, 'Nike Air Max 270', 'Chaussure avec une technologie Air Max pour un confort optimal toute la journée.', 129.99, 'product1.png', 15, '2024-08-15 23:10:30', 0),
(30, 'Nike Air Force 1', 'Modèle classique de Nike, offrant une combinaison parfaite de style et de confort.', 99.99, 'product2.png', 12, '2024-08-15 23:10:30', 0),
(31, 'Nike Air Jordan 3 Retro', 'Version rétro de la Nike Air Jordan 3 avec un design innovant et un confort exceptionnel.', 159.99, 'product3.png', 12, '2024-08-15 23:10:30', 0),
(32, 'Nike Air Max 97', 'Chaussure avec la célèbre unité Air Max pour une absorption des chocs exceptionnelle.', 139.99, 'product4.png', 15, '2024-08-15 23:10:30', 0),
(33, 'Nike Air Jordan 5 Retro', 'Design emblématique de la Nike Air Jordan 5 avec une touche rétro.', 169.99, 'product1.png', 12, '2024-08-15 23:10:30', 0),
(34, 'Nike SB Zoom Stefan Janoski', 'Chaussure de skate Nike SB avec une construction durable et un confort inégalé.', 89.99, 'product2.png', 12, '2024-08-15 23:10:30', 0),
(35, 'Nike Air Jordan 6 Retro', 'Chaussure classique Nike Air Jordan 6 avec un design intemporel et un confort moderne.', 179.99, 'product3.png', 12, '2024-08-15 23:10:30', 0),
(36, 'Nike Air Max Plus', 'Chaussure avec une technologie Air Max pour un amorti réactif et un style audacieux.', 119.99, 'product4.png', 12, '2024-08-15 23:10:30', 0),
(37, 'Nike SB Dunk Low Pro', 'Version professionnelle de la Nike SB Dunk Low avec une meilleure performance pour les skateurs.', 109.99, 'product1.png', 14, '2024-08-15 23:10:30', 0),
(38, 'Nike Air Zoom Pegasus 39', 'Chaussure de running Nike avec une technologie Air Zoom pour un amorti léger et réactif.', 129.99, 'product2.png', 14, '2024-08-15 23:10:30', 0),
(39, 'Air Jordan 1 Mid Smoke', 'Air Jordan 1 Mid Smoke', 299.00, 'product6.jpeg', 12, '2024-08-17 01:26:09', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(2, 'YahyaFaridi', '$2y$10$suMukGTSCCuTQRvVHcZxiORNs8DSGWYevixQrhIz/t5PfnByazKq.', 'faridiyahya0@gmail.com', 'admin'),
(3, 'yahya', '$2y$10$qxDtJmVWWUWksTD4qAbo6uUzMQm2eMoB3R4jQf1usJhJKh8MaKKKa', 'ali-ameskane@hotmail.fr', 'user'),
(5, 'admin', 'Admin1234', 'admin@example.com', 'admin'),
(6, 'AliYahya', 'User@@us1', 'ali@example.com', 'user'),
(7, 'yahay', '$2y$10$9eblEJHYzkohFv.yewdFi.r8wC2StQBiC/0FPlr5awMV8NVFv7JxC', 'h@gnail.com', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
