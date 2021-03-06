-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: p6_opina
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

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
-- Table structure for table `encuesta`
--

DROP TABLE IF EXISTS `encuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encuesta` (
  `ID_Encuesta` int(6) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) NOT NULL,
  `Creador` int(9) NOT NULL,
  `Categoría` int(2) NOT NULL,
  `Descripción` tinytext NOT NULL,
  `Imagen` blob DEFAULT NULL,
  `Estado` varchar(20) NOT NULL,
  `Fecha_de_inicio` int(10) NOT NULL,
  `Fecha_de_final` int(10) NOT NULL,
  PRIMARY KEY (`ID_Encuesta`),
  KEY `Creador` (`Creador`),
  KEY `Categoría` (`Categoría`),
  CONSTRAINT `encuesta_ibfk_1` FOREIGN KEY (`Creador`) REFERENCES `usuario` (`Número_de_cuenta_o_trabajador`),
  CONSTRAINT `encuesta_ibfk_2` FOREIGN KEY (`Categoría`) REFERENCES `tipo_encuesta` (`ID_Categoría`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`Estado` = 'Abierta' or `Estado` = 'Cerrada')
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encuesta`
--

LOCK TABLES `encuesta` WRITE;
/*!40000 ALTER TABLE `encuesta` DISABLE KEYS */;
/*!40000 ALTER TABLE `encuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opción`
--

DROP TABLE IF EXISTS `opción`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opción` (
  `ID_Opción` int(13) NOT NULL AUTO_INCREMENT,
  `Opción` tinytext NOT NULL,
  `Imagen` blob DEFAULT NULL,
  `Pregunta` int(12) NOT NULL,
  `Encuesta` int(6) NOT NULL,
  PRIMARY KEY (`ID_Opción`),
  KEY `Pregunta` (`Pregunta`),
  KEY `Encuesta` (`Encuesta`),
  CONSTRAINT `opción_ibfk_1` FOREIGN KEY (`Pregunta`) REFERENCES `pregunta` (`ID_pregunta`),
  CONSTRAINT `opción_ibfk_2` FOREIGN KEY (`Encuesta`) REFERENCES `encuesta` (`ID_Encuesta`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opción`
--

LOCK TABLES `opción` WRITE;
/*!40000 ALTER TABLE `opción` DISABLE KEYS */;
/*!40000 ALTER TABLE `opción` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pregunta` (
  `ID_pregunta` int(12) NOT NULL AUTO_INCREMENT,
  `Pregunta` varchar(30) NOT NULL,
  `Encuesta` int(6) NOT NULL,
  `Número_de_pregunta` int(1) NOT NULL,
  `Imagen` blob DEFAULT NULL,
  PRIMARY KEY (`ID_pregunta`),
  KEY `Encuesta` (`Encuesta`),
  CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`Encuesta`) REFERENCES `encuesta` (`ID_Encuesta`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`Número_de_pregunta` <= 5 and `Número_de_pregunta` >= 1)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pregunta`
--

LOCK TABLES `pregunta` WRITE;
/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuesta`
--

DROP TABLE IF EXISTS `respuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respuesta` (
  `ID_Respuesta` int(13) NOT NULL AUTO_INCREMENT,
  `Usuario` int(9) NOT NULL,
  `Respuesta` int(13) NOT NULL,
  PRIMARY KEY (`ID_Respuesta`),
  KEY `Usuario` (`Usuario`),
  KEY `Respuesta` (`Respuesta`),
  CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuario` (`Número_de_cuenta_o_trabajador`),
  CONSTRAINT `respuesta_ibfk_2` FOREIGN KEY (`Respuesta`) REFERENCES `opción` (`ID_Opción`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuesta`
--

LOCK TABLES `respuesta` WRITE;
/*!40000 ALTER TABLE `respuesta` DISABLE KEYS */;
/*!40000 ALTER TABLE `respuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_encuesta`
--

DROP TABLE IF EXISTS `tipo_encuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_encuesta` (
  `ID_Categoría` int(2) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_Categoría`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_encuesta`
--

LOCK TABLES `tipo_encuesta` WRITE;
/*!40000 ALTER TABLE `tipo_encuesta` DISABLE KEYS */;
INSERT INTO `tipo_encuesta` VALUES (1,'Académico'),(2,'Cultura'),(3,'Deportes'),(4,'Ciencias');
/*!40000 ALTER TABLE `tipo_encuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `Número_de_cuenta_o_trabajador` int(9) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Apellido_Pat` varchar(40) NOT NULL,
  `Apellido_Mat` varchar(40) NOT NULL,
  `Correo_electrónico` blob NOT NULL,
  `Sexo` char(1) NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `CURP_o_RFC` blob NOT NULL,
  `Fecha_de_nacimiento` date NOT NULL,
  `Contraseña` blob NOT NULL,
  `Imagen` blob NOT NULL,
  PRIMARY KEY (`Número_de_cuenta_o_trabajador`),
  UNIQUE KEY `CURP_o_RFC` (`CURP_o_RFC`) USING HASH,
  UNIQUE KEY `Correo_electrónico` (`Correo_electrónico`) USING HASH,
  CONSTRAINT `CONSTRAINT_1` CHECK (`Sexo` = 'M' or `Sexo` = 'H'),
  CONSTRAINT `CONSTRAINT_2` CHECK (`Estado` = 'Suspendida' or `Estado` = 'No_Suspendida')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-28  5:48:10
