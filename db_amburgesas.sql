DROP TABLE IF EXISTS `notificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `asunto` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `fecha_alta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `perfil` int DEFAULT NULL,
  `fecha_creado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `telefono` varchar(10) DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notificacion_usuario`
--

DROP TABLE IF EXISTS `notificacion_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificacion_usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha_visto` date DEFAULT NULL,
  `id_notificacion` int NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_notificacion` (`id_notificacion`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `notificacion_usuario_ibfk_1` FOREIGN KEY (`id_notificacion`) REFERENCES `notificacion` (`id`),
  CONSTRAINT `notificacion_usuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `cantidad` varchar(50) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `fecha_alta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `precio` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ingrediente`
--

DROP TABLE IF EXISTS `ingrediente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingrediente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `fecha_creado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_producto` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `ingrediente_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notificacion`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `visto` tinyint(1) DEFAULT NULL,
  `atendido` tinyint(1) DEFAULT NULL,
  `fecha_creado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_eliminado` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `producto_pedido`
--

DROP TABLE IF EXISTS `producto_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto_pedido` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pedido` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad` int DEFAULT '0',
  `ingredientes` text,
  PRIMARY KEY (`id`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `producto_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`),
  CONSTRAINT `producto_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


INSERT INTO usuario
(id, usuario, password, nombre, apellidos, perfil, fecha_creado, telefono, fecha_baja)
VALUES(1, 'israel3', 'aXNyYWVsMw==', 'Israel', 'Navarro', 1, '2023-09-13 16:38:55', '7361040461', NULL);

INSERT INTO producto
(id, nombre, descripcion, cantidad, imagen, fecha_baja, fecha_alta, precio)
VALUES(1, 'Hamburgueza', 'De buena calidad', '10', '90a7e414-dd8f-413c-bf73-0defca0bd71f.webp', NULL, NULL, 22.00);
INSERT INTO producto
(id, nombre, descripcion, cantidad, imagen, fecha_baja, fecha_alta, precio)
VALUES(2, 'Amburguesa 2', 'Rico en sabores', '75', '973c7316-a324-457e-896b-f6169bcfeb78.webp', NULL, '2023-08-09 18:17:17', 34.00);

INSERT INTO ingrediente
(id, nombre, fecha_baja, fecha_creado, id_producto)
VALUES(1, 'Jamones', NULL, '2023-09-05 17:06:34', 2);
INSERT INTO db_amburgesas.ingrediente
(id, nombre, fecha_baja, fecha_creado, id_producto)
VALUES(2, 'Jamon', NULL, '2023-09-12 14:40:59', 1);
INSERT INTO ingrediente
(id, nombre, fecha_baja, fecha_creado, id_producto)
VALUES(3, 'Queso', NULL, '2023-09-12 14:41:13', 1);

INSERT INTO pedido
(id, nombre_completo, direccion, telefono, visto, atendido, fecha_creado, fecha_eliminado)
VALUES(1, 'Israel Navarrp', '16 de Septiembre', '76361040461', 1, 0, '2023-09-12 18:08:10', NULL);
INSERT INTO pedido
(id, nombre_completo, direccion, telefono, visto, atendido, fecha_creado, fecha_eliminado)
VALUES(2, 'Israel Navarrp', '16 de Septiembre', '76361040461', 1, 0, '2023-09-12 18:08:52', NULL);

INSERT INTO producto_pedido
(id, id_pedido, id_producto, cantidad, ingredientes)
VALUES(1, 1, 1, 1, 'jamon, queso');
INSERT INTO producto_pedido
(id, id_pedido, id_producto, cantidad, ingredientes)
VALUES(2, 1, 2, 11, 'jamon, queso');
INSERT INTO producto_pedido
(id, id_pedido, id_producto, cantidad, ingredientes)
VALUES(3, 2, 2, 1, 'jamon, queso');
INSERT INTO producto_pedido
(id, id_pedido, id_producto, cantidad, ingredientes)
VALUES(4, 2, 1, 1, 'Jamon, carne');






