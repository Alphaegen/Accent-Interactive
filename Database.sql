/*
MySQL Backup
Database: buggin_Events
Backup Time: 2019-04-25 15:16:14
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `buggin_Events`.`events`;
DROP TABLE IF EXISTS `buggin_Events`.`orders`;
DROP TABLE IF EXISTS `buggin_Events`.`users`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) NOT NULL,
  `eventname` varchar(255) NOT NULL,
  `seats` int(11) NOT NULL,
  `starttime` date NOT NULL,
  `endtime` date DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `smalldesc` varchar(255) DEFAULT NULL,
  `price` decimal(13,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) NOT NULL,
  `eventname` varchar(50) NOT NULL,
  `seats` int(11) NOT NULL,
  `total` varchar(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(40) NOT NULL,
  `infix` varchar(30) DEFAULT NULL,
  `lname` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `sname` varchar(75) NOT NULL,
  `snumber` int(11) NOT NULL,
  `postcode` varchar(11) NOT NULL,
  `city` varchar(40) NOT NULL,
  `country` varchar(40) NOT NULL,
  `wrong_logins` int(11) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_role` int(11) NOT NULL DEFAULT '1',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `confirm_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
DELETE FROM `buggin_Events`.`events`;
INSERT INTO `buggin_Events`.`events` (`id`,`img`,`eventname`,`seats`,`starttime`,`endtime`,`city`,`address`,`description`,`smalldesc`,`price`) VALUES (1, 'Citadel-min.jpg', 'Citadel', 1925, '2019-05-05', '2019-05-11', 'London', '', 'Big description here for the people being interested in this event to read. You could put a lot of text here, it will automatically get bigger.', 'Standart Event mini description here for the people to read.', 10.50),(2, 'defqon-min.jpg', 'Defqon', 5839, '2019-05-12', '2019-05-12', 'Biddinghuizen', '', 'Big description here for the people being interested in this event to read. You could put a lot of text here, it will automatically get bigger.', 'Standart Event mini description here for the people to read.', 10.00),(3, 'Field-Day-min.jpg', 'Field-Day', 1956, '2019-05-19', '2019-06-01', 'London', '', 'Big description here for the people being interested in this event to read. You could put a lot of text here, it will automatically get bigger.', 'Standart Event mini description here for the people to read.', 11.00),(4, 'Lollapalooza-min.jpg', 'Lollapalooza', 0, '2019-06-09', '2019-06-22', 'Paris', '', 'Big description here for the people being interested in this event to read. You could put a lot of text here, it will automatically get bigger.', 'Standart Event mini description here for the people to read.', 5.00),(5, 'Mysteryland-min.jpg', 'Mysteryland', 1759, '2019-08-25', '2019-08-31', 'Haarlemmermeer', '', 'Big description here for the people being interested in this event to read. You could put a lot of text here, it will automatically get bigger.', 'Standart Event mini description here for the people to read.', 5.00),(6, 'Roskilde-min.jpg', 'Roskilde', 5372, '2019-08-04', '2019-08-10', 'Copenhagen', 'Achter \'t Holthuis 32', 'Big description here for the people being interested in this event to read. You could put a lot of text here, it will automatically get bigger.', 'Standart Event mini description here for the people to read.', 5.00),(7, 'Sziget-min.jpg', 'Sziget', 0, '2019-06-17', '2019-06-20', 'Budapest', '', 'Big description here for the people being interested in this event to read. You could put a lot of text here, it will automatically get bigger.', 'Standart Event mini description here for the people to read.', 5.00),(8, 'Exit-min.jpg', 'Exit', 3582, '2019-04-23', '2019-04-23', 'Novi Sad', '', 'Big description here for the people being interested in this event to read. You could put a lot of text here, it will automatically get bigger.', 'Standart Event mini description here for the people to read.', 14.40),(9, 'Exit-min.jpg', 'Exit2', 3582, '2019-11-19', '2019-12-17', 'Novi Sad', '', 'Big description here for the people being interested in this event to read. You could put a lot of text here, it will automatically get bigger.', 'Standart Event mini description here for the people to read.', 14.40);
DELETE FROM `buggin_Events`.`orders`;
INSERT INTO `buggin_Events`.`orders` (`id`,`user_email`,`eventname`,`seats`,`total`,`timestamp`) VALUES (20, 'vlam4695@gmail.com', 'Exit', 6, '86.4', '2019-04-24 17:40:45'),(21, 'vlam4695@gmail.com', 'Defqon', 3, '30', '2019-04-24 17:40:53'),(22, 'vlam4695@gmail.com', 'Sziget', 2, '10', '2019-04-24 17:40:57'),(23, 'notme@gmail.com', 'Sziget', 2, '10', '2019-04-24 18:33:00'),(24, 'vlam4695@gmail.com', 'Defqon', 3, '30', '2019-04-25 13:55:56'),(25, 'vlam4695@gmail.com', 'Defqon', 1, '10', '2019-04-25 14:14:12'),(26, 'vlam4695@gmail.com', 'Defqon', 2, '20', '2019-04-25 14:17:51');
DELETE FROM `buggin_Events`.`users`;
INSERT INTO `buggin_Events`.`users` (`id`,`fname`,`infix`,`lname`,`email`,`telephone`,`sname`,`snumber`,`postcode`,`city`,`country`,`wrong_logins`,`password`,`user_role`,`confirmed`,`confirm_code`) VALUES (2, 'Niek', '', 'Vlam', 'vlam4695@gmail.com', '6', 'Achter &#39;t Holthuis', 32, '7391TN', 'Twello', 'NL', 2, '$2y$10$EJuCAV1xYcbrLlzf/xM50OcyefOYbFh5zPLQFfkMOSvIQ/lPAnu86', 1, 1, '$2y$10$.XYRhCR0RIN0RdiuqxOyoeIyWuHxTVbI7zgy17kKQWa.rhdzXyukq'),(3, 'Joost', '', 'Trein', 'herman1973@gmail.com', '224', 'Jadewood Drive', 2031, '60148', 'Lombard', 'NL', 0, '$2y$10$1WdRDe.SypsaWoGfYm2TT.QwutPGR4R9fTe3tUmXFdBJibETJvOOa', 1, 0, '$2y$10$uo2xfifQAV3Uxayhs3GKXeybsv1HWOMkGnN3ywK8pRQyZ32A3hqki'),(5, 'Robert', 'B ', 'Schipper', 'JulliusSchipper@gmail.com', '224', 'Jadewood Drive', 2031, '60148', 'Lombard', 'US', 0, '$2y$10$UvM35IkcsYnCku5xjKWq2OO5/FY5ial3HTrq.fDjQyTpGkNmLiG3u', 1, 0, '$2y$10$QLNRAwsHVV3DsMGW.Km5s.iAKy28/Yn89ZS81CJz1n.68yWkz5RbK'),(6, 'Luuk', 'B ', 'Zwaluw', 'luukzw@gmail.com', '224', 'Jadewood Drive', 2031, '60148', 'Lombard', 'US', 0, '$2y$10$Nbp49vKrHAvoywIavbchL.G5MP166zw3D7i7leDYyhwTj7D6inA/a', 1, 0, '$2y$10$.Ql5XrhPJSuFngDb2dLaxu/11TOSby1lu1LNLEcVPoTfQgLp8Cpcq'),(7, 'Herman', 'van', 'Brood', 'HermanB@gmail.com', '482359283', 'Save Me', 395, '53732', 'Apeldoorn', 'DU', 0, '$2y$10$G2mK433L13eZjizkOXt7nOpLryEqd.uV/DgZJIJ4FXCG5Czimx7eG', 1, 0, '$2y$10$gX34MrtKAG0ToBHqZmMTz.HcuwJLHqXfPosh2JuLMpeE18RUZqQoe'),(14, 'Joost', NULL, 'Herman', 'Joost@gmail.com', '06-49300966', 'Achter &#39;t Holthuis', 32, '7391TN', 'Twello', 'NL', 0, '$2y$10$k2RdaovOgz.1ReArO9Kg2eCmrIPZhCMSNt3P7VW3U1qKA9FDXEoMC', 1, 0, '$2y$10$Lj913FKuLvtF7CHsTta3F.BdyV7/6eqAQsOg2nzjw/lfWMOVeylZu'),(16, 'fwhuifw', NULL, 'weffew', 'xch90772@cndps.com', '0610101010', 'sdfsdfs', 0, 'sdfsdfs', 'sdfsdfsdf', 'NL', 0, '$2y$10$EoEOrNm1GYPycun28BcO/OaIlN1dNNdIuH5jOgwARYi4actrmejge', 1, 1, '$2y$10$rZNKEh1/H1K.Zduw/BwqN.8T/Hv5El8UCpKqQksSOrVRLy5un7G8m'),(17, 'Lukas', NULL, 'Stroomer', 'lstroomer@glu.nl', '06-12345678', 'Zilverstein', 1, '2342BN', 'Oegstgeest', 'NL', 0, '$2y$10$5FtWpRJExqyCycgSrG321OnxMN2hlC7ZojfA2L4s1sBLMqwN14XXq', 1, 1, '$2y$10$bkhBXrLu2Th/3LQFwM4FCOZcqc2.BZykQhaveq9OucUGBs7Zn.88S');
