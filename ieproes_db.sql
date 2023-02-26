-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ieproes_db
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `ieproes_db`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ieproes_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `ieproes_db`;

--
-- Table structure for table `alumnos_asignatura_tbl`
--

DROP TABLE IF EXISTS `alumnos_asignatura_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumnos_asignatura_tbl` (
  `id_alumnosasignatura` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_id_alumno` int(11) NOT NULL,
  `fk_id_asignatura` int(11) NOT NULL,
  PRIMARY KEY (`id_alumnosasignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos_asignatura_tbl`
--

LOCK TABLES `alumnos_asignatura_tbl` WRITE;
/*!40000 ALTER TABLE `alumnos_asignatura_tbl` DISABLE KEYS */;
INSERT INTO `alumnos_asignatura_tbl` VALUES (1,1,2),(2,2,2),(3,3,6),(4,4,6),(10,5,2),(13,5,3),(14,5,4),(15,1,4),(16,4,4),(17,4,1),(18,1,1),(19,3,1),(20,6,1),(21,6,5),(22,7,2),(23,7,6);
/*!40000 ALTER TABLE `alumnos_asignatura_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `alumnosporasigntura_vw`
--

DROP TABLE IF EXISTS `alumnosporasigntura_vw`;
/*!50001 DROP VIEW IF EXISTS `alumnosporasigntura_vw`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `alumnosporasigntura_vw` AS SELECT
 1 AS `id_alumno`,
  1 AS `nombre_alumno`,
  1 AS `apellidos_alumno`,
  1 AS `numcarnet_alumno`,
  1 AS `fk_id_asignatura` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `alumnotbl`
--

DROP TABLE IF EXISTS `alumnotbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumnotbl` (
  `id_alumno` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_alumno` varchar(60) NOT NULL,
  `apellidos_alumno` varchar(60) NOT NULL,
  `genero_alumno` tinyint(1) DEFAULT NULL,
  `fechanac_alumno` date DEFAULT NULL,
  `direccion_alumno` varchar(100) DEFAULT NULL,
  `telefono_alumno` varchar(15) DEFAULT NULL,
  `numcarnet_alumno` varchar(10) NOT NULL,
  PRIMARY KEY (`id_alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnotbl`
--

LOCK TABLES `alumnotbl` WRITE;
/*!40000 ALTER TABLE `alumnotbl` DISABLE KEYS */;
INSERT INTO `alumnotbl` VALUES (1,'Fernando Javier','De la O',1,'2012-02-01','Usulutan','2662-2222','FJ23001'),(2,'Fatima Michell','Manzano Rodezno',0,'2003-02-02','San Miguel','26611122','MR23002'),(3,'Keily Melissa','Rivas',0,'2008-03-05',NULL,NULL,'RM23003'),(4,'Nancy Lorena','De Rivas',0,'1980-02-21',NULL,NULL,'RM23004'),(5,'Diana Sofia','Campos',0,'2013-05-01',NULL,NULL,'CM23005'),(6,'Miguel Angel','Campos Herrera',1,'1989-08-21',NULL,NULL,'CH23006'),(7,'Alvaro Jose','Mendez Henriquez',1,'1984-08-01',NULL,NULL,'MH23007');
/*!40000 ALTER TABLE `alumnotbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asignatura_tbl`
--

DROP TABLE IF EXISTS `asignatura_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignatura_tbl` (
  `id_asignatura` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_asignatura` varchar(60) NOT NULL,
  `id_profesor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_asignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignatura_tbl`
--

LOCK TABLES `asignatura_tbl` WRITE;
/*!40000 ALTER TABLE `asignatura_tbl` DISABLE KEYS */;
INSERT INTO `asignatura_tbl` VALUES (1,'Ciencias Naturales',4),(2,'Ciencias Sociales',2),(3,'Informática',5),(4,'Matemáticas',3),(5,'Moral y Civica',4),(6,'Lenguaje y literatura',2);
/*!40000 ALTER TABLE `asignatura_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `asignaturas_vw`
--

DROP TABLE IF EXISTS `asignaturas_vw`;
/*!50001 DROP VIEW IF EXISTS `asignaturas_vw`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `asignaturas_vw` AS SELECT
 1 AS `id_asignatura`,
  1 AS `nombre_asignatura`,
  1 AS `id_profesor` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `calificacion_tbl`
--

DROP TABLE IF EXISTS `calificacion_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calificacion_tbl` (
  `id_calificacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nota_calificacion` varchar(3) NOT NULL,
  `observacion_calificacion` varchar(100) DEFAULT NULL,
  `fk_id_asignatura` int(11) NOT NULL,
  `fk_id_alumno` int(11) NOT NULL,
  `fk_id_evaluacion` int(11) NOT NULL,
  PRIMARY KEY (`id_calificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calificacion_tbl`
--

LOCK TABLES `calificacion_tbl` WRITE;
/*!40000 ALTER TABLE `calificacion_tbl` DISABLE KEYS */;
INSERT INTO `calificacion_tbl` VALUES (21,'10',NULL,6,3,3),(22,'8',NULL,2,2,1),(23,'8',NULL,6,3,2),(29,'8',NULL,4,5,2),(30,'7',NULL,4,1,2),(31,'8',NULL,4,5,1),(32,'10',NULL,1,4,2),(33,'8',NULL,1,1,2),(34,'7',NULL,1,4,1),(35,'10',NULL,1,6,2),(36,'9',NULL,1,6,1),(37,'10','Muy buena estudiante',3,5,2),(38,'7',NULL,4,4,2),(39,'10','Bien hecho',2,1,1),(40,'8',NULL,2,5,1),(41,'10',NULL,6,4,2),(42,'8',NULL,6,4,3),(43,'7',NULL,2,7,2),(44,'8',NULL,2,7,1),(45,'7.5',NULL,6,7,2),(46,'8',NULL,6,7,1);
/*!40000 ALTER TABLE `calificacion_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `calificacionesxalumno_vw`
--

DROP TABLE IF EXISTS `calificacionesxalumno_vw`;
/*!50001 DROP VIEW IF EXISTS `calificacionesxalumno_vw`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `calificacionesxalumno_vw` AS SELECT
 1 AS `CONCAT(alm.``nombre_alumno``,' ',alm.``apellidos_alumno``)`,
  1 AS `nombre_asignatura`,
  1 AS `nombre_evaluacion`,
  1 AS `nota_calificacion`,
  1 AS `id_profesor` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `evaluacion_tbl`
--

DROP TABLE IF EXISTS `evaluacion_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluacion_tbl` (
  `id_evaluacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_evaluacion` varchar(50) NOT NULL,
  `descripcion_evaluacion` text DEFAULT NULL,
  PRIMARY KEY (`id_evaluacion`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluacion_tbl`
--

LOCK TABLES `evaluacion_tbl` WRITE;
/*!40000 ALTER TABLE `evaluacion_tbl` DISABLE KEYS */;
INSERT INTO `evaluacion_tbl` VALUES (1,'1er examen mensual','1er examen anual'),(2,'1 laboratorio evaluado','En el trimestre'),(3,'1er parcial trimestral','cada trimestre'),(4,'Examen trimestral',NULL),(5,'Examen corto',NULL),(6,'Examen final',NULL),(7,'Tarea evaluada',NULL);
/*!40000 ALTER TABLE `evaluacion_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesor_tbl`
--

DROP TABLE IF EXISTS `profesor_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profesor_tbl` (
  `id_profesor` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_profesor` varchar(100) NOT NULL,
  `dui_profesor` varchar(10) NOT NULL,
  `direccion_profesor` varchar(100) DEFAULT NULL,
  `telefono_profesor` varchar(10) DEFAULT NULL,
  `email_profesor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_profesor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor_tbl`
--

LOCK TABLES `profesor_tbl` WRITE;
/*!40000 ALTER TABLE `profesor_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `profesor_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `promedioxasignatura_vw`
--

DROP TABLE IF EXISTS `promedioxasignatura_vw`;
/*!50001 DROP VIEW IF EXISTS `promedioxasignatura_vw`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `promedioxasignatura_vw` AS SELECT
 1 AS `CONCAT(alm.``nombre_alumno``,' ',alm.``apellidos_alumno``)`,
  1 AS `nombre_asignatura`,
  1 AS `AVG(cal.``nota_calificacion``)`,
  1 AS `id_profesor` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `userlevelpermissions`
--

DROP TABLE IF EXISTS `userlevelpermissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userlevelpermissions` (
  `UserLevelID` int(11) NOT NULL,
  `TableName` varchar(255) NOT NULL,
  `Permission` int(11) NOT NULL,
  PRIMARY KEY (`UserLevelID`,`TableName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userlevelpermissions`
--

LOCK TABLES `userlevelpermissions` WRITE;
/*!40000 ALTER TABLE `userlevelpermissions` DISABLE KEYS */;
INSERT INTO `userlevelpermissions` VALUES (-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}alumnosporasigntura_vw',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}alumnos_asignatura_tbl',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}alumnotbl',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}asignaturas_vw',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}asignatura_tbl',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}calificacionesxalumno_rpt',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}calificacionesxalumno_vw',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}calificacion_tbl',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}evaluacion_tbl',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}profesor_tbl',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}promedioxasignatura_rpt',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}promedioxasignatura_vw',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}userlevelpermissions',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}userlevels',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}usuarios_tbl',0),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}alumnosporasigntura_vw',488),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}alumnos_asignatura_tbl',1519),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}alumnotbl',1517),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}asignaturas_vw',1519),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}asignatura_tbl',1512),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}calificacionesxalumno_rpt',1128),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}calificacionesxalumno_vw',1096),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}calificacion_tbl',1519),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}evaluacion_tbl',1517),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}profesor_tbl',0),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}promedioxasignatura_rpt',1128),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}promedioxasignatura_vw',1128),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}userlevelpermissions',0),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}userlevels',0),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}usuarios_tbl',0);
/*!40000 ALTER TABLE `userlevelpermissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userlevels`
--

DROP TABLE IF EXISTS `userlevels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userlevels` (
  `UserLevelID` int(11) NOT NULL,
  `UserLevelName` varchar(255) NOT NULL,
  PRIMARY KEY (`UserLevelID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userlevels`
--

LOCK TABLES `userlevels` WRITE;
/*!40000 ALTER TABLE `userlevels` DISABLE KEYS */;
INSERT INTO `userlevels` VALUES (-2,'Anonymous'),(-1,'Administrator'),(1,'profesor');
/*!40000 ALTER TABLE `userlevels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_tbl`
--

DROP TABLE IF EXISTS `usuarios_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_tbl` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_usuario` varchar(25) NOT NULL,
  `password_usuario` varchar(30) NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `email_usuario` varchar(60) DEFAULT NULL,
  `parent_id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_tbl`
--

LOCK TABLES `usuarios_tbl` WRITE;
/*!40000 ALTER TABLE `usuarios_tbl` DISABLE KEYS */;
INSERT INTO `usuarios_tbl` VALUES (1,'admin','ieproespass',-1,'',NULL,0),(2,'juanprofesor','ieproespass',1,'Juan Garcia',NULL,0),(3,'carlosprofesor','ieproespass',1,'Carlos Lopez','carloslopez@ieproes.com.sv',0),(4,'margaritaprofe','ieproespass',1,'Margarita Campos','margaritaprofe@ieproes.com.sv',0),(5,'ivetterprofe','ieproespass',1,'Ivette Saturnino',NULL,0);
/*!40000 ALTER TABLE `usuarios_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `ieproes_db`
--

USE `ieproes_db`;

--
-- Final view structure for view `alumnosporasigntura_vw`
--

/*!50001 DROP VIEW IF EXISTS `alumnosporasigntura_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `alumnosporasigntura_vw` AS select `alm`.`id_alumno` AS `id_alumno`,`alm`.`nombre_alumno` AS `nombre_alumno`,`alm`.`apellidos_alumno` AS `apellidos_alumno`,`alm`.`numcarnet_alumno` AS `numcarnet_alumno`,`almsg`.`fk_id_asignatura` AS `fk_id_asignatura` from ((`alumnos_asignatura_tbl` `almsg` join `alumnotbl` `alm` on(`almsg`.`fk_id_alumno` = `alm`.`id_alumno`)) join `asignatura_tbl` `asg` on(`almsg`.`fk_id_asignatura` = `asg`.`id_asignatura`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `asignaturas_vw`
--

/*!50001 DROP VIEW IF EXISTS `asignaturas_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `asignaturas_vw` AS select `asignatura_tbl`.`id_asignatura` AS `id_asignatura`,`asignatura_tbl`.`nombre_asignatura` AS `nombre_asignatura`,`asignatura_tbl`.`id_profesor` AS `id_profesor` from `asignatura_tbl` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `calificacionesxalumno_vw`
--

/*!50001 DROP VIEW IF EXISTS `calificacionesxalumno_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `calificacionesxalumno_vw` AS select concat(`alm`.`nombre_alumno`,' ',`alm`.`apellidos_alumno`) AS `CONCAT(alm.``nombre_alumno``,' ',alm.``apellidos_alumno``)`,`asg`.`nombre_asignatura` AS `nombre_asignatura`,`eval`.`nombre_evaluacion` AS `nombre_evaluacion`,`cal`.`nota_calificacion` AS `nota_calificacion`,`asg`.`id_profesor` AS `id_profesor` from (((`alumnotbl` `alm` join `calificacion_tbl` `cal` on(`alm`.`id_alumno` = `cal`.`fk_id_alumno`)) join `asignatura_tbl` `asg` on(`cal`.`fk_id_asignatura` = `asg`.`id_asignatura`)) join `evaluacion_tbl` `eval` on(`cal`.`fk_id_evaluacion` = `eval`.`id_evaluacion`)) order by `alm`.`nombre_alumno`,`asg`.`nombre_asignatura` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `promedioxasignatura_vw`
--

/*!50001 DROP VIEW IF EXISTS `promedioxasignatura_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `promedioxasignatura_vw` AS select concat(`alm`.`nombre_alumno`,' ',`alm`.`apellidos_alumno`) AS `CONCAT(alm.``nombre_alumno``,' ',alm.``apellidos_alumno``)`,`asg`.`nombre_asignatura` AS `nombre_asignatura`,avg(`cal`.`nota_calificacion`) AS `AVG(cal.``nota_calificacion``)`,`asg`.`id_profesor` AS `id_profesor` from ((`alumnotbl` `alm` join `calificacion_tbl` `cal` on(`alm`.`id_alumno` = `cal`.`fk_id_alumno`)) join `asignatura_tbl` `asg` on(`cal`.`fk_id_asignatura` = `asg`.`id_asignatura`)) group by `asg`.`id_asignatura`,`alm`.`id_alumno` order by `alm`.`nombre_alumno`,`asg`.`nombre_asignatura` */;
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

-- Dump completed on 2023-02-26 17:26:03
