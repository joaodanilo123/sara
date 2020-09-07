-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: sara
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

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
INSERT INTO `ambiente` VALUES ('5ee11b4721c7c','Sala 201','201','não','123456789123','123456789123'),('5ee3bf799398b','Mini auditório','101','não','123456789124','123456789123'),('5ee3bf9c20e64','Salão social','000','sim','123456789124','45645645645'),('5ee3bfbab41a0','Lab 201','201','sim','123456789125','123456789123'),('5ee3bfcd1f61c','Sala 302','302','sim','123456789123','123456789123'),('5ee3bfdebfc8f','Lab 204','204','sim','123456789125','123456789123'),('5ee3bfef77898','Lab de Biologia','000','sim','123456789126','45645645645'),('5ee3c00b15815','Lab de hardware','202','sim','123456789125','123456789123'),('5ee3c0150a196','Lab de redes','301','sim','123456789125','123456789123'),('5f11d21b088a8','Sala 302','302','sim','123456789123','123456789123'),('5f11d2b708760','Sala 104','104','sim','123456789123','123456789123'),('5f18857c3a881','sala teste mudnaça','1312','não','123456789124','45645645645'),('5f1e15ef87f65','Sala 104','104','sim','123456789123','5f1e15de3d844');
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
INSERT INTO `predio` VALUES ('123456789123','Prédio da TI'),('45645645645','Prédio Central'),('5f1e15de3d844','Prédio da Veterinária'),('5f53df0fc9a85','Alojamentos'),('5f53df41e41ec','A');
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
  `agente_id` char(13) NOT NULL,
  `reserva_inicio` datetime NOT NULL,
  `reserva_fim` datetime NOT NULL,
  `reserva_cor` varchar(10) NOT NULL,
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
INSERT INTO `reserva` VALUES ('1234567891234','5ee3bf9c20e64','5ee378e59e95d','gfed34567123','2020-06-24 15:51:51','2020-06-24 18:50:19','#0373fc'),('5efd0e98b4698','5ee11b4721c7c','5ee378e59e95d','5ee37ae176a04','2020-07-01 14:29:00','2020-07-01 16:29:00','#40E0D0'),('5efd0f31eaafd','5ee3bfdebfc8f','5ef161491fa97','5ee37ae176a04','2020-07-01 13:33:00','2020-07-01 13:33:00','#0071c5'),('5f2d4cd249c62','5ee3bfdebfc8f','5ef161491fa97','5ee37ae176a04','2020-08-07 09:42:00','2020-08-07 21:42:00','#436EEE'),('5f2d4eef83a12','5ee3bfdebfc8f','5ee378e59e95d','5ee37ae176a04','2020-08-07 09:53:00','2020-08-07 20:53:00','#0071c5'),('5f3ab2d4cb60b','5ee3bfbab41a0','5ef161491fa97','5ee37ae176a04','2020-08-21 13:39:00','2020-08-21 13:39:00','#436EEE'),('5f3dd82d23035','5ee3bfbab41a0','5ee378e59e95d','5ee37ae176a04','2020-08-19 08:15:00','2020-08-19 09:15:00','#FF4500'),('5f3dda14db11c','5ee3bfcd1f61c','5f10eb46813c8','5ee37ae176a04','2020-08-18 08:45:00','2020-08-18 11:45:00','#0071c5'),('5f3ddcfbc96ba','5ee3bfcd1f61c','5ef161491fa97','5ee37ae176a04','2020-08-19 10:45:00','2020-08-19 11:45:00','#8B4513'),('5f3ddd1274df8','5ee3bfcd1f61c','5ee378e59e95d','5ee37ae176a04','2020-08-19 13:15:00','2020-08-19 15:15:00','#40E0D0'),('5f3ddd2326ec5','5ee3bfcd1f61c','5ef161491fa97','5ee37ae176a04','2020-08-20 15:15:00','2020-08-20 16:45:00','#8B0000'),('5f3ddd5c1a981','5ee3bfcd1f61c','5ef161491fa97','5ee37ae176a04','2020-08-20 10:15:00','2020-08-20 11:45:00','#436EEE'),('5f3ec44078e11','5ee3bfbab41a0','5ee378e59e95d','5ee37ae176a04','2020-08-17 09:45:00','2020-08-17 10:45:00','#FF4500'),('5f3ec5704b969','5ee3bfbab41a0','5ef161491fa97','5ee37ae176a04','2020-08-19 10:45:00','2020-08-19 11:45:00','#0071c5'),('5f3ec67d761f6','5ee3bfbab41a0','5f10eb46813c8','5ee37ae176a04','2020-08-20 09:45:00','2020-08-20 11:15:00','#0071c5'),('5f3ec6a530ae7','5ee3bfbab41a0','5ef161491fa97','5ee37ae176a04','2020-08-20 11:15:00','2020-08-20 12:15:00','#0071c5'),('5f3ec6d80302a','5ee3bfcd1f61c','5ee378e59e95d','5ee37ae176a04','2020-08-21 11:15:00','2020-08-21 13:15:00','#FF4500'),('5f3ec70e99424','5ee3bfcd1f61c','5ee378e59e95d','5ee37ae176a04','2020-08-20 11:45:00','2020-08-20 12:45:00','#228B22'),('5f3ecc4d7d748','5ee3bfbab41a0','5ee378e59e95d','5ee37ae176a04','2020-08-20 13:45:00','2020-08-20 14:45:00','#0071c5'),('5f3ed1afdfdb0','5ee3bfbab41a0','5ef161491fa97','5ee37ae176a04','2020-08-18 14:15:00','2020-08-18 15:45:00','#FF4500'),('5f3ed1fc6f85c','5ee3bfcd1f61c','5ee378e59e95d','5ee37ae176a04','2020-08-18 12:45:00','2020-08-18 14:45:00','#1C1C1C'),('5f3f1869a88ed','5ee3bfbab41a0','5ef161491fa97','5ee37ae176a04','2020-08-20 15:15:00','2020-08-20 17:15:00','#228B22'),('5f3f187867081','5ee3bfbab41a0','5f10eb46813c8','5ee37ae176a04','2020-08-21 15:45:00','2020-08-21 19:45:00','#8B4513');
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
INSERT INTO `usuario` VALUES ('5ee378e59e95d','Bruno Batista Boniati','bruno@gmail.com','e10adc3949ba59abbe56e057f20f883e','professor','0003260990'),('5ee3795321ace','Maria de Lourdes','maria@gmail.com','e10adc3949ba59abbe56e057f20f883e','agente','0000000000'),('5ee3798ed3251','Jonas Tadeu','jonas@gmail.com','e10adc3949ba59abbe56e057f20f883e','admin','0000000000'),('5ee37ae176a04','Ana Maria Braga','ana@globo.com','e10adc3949ba59abbe56e057f20f883e','agente','0000000000'),('5ef161491fa97','Mateus Henrique Dalforno','mateus.dalforno@iffarroupilha.edu.br','e10adc3949ba59abbe56e057f20f883e','professor','0003251430'),('5f10eb46813c8','Rodrigo Poglia','rodrigo@gmail.com','e10adc3949ba59abbe56e057f20f883e','professor','0003217003'),('5f5667472ab35','Kleiton Silva Prado','ff@gmail.com','e10adc3949ba59abbe56e057f20f883e','professor','0003275553'),('gfed34567123','João Danilo Zucolotto','jddiedrich@gmail.com','202cb962ac59075b964b07152d234b70','admin','0000000000');
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

-- Dump completed on 2020-09-07 16:27:00
