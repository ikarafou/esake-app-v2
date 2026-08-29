-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mydb
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `championship_has_team`
--

DROP TABLE IF EXISTS `championship_has_team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `championship_has_team` (
  `Championship_id` int NOT NULL,
  `Team_id` int NOT NULL,
  PRIMARY KEY (`Championship_id`,`Team_id`),
  KEY `fk_Championship_has_Team_Team1_idx` (`Team_id`),
  KEY `fk_Championship_has_Team_Championship1_idx` (`Championship_id`),
  CONSTRAINT `fk_Championship_has_Team_Championship1` FOREIGN KEY (`Championship_id`) REFERENCES `championships` (`id`),
  CONSTRAINT `fk_Championship_has_Team_Team1` FOREIGN KEY (`Team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `championships`
--

DROP TABLE IF EXISTS `championships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `championships` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `TeamQuantity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gamecomentary`
--

DROP TABLE IF EXISTS `gamecomentary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gamecomentary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Games_id` int NOT NULL,
  `GameTime` varchar(10) DEFAULT NULL,
  `Comentary` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`,`Games_id`),
  KEY `fk_GameComentary_Games1` (`Games_id`),
  CONSTRAINT `fk_GameComentary_Games1` FOREIGN KEY (`Games_id`) REFERENCES `games` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gameplayerstatistics`
--

DROP TABLE IF EXISTS `gameplayerstatistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gameplayerstatistics` (
  `Games_id` int NOT NULL,
  `Players_id` int NOT NULL,
  `Point` int DEFAULT '0',
  `Rebounds` int DEFAULT '0',
  `Assists` int DEFAULT '0',
  `Steals` int DEFAULT '0',
  `Blocks` int DEFAULT '0',
  `Fouls` int DEFAULT '0',
  `Turnover` int DEFAULT '0',
  `FreethrowsAttempted` int DEFAULT '0',
  `FreethrowsMade` int DEFAULT '0',
  `ThreepointsAttempted` int DEFAULT '0',
  `ThreepointsMade` int DEFAULT '0',
  `ShootsAttempted` int DEFAULT '0',
  `ShootsMade` int DEFAULT '0',
  `FreethrowPerc` float DEFAULT '0',
  `ThreePointPerc` float DEFAULT '0',
  `ShootPerc` float DEFAULT '0',
  `Minutes` varchar(10) DEFAULT '0',
  PRIMARY KEY (`Games_id`,`Players_id`),
  KEY `fk_GamePlayerStatistics_Players1_idx` (`Players_id`),
  CONSTRAINT `fk_GamePlayerStatistics_Games1` FOREIGN KEY (`Games_id`) REFERENCES `games` (`id`),
  CONSTRAINT `fk_GamePlayerStatistics_Players1` FOREIGN KEY (`Players_id`) REFERENCES `players` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Championship_id` int NOT NULL,
  `Game_week` int NOT NULL,
  `Team1_id` int NOT NULL,
  `Team2_id` int NOT NULL,
  `GameFinished` tinyint DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_Games_Championships1_idx` (`Championship_id`),
  KEY `fk_Games_Teams1_idx` (`Team1_id`),
  KEY `fk_Games_Teams2_idx` (`Team2_id`),
  CONSTRAINT `fk_Games_Championships1` FOREIGN KEY (`Championship_id`) REFERENCES `championships` (`id`),
  CONSTRAINT `fk_Games_Teams1` FOREIGN KEY (`Team1_id`) REFERENCES `teams` (`id`),
  CONSTRAINT `fk_Games_Teams2` FOREIGN KEY (`Team2_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gameteamstatistics`
--

DROP TABLE IF EXISTS `gameteamstatistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gameteamstatistics` (
  `Teams_id` int NOT NULL,
  `Games_id` int NOT NULL,
  `Point` int DEFAULT '0',
  `Rebounds` int DEFAULT '0',
  `Assists` int DEFAULT '0',
  `Steals` int DEFAULT '0',
  `Blocks` int DEFAULT '0',
  `Fouls` int DEFAULT '0',
  `Turnover` int DEFAULT '0',
  `FreethrowsAttempted` int DEFAULT '0',
  `FreethrowsMade` int DEFAULT '0',
  `ThreepointsAttempted` int DEFAULT '0',
  `ThreepointsMade` int DEFAULT '0',
  `ShootsAttempted` int DEFAULT '0',
  `ShootsMade` int DEFAULT '0',
  `FreethrowPerc` float DEFAULT '0',
  `ThreePointPerc` float DEFAULT '0',
  `ShootPerc` float DEFAULT '0',
  PRIMARY KEY (`Teams_id`,`Games_id`),
  KEY `fk_GameTeamStatistics_Games1_idx` (`Games_id`),
  CONSTRAINT `fk_GameTeamStatistics_Games1` FOREIGN KEY (`Games_id`) REFERENCES `games` (`id`),
  CONSTRAINT `fk_GameTeamStatistics_Teams1` FOREIGN KEY (`Teams_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `players` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Position` varchar(45) DEFAULT NULL,
  `PhotoPath` varchar(200) NOT NULL,
  `Team_id` int NOT NULL,
  `Name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Player_Team_idx` (`Team_id`),
  CONSTRAINT `fk_Player_Team` FOREIGN KEY (`Team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `LogoPath` varchar(200) NOT NULL,
  `TeamWins` int DEFAULT '0',
  `TeamLoses` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(60) NOT NULL,
  `Type` char(5) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-05 17:55:15
