-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: mysql.labranet.jamk.fi    Database: L4062_3
-- ------------------------------------------------------
-- Server version	5.1.73

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
-- Table structure for table `ASIAKAS`
--

DROP TABLE IF EXISTS `ASIAKAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ASIAKAS` (
  `etunimi` varchar(30) NOT NULL,
  `sukunimi` varchar(45) NOT NULL,
  `osoite` varchar(45) NOT NULL,
  `puhelinnumero` int(11) DEFAULT NULL,
  `asiakasnumero` varchar(45) NOT NULL,
  PRIMARY KEY (`asiakasnumero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Kysytään asiakkaan tietoja tilausta varten';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ASIAKAS`
--

LOCK TABLES `ASIAKAS` WRITE;
/*!40000 ALTER TABLE `ASIAKAS` DISABLE KEYS */;
INSERT INTO `ASIAKAS` VALUES ('','','',0,'');
/*!40000 ALTER TABLE `ASIAKAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LAHETYS`
--

DROP TABLE IF EXISTS `LAHETYS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LAHETYS` (
  `ryhmaID` varchar(45) NOT NULL,
  `lahetys_tunnus` int(11) NOT NULL,
  `tilauksen_vastaanotto` varchar(45) DEFAULT NULL,
  `tilauksen_lahetys` varchar(45) DEFAULT NULL,
  `pvm` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `arvioitu_saapumisaika` date DEFAULT NULL,
  PRIMARY KEY (`ryhmaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Lähetyksestä kertovat tiedot tulevat tänne.\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LAHETYS`
--

LOCK TABLES `LAHETYS` WRITE;
/*!40000 ALTER TABLE `LAHETYS` DISABLE KEYS */;
/*!40000 ALTER TABLE `LAHETYS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TILAUS`
--

DROP TABLE IF EXISTS `TILAUS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TILAUS` (
  `tilauksenID` int(11) NOT NULL,
  `istuntoID` varchar(45) DEFAULT NULL,
  `TuoteID` varchar(11) NOT NULL,
  `asiakasnumero` varchar(45) NOT NULL,
  `kpl` int(11) NOT NULL,
  `ryhmaID` varchar(45) NOT NULL,
  PRIMARY KEY (`tilauksenID`),
  KEY `fk_asiakasnumero_idx` (`asiakasnumero`),
  KEY `fk_ryhmaID_idx` (`ryhmaID`),
  KEY `fk_tuoteID_idx` (`TuoteID`),
  CONSTRAINT `fk_tuoteID` FOREIGN KEY (`TuoteID`) REFERENCES `TUOTTEET` (`TuoteID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_asiakasnumero` FOREIGN KEY (`asiakasnumero`) REFERENCES `ASIAKAS` (`asiakasnumero`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_ryhmaID` FOREIGN KEY (`ryhmaID`) REFERENCES `LAHETYS` (`ryhmaID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tilaukseen tarvittava välitaulukko';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TILAUS`
--

LOCK TABLES `TILAUS` WRITE;
/*!40000 ALTER TABLE `TILAUS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TILAUS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TUOTERYHMA`
--

DROP TABLE IF EXISTS `TUOTERYHMA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TUOTERYHMA` (
  `TuoteRyhmaID` int(11) NOT NULL,
  `nimi` varchar(45) DEFAULT NULL,
  `kuvaus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`TuoteRyhmaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tuoteryhmät (koirat sekä hevoset)\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TUOTERYHMA`
--

LOCK TABLES `TUOTERYHMA` WRITE;
/*!40000 ALTER TABLE `TUOTERYHMA` DISABLE KEYS */;
INSERT INTO `TUOTERYHMA` VALUES (1,'Hevoset','Hevostarvikkeet'),(2,'Koirat','Koiratarvikkeet');
/*!40000 ALTER TABLE `TUOTERYHMA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TUOTTEET`
--

DROP TABLE IF EXISTS `TUOTTEET`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TUOTTEET` (
  `TuoteID` varchar(11) NOT NULL,
  `tuotteenNimi` varchar(45) NOT NULL,
  `hinta` decimal(6,2) NOT NULL,
  `TuoteRyhmaID` int(11) NOT NULL,
  `maara` int(11) NOT NULL,
  PRIMARY KEY (`TuoteID`),
  KEY `fk_TuoteRyhmaID_idx` (`TuoteRyhmaID`),
  CONSTRAINT `fk_TuoteRyhmaID` FOREIGN KEY (`TuoteRyhmaID`) REFERENCES `TUOTERYHMA` (`TuoteRyhmaID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tuote-listaus kaikille tuotteille\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TUOTTEET`
--

LOCK TABLES `TUOTTEET` WRITE;
/*!40000 ALTER TABLE `TUOTTEET` DISABLE KEYS */;
INSERT INTO `TUOTTEET` VALUES ('100','Punainen loimi',100.00,1,0),('200','Sininen takki',78.00,2,0),('300','Ratsastusloimi',200.00,1,0),('400','Koiran tossut',50.00,2,0);
/*!40000 ALTER TABLE `TUOTTEET` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-16 13:00:50