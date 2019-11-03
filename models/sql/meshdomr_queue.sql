-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2019 at 10:57 AM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.2.11-2+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meshdomr_queue`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1571523010),
('genuser', '2', 1571524493),
('genuser', '5', 1571946516);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'system admin', NULL, NULL, 1571521854, 1571690775),
('genuser', 1, 'general user', NULL, NULL, 1571521661, 1571524447),
('grantQueue', 2, 'Full access for Queue', NULL, NULL, 1571688682, 1571688682),
('manageOwnQueue', 2, 'for owner of queue', 'QueueOwnerRule', NULL, 1571521821, 1571688642),
('manageQueue', 2, 'manage Queue access', NULL, NULL, 1571521614, 1571688607);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'grantQueue'),
('genuser', 'manageOwnQueue'),
('admin', 'manageQueue'),
('manageOwnQueue', 'manageQueue');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('QueueOwnerRule', 0x4f3a33303a226170705c6d6f64656c735c726261635c51756575654f776e657252756c65223a333a7b733a343a226e616d65223b733a31343a2251756575654f776e657252756c65223b733a393a22637265617465644174223b693a313537313532313231383b733a393a22757064617465644174223b693a313537313532313231383b7d, 1571521218, 1571521218);

-- --------------------------------------------------------

--
-- Table structure for table `Item`
--

DROP TABLE IF EXISTS `Item`;
CREATE TABLE `Item` (
  `idItem` int(11) NOT NULL,
  `idQueue` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `CreateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `StatusDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `RestTime` int(11) DEFAULT NULL,
  `Position` int(11) NOT NULL,
  `Comment` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Item`
--

INSERT INTO `Item` (`idItem`, `idQueue`, `idClient`, `Status`, `CreateDate`, `StatusDate`, `RestTime`, `Position`, `Comment`) VALUES
(1, 1, 1, 2, '2019-01-01 05:00:00', '2019-11-02 00:05:48', 26337948, -1, NULL),
(2, 3, 4, 2, '2019-10-21 01:10:02', '2019-10-21 01:18:10', 488, -1, 'First Item'),
(3, 6, 4, 2, '2019-10-22 01:50:23', '2019-10-25 10:14:11', 289428, -1, 'One cake'),
(4, 6, 4, 2, '2019-10-25 10:09:24', '2019-10-25 10:19:12', 588, -1, 'One more cake'),
(5, 6, 4, 2, '2019-10-25 10:13:13', '2019-10-28 00:25:28', 223935, -1, 'One banan cake'),
(6, 6, 4, 0, '2019-10-25 10:14:40', '2019-10-27 19:30:16', 29, 1, 'I need more coca cola'),
(7, 6, 4, 0, '2019-10-28 00:55:29', '2019-10-28 00:55:29', 145244, 2, 'Vanila sirope'),
(8, 6, 4, 0, '2019-10-28 01:01:51', '2019-10-28 01:01:51', 217866, 3, 'Хочу вафлю'),
(9, 6, 4, 0, '2019-10-28 01:02:08', '2019-10-28 01:02:08', 290488, 4, 'где мои булочки'),
(10, 6, 4, 0, '2019-10-28 01:02:42', '2019-10-28 01:02:42', 363110, 5, 'Мороженое с шоколадом'),
(11, 6, 4, 0, '2019-10-28 01:03:21', '2019-10-28 01:03:21', 435732, 6, 'Послдений пончик'),
(12, 1, 1, 3, '2019-11-02 00:02:45', '2019-11-02 00:06:53', 248, -1, 'Whanna'),
(13, 1, 1, 3, '2019-11-02 00:03:02', '2019-11-02 00:06:57', 235, -1, 'The best'),
(14, 1, 1, 3, '2019-11-02 00:03:17', '2019-11-02 00:15:58', 761, -1, 'Last one');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1561495920),
('m140209_132017_init', 1561495940);

-- --------------------------------------------------------

--
-- Table structure for table `Owner`
--

