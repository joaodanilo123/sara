-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: sara
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.10.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ambiente`
--

DROP TABLE IF EXISTS `ambiente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ambiente` (
  `ambiente_id` char(13) NOT NULL,
  `ambiente_nome` varchar(50) NOT NULL,
  `ambiente_numero` varchar(4) NOT NULL,
  `ambiente_ativo` char(3) NOT NULL DEFAULT 'sim',
  `tipo_ambiente_id` char(13) NOT NULL,
  `predio_id` char(13) NOT NULL,
  PRIMARY KEY (`ambiente_id`),
  KEY `tipo_ambi_fk` (`tipo_ambiente_id`),
  KEY `predio_fk` (`predio_id`),
  CONSTRAINT `predio_fk` FOREIGN KEY (`predio_id`) REFERENCES `predio` (`predio_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ambiente`
--

LOCK TABLES `ambiente` WRITE;
/*!40000 ALTER TABLE `ambiente` DISABLE KEYS */;
INSERT INTO `ambiente` VALUES ('5ee11b4721c7c','Sala 201','201','não','123456789123','123456789123'),('5ee3bf799398b','Mini auditório','101','não','123456789124','123456789123'),('5ee3bf9c20e64','Salão social','000','sim','123456789124','45645645645'),('5ee3bfbab41a0','Lab 201','201','sim','123456789125','123456789123'),('5ee3bfcd1f61c','Sala 302','302','sim','123456789123','123456789123'),('5ee3bfdebfc8f','Lab 204','204','sim','123456789125','123456789123'),('5ee3bfef77898','Lab de Biologia','000','sim','123456789126','45645645645'),('5ee3c00b15815','Lab de hardware','202','sim','123456789125','123456789123'),('5ee3c0150a196','Lab de redes','301','sim','123456789125','123456789123'),('5f11d21b088a8','Sala 302','302','sim','123456789123','123456789123'),('5f11d2b708760','Sala 104','104','sim','123456789123','123456789123'),('5f18857c3a881','sala ssssss','1312','não','123456789124','5f53df0fc9a85'),('5f1e15ef87f65','Sala 104','104','sim','123456789123','5f1e15de3d844'),('5fa1da707c5c3','Lab 701','701','sim','123456789125','123456789123');
/*!40000 ALTER TABLE `ambiente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hierarquia`
--

DROP TABLE IF EXISTS `hierarquia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hierarquia` (
  `hierarquia_nome` varchar(20) NOT NULL,
  `hierarquia_descricao` tinytext NOT NULL,
  PRIMARY KEY (`hierarquia_nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hierarquia`
--

LOCK TABLES `hierarquia` WRITE;
/*!40000 ALTER TABLE `hierarquia` DISABLE KEYS */;
INSERT INTO `hierarquia` VALUES ('admin','administrador do sistema'),('agente','Agente de portaria'),('professor','Professor');
/*!40000 ALTER TABLE `hierarquia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `predio`
--

DROP TABLE IF EXISTS `predio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `predio` (
  `predio_id` char(13) NOT NULL,
  `predio_nome` varchar(50) NOT NULL,
  PRIMARY KEY (`predio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `predio`
--

