-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: bienesraices_crud
-- ------------------------------------------------------
-- Server version	9.3.0

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
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propiedades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamientos` int DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedorId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Propiedades_vendedores_idx` (`vendedorId`),
  CONSTRAINT `fk_Propiedades_vendedores` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedades`
--

LOCK TABLES `propiedades` WRITE;
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` VALUES (23,'Hermosa Casa Familiar',230000.00,'0b6ce4792c316cd41050002bd77eee97.jpg','Esta hermosa casa familiar es espaciosa, luminosa y muy acogedora. Tiene un lindo jardín para disfrutar y crear recuerdos inolvidables.',3,2,1,'2025-11-17',2),(24,'Chalet Familiar',320000.00,'55fbfd4b8346f9df90965a4ba910facf.jpg','Este encantador chalet de montaña, con su distintiva arquitectura de madera y techos inclinados, ofrece un refugio perfecto lejos del ruido. Sus amplios ventanales enmarcan vistas espectaculares del paisaje, mientras que por dentro, el calor de la chimenea de piedra y los acabados rústicos crean una atmósfera increíblemente acogedora. Es el lugar ideal para desconectar, disfrutar de la naturaleza y relajarse con todas las comodidades modernas.',5,3,3,'2025-11-17',1),(25,'Casa frente al Lago',254000.00,'866954654f87de655a6e5fec4b66d742.jpg','Imagina despertar cada mañana con la calma absoluta, mirando cómo el sol se eleva sobre la superficie espejada del lago. Esta casa no es solo una estructura; es un balcón privado a la naturaleza.\r\n\r\nDesde su amplia terraza, el agua se extiende hasta donde alcanza la vista, invitándote a disfrutar de atardeceres serenos y el sonido relajante de las olas. Por dentro, cada habitación principal está diseñada para capturar la luz y maximizar esa vista panorámica. Es un refugio de paz, donde el límite entre el cómodo interior y el impresionante paisaje azul se desvanece por completo.',3,3,1,'2025-11-17',2),(26,'Casa con Pileta',400000.00,'b17a2c0810e82e84f17c3738b10cb135.jpg','Esta casa define el verano. Su espectacular pileta es el corazón del jardín, un oasis privado perfecto para refrescarse en días de calor, relajarse bajo el sol o disfrutar de reuniones al aire libre. Es el lugar ideal para crear momentos de diversión y desconexión sin salir de casa.',4,4,2,'2025-11-17',2);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` char(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,'correo@correo.com','$2y$10$ZWOyJJeWhwvCt9lmi.vTpOK84Qtq1eiCYgemVSsK4bt9z4HMLG3Xu'),(3,'corrro@correo.com','$2y$10$BLHkxf6FTibp/a/DjY/2UutFMcfVwP4CPG9GRduU.Nhmipky/G.VO'),(4,'corrro@correo.com','$2y$10$q9nM.Iz2YPYaGYg3izbvn.t/Kf7tCbjlz.3R.hYh803k60rG6wv26');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `id` int NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'Tomas','Miqueleiz','2915052600'),(2,'German','Miqueleiz','1289459872');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-18 10:18:55