DROP TABLE IF EXISTS `Owner`;
CREATE TABLE `Owner` (
  `idOwner` int(11) NOT NULL,
  `Description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idPerson` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Owner`
--

INSERT INTO `Owner` (`idOwner`, `Description`, `idPerson`, `Status`) VALUES
(1, 'Admin Company', 1, 0),
(4, 'vonukiy_queues', 2, 0),
(5, 'Owner|client 5', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Queue`
--

DROP TABLE IF EXISTS `Queue`;
CREATE TABLE `Queue` (
  `idQueue` int(11) NOT NULL,
  `Description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `QueueShare` int(11) NOT NULL,
  `idOwner` int(11) NOT NULL,
  `FirstItem` int(11) NOT NULL,
  `QueueLen` int(11) NOT NULL,
  `Takt` int(11) NOT NULL DEFAULT '0',
  `Cycle` int(11) DEFAULT NULL,
  `AutoTake` int(11) DEFAULT NULL,
  `Finished` int(11) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Queue`
--

INSERT INTO `Queue` (`idQueue`, `Description`, `QueueShare`, `idOwner`, `FirstItem`, `QueueLen`, `Takt`, `Cycle`, `AutoTake`, `Finished`, `Status`) VALUES
(1, 'Admin  Queue 01', 1, 1, 0, 2, 107, 26337948, NULL, 1, 1),
(3, 'Some Queue', 1, 4, 0, 0, 25, 488, 0, 1, 2),
(5, 'Queue for Jit Tracks', 1, 4, 0, 0, 1, 0, 1, NULL, 1),
(6, 'Pancake queue', 1, 4, 0, 6, 72622, 171317, 0, 3, 0),
(7, 'Private Tree Queue', 0, 1, 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `social_account`
--

DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`) VALUES
(1, 'admin', 'vonuki@gmail.com', '$2y$10$IqXVr2tNWdNi5dOHVW1YAeFvmY1FBaYs46z6Fgkmnw10DaZDt3oLG', '8iPrHS5L-Dh0Ve0sTf30u8DpDtP1ifPi', 1561662050, NULL, NULL, '194.246.46.15', 1561641238, 1561641238, 0, 1572795458),
(2, 'vonukiy', 'vonuki@yandex.ru', '$2y$10$d2ka55Oabh0zt8UGdRlQdu5qFrKLVAbksYL82nIXEn3FDW16ut0qi', 'Cn0RgoQMi77shFtVubf96mRUeViJA6E7', 1562269978, NULL, NULL, '10.1.0.8', 1562269869, 1562269869, 0, 1572643126),
(5, 'DK123', 'dmitrii.k@easymatic.su', '$2y$10$EOSR87I.r8FCYUZpP7JuSO/7i9apF/CYtsZjB4uWmDDoYDQKHNMUq', 'aBGZW7yFami_lgrPrHPrOckTsSgb_WJU', 1571946516, NULL, NULL, '10.138.0.2', 1571946471, 1571946471, 0, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vItem`
--
DROP VIEW IF EXISTS `vItem`;
CREATE TABLE `vItem` (
`idItem` int(11)
,`idQueue` int(11)
,`idClient` int(11)
,`Status` int(11)
,`CreateDate` timestamp
,`StatusDate` timestamp
,`RestTime` int(11)
,`Position` int(11)
,`Comment` varchar(200)
,`QueueDescription` varchar(50)
,`OwnerDescription` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vQueue`
--
DROP VIEW IF EXISTS `vQueue`;
CREATE TABLE `vQueue` (
`idQueue` int(11)
,`Description` varchar(50)
,`QueueShare` int(11)
,`idOwner` int(11)
,`FirstItem` int(11)
,`QueueLen` int(11)
,`Takt` int(11)
,`Cycle` int(11)
,`AutoTake` int(11)
,`Finished` int(11)
,`Status` int(11)
,`OwnerDescription` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `vItem`
--
DROP TABLE IF EXISTS `vItem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vItem`  AS  select `Item`.`idItem` AS `idItem`,`Item`.`idQueue` AS `idQueue`,`Item`.`idClient` AS `idClient`,`Item`.`Status` AS `Status`,`Item`.`CreateDate` AS `CreateDate`,`Item`.`StatusDate` AS `StatusDate`,`Item`.`RestTime` AS `RestTime`,`Item`.`Position` AS `Position`,`Item`.`Comment` AS `Comment`,`Queue`.`Description` AS `QueueDescription`,`Owner`.`Description` AS `OwnerDescription` from ((`Item` left join `Owner` on((`Item`.`idClient` = `Owner`.`idOwner`))) left join `Queue` on((`Item`.`idQueue` = `Queue`.`idQueue`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vQueue`
--
DROP TABLE IF EXISTS `vQueue`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vQueue`  AS  select `Queue`.`idQueue` AS `idQueue`,`Queue`.`Description` AS `Description`,`Queue`.`QueueShare` AS `QueueShare`,`Queue`.`idOwner` AS `idOwner`,`Queue`.`FirstItem` AS `FirstItem`,`Queue`.`QueueLen` AS `QueueLen`,`Queue`.`Takt` AS `Takt`,`Queue`.`Cycle` AS `Cycle`,`Queue`.`AutoTake` AS `AutoTake`,`Queue`.`Finished` AS `Finished`,`Queue`.`Status` AS `Status`,`Owner`.`Description` AS `OwnerDescription` from (`Queue` left join `Owner` on((`Queue`.`idOwner` = `Owner`.`idOwner`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `Item`
--
ALTER TABLE `Item`
  ADD PRIMARY KEY (`idItem`),
  ADD KEY `idQueue` (`idQueue`),
  ADD KEY `idClient` (`idClient`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `Owner`
--
ALTER TABLE `Owner`
  ADD PRIMARY KEY (`idOwner`),
  ADD KEY `idPerson` (`idPerson`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `Queue`
--
ALTER TABLE `Queue`
  ADD PRIMARY KEY (`idQueue`),
  ADD KEY `idOwner` (`idOwner`);

--
-- Indexes for table `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_username` (`username`),
  ADD UNIQUE KEY `user_unique_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Item`
--
ALTER TABLE `Item`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `Owner`
--
ALTER TABLE `Owner`
  MODIFY `idOwner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Queue`
--
ALTER TABLE `Queue`
  MODIFY `idQueue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Item`
--
ALTER TABLE `Item`
  ADD CONSTRAINT `Item_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `Owner` (`idOwner`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Item_ibfk_2` FOREIGN KEY (`idQueue`) REFERENCES `Queue` (`idQueue`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Owner`
--
ALTER TABLE `Owner`
  ADD CONSTRAINT `Owner_ibfk_1` FOREIGN KEY (`idPerson`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Queue`
--
ALTER TABLE `Queue`
  ADD CONSTRAINT `Queue_ibfk_1` FOREIGN KEY (`idOwner`) REFERENCES `Owner` (`idOwner`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
