/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.25-MariaDB : Database - gplms_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`gplms_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `gplms_db`;

/*Table structure for table `author` */

DROP TABLE IF EXISTS `author`;

CREATE TABLE `author` (
  `author_ID` int(50) NOT NULL AUTO_INCREMENT,
  `author_Name` varchar(50) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `updation_date` date DEFAULT NULL,
  PRIMARY KEY (`author_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10002 DEFAULT CHARSET=utf8mb4;

/*Data for the table `author` */

insert  into `author`(`author_ID`,`author_Name`,`creation_date`,`updation_date`) values (10001,'Henry Sy','2023-10-12','2023-10-20');

/*Table structure for table `author_book` */

DROP TABLE IF EXISTS `author_book`;

CREATE TABLE `author_book` (
  `authorbk_ID` int(50) NOT NULL,
  `ISBN` varchar(50) DEFAULT NULL,
  `author_ID` int(50) DEFAULT NULL,
  PRIMARY KEY (`authorbk_ID`),
  KEY `ISBN` (`ISBN`),
  KEY `author_book_ibfk_2` (`author_ID`),
  CONSTRAINT `author_book_ibfk_2` FOREIGN KEY (`author_ID`) REFERENCES `author` (`author_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `author_book_ibfk_3` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `author_book` */

/*Table structure for table `book` */

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `ISBN` varchar(50) NOT NULL,
  `booknum` int(100) NOT NULL AUTO_INCREMENT,
  `bk_title` varchar(50) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `bk_cat` varchar(255) DEFAULT NULL,
  `publisher` varchar(50) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `pub_date` date DEFAULT NULL,
  `edition` varchar(50) DEFAULT NULL,
  `initial_copies` int(50) DEFAULT NULL,
  `copies` int(50) NOT NULL,
  `stock` int(50) DEFAULT NULL,
  `cost` int(50) DEFAULT NULL,
  `date_acquired` date DEFAULT NULL,
  `purchased_from` varchar(50) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` timestamp(5) NULL DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `published_in` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `bk_subcat` varchar(255) DEFAULT NULL,
  `material` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `location_row` varchar(100) DEFAULT NULL,
  `bk_subdivision` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ISBN`,`booknum`),
  KEY `sample` (`booknum`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

/*Data for the table `book` */

insert  into `book`(`ISBN`,`booknum`,`bk_title`,`image_url`,`bk_cat`,`publisher`,`author`,`pub_date`,`edition`,`initial_copies`,`copies`,`stock`,`cost`,`date_acquired`,`purchased_from`,`is_deleted`,`deleted_at`,`location`,`description`,`subtitle`,`published_in`,`notes`,`bk_subcat`,`material`,`language`,`location_row`,`bk_subdivision`) values ('978-0062316097',43,'Sapiens','6646282337828_book_image_65ae040e045da.jpg','900-999: History and geography','Harper','Yuval Noah Harari','2015-07-04','0',NULL,3,3,NULL,'2024-05-09',NULL,0,NULL,NULL,'\"Sapiens\" offers a sweeping history of humankind, from the emergence of Homo sapiens in Africa to the present day. Yuval Noah Harari explores the key developments and revolutions that have shaped human societies, from the cognitive revolution to the agricultural revolution to the rise of empires and beyond.','A Brief History of Humankind','New York',NULL,'900: History & geography',NULL,NULL,NULL,'909: World history'),('978-0062316099',44,'The Alchemist','664629a9d1289_book_image_65d98e8921cb1.jpg','800-899: Literature','HarperOne','Paulo Coelho','1993-07-07','0',NULL,1,1,NULL,'2024-05-06',NULL,0,NULL,NULL,'\"The Alchemist\" is a philosophical novel that follows the journey of Santiago, a young Andalusian shepherd boy, as he embarks on a quest to find his Personal Legend. Along the way, he encounters various characters and learns valuable lessons about life, destiny, and the pursuit of dreams.','(No subtitle)','San Francisco',NULL,'860: Spanish & Portuguese literatures',NULL,NULL,NULL,'869: Portuguese and Galician literatures'),('978-0141439518',42,'Pride and Prejudice','6646278fe22fb_book_image_65ae02e8e51fb.jpg','800-899: Literature','Penguin Classics','Jane Austen','2003-01-02','0',NULL,1,1,NULL,'2024-05-16',NULL,0,NULL,NULL,'\"Pride and Prejudice\" is a classic novel set in early 19th-century England that follows the romantic endeavors of Elizabeth Bennet, one of five daughters of the Bennet family. The novel explores themes of love, marriage, social class, and personal growth against the backdrop of Regency-era society.','a','London',NULL,'820: English & Old English literatures',NULL,NULL,NULL,'823: English fiction'),('978-0399590504',40,'Educated','664623936e7cb_book_image_65ae0242e9ec2.jpg','900-999: History and geography','Random House','Tara Westover','2018-12-23','First Edition',NULL,1,1,NULL,'2024-05-16',NULL,0,NULL,NULL,'\"Educated\" is a memoir that chronicles Tara Westover\'s journey from growing up in a strict and isolated household in rural Idaho to ultimately earning a PhD from Cambridge University. It explores themes of family, education, resilience, and the power of self-discovery.','A Memoir','New York',NULL,'920: Biography, genealogy, insignia',NULL,NULL,NULL,'929: Genealogy, names & insignia'),('978-0439023481',45,'The Hunger Games','66462a3570364_book_image_65ae03a50a576.jpg','800-899: Literature','Scholastic Press','Suzanne Collins','2008-08-28','0',NULL,4,4,NULL,'2024-05-01',NULL,0,NULL,NULL,'\"The Hunger Games\" is the first book in a dystopian trilogy set in a future where children are forced to fight to the death in a televised event called the Hunger Games. The story follows Katniss Everdeen as she volunteers to take her sister\'s place in the Games and becomes a symbol of rebellion against the oppressive government.','(No subtitle)','New York',NULL,'810: American literature in English',NULL,NULL,NULL,'813: American fiction in English'),('978-0590353427',41,'Harry Potter and the Sorcerer\'s Stone','664625dbb204c_51DF6ZR8G7L__38888.jpg','800-899: Literature','Random House','J.K. Rowling','1998-05-08','First Edition',NULL,1,1,NULL,'2024-05-16',NULL,0,NULL,NULL,'The first book in the beloved Harry Potter series, \\\"Harry Potter and the Sorcerer\\\'s Stone\\\" introduces readers to the magical world of Hogwarts School of Witchcraft and Wizardry. Follow Harry Potter as he discovers his true identity, makes friends, and confronts the dark forces threatening the wizarding world.','','New York',NULL,'820: English & Old English literatures',NULL,NULL,NULL,'823: English fiction'),('978-0735211292',39,'Atomic Habits','66461f3cc52a5_a9679d1a-ad57-4177-8a8a-acca3928174d.jpg','100-199: Philosophy and psychology','Avery','James Clear','2018-05-21','First Edition',NULL,2,2,NULL,'2024-05-01',NULL,0,NULL,NULL,' \"Atomic Habits\" provides a comprehensive guide to understanding how habits are formed and how they can be changed. James Clear explores practical strategies for building good habits, breaking bad ones, and mastering the tiny behaviors that lead to remarkable results.','An Easy & Proven Way to Build Good Habits & Break Bad Ones','New York',NULL,'150: Psychology',NULL,NULL,NULL,'158: Applied psychology');

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `cart_ID` int(50) NOT NULL AUTO_INCREMENT,
  `user_ID` int(50) DEFAULT NULL,
  `ISBN` varchar(50) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`cart_ID`),
  KEY `ISBN` (`ISBN`),
  KEY `user_ID` (`user_ID`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=277 DEFAULT CHARSET=utf8mb4;

/*Data for the table `cart` */

/*Table structure for table `transaction` */

DROP TABLE IF EXISTS `transaction`;

CREATE TABLE `transaction` (
  `trans_ID` int(50) NOT NULL AUTO_INCREMENT,
  `trans_name` varchar(50) DEFAULT NULL,
  `user_ID` int(50) DEFAULT NULL,
  `ISBN` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_requested` date DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `date_borrowed` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `date_returned` date DEFAULT NULL,
  `fine` double DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `released_condition` varchar(100) DEFAULT NULL,
  `returned_condition` varchar(100) DEFAULT NULL,
  `returned` varchar(50) DEFAULT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`trans_ID`),
  KEY `ISBN` (`ISBN`),
  KEY `transaction_ibfk_1` (`user_ID`),
  CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10240 DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaction` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_ID` int(50) NOT NULL AUTO_INCREMENT,
  `lib_num` varchar(100) DEFAULT NULL,
  `fName` varchar(50) NOT NULL,
  `mInitial` varchar(50) DEFAULT NULL,
  `lName` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` int(50) NOT NULL,
  `b_date` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_num` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `active` int(1) DEFAULT 1,
  PRIMARY KEY (`user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`user_ID`,`lib_num`,`fName`,`mInitial`,`lName`,`gender`,`age`,`b_date`,`address`,`contact_num`,`user_email`,`user_pass`,`type`,`active`) values (75,'','admin','admin','admin','male',24,'0000-00-00','','','admin','adminak0','Administrator',1),(79,'LIB2024-79','Aljon','C','Casim','male',22,'2024-05-14','Irosin, Sorsogon','9914945150','aljoncasim','aljon1234','Patron',1),(80,'LIB2024-80','Mark','B','Estareja','male',22,'2001-12-21','Cabigaan, Gubat, Sorsogon','9914945150','markestareja','mark1234','Patron',1),(81,'LIB2024-81','Darlen Benneth','L','Golpeo','female',22,'2001-11-07','Bulan Sorsogon','9914945150','darlenbennethgolpeo','darlen1234','Patron',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
