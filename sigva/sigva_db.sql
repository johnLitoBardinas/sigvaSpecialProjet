-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: sigva_db
-- ------------------------------------------------------
-- Server version	5.5.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_account_tbl`
--

DROP TABLE IF EXISTS `admin_account_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_account_tbl` (
  `admin_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(25) NOT NULL,
  `admin_password` varchar(40) NOT NULL,
  PRIMARY KEY (`admin_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_account_tbl`
--

LOCK TABLES `admin_account_tbl` WRITE;
/*!40000 ALTER TABLE `admin_account_tbl` DISABLE KEYS */;
INSERT INTO `admin_account_tbl` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `admin_account_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guardian_student_tbl`
--

DROP TABLE IF EXISTS `guardian_student_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guardian_student_tbl` (
  `guardian_student_id` int(11) NOT NULL AUTO_INCREMENT,
  `guardian_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`guardian_student_id`),
  KEY `guardian_id` (`guardian_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `guardian_student_tbl_ibfk_1` FOREIGN KEY (`guardian_id`) REFERENCES `guardian_tbl` (`guardian_id`) ON UPDATE CASCADE,
  CONSTRAINT `guardian_student_tbl_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_tbl` (`student_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guardian_student_tbl`
--

LOCK TABLES `guardian_student_tbl` WRITE;
/*!40000 ALTER TABLE `guardian_student_tbl` DISABLE KEYS */;
INSERT INTO `guardian_student_tbl` VALUES (1,1,1),(7,5,8),(10,7,11),(12,1,14),(13,8,15),(14,9,16),(15,10,17),(16,11,18),(17,1,19),(18,1,20);
/*!40000 ALTER TABLE `guardian_student_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guardian_tbl`
--

DROP TABLE IF EXISTS `guardian_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guardian_tbl` (
  `guardian_id` int(11) NOT NULL AUTO_INCREMENT,
  `guardian_lname` tinytext NOT NULL,
  `guardian_fname` tinytext NOT NULL,
  `guardian_mname` tinytext,
  `guardian_address` varchar(100) NOT NULL,
  `phone_number` char(11) NOT NULL,
  PRIMARY KEY (`guardian_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guardian_tbl`
--

LOCK TABLES `guardian_tbl` WRITE;
/*!40000 ALTER TABLE `guardian_tbl` DISABLE KEYS */;
INSERT INTO `guardian_tbl` VALUES (1,'Bardinas','Purisima ','Misola','Cararayan Naga City','09100261672'),(5,'Orante','Joseph','Pontilias','San Ramon, Nabua Camarines Sur ','09480088381'),(7,'Manchete','Ken','Sacdalan','Buhi Camarines Sur','09167690634'),(8,'bernardez','arlene','','Magarao Camarines Sur','09501069996'),(9,'Atole','Clemen','','Conception Peqeuna','09305954313'),(10,'Dichoso','Efren ','','Conception Grande Naga City','09093138164'),(11,'Vergara','editha ','Barrosa','Anayan Pili Camarines Sur','09472186480');
/*!40000 ALTER TABLE `guardian_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrar_account_tbl`
--

DROP TABLE IF EXISTS `registrar_account_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrar_account_tbl` (
  `registrar_acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `registrar_username` varchar(25) NOT NULL,
  `registrar_pass` varchar(40) NOT NULL,
  PRIMARY KEY (`registrar_acc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrar_account_tbl`
--

LOCK TABLES `registrar_account_tbl` WRITE;
/*!40000 ALTER TABLE `registrar_account_tbl` DISABLE KEYS */;
INSERT INTO `registrar_account_tbl` VALUES (1,'registrar','21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `registrar_account_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_grades_log`
--

DROP TABLE IF EXISTS `request_grades_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_grades_log` (
  `request_grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `student` text NOT NULL,
  `sem` enum('1st','2nd') NOT NULL,
  `school_year` varchar(15) NOT NULL,
  `status` enum('ok','error') NOT NULL,
  `requested_number` char(11) NOT NULL,
  `requested_date_time` datetime NOT NULL,
  PRIMARY KEY (`request_grade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_grades_log`
--

LOCK TABLES `request_grades_log` WRITE;
/*!40000 ALTER TABLE `request_grades_log` DISABLE KEYS */;
INSERT INTO `request_grades_log` VALUES (1,'sample_fname','1st','2016-2017','ok','09100261672','2016-10-22 12:10:26');
/*!40000 ALTER TABLE `request_grades_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section_tbl`
--

DROP TABLE IF EXISTS `section_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `section_tbl` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(15) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section_tbl`
--

LOCK TABLES `section_tbl` WRITE;
/*!40000 ALTER TABLE `section_tbl` DISABLE KEYS */;
INSERT INTO `section_tbl` VALUES (2,'BSCS-4A'),(5,'BSIT-3A'),(6,'BSIT-3B'),(7,'BSIT-4A'),(8,'BSIT-4B');
/*!40000 ALTER TABLE `section_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `stud_grade_view`
--

DROP TABLE IF EXISTS `stud_grade_view`;
/*!50001 DROP VIEW IF EXISTS `stud_grade_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `stud_grade_view` AS SELECT 
 1 AS `grade_id`,
 1 AS `stud_id`,
 1 AS `sched_id`,
 1 AS `stud_name`,
 1 AS `pr_g`,
 1 AS `md_g`,
 1 AS `pf_g`,
 1 AS `f_g`,
 1 AS `sub_g`,
 1 AS `eq`,
 1 AS `remarks`,
 1 AS `guardian_num`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `stud_page_grades_summary`
--

DROP TABLE IF EXISTS `stud_page_grades_summary`;
/*!50001 DROP VIEW IF EXISTS `stud_page_grades_summary`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `stud_page_grades_summary` AS SELECT 
 1 AS `grade_id`,
 1 AS `stud_name`,
 1 AS `grade_code`,
 1 AS `stud_status`,
 1 AS `program`,
 1 AS `sec`,
 1 AS `subject_name`,
 1 AS `description`,
 1 AS `sub_units`,
 1 AS `pr_grade`,
 1 AS `md_grade`,
 1 AS `pf_grade`,
 1 AS `finals`,
 1 AS `sub_grade`,
 1 AS `gen_ave`,
 1 AS `remarks`,
 1 AS `sem`,
 1 AS `school_year`,
 1 AS `room`,
 1 AS `date_sched`,
 1 AS `teach_name`,
 1 AS `guard_name`,
 1 AS `guard_address`,
 1 AS `guardian_num`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `stud_page_stud_grades`
--

DROP TABLE IF EXISTS `stud_page_stud_grades`;
/*!50001 DROP VIEW IF EXISTS `stud_page_stud_grades`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `stud_page_stud_grades` AS SELECT 
 1 AS `grade_id`,
 1 AS `stud_name`,
 1 AS `grade_code`,
 1 AS `stud_status`,
 1 AS `program`,
 1 AS `sec`,
 1 AS `subject`,
 1 AS `description`,
 1 AS `gen_ave`,
 1 AS `remarks`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `stud_sub_sched_view`
--

DROP TABLE IF EXISTS `stud_sub_sched_view`;
/*!50001 DROP VIEW IF EXISTS `stud_sub_sched_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `stud_sub_sched_view` AS SELECT 
 1 AS `stud_grade_id`,
 1 AS `stud_access_code`,
 1 AS `stud_name`,
 1 AS `sub_code`,
 1 AS `sub_desc`,
 1 AS `teach_name`,
 1 AS `sec_name`,
 1 AS `room_no`,
 1 AS `sched`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `student_grade_tbl`
--

DROP TABLE IF EXISTS `student_grade_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_grade_tbl` (
  `student_grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_schedule_id` int(11) NOT NULL,
  `prelim_grade` int(3) DEFAULT '0',
  `midterm_grade` int(3) DEFAULT '0',
  `pre_finals_grade` int(3) DEFAULT '0',
  `finals_grade` int(3) DEFAULT '0',
  `subject_grade` int(3) DEFAULT '0',
  `equivalent` decimal(3,2) DEFAULT '0.00',
  `remarks` varchar(100) DEFAULT 'none',
  `sem` enum('1st','2nd') NOT NULL,
  `school_year` varchar(15) NOT NULL,
  PRIMARY KEY (`student_grade_id`),
  KEY `student_id_idx` (`student_id`),
  KEY `subject_sched_id_idx` (`subject_schedule_id`),
  CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `student_tbl` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subject_schedule_id` FOREIGN KEY (`subject_schedule_id`) REFERENCES `subject_schedule_tbl` (`subject_schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_grade_tbl`
--

LOCK TABLES `student_grade_tbl` WRITE;
/*!40000 ALTER TABLE `student_grade_tbl` DISABLE KEYS */;
INSERT INTO `student_grade_tbl` VALUES (7,15,12,0,0,0,0,0,0.00,'none','1st','2016-2017'),(8,1,22,89,99,86,89,92,1.25,'none','1st','2016-2017'),(10,1,21,90,89,87,88,94,1.50,'none','1st','2016-2017'),(12,11,16,0,0,0,0,0,0.00,'none','1st','2016-2017'),(15,11,18,0,0,0,0,0,0.00,'none','1st','2016-2017'),(16,11,20,0,0,0,0,0,0.00,'none','1st','2016-2017'),(17,15,16,0,0,0,0,0,0.00,'none','1st','2016-2017'),(19,15,14,0,0,0,0,0,0.00,'none','1st','2016-2017'),(21,16,18,0,0,0,0,0,0.00,'none','1st','2016-2017'),(22,16,16,0,0,0,0,0,0.00,'none','1st','2016-2017'),(24,16,15,0,0,0,0,0,0.00,'none','1st','2016-2017'),(25,16,14,0,0,0,0,0,0.00,'none','1st','2016-2017'),(26,15,23,98,88,90,89,91,1.75,'none','1st','2016-2017'),(27,11,23,99,99,99,99,99,1.00,'sample remarks','1st','2016-2017'),(28,16,23,90,90,89,66,80,2.50,'none','1st','2016-2017'),(29,17,23,87,77,99,98,92,1.75,'none','1st','2016-2017'),(30,17,22,0,0,0,0,0,0.00,'none','1st','2016-2017'),(31,17,21,0,0,0,0,0,0.00,'none','1st','2016-2017'),(32,18,23,88,78,99,100,93,1.50,'sample remarks','1st','2016-2017'),(33,18,21,0,0,0,0,0,0.00,'none','1st','2016-2017'),(34,1,23,99,99,98,99,99,1.00,'Sample','1st','2016-2017'),(35,19,23,90,90,99,100,96,1.25,'none','1st','2016-2017'),(36,19,21,0,0,0,0,0,0.00,'none','1st','2016-2017'),(37,19,20,0,0,0,0,0,0.00,'none','1st','2016-2017'),(40,20,23,0,0,0,0,0,0.00,'none','1st','2016-2017'),(41,20,22,0,0,0,0,0,0.00,'none','1st','2016-2017');
/*!40000 ALTER TABLE `student_grade_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `student_subject_sched_list`
--

DROP TABLE IF EXISTS `student_subject_sched_list`;
/*!50001 DROP VIEW IF EXISTS `student_subject_sched_list`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `student_subject_sched_list` AS SELECT 
 1 AS `sub_sched_id`,
 1 AS `sub_code`,
 1 AS `sub_desc`,
 1 AS `teacher_name`,
 1 AS `section`,
 1 AS `room`,
 1 AS `schedule`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `student_tbl`
--

DROP TABLE IF EXISTS `student_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_tbl` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_access_grade_code` varchar(9) NOT NULL,
  `stud_lname` tinytext NOT NULL,
  `stud_fname` tinytext NOT NULL,
  `stud_mname` tinytext,
  `stud_status` enum('regular','irregular') NOT NULL,
  `program` char(10) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_tbl`
--

LOCK TABLES `student_tbl` WRITE;
/*!40000 ALTER TABLE `student_tbl` DISABLE KEYS */;
INSERT INTO `student_tbl` VALUES (1,'SRL-5127','Bardinas','John lito','Takahashi','irregular','bsit'),(8,'FEO-9506','Orante','Jovet','Bardinas','regular','bsit'),(11,'SMK-2789','Sacdalan','Christian','Manchete','regular','bscs'),(14,'HXB-2749','Takahashi','Eunice Trixen','Bardinas','regular','bsit'),(15,'ESH-2506','Bernardez','Jay ann','Barrera','regular','bsit'),(16,'VA2-4708','Atole','Jake','Vegas','irregular','bsit'),(17,'A2Y-7164','Dichoso','Mark Vincent','','regular','bscs'),(18,'T15-1695','Barrosa','Fahad ','','irregular','bsit'),(19,'JB0-1825','Dela Cruz','kim','San Juan','regular','bscs'),(20,'FRB-6985','Bagacina','James','','irregular','bscs');
/*!40000 ALTER TABLE `student_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject_schedule_tbl`
--

DROP TABLE IF EXISTS `subject_schedule_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject_schedule_tbl` (
  `subject_schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_subject_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `room` varchar(15) NOT NULL,
  `date_time` varchar(50) NOT NULL,
  PRIMARY KEY (`subject_schedule_id`),
  KEY `teacher_subject_id_idx` (`teacher_subject_id`),
  KEY `section_id_idx` (`section_id`),
  CONSTRAINT `section_id` FOREIGN KEY (`section_id`) REFERENCES `section_tbl` (`section_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `teacher_subject_id` FOREIGN KEY (`teacher_subject_id`) REFERENCES `teacher_subject_tbl` (`teacher_subject_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject_schedule_tbl`
--

LOCK TABLES `subject_schedule_tbl` WRITE;
/*!40000 ALTER TABLE `subject_schedule_tbl` DISABLE KEYS */;
INSERT INTO `subject_schedule_tbl` VALUES (11,4,2,'444','mon,wed 9:00 AM - 9:30 AM'),(12,4,7,'403','mon,wed 8:00 AM - 10:30 AM'),(13,15,7,'303','mon,wed 10:30 AM - 11:00 AM'),(14,17,7,'303','mon,wed 3:00 PM - 4:30 PM'),(15,14,7,'comlab1','tue,thurs 7:00 PM - 8:30 PM'),(16,16,7,'305','mon,wed 1:30 PM - 3:00 PM'),(18,12,7,'305','tue,thurs 9:30 AM - 11:00 AM'),(20,13,6,'306','tue,thurs 2:30 PM - 4:00 PM'),(21,17,6,'306','tue,thurs 2:30 PM - 4:00 PM'),(22,14,6,'306','mon,fri 7:00 PM - 8:30 PM'),(23,19,2,'233','mon,wed 4:30 PM - 5:30 PM');
/*!40000 ALTER TABLE `subject_schedule_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `subject_schedule_view`
--

DROP TABLE IF EXISTS `subject_schedule_view`;
/*!50001 DROP VIEW IF EXISTS `subject_schedule_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `subject_schedule_view` AS SELECT 
 1 AS `subject_schedule_id`,
 1 AS `subject_code`,
 1 AS `TeacherName`,
 1 AS `section_name`,
 1 AS `room`,
 1 AS `date_time`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `subject_tbl`
--

DROP TABLE IF EXISTS `subject_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject_tbl` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(15) NOT NULL,
  `subject_description` varchar(100) NOT NULL,
  `subject_units` decimal(3,2) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject_tbl`
--

LOCK TABLES `subject_tbl` WRITE;
/*!40000 ALTER TABLE `subject_tbl` DISABLE KEYS */;
INSERT INTO `subject_tbl` VALUES (6,'JP Rizal','Jose Protacio Rizal Mercado y Alonso Realonda',3.00),(10,'WorldLit','World Literature',2.00),(12,'SadSign','System and Analysis and Design',1.00),(13,'GenPsy','General Psychology',2.00),(14,'Philita','Philippine Literatue',3.00),(15,'Technop','Technopreneurship',3.00),(16,'IT-PRACB','IT Practicum',6.00),(17,'Addprog2','Advance programming',3.00),(18,'Forlang','Foreign Language',2.00),(19,'Sample Subject','Sample Subject Desc',4.00);
/*!40000 ALTER TABLE `subject_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `teach_sched_view`
--

DROP TABLE IF EXISTS `teach_sched_view`;
/*!50001 DROP VIEW IF EXISTS `teach_sched_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `teach_sched_view` AS SELECT 
 1 AS `teach_id`,
 1 AS `sched_id`,
 1 AS `sec_name`,
 1 AS `sub_code`,
 1 AS `room`,
 1 AS `date_time`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `teach_sub_get_id`
--

DROP TABLE IF EXISTS `teach_sub_get_id`;
/*!50001 DROP VIEW IF EXISTS `teach_sub_get_id`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `teach_sub_get_id` AS SELECT 
 1 AS `teach_id`,
 1 AS `teach_sub_id`,
 1 AS `sub_code`,
 1 AS `sub_decs`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `teacher_account_tbl`
--

DROP TABLE IF EXISTS `teacher_account_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher_account_tbl` (
  `teacher_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `teacher_username` varchar(50) NOT NULL,
  `teacher_pass` varchar(50) NOT NULL,
  PRIMARY KEY (`teacher_account_id`),
  KEY `teacher_id_idx` (`teacher_id`),
  CONSTRAINT `teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_tbl` (`teacher_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher_account_tbl`
--

LOCK TABLES `teacher_account_tbl` WRITE;
/*!40000 ALTER TABLE `teacher_account_tbl` DISABLE KEYS */;
INSERT INTO `teacher_account_tbl` VALUES (1,4,'sampleuser','912d2755d7c14dc7dcf604e68f1774f4'),(2,9,'spjay','6627691e93866a738459402766104f1b');
/*!40000 ALTER TABLE `teacher_account_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher_subject_tbl`
--

DROP TABLE IF EXISTS `teacher_subject_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher_subject_tbl` (
  `teacher_subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`teacher_subject_id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `teacher_subject_tbl_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_tbl` (`teacher_id`) ON UPDATE CASCADE,
  CONSTRAINT `teacher_subject_tbl_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject_tbl` (`subject_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher_subject_tbl`
--

LOCK TABLES `teacher_subject_tbl` WRITE;
/*!40000 ALTER TABLE `teacher_subject_tbl` DISABLE KEYS */;
INSERT INTO `teacher_subject_tbl` VALUES (4,6,12),(11,11,6),(12,11,10),(13,11,14),(14,9,18),(15,6,17),(16,10,13),(17,8,15),(19,4,19);
/*!40000 ALTER TABLE `teacher_subject_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `teacher_subject_view`
--

DROP TABLE IF EXISTS `teacher_subject_view`;
/*!50001 DROP VIEW IF EXISTS `teacher_subject_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `teacher_subject_view` AS SELECT 
 1 AS `teacher_subject_id`,
 1 AS `teacher_lname`,
 1 AS `teacher_fname`,
 1 AS `subject_code`,
 1 AS `subject_description`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `teacher_tbl`
--

DROP TABLE IF EXISTS `teacher_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher_tbl` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_lname` tinytext NOT NULL,
  `teacher_fname` tinytext NOT NULL,
  `teacher_mname` tinytext,
  `teach_account` enum('y','n') DEFAULT 'n',
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher_tbl`
--

LOCK TABLES `teacher_tbl` WRITE;
/*!40000 ALTER TABLE `teacher_tbl` DISABLE KEYS */;
INSERT INTO `teacher_tbl` VALUES (4,'Sample ','Teacher','','y'),(6,'Ibo','Abelardo','Adviser','n'),(8,'Calleja','Carlo','','n'),(9,'Malate','Charrise','San Juan','y'),(10,'Daplas','Tanya','','n'),(11,'Reugallano','Jefrey','','n');
/*!40000 ALTER TABLE `teacher_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'sigva_db'
--

--
-- Dumping routines for database 'sigva_db'
--
/*!50003 DROP PROCEDURE IF EXISTS `sproc_ajax_get_student_grades` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_ajax_get_student_grades`(IN sched_id INT)
BEGIN
	SELECT sg.grade_id, sg.stud_name, sg.pr_g, sg.md_g, sg.pf_g, sg.f_g, sg.sub_g, sg.eq, sg.remarks FROM stud_grade_view as sg WHERE sg.sched_id = sched_id order by stud_name asc;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sproc_auto_reply_grade` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_auto_reply_grade`(IN  grade_codeIn varchar(9), IN sem enum('1st','2nd'), IN school_year varchar(15))
BEGIN
	
    select stud_name, program, concat(sem,", ",school_year) as 'term',
		subject_name as 'subject',
	   gen_ave as 'gen_average', 
       remarks as 'remarks',
       teach_name as 'teacher'
	from stud_page_grades_summary 
	where grade_code = grade_codeIn
    AND  sem = sem
    AND school_year = school_year;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sproc_get_stud_article_grades` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_get_stud_article_grades`(IN grade_codes VARCHAR(9))
BEGIN
	select sec, subject_name, description, pr_grade, md_grade, pf_grade, finals, room, date_sched, teach_name,
	sub_grade, gen_ave, remarks from stud_page_grades_summary
	where grade_code = grade_codes;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sproc_get_stud_grade_info` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_get_stud_grade_info`(IN access_code varchar(9))
BEGIN

	select distinct stud_name,stud_status,program from 
	stud_page_stud_grades
	where grade_code = access_code;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sproc_get_teach_dat` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_get_teach_dat`(IN teach_id INT)
BEGIN

	select 	t.teacher_id as 'teach_id',
		upper(concat(t.teacher_lname, ', ', t. teacher_fname, ' ', t.teacher_mname)) as 'teach_name',
        tc.teacher_username as 'username'
        from teacher_tbl as t
        inner join teacher_account_tbl as tc
        using(teacher_id)
        where teacher_id = teach_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sproc_get_Tsched_dat` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_get_Tsched_dat`(IN teach_id INT)
BEGIN
		Select
		/**a.teacher_id as 'teach_id',*/
		b.subject_schedule_id as 'sched_id',
		e.section_name as 'sec_name',
		c.subject_code as 'sub_code',
		b.room as 'room',
		b.date_time as 'date_time'
	from teacher_tbl as a

	left join teacher_subject_tbl as d
		on d.teacher_id = a.teacher_id
		
	right join subject_schedule_tbl as b
		on b.teacher_subject_id = d.teacher_subject_id
		
	left join section_tbl as e
		on e.section_id = b.section_id

	left join subject_tbl as c
		on c.subject_id = d.subject_id
		
	where a.teacher_id = teach_id;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sproc_get_tSub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_get_tSub`(IN teach_id INT)
BEGIN

	select tt.teacher_subject_id as 'id',
	   sub.subject_code as 'sub_code',
	   sub.subject_description as 'sub_decs'
	from teacher_subject_tbl as tt
	inner join subject_tbl as sub
	using(subject_id)
	where tt.teacher_id = teach_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sproc_guard_list` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_guard_list`()
BEGIN

	select guardian_id as 'guard_id', 
    lower(concat(guardian_lname, ', ', guardian_fname, ' ', guardian_mname)) as 'guard_name' 
    from guardian_tbl;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sproc_stud_grade_sched` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_stud_grade_sched`(IN sched_id INT)
BEGIN

	select distinct sub.subject_code as 'sub_code',
		sec.section_name as 'sec_name',
        count(student_id) as 'num_stud' 
       
	from student_grade_tbl as s
	inner join subject_schedule_tbl
	using(subject_schedule_id)
	inner join  teacher_subject_tbl
	using(teacher_subject_id)
	inner join subject_tbl as sub
	using(subject_id)
	inner join section_tbl as sec
	using(section_id)
	where s.subject_schedule_id = sched_id ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sproc_stud_list` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_stud_list`()
BEGIN

	 select student_id, concat(stud_lname, ', ', stud_fname, ' ', stud_mname) as 'stud_fulname' 
     from student_tbl
     
     group by stud_lname;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sproc_subject_sched` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_subject_sched`()
BEGIN
	
     select ss.subject_schedule_id as 'sub_sched_id', st.subject_code as 'sub_code', st.subject_description as 'sub_desc', 
     upper(concat(tt.teacher_lname, ', ', tt.teacher_fname, ' ', tt.teacher_mname)) as 'teacher_name',
     sec.section_name as 'section', ss.room as 'room', ss.date_time as 'schedule'
     from subject_schedule_tbl as ss
     inner join teacher_subject_tbl
     using(teacher_subject_id)
     inner join subject_tbl as st
     using(subject_id)
     inner join teacher_tbl as tt
     using(teacher_id)
     inner join section_tbl as sec
     using(section_id)
     inner join subject_prerequisite_tbl as spt
     using(subject_id);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sproc_sub_list` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_sub_list`()
BEGIN
		
        select subject_id, subject_code from subject_tbl;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sproc_sub_teachlist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_sub_teachlist`()
BEGIN

	select teacher_id, concat(teacher_lname," ",teacher_fname) as 'TeacherName' 
    from teacher_tbl;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sproc_teach_sub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sproc_teach_sub`()
BEGIN

	 select ts.teacher_subject_id, 
     upper(concat(ts.subject_code, ' - ', ts.teacher_lname, " " ,ts.teacher_fname)) 
     as 'TeacherSubject' 
     from teacher_subject_view as ts
     
     group by ts.subject_code;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `stud_grade_view`
--

/*!50001 DROP VIEW IF EXISTS `stud_grade_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `stud_grade_view` AS (select `sg`.`student_grade_id` AS `grade_id`,`sg`.`student_id` AS `stud_id`,`sg`.`subject_schedule_id` AS `sched_id`,lcase(concat(`s`.`stud_lname`,', ',`s`.`stud_fname`,' ',`s`.`stud_mname`)) AS `stud_name`,`sg`.`prelim_grade` AS `pr_g`,`sg`.`midterm_grade` AS `md_g`,`sg`.`pre_finals_grade` AS `pf_g`,`sg`.`finals_grade` AS `f_g`,`sg`.`subject_grade` AS `sub_g`,`sg`.`equivalent` AS `eq`,`sg`.`remarks` AS `remarks`,`g`.`phone_number` AS `guardian_num` from (((`student_grade_tbl` `sg` join `student_tbl` `s` on((`sg`.`student_id` = `s`.`student_id`))) join `guardian_student_tbl` on((`sg`.`student_id` = `guardian_student_tbl`.`student_id`))) join `guardian_tbl` `g` on((`guardian_student_tbl`.`guardian_id` = `g`.`guardian_id`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `stud_page_grades_summary`
--

/*!50001 DROP VIEW IF EXISTS `stud_page_grades_summary`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `stud_page_grades_summary` AS (select `g`.`student_grade_id` AS `grade_id`,lcase(concat(`s`.`stud_lname`,' ',`s`.`stud_fname`,' ',`s`.`stud_mname`)) AS `stud_name`,`s`.`stud_access_grade_code` AS `grade_code`,`s`.`stud_status` AS `stud_status`,`s`.`program` AS `program`,`sec`.`section_name` AS `sec`,`sub`.`subject_code` AS `subject_name`,`sub`.`subject_description` AS `description`,`sub`.`subject_units` AS `sub_units`,`g`.`prelim_grade` AS `pr_grade`,`g`.`midterm_grade` AS `md_grade`,`g`.`pre_finals_grade` AS `pf_grade`,`g`.`finals_grade` AS `finals`,`g`.`subject_grade` AS `sub_grade`,`g`.`equivalent` AS `gen_ave`,`g`.`remarks` AS `remarks`,`g`.`sem` AS `sem`,`g`.`school_year` AS `school_year`,`sub_sched`.`room` AS `room`,`sub_sched`.`date_time` AS `date_sched`,lcase(concat(`teach`.`teacher_lname`,', ',`teach`.`teacher_fname`,' ',`teach`.`teacher_mname`)) AS `teach_name`,lcase(concat(`guar`.`guardian_lname`,', ',`guar`.`guardian_fname`,' ',`guar`.`guardian_mname`)) AS `guard_name`,`guar`.`guardian_address` AS `guard_address`,`guar`.`phone_number` AS `guardian_num` from ((((((((`student_grade_tbl` `g` left join `student_tbl` `s` on((`g`.`student_id` = `s`.`student_id`))) left join `subject_schedule_tbl` `sub_sched` on((`g`.`subject_schedule_id` = `sub_sched`.`subject_schedule_id`))) left join `guardian_student_tbl` on((`g`.`student_id` = `guardian_student_tbl`.`student_id`))) left join `guardian_tbl` `guar` on((`guardian_student_tbl`.`guardian_id` = `guar`.`guardian_id`))) left join `section_tbl` `sec` on((`sub_sched`.`section_id` = `sec`.`section_id`))) left join `teacher_subject_tbl` on((`sub_sched`.`teacher_subject_id` = `teacher_subject_tbl`.`teacher_subject_id`))) left join `teacher_tbl` `teach` on((`teacher_subject_tbl`.`teacher_id` = `teach`.`teacher_id`))) left join `subject_tbl` `sub` on((`teacher_subject_tbl`.`subject_id` = `sub`.`subject_id`))) order by lcase(concat(`s`.`stud_lname`,' ',`s`.`stud_fname`,' ',`s`.`stud_mname`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `stud_page_stud_grades`
--

/*!50001 DROP VIEW IF EXISTS `stud_page_stud_grades`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `stud_page_stud_grades` AS (select `g`.`student_grade_id` AS `grade_id`,lcase(concat(`s`.`stud_lname`,' ',`s`.`stud_fname`,' ',`s`.`stud_mname`)) AS `stud_name`,`s`.`stud_access_grade_code` AS `grade_code`,`s`.`stud_status` AS `stud_status`,`s`.`program` AS `program`,`sec`.`section_name` AS `sec`,`sub`.`subject_code` AS `subject`,`sub`.`subject_description` AS `description`,`g`.`equivalent` AS `gen_ave`,`g`.`remarks` AS `remarks` from ((((((`student_grade_tbl` `g` left join `student_tbl` `s` on((`g`.`student_id` = `s`.`student_id`))) left join `subject_schedule_tbl` on((`g`.`subject_schedule_id` = `subject_schedule_tbl`.`subject_schedule_id`))) left join `section_tbl` `sec` on((`subject_schedule_tbl`.`section_id` = `sec`.`section_id`))) left join `teacher_subject_tbl` on((`subject_schedule_tbl`.`teacher_subject_id` = `teacher_subject_tbl`.`teacher_subject_id`))) left join `teacher_tbl` `teach` on((`teacher_subject_tbl`.`teacher_id` = `teach`.`teacher_id`))) left join `subject_tbl` `sub` on((`teacher_subject_tbl`.`subject_id` = `sub`.`subject_id`))) order by lcase(concat(`s`.`stud_lname`,' ',`s`.`stud_fname`,' ',`s`.`stud_mname`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `stud_sub_sched_view`
--

/*!50001 DROP VIEW IF EXISTS `stud_sub_sched_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `stud_sub_sched_view` AS (select `student_grade_tbl`.`student_grade_id` AS `stud_grade_id`,`st`.`stud_access_grade_code` AS `stud_access_code`,ucase(concat(`st`.`stud_lname`,', ',`st`.`stud_fname`,' ',`st`.`stud_mname`)) AS `stud_name`,`sub`.`subject_code` AS `sub_code`,`sub`.`subject_description` AS `sub_desc`,ucase(concat(`teach`.`teacher_lname`,', ',`teach`.`teacher_fname`,' ',`teach`.`teacher_mname`)) AS `teach_name`,`sec`.`section_name` AS `sec_name`,`sched`.`room` AS `room_no`,`sched`.`date_time` AS `sched` from ((((((`student_grade_tbl` join `student_tbl` `st` on((`student_grade_tbl`.`student_id` = `st`.`student_id`))) join `subject_schedule_tbl` `sched` on((`student_grade_tbl`.`subject_schedule_id` = `sched`.`subject_schedule_id`))) join `teacher_subject_tbl` on((`sched`.`teacher_subject_id` = `teacher_subject_tbl`.`teacher_subject_id`))) join `section_tbl` `sec` on((`sched`.`section_id` = `sec`.`section_id`))) join `teacher_tbl` `teach` on((`teacher_subject_tbl`.`teacher_id` = `teach`.`teacher_id`))) join `subject_tbl` `sub` on((`teacher_subject_tbl`.`subject_id` = `sub`.`subject_id`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `student_subject_sched_list`
--

/*!50001 DROP VIEW IF EXISTS `student_subject_sched_list`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `student_subject_sched_list` AS (select `ss`.`subject_schedule_id` AS `sub_sched_id`,`st`.`subject_code` AS `sub_code`,`st`.`subject_description` AS `sub_desc`,lcase(concat(`tt`.`teacher_lname`,', ',`tt`.`teacher_fname`,' ',`tt`.`teacher_mname`)) AS `teacher_name`,`sec`.`section_name` AS `section`,`ss`.`room` AS `room`,`ss`.`date_time` AS `schedule` from ((((`subject_schedule_tbl` `ss` join `teacher_subject_tbl` on((`ss`.`teacher_subject_id` = `teacher_subject_tbl`.`teacher_subject_id`))) join `subject_tbl` `st` on((`teacher_subject_tbl`.`subject_id` = `st`.`subject_id`))) join `teacher_tbl` `tt` on((`teacher_subject_tbl`.`teacher_id` = `tt`.`teacher_id`))) join `section_tbl` `sec` on((`ss`.`section_id` = `sec`.`section_id`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `subject_schedule_view`
--

/*!50001 DROP VIEW IF EXISTS `subject_schedule_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `subject_schedule_view` AS (select `sst`.`subject_schedule_id` AS `subject_schedule_id`,`st`.`subject_code` AS `subject_code`,concat(`tt`.`teacher_lname`,' ',`tt`.`teacher_fname`) AS `TeacherName`,`sec`.`section_name` AS `section_name`,`sst`.`room` AS `room`,`sst`.`date_time` AS `date_time` from ((((`subject_schedule_tbl` `sst` join `teacher_subject_tbl` `ts` on((`sst`.`teacher_subject_id` = `ts`.`teacher_subject_id`))) join `section_tbl` `sec` on((`sst`.`section_id` = `sec`.`section_id`))) join `teacher_tbl` `tt` on((`ts`.`teacher_id` = `tt`.`teacher_id`))) join `subject_tbl` `st` on((`ts`.`subject_id` = `st`.`subject_id`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `teach_sched_view`
--

/*!50001 DROP VIEW IF EXISTS `teach_sched_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `teach_sched_view` AS (select `a`.`teacher_id` AS `teach_id`,`b`.`subject_schedule_id` AS `sched_id`,`e`.`section_name` AS `sec_name`,`c`.`subject_code` AS `sub_code`,`b`.`room` AS `room`,`b`.`date_time` AS `date_time` from ((((`teacher_tbl` `a` join `teacher_subject_tbl` `d` on((`d`.`teacher_id` = `a`.`teacher_id`))) join `subject_schedule_tbl` `b` on((`b`.`teacher_subject_id` = `d`.`teacher_subject_id`))) join `section_tbl` `e` on((`e`.`section_id` = `b`.`section_id`))) join `subject_tbl` `c` on((`c`.`subject_id` = `d`.`subject_id`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `teach_sub_get_id`
--

/*!50001 DROP VIEW IF EXISTS `teach_sub_get_id`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `teach_sub_get_id` AS (select `tc`.`teacher_id` AS `teach_id`,`tt`.`teacher_subject_id` AS `teach_sub_id`,`sub`.`subject_code` AS `sub_code`,`sub`.`subject_description` AS `sub_decs` from (`teacher_tbl` `tc` join (`teacher_subject_tbl` `tt` join `subject_tbl` `sub` on((`tt`.`subject_id` = `sub`.`subject_id`))) on((`tt`.`teacher_id` = `tc`.`teacher_id`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `teacher_subject_view`
--

/*!50001 DROP VIEW IF EXISTS `teacher_subject_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `teacher_subject_view` AS (select `ts`.`teacher_subject_id` AS `teacher_subject_id`,`t`.`teacher_lname` AS `teacher_lname`,`t`.`teacher_fname` AS `teacher_fname`,`s`.`subject_code` AS `subject_code`,`s`.`subject_description` AS `subject_description` from ((`teacher_subject_tbl` `ts` join `teacher_tbl` `t` on((`ts`.`teacher_id` = `t`.`teacher_id`))) join `subject_tbl` `s` on((`ts`.`subject_id` = `s`.`subject_id`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-25  2:28:22
