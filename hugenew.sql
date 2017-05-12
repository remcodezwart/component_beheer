-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server versie:                5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Versie:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Structuur van  tabel hugenew.components wordt geschreven
CREATE TABLE IF NOT EXISTS `components` (
  `productId` int(11) NOT NULL AUTO_INCREMENT,
  `photo` text NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `supplierId` int(11) NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel hugenew.components: ~5 rows (ongeveer)
/*!40000 ALTER TABLE `components` DISABLE KEYS */;
REPLACE INTO `components` (`productId`, `photo`, `description`, `price`, `supplierId`) VALUES
	(8, 'http://i.imgur.com/jYrYYod.png', 'dc motor', 1.54, 2),
	(10, 'http://i.imgur.com/DqXB2VO.png', 'arduino', 2.95, 2),
	(15, 'http://i.imgur.com/RnTXPsl.png', 'breadboard', 0.54, 2),
	(17, 'http://i.imgur.com/RnTXPsl.png', 'breadboard', 0.54, 2),
	(22, 'http://i.imgur.com/DqXB2VO.png', 'arduino', 2.95, 2);
/*!40000 ALTER TABLE `components` ENABLE KEYS */;


-- Structuur van  tabel hugenew.loaned wordt geschreven
CREATE TABLE IF NOT EXISTS `loaned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_start` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `compid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `compid` (`compid`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel hugenew.loaned: ~15 rows (ongeveer)
/*!40000 ALTER TABLE `loaned` DISABLE KEYS */;
REPLACE INTO `loaned` (`id`, `date_start`, `date_end`, `compid`, `userid`) VALUES
	(1, '2016-12-14', '2020-10-31', 9, 0),
	(2, '2016-12-14', '2016-11-03', 10, 0),
	(3, '1997-11-15', '0000-00-00', 11, 1),
	(4, '2016-11-30', '0000-00-00', 15, 0),
	(5, '2016-12-07', '2017-11-01', 8, 0),
	(6, '1999-11-22', '2016-12-11', 7, 2),
	(7, '1999-11-02', '2016-11-02', 6, 0),
	(8, '2016-11-02', NULL, 3, 2),
	(9, '2016-12-07', '2016-11-02', 16, 0),
	(10, '2016-12-06', '0000-00-00', 17, 0),
	(11, '2016-11-02', NULL, 18, NULL),
	(12, '2016-11-02', NULL, 19, NULL),
	(13, '2016-11-02', NULL, 20, NULL),
	(20, '2016-11-30', NULL, 21, 0),
	(58, '2016-12-14', NULL, 1, 1);
/*!40000 ALTER TABLE `loaned` ENABLE KEYS */;


-- Structuur van  tabel hugenew.mutations wordt geschreven
CREATE TABLE IF NOT EXISTS `mutations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `studentId` int(11) NOT NULL DEFAULT '0',
  `description` varchar(50) NOT NULL DEFAULT '0',
  `stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel hugenew.mutations: ~26 rows (ongeveer)
/*!40000 ALTER TABLE `mutations` DISABLE KEYS */;
REPLACE INTO `mutations` (`id`, `productId`, `date`, `studentId`, `description`, `stock`) VALUES
	(1, 0, '0000-00-00 00:00:00', 0, '0', NULL),
	(2, 0, '2017-01-24 00:00:00', 99030821, '', NULL),
	(3, 22, '2017-01-24 00:00:00', 99030821, '', NULL),
	(4, 22, '2017-01-24 00:00:00', 99030821, '', NULL),
	(5, 22, '2017-01-24 00:00:00', 99, '', NULL),
	(6, 22, '2017-01-24 00:00:00', 999, '', NULL),
	(7, 22, '2017-01-24 00:00:00', 999, '', NULL),
	(8, 22, '2017-01-24 00:00:00', 9999, '', NULL),
	(9, 22, '2017-01-24 00:00:00', 0, '', NULL),
	(10, 22, '2017-01-24 00:00:00', 0, '', 132),
	(11, 22, '2017-01-24 00:00:00', 0, '', 3),
	(12, 22, '2017-01-24 00:00:00', 12314, '', -3),
	(13, 3, '2017-01-24 00:00:00', 990, 'test', -33),
	(14, 22, '2017-01-24 00:00:00', 12314, '', -3),
	(15, 10, '2017-01-24 00:00:00', 213213, '', 123),
	(16, 10, '2017-01-24 00:00:00', 213213, '', 123),
	(17, 22, '2017-01-24 00:00:00', 123123, '', 213),
	(18, 22, '2017-01-24 00:00:00', 123123, '', 213),
	(19, 22, '2017-01-24 00:00:00', 213123, '', 0),
	(20, 22, '2017-01-24 00:00:00', 213123, '', 0),
	(21, 22, '2017-01-24 00:00:00', 123123, '', 0),
	(22, 10, '2017-01-31 00:00:00', 9999, '', 13),
	(23, 10, '2017-01-31 00:00:00', 9999, '', 13),
	(24, 0, '2017-01-31 00:00:00', 9999, '', 13),
	(25, 10, '2017-01-31 00:00:00', 123123, '', 0),
	(26, 10, '2017-01-31 00:00:00', 12312, 'testestsetets', 123),
	(27, 10, '2017-01-31 00:00:00', 12312, 'testestsetets', 123),
	(28, 10, '2017-01-31 00:00:00', 12312, 'testestsetets', 123),
	(29, 10, '2017-01-31 00:00:00', 666, 'testmutatioe', 69),
	(30, 10, '2017-01-31 00:00:00', 99030821, 'Uitgeleend aan', -2);
/*!40000 ALTER TABLE `mutations` ENABLE KEYS */;


-- Structuur van  tabel hugenew.supplier wordt geschreven
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel hugenew.supplier: ~2 rows (ongeveer)
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
REPLACE INTO `supplier` (`id`, `name`) VALUES
	(1, 'bol.com'),
	(2, 'aliexpress');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;


-- Structuur van  tabel hugenew.users wordt geschreven
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
  `user_account_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'user''s account type (basic, premium, etc)',
  `user_has_avatar` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if user has a local avatar, 0 if not',
  `user_remember_me_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_creation_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the creation of user''s account',
  `user_last_login_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of user''s last login',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attempts',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_provider_type` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=99030822 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

-- Dumpen data van tabel hugenew.users: ~3 rows (ongeveer)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_account_type`, `user_has_avatar`, `user_remember_me_token`, `user_creation_timestamp`, `user_last_login_timestamp`, `user_failed_logins`, `user_last_failed_login`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_provider_type`) VALUES
	(1, 'test', '$2y$10$OvprunjvKOOhM1h9bzMPs.vuwGIsOqZbw88rzSyGCTJTcE61g5WXi', 'demo@demo.com', 1, 1, 0, NULL, 1422205178, 1422209189, 0, NULL, NULL, NULL, NULL, 'DEFAULT'),
	(3, 'Rick', '$2y$10$Z8bBuVugfmbiJ9DwDif7A.KpJe1eKbTJOSEVzrn1PYzB.PY4YNAom', 'rick@rick.rick', 1, 1, 0, NULL, 1477465555, 1477465588, 0, NULL, 'ad524dbff43dcc9127ca79138a4fd2170f8a4853', NULL, NULL, 'DEFAULT'),
	(99030821, 'Sebas', '$2y$10$yvjCLSxp7VcNm.kIe3bpi.s7JJi4lbW..lO4VzHi21eDQ/RlA3s2u', 'sebasbakker8@hotmail.com', 1, 7, 0, '94085915c0c59ee0f7cfb2afed9197b28d76c84f68144efa12d4bdb55c0f455e', 1474361433, 1494408235, 0, NULL, '484234b4db38a54986cc3594a32a8a5263a3ce21', NULL, NULL, 'DEFAULT');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
