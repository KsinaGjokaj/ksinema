-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2024 at 06:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kinemadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `casting`
--

CREATE TABLE `casting` (
  `film_id` bigint(20) UNSIGNED NOT NULL,
  `person_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(32) NOT NULL,
  `production` date DEFAULT NULL,
  `duration` smallint(5) UNSIGNED NOT NULL,
  `genre_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` smallint(5) UNSIGNED NOT NULL,
  `trailer` varchar(128) DEFAULT NULL,
  `poster` varchar(128) DEFAULT NULL,
  `video` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id`, `title`, `production`, `duration`, `genre_id`, `price`, `trailer`, `poster`, `video`) VALUES
(1, 'The Amaizing Amuricee', '2023-02-01', 70, 1, 12, 'https://www.youtube.com/watch?v=fotvV-Ty9rU', '/resource/media/img/rsz_17gowje4afmat7tyg4xes6bnibkq.png', '/resource/media/video/vid-63dff4560abe67.28667828.mp4'),
(2, 'Tueurs', '2023-02-01', 65, 1, 100, 'https://www.youtube.com/watch?v=LEwnwd2cmRs', '/resource/media/img/rsz_fjmz7fziuqntxhgatewc1fjm0l.png', '/resource/media/video/vid-63dff6a97cdd31.03037856.mp4'),
(3, 'JACK RYAN', '2023-02-01', 70, 3, 60, 'https://www.youtube.com/watch?v=c3lQ53e2j6Q', '/resource/media/img/rsz_tom.png', '/resource/media/video/vid-63ee19bf18b5f1.37422565.mp4'),
(4, 'LIMITLESS', '2023-02-02', 90, 3, 30, 'https://www.youtube.com/watch?v=SJPnK_NgHVI', '/resource/media/img/mGrgY9FoZiJcwklEiEzyWD2DST1.jpg', '/resource/media/video/vid-63ee1a15daaf30.34494678.mp4'),
(5, 'Money Heist', '2023-02-03', 60, 3, 30, 'https://www.youtube.com/watch?v=_InqQJRqGW4', '/resource/media/img/rsz_1money.png', '/resource/media/video/vid-63ee1a5f590222.69023871.mp4'),
(17, 'stilennn', '1999-04-12', 1234, 4, 111, 'ad', '/resource/media/img/rsz_sttt.png', '/resource/media/video/vid-661feebdd82a22.34556988.mp4'),
(18, 'dccdcd', '1999-02-22', 22, 5, 222, 'adad', '/resource/media/img/IMG_1062.jpg', '/resource/media/video/vid-661ff01bb61671.07056619.mp4'),
(19, 'ssss', '1999-11-11', 11, 5, 11, 'adad', '/resource/media/img/netflix.png', '/resource/media/video/vid-661ff12cbbe909.14677852.mp4'),
(20, 'testttt', '1999-02-22', 22, 5, 222, 'adad', '/resource/media/img/IMG_1062.jpg', '/resource/media/video/vid-661ff21782e039.42723361.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `film_role`
--

CREATE TABLE `film_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `film_role`
--

INSERT INTO `film_role` (`id`, `name`) VALUES
(1, 'Guest star'),
(2, 'Series regular'),
(3, 'Co-star/day player');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(16) NOT NULL,
  `description` varchar(64) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`, `description`) VALUES
(1, 'animation', 'description  here'),
(2, 'anime', 'description  here'),
(3, 'Crime', 'description  here'),
(4, 'Aventure', 'description  here'),
(5, 'Horror', 'description  here'),
(6, 'sci-fi', 'science fiction'),
(7, 'romance', 'romance movie'),
(8, 'thriller', 'thriller'),
(9, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `name`) VALUES
(1, 'Arditi');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `film_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `film_id`, `user_id`, `purchase_date`) VALUES
(1, 1, 1, '2023-02-05'),
(2, 1, 2, '2023-02-15'),
(3, 8, 1, '2023-03-16'),
(4, 9, 1, '2023-03-16'),
(5, 2, 1, '2023-04-05'),
(6, 4, 1, '2023-04-05'),
(7, 2, 8, '2024-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `film_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`id`, `film_id`, `user_id`, `start_date`, `end_date`) VALUES
(1, 1, 4, '2023-03-02', '2023-03-05'),
(2, 8, 1, '2023-03-16', '2023-03-19'),
(3, 9, 1, '2023-03-16', '2023-03-19'),
(4, 9, 1, '2023-03-16', '2023-03-19'),
(5, 1, 5, '2023-03-16', '2023-03-19'),
(6, 10, 1, '2023-03-17', '2023-03-20'),
(7, 1, 1, '2023-04-05', '2023-04-08'),
(8, 1, 1, '2023-04-05', '2023-04-08'),
(9, 1, 1, '2023-04-05', '2023-04-08'),
(10, 1, 1, '2023-04-05', '2023-04-08'),
(11, 6, 5, '2023-04-07', '2023-04-10'),
(12, 6, 5, '2023-04-07', '2023-04-10'),
(13, 2, 5, '2023-06-12', '2023-06-15'),
(14, 5, 1, '2023-06-16', '2023-06-19'),
(15, 1, 7, '2023-06-16', '2023-06-19'),
(16, 1, 8, '2024-04-17', '2024-04-20'),
(17, 1, 8, '2024-04-17', '2024-04-20'),
(18, 1, 8, '2024-04-17', '2024-04-20'),
(19, 1, 1, '2024-04-17', '2024-04-20'),
(20, 1, 8, '2024-04-17', '2024-04-20'),
(21, 1, 8, '2024-04-17', '2024-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(128) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(128) NOT NULL,
  `failed_logins` tinyint(3) UNSIGNED DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `role_id`, `password`, `failed_logins`) VALUES
(1, 'admin', 'admin', 'admin', 1, '$2y$10$mDHQjXHr7GOtXP2Svir5r.3ODMHzzCocqVyP2F3B7G.7kxs9eFMdm', 0),
(8, 'klajdizmalaj@icloud.com', 'klajdi', 'Klajdi', 2, '$2y$10$hRbs82DbP8H2LO/TaH43NekA6ef7SY6/55vKzTkQT7dJMmy6nPOd6', 0),
(3, 'test@gmail.com', 'test', 'test', 2, '$2y$10$OMTclDnUb6Q6Tu89WK8am.sE4yTeMZxXPXyxcuUSUwoNlt2KzIIpO', 0),
(7, 'test2@test.com', 'test2', 'test', 2, '$2y$10$gic2ecnaX83urLgL9qAjYeh6Q4Ik1OrNplqAnXl2IxuuzFg4AhWq2', 0),
(6, 'test@test.com', 'test', 'test', 2, '$2y$10$ZFPzzgB3RudHXHy0oJXkROY9Ii0OB1VFtfPgI2PkI/bXa.rUJJ6wW', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `casting`
--
ALTER TABLE `casting`
  ADD PRIMARY KEY (`film_id`,`person_id`,`role_id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `casting_ibfk_3` (`role_id`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `film_role`
--
ALTER TABLE `film_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `unique` (`film_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `film_role`
--
ALTER TABLE `film_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
