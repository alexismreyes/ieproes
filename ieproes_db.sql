/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.27-MariaDB : Database - ieproes_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ieproes_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `ieproes_db`;

/*Table structure for table `alumnos_asignatura_tbl` */

DROP TABLE IF EXISTS `alumnos_asignatura_tbl`;

CREATE TABLE `alumnos_asignatura_tbl` (
  `id_alumnosasignatura` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_id_alumno` int(11) NOT NULL,
  `fk_id_asignatura` int(11) NOT NULL,
  PRIMARY KEY (`id_alumnosasignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `alumnos_asignatura_tbl` */

insert  into `alumnos_asignatura_tbl`(`id_alumnosasignatura`,`fk_id_alumno`,`fk_id_asignatura`) values (1,1,2),(2,2,2),(3,3,6),(4,4,6),(10,5,2),(13,5,3),(14,5,4),(15,1,4),(16,4,4),(17,4,1),(18,1,1),(19,3,1),(20,6,1),(21,6,5);

/*Table structure for table `alumnotbl` */

DROP TABLE IF EXISTS `alumnotbl`;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `alumnotbl` */

insert  into `alumnotbl`(`id_alumno`,`nombre_alumno`,`apellidos_alumno`,`genero_alumno`,`fechanac_alumno`,`direccion_alumno`,`telefono_alumno`,`numcarnet_alumno`) values (1,'Fernando Javier','De la O',1,'2012-02-01','Usulutan','2662-2222','FJ23001'),(2,'Fatima Michell','Manzano Rodezno',0,'2003-02-02','San Miguel','26611122','MR23002'),(3,'Keily Melissa','Rivas',0,'2008-03-05',NULL,NULL,'RM23003'),(4,'Nancy Lorena','De Rivas',0,'1980-02-21',NULL,NULL,'RM23004'),(5,'Diana Sofia','Campos',0,'2013-05-01',NULL,NULL,'CM23005'),(6,'Miguel Angel','Campos Herrera',1,'1989-08-21',NULL,NULL,'CH23006');

/*Table structure for table `asignatura_tbl` */

DROP TABLE IF EXISTS `asignatura_tbl`;

CREATE TABLE `asignatura_tbl` (
  `id_asignatura` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_asignatura` varchar(60) NOT NULL,
  `id_profesor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_asignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `asignatura_tbl` */

insert  into `asignatura_tbl`(`id_asignatura`,`nombre_asignatura`,`id_profesor`) values (1,'Ciencias Naturales',4),(2,'Ciencias Sociales',2),(3,'Informática',5),(4,'Matemáticas',3),(5,'Moral y Civica',4),(6,'Lenguaje y literatura',2);

/*Table structure for table `calificacion_tbl` */

DROP TABLE IF EXISTS `calificacion_tbl`;

CREATE TABLE `calificacion_tbl` (
  `id_calificacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nota_calificacion` varchar(3) NOT NULL,
  `observacion_calificacion` varchar(100) DEFAULT NULL,
  `fk_id_asignatura` int(11) NOT NULL,
  `fk_id_alumno` int(11) NOT NULL,
  `fk_id_evaluacion` int(11) NOT NULL,
  PRIMARY KEY (`id_calificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `calificacion_tbl` */

insert  into `calificacion_tbl`(`id_calificacion`,`nota_calificacion`,`observacion_calificacion`,`fk_id_asignatura`,`fk_id_alumno`,`fk_id_evaluacion`) values (21,'10',NULL,6,3,3),(22,'8',NULL,2,2,1),(23,'8',NULL,6,3,2),(29,'8',NULL,4,5,2),(30,'7',NULL,4,1,2),(31,'8',NULL,4,5,1),(32,'10',NULL,1,4,2),(33,'8',NULL,1,1,2),(34,'7',NULL,1,4,1),(35,'10',NULL,1,6,2),(36,'9',NULL,1,6,1);

/*Table structure for table `evaluacion_tbl` */

DROP TABLE IF EXISTS `evaluacion_tbl`;

CREATE TABLE `evaluacion_tbl` (
  `id_evaluacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_evaluacion` varchar(50) NOT NULL,
  `descripcion_evaluacion` text DEFAULT NULL,
  PRIMARY KEY (`id_evaluacion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `evaluacion_tbl` */

insert  into `evaluacion_tbl`(`id_evaluacion`,`nombre_evaluacion`,`descripcion_evaluacion`) values (1,'1er examen mensual','1er examen anual'),(2,'1 laboratorio evaluado','En el trimestre'),(3,'1er parcial trimestral','cada trimestre');

/*Table structure for table `profesor_tbl` */

DROP TABLE IF EXISTS `profesor_tbl`;

CREATE TABLE `profesor_tbl` (
  `id_profesor` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_profesor` varchar(100) NOT NULL,
  `dui_profesor` varchar(10) NOT NULL,
  `direccion_profesor` varchar(100) DEFAULT NULL,
  `telefono_profesor` varchar(10) DEFAULT NULL,
  `email_profesor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_profesor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `profesor_tbl` */

/*Table structure for table `userlevelpermissions` */

DROP TABLE IF EXISTS `userlevelpermissions`;

CREATE TABLE `userlevelpermissions` (
  `UserLevelID` int(11) NOT NULL,
  `TableName` varchar(255) NOT NULL,
  `Permission` int(11) NOT NULL,
  PRIMARY KEY (`UserLevelID`,`TableName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `userlevelpermissions` */

insert  into `userlevelpermissions`(`UserLevelID`,`TableName`,`Permission`) values (-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}alumnotbl',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}asignatura_tbl',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}calificacion_tbl',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}profesor_tbl',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}userlevelpermissions',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}userlevels',0),(-2,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}usuarios_tbl',0),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}alumnosporasigntura_vw',488),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}alumnos_asignatura_tbl',1519),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}alumnotbl',1517),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}asignaturas_vw',1519),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}asignatura_tbl',1512),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}calificacion_tbl',1519),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}evaluacion_tbl',1517),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}profesor_tbl',0),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}userlevelpermissions',0),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}userlevels',0),(1,'{F73A7286-9F13-4725-9F3C-54E276C53E3B}usuarios_tbl',0);

/*Table structure for table `userlevels` */

DROP TABLE IF EXISTS `userlevels`;

CREATE TABLE `userlevels` (
  `UserLevelID` int(11) NOT NULL,
  `UserLevelName` varchar(255) NOT NULL,
  PRIMARY KEY (`UserLevelID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `userlevels` */

insert  into `userlevels`(`UserLevelID`,`UserLevelName`) values (-2,'Anonymous'),(-1,'Administrator'),(0,'Default'),(1,'profesor');

/*Table structure for table `usuarios_tbl` */

DROP TABLE IF EXISTS `usuarios_tbl`;

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

/*Data for the table `usuarios_tbl` */

insert  into `usuarios_tbl`(`id_usuario`,`login_usuario`,`password_usuario`,`tipo_usuario`,`nombre_usuario`,`email_usuario`,`parent_id_usuario`) values (1,'admin','ieproespass',-1,'',NULL,0),(2,'juanprofesor','ieproespass',1,'Juan Garcia',NULL,0),(3,'carlosprofesor','ieproespass',1,'Carlos Lopez','carloslopez@ieproes.com.sv',0),(4,'margaritaprofe','ieproespass',1,'Margarita Campos','margaritaprofe@ieproes.com.sv',0),(5,'ivetterprofe','ieproespass',1,'Ivette Saturnino',NULL,0);

/*Table structure for table `alumnosporasigntura_vw` */

DROP TABLE IF EXISTS `alumnosporasigntura_vw`;

/*!50001 DROP VIEW IF EXISTS `alumnosporasigntura_vw` */;
/*!50001 DROP TABLE IF EXISTS `alumnosporasigntura_vw` */;

/*!50001 CREATE TABLE  `alumnosporasigntura_vw`(
 `id_alumno` int(10) unsigned ,
 `nombre_alumno` varchar(60) ,
 `apellidos_alumno` varchar(60) ,
 `numcarnet_alumno` varchar(10) ,
 `fk_id_asignatura` int(11) 
)*/;

/*Table structure for table `asignaturas_vw` */

DROP TABLE IF EXISTS `asignaturas_vw`;

/*!50001 DROP VIEW IF EXISTS `asignaturas_vw` */;
/*!50001 DROP TABLE IF EXISTS `asignaturas_vw` */;

/*!50001 CREATE TABLE  `asignaturas_vw`(
 `id_asignatura` int(10) unsigned ,
 `nombre_asignatura` varchar(60) ,
 `id_profesor` int(11) 
)*/;

/*View structure for view alumnosporasigntura_vw */

/*!50001 DROP TABLE IF EXISTS `alumnosporasigntura_vw` */;
/*!50001 DROP VIEW IF EXISTS `alumnosporasigntura_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `alumnosporasigntura_vw` AS select `alm`.`id_alumno` AS `id_alumno`,`alm`.`nombre_alumno` AS `nombre_alumno`,`alm`.`apellidos_alumno` AS `apellidos_alumno`,`alm`.`numcarnet_alumno` AS `numcarnet_alumno`,`almsg`.`fk_id_asignatura` AS `fk_id_asignatura` from ((`alumnos_asignatura_tbl` `almsg` join `alumnotbl` `alm` on(`almsg`.`fk_id_alumno` = `alm`.`id_alumno`)) join `asignatura_tbl` `asg` on(`almsg`.`fk_id_asignatura` = `asg`.`id_asignatura`)) */;

/*View structure for view asignaturas_vw */

/*!50001 DROP TABLE IF EXISTS `asignaturas_vw` */;
/*!50001 DROP VIEW IF EXISTS `asignaturas_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `asignaturas_vw` AS select `asignatura_tbl`.`id_asignatura` AS `id_asignatura`,`asignatura_tbl`.`nombre_asignatura` AS `nombre_asignatura`,`asignatura_tbl`.`id_profesor` AS `id_profesor` from `asignatura_tbl` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
