-- Generation time: Thu, 17 Sep 2020 23:13:10 +0200
-- Host: localhost
-- DB name: ban
/*!40030 SET NAMES UTF8 */;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `ban`;
CREATE TABLE `ban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `side` text NOT NULL,
  `reason_ban` text NOT NULL,
  `evidence` text NOT NULL,
  `by` text NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



DROP TABLE IF EXISTS `datalogin`;
CREATE TABLE `datalogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `countError` int(2) NOT NULL DEFAULT 0,
  `dateLogin` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `group` int(11) NOT NULL DEFAULT 1,
  `data` varchar(255) NOT NULL,
  `updata_date` varchar(255) NOT NULL,
  `ip` text NOT NULL,
  `Basis` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `members` VALUES ('1','Admin','356a192b7913b04c54574d18c28d46e6395428ab','','admin@gmail.com','1','','','::1','1'); 


DROP TABLE IF EXISTS `sett`;
CREATE TABLE `sett` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nWebsit` varchar(50) NOT NULL,
  `dWebsit` varchar(255) NOT NULL,
  `kWebsit` varchar(255) NOT NULL,
  `sWebsit` int(1) NOT NULL DEFAULT 0,
  `sText` text NOT NULL,
  `ipWebsit` varchar(255) NOT NULL,
  `urlWebsit` text NOT NULL,
  `copyright` int(11) DEFAULT 0,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `sett` VALUES ('1','قائمة المحظورين في localhost','هنا ستجد جميع أسماء المحظورين في لعبة localhost الخاصة.','لعبة، localhost، للابطال، محظورين، حظر، مخالف، مخالفة','0','','','','0',''); 




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