LOCK TABLES `predio` WRITE;
/*!40000 ALTER TABLE `predio` DISABLE KEYS */;
INSERT INTO `predio` VALUES ('123456789123','Prédio da TI'),('45645645645','Prédio Central'),('5f1e15de3d844','Prédio da Veterinária'),('5f53df0fc9a85','Alojamentos'),('5f53df41e41ec','A'),('5fa1e05f2bfb6','Almoxarifado'),('5fa30bc32eef5','123');
/*!40000 ALTER TABLE `predio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reserva` (
  `reserva_id` char(13) NOT NULL,
  `ambiente_id` char(13) NOT NULL,
  `reservista_id` char(13) NOT NULL,
  `agente_id` char(13) DEFAULT NULL,
  `reserva_inicio` datetime NOT NULL,
  `reserva_fim` datetime NOT NULL,
  `reserva_cor` varchar(10) NOT NULL,
  `reserva_ativa` tinyint NOT NULL,
  `reserva_descricao` varchar(100) NOT NULL,
  `reserva_iniciada` datetime DEFAULT NULL,
  `reserva_finalizada` datetime DEFAULT NULL,
  PRIMARY KEY (`reserva_id`),
  KEY `ambiente_fk` (`ambiente_id`),
  KEY `reservista_fk` (`reservista_id`),
  KEY `agente_fk` (`agente_id`),
  CONSTRAINT `agente_fk` FOREIGN KEY (`agente_id`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `ambiente_fk` FOREIGN KEY (`ambiente_id`) REFERENCES `ambiente` (`ambiente_id`),
  CONSTRAINT `reservista_fk` FOREIGN KEY (`reservista_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva`
--

LOCK TABLES `reserva` WRITE;
/*!40000 ALTER TABLE `reserva` DISABLE KEYS */;
INSERT INTO `reserva` VALUES ('5fb6b5199c3ad','5ee3bfbab41a0','5ee378e59e95d','5ee37ae176a04','2020-11-19 08:45:00','2020-11-19 09:45:00','#40E0D0',1,'aulafsdfsdfs',NULL,NULL),('5fb6b52cc837b','5ee3bfbab41a0','5ee378e59e95d','5ee37ae176a04','2020-11-19 10:15:00','2020-11-19 11:45:00','#FF4500',1,'fdfdfdfsdfsdf',NULL,NULL),('5fb6b53f69cee','5ee3bfbab41a0','5ef161491fa97','5ee37ae176a04','2020-11-19 11:45:00','2020-11-19 13:15:00','#A020F0',1,'rrrrrrfffffsssss',NULL,NULL),('5fb6b54aafe18','5ee3bfbab41a0','5ef161491fa97','5ee37ae176a04','2020-11-19 13:15:00','2020-11-19 15:15:00','#436EEE',1,'dfdfsdf',NULL,NULL),('5fb6b558728e2','5ee3bfdebfc8f','5ef161491fa97','5ee37ae176a04','2020-11-19 08:45:00','2020-11-19 10:45:00','#A020F0',1,'44444444444',NULL,NULL),('5fb6b56462421','5ee3bfdebfc8f','5f10eb46813c8','5ee37ae176a04','2020-11-19 10:45:00','2020-11-19 12:15:00','#8B4513',1,'2342342342342342',NULL,NULL),('5fb6b5700bc38','5ee3bfdebfc8f','5f5667472ab35','5ee37ae176a04','2020-11-19 12:15:00','2020-11-19 14:15:00','#436EEE',1,'ffdfdfdf',NULL,NULL),('5fb6b57e973a7','5ee3bfdebfc8f','5ee378e59e95d','5ee37ae176a04','2020-11-19 14:15:00','2020-11-19 16:15:00','#228B22',1,'rrrrrrrrrrrrrrrrrrrr',NULL,NULL);
/*!40000 ALTER TABLE `reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_ambiente`
--

DROP TABLE IF EXISTS `tipo_ambiente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_ambiente` (
  `tipo` char(13) NOT NULL,
  `tipo_ambiente_nome` varchar(50) NOT NULL,
  `tipo_ambiente_descricao` tinytext NOT NULL,
  PRIMARY KEY (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_ambiente`
--

LOCK TABLES `tipo_ambiente` WRITE;
/*!40000 ALTER TABLE `tipo_ambiente` DISABLE KEYS */;
INSERT INTO `tipo_ambiente` VALUES ('123456789123','Sala de aula','sala de aula comum'),('123456789124','Auditório','auditórios para apresentações ou reuniões'),('123456789125','Laboratório de Informática','laboratório para uso de computadores'),('123456789126','Laboratório','Laboratórios de ciências em geral');
/*!40000 ALTER TABLE `tipo_ambiente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `usuario_id` char(13) NOT NULL,
  `usuario_nome` varchar(50) NOT NULL,
  `usuario_email` varchar(50) NOT NULL,
  `usuario_senha` char(32) NOT NULL,
  `hierarquia_nome` varchar(20) NOT NULL,
  `usuario_token` char(10) NOT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `hierarquia_fk` (`hierarquia_nome`),
  CONSTRAINT `hierarquia_fk` FOREIGN KEY (`hierarquia_nome`) REFERENCES `hierarquia` (`hierarquia_nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('5ee378e59e95d','Bruno Batista Boniati','bruno@gmail.com','e10adc3949ba59abbe56e057f20f883e','professor','0003260990'),('5ee3795321ace','Maria de Lourdes','maria@gmail.com','e10adc3949ba59abbe56e057f20f883e','agente','0000000000'),('5ee3798ed3251','Jonas Tadeu','jonas@gmail.com','e10adc3949ba59abbe56e057f20f883e','admin','0000000000'),('5ee37ae176a04','Ana Maria Braga','ana@globo.com','e10adc3949ba59abbe56e057f20f883e','agente','0000000000'),('5ef161491fa97','Mateus Henrique Dalforno','mateus.dalforno@iffarroupilha.edu.br','e10adc3949ba59abbe56e057f20f883e','professor','0003251430'),('5f10eb46813c8','Rodrigo Poglia','rodrigo@gmail.com','e10adc3949ba59abbe56e057f20f883e','professor','0003217003'),('5f5667472ab35','Kleiton Silva Prs','f123@gmail.com','e10adc3949ba59abbe56e057f20f883e','professor','0003275553'),('5fa1dfad10c8e','Gleison Da Silva Pires','g@gmail.com','202cb962ac59075b964b07152d234b70','agente','0000000000'),('gfed34567123','João Danilo Zucolotto','jddiedrich@gmail.com','202cb962ac59075b964b07152d234b70','admin','0000000000');
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

-- Dump completed on 2020-11-24 10:05:27
