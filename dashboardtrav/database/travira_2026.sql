-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2026 at 09:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `travira_2026` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `travira_2026`;

CREATE TABLE `company` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(10) NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_description` text NOT NULL,
  `seo_keywords` text NOT NULL,
  `hero_title` varchar(255) NOT NULL,
  `hero_lead` text NOT NULL,
  `kicker` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `lead` text NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `operations_kicker` varchar(255) NOT NULL,
  `operations_title` varchar(255) NOT NULL,
  `operations_text` text NOT NULL,
  `operations_locations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `sustainability_kicker` varchar(255) NOT NULL,
  `sustainability_title` varchar(255) NOT NULL,
  `sustainability_lead` text NOT NULL,
  `sustainibility_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `media` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `company`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


-- Akun awal: username `admin`, password `admin123`

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`username`, `password_hash`) VALUES
('admin', '$2y$10$o.S7AOxQrpZGHvPQzZttLe1O8Rzrm7GX9FEfSRIHY2azfHXCX8P06')
ON DUPLICATE KEY UPDATE `username` = `username`;


COMMIT;
