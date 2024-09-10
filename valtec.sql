/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: valtecgda
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB-0ubuntu0.24.04.1

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
-- Table structure for table `banner__estilos`
--

DROP TABLE IF EXISTS `banner__estilos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner__estilos` (
  `banner__estilo_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`banner__estilo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner__estilos`
--

LOCK TABLES `banner__estilos` WRITE;
/*!40000 ALTER TABLE `banner__estilos` DISABLE KEYS */;
INSERT INTO `banner__estilos` VALUES
(1,'Banner Normal','0','46749322','2022-09-02 22:36:48',NULL,NULL,NULL,NULL),
(2,'Banner con Hover','0','46749322','2022-09-02 22:36:48',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `banner__estilos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `banner_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bloque_id` bigint(20) unsigned NOT NULL,
  `banner__estilo_id` bigint(20) unsigned NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `columnas` int(11) NOT NULL,
  `posicion` int(11) NOT NULL,
  `banner` text DEFAULT NULL,
  `nombre_banner` varchar(255) DEFAULT NULL,
  `size_banner` varchar(100) DEFAULT NULL,
  `banner_superpuesto` text DEFAULT NULL,
  `nombre_banner_superpuesto` varchar(255) DEFAULT NULL,
  `size_banner_superpuesto` varchar(100) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`banner_id`),
  KEY `banners_bloque_id_foreign` (`bloque_id`),
  KEY `banners_banner__estilo_id_foreign` (`banner__estilo_id`),
  CONSTRAINT `banners_banner__estilo_id_foreign` FOREIGN KEY (`banner__estilo_id`) REFERENCES `banner__estilos` (`banner__estilo_id`),
  CONSTRAINT `banners_bloque_id_foreign` FOREIGN KEY (`bloque_id`) REFERENCES `bloques` (`bloque_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES
(1,1,1,'CALL OF DUTY','https://valtecgda.com',1,1,'assets/images/banners/1721138225_1_BO6_LP-meta_image.jpg','1721138225_1_BO6_LP-meta_image.jpg','495863',NULL,NULL,NULL,'1','1','46749322','2024-07-16 08:57:37',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bloque_tipos`
--

DROP TABLE IF EXISTS `bloque_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bloque_tipos` (
  `bloque_tipo_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `parametros` text DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bloque_tipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bloque_tipos`
--

LOCK TABLES `bloque_tipos` WRITE;
/*!40000 ALTER TABLE `bloque_tipos` DISABLE KEYS */;
INSERT INTO `bloque_tipos` VALUES
(1,'PRODUCTS','Productos','[\'categoria\',\'items\',\'titulo\',\'icono\']','1','0','46749322','2022-08-27 03:48:49',NULL,NULL,NULL,NULL),
(2,'CARROUSEL','Carrousel','[\'categoria\',\'items\',\'titulo\',\'icono\']','1','0','46749322','2022-08-27 03:48:49',NULL,NULL,NULL,NULL),
(3,'OPINIONS','Opiniones','[\'icono\']','1','1','46749322','2022-08-27 03:48:49',NULL,NULL,NULL,NULL),
(4,'BANNERS','Banner','[\'titulo\']','1','0','46749322','2022-08-27 03:48:49',NULL,NULL,NULL,NULL),
(5,'NOTICIAS','Noticias','[\'icono\']','1','0','46749322','2022-08-27 03:48:49',NULL,NULL,NULL,NULL),
(6,'OFERTAS','Ofertas','[\'icono\']','1','0','46749322','2023-11-30 13:28:45',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `bloque_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bloques`
--

DROP TABLE IF EXISTS `bloques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bloques` (
  `bloque_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bloque_tipo_id` bigint(20) unsigned NOT NULL,
  `config` longtext NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `icono` text DEFAULT NULL,
  `nombre_icono` varchar(100) DEFAULT NULL,
  `size_icono` varchar(50) DEFAULT NULL,
  `posicion` int(11) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bloque_id`),
  KEY `bloques_bloque_tipo_id_foreign` (`bloque_tipo_id`),
  CONSTRAINT `bloques_bloque_tipo_id_foreign` FOREIGN KEY (`bloque_tipo_id`) REFERENCES `bloque_tipos` (`bloque_tipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bloques`
--

LOCK TABLES `bloques` WRITE;
/*!40000 ALTER TABLE `bloques` DISABLE KEYS */;
INSERT INTO `bloques` VALUES
(1,4,'','Banner Superior',NULL,'','',1,'1','0','','2022-09-01 01:22:29',NULL,NULL,NULL,NULL),
(2,4,'','Banner Inferior','','','',0,'0','1','','2022-09-01 03:22:32','46749322','2022-09-02 00:59:24',NULL,NULL),
(6,3,'',NULL,'assets/images/iconos/1662003054_1_1649871887-906338.jpg','1662003054_1_1649871887-906338.jpg','31026',18,'0','0','','2022-09-01 03:30:57',NULL,NULL,NULL,NULL),
(7,2,'{\"categoria\":\"3\",\"nro_items\":\"12\"}','PS5','assets/images/iconos/1662144001_1_1645488576-1645280432-1642700816-mando_dualsense_ps5.jpg','1662144001_1_1645488576-1645280432-1642700816-mando_dualsense_ps5.jpg','37538',3,'1','1','','2022-09-01 03:32:50','46749322','2022-09-02 18:40:03',NULL,NULL),
(9,1,'{\"categoria\":\"5\",\"nro_items\":\"12\"}','XBOX ONE','assets/images/iconos/1664948692_1_1645280459-1642701026-xbox_one_logo.jpg','1664948692_1_1645280459-1642701026-xbox_one_logo.jpg','61823',7,'1','1','','2022-09-02 08:17:42','46749322','2022-10-08 14:44:03',NULL,NULL),
(10,1,'{\"categoria\":\"6\",\"nro_items\":\"12\"}','NINTENDO SWITCH','assets/images/iconos/1664948895_1_1645281480-1642701256-nintendo-switch-emblema.jpg','1664948895_1_1645281480-1642701256-nintendo-switch-emblema.jpg','70344',8,'1','1','','2022-09-15 15:47:05','46749322','2023-04-13 20:57:19',NULL,NULL),
(13,1,'{\"categoria\":\"2\",\"nro_items\":\"1\"}','Ofertas','assets/images/iconos/1663264070_1_305014086_3240413929610018_1112104786140118137_n.jpg','1663264070_1_305014086_3240413929610018_1112104786140118137_n.jpg','27776',0,'1','1','','2022-09-15 16:29:14','46749322','2022-09-15 17:48:02',NULL,NULL),
(14,2,'{\"categoria\":\"4\",\"nro_items\":\"12\"}','JUEGOS PC','assets/images/iconos/1663272381_1_305397200_1517046305424636_658089405863119844_n.png','1663272381_1_305397200_1517046305424636_658089405863119844_n.png','705109',0,'1','1','','2022-09-15 20:02:29','46749322','2022-09-15 20:06:23',NULL,NULL),
(15,2,'{\"categoria\":\"1\",\"nro_items\":\"10\"}','PS3 Plus','assets/images/iconos/1663719050_1_1645488503-1645280422-1642700733-image-813956a9160f42d189e0230c9104b8c8.jpg','1663719050_1_1645488503-1645280422-1642700733-image-813956a9160f42d189e0230c9104b8c8.jpg','112454',6,'1','1','','2022-09-21 00:10:51','46749322','2022-10-04 16:37:38',NULL,NULL),
(16,1,'{\"categoria\":\"19\",\"nro_items\":\"6\"}','AUDIFONOS Y PARLANTES','assets/images/iconos/1666800240_1_1646763454-1643644130-0-02.jpg','1666800240_1_1646763454-1643644130-0-02.jpg','16972',10,'1','1','','2022-09-21 00:15:19','46749322','2022-10-26 16:04:09',NULL,NULL),
(17,5,'','','assets/images/iconos/1670485539_1_1649871887-906338.jpg','1670485539_1_1649871887-906338.jpg','31026',17,'1','0','','2022-09-21 00:19:57','46749322','2022-12-08 07:45:41',NULL,NULL),
(18,1,'{\"categoria\":\"18\",\"nro_items\":\"6\"}','Teclados','assets/images/iconos/1666797715_1_1653080754-teclados.jpg','1666797715_1_1653080754-teclados.jpg','56871',13,'1','1','','2022-10-11 00:38:18','46749322','2022-10-26 15:21:56',NULL,NULL),
(19,2,'{\"categoria\":\"6\",\"nro_items\":\"8\"}','Productos para Fracasados',NULL,NULL,NULL,0,'1','1','','2022-12-21 04:05:17',NULL,NULL,NULL,NULL),
(20,4,'','Banner_AssasinsODE','','','',5,'1','1','','2023-04-14 23:25:19','46749322','2023-04-14 23:25:50',NULL,NULL),
(21,4,'','Componentes_PC',NULL,NULL,NULL,9,'1','1','','2023-04-15 01:36:17',NULL,NULL,NULL,NULL),
(22,4,'','Mouse Gamer',NULL,NULL,NULL,12,'1','1','','2023-04-15 02:00:53',NULL,NULL,NULL,NULL),
(23,4,'','Banner Página Pago',NULL,NULL,NULL,15,'1','1','','2023-04-30 05:08:27',NULL,NULL,NULL,NULL),
(24,2,'{\"categoria\":\"21\",\"nro_items\":\"10\"}','Funkos','assets/images/iconos/1683053781_1_174230_reddit_icon.png','1683053781_1_174230_reddit_icon.png','5019',2,'1','1','','2023-05-02 18:54:33','46749322','2023-05-02 18:56:24',NULL,NULL),
(25,6,'{}','Ofertas',NULL,NULL,NULL,4,'1','0','46749322','2023-11-30 14:27:52',NULL,NULL,NULL,NULL),
(26,1,'{\"categoria\":\"57\",\"nro_items\":\"10\"}','CABLES Y CONECTORES',NULL,NULL,NULL,11,'1','0','','2024-07-18 10:33:19','46749322','2024-07-18 10:34:26',NULL,NULL),
(27,1,'{\"categoria\":\"56\",\"nro_items\":null}','ALMACENAMIENTO',NULL,NULL,NULL,14,'1','0','','2024-07-18 10:35:03','46749322','2024-07-18 10:35:34',NULL,NULL),
(28,1,'{\"categoria\":\"58\",\"nro_items\":null}','PERIFERICOS',NULL,NULL,NULL,15,'1','0','','2024-07-18 10:36:31',NULL,NULL,NULL,NULL),
(29,1,'{\"categoria\":\"60\",\"nro_items\":null}','CAMARAS Y SEGURIDAD',NULL,NULL,NULL,16,'1','0','','2024-07-18 10:37:20',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `bloques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `categoria_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(40) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `url` text NOT NULL,
  `nombre_img` varchar(200) NOT NULL,
  `size_img` varchar(50) NOT NULL,
  `img` text NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registra` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES
(55,'Juegos en Linea','Prueba',0,'juegos-en-linea','','','','1','1','admin','2024-07-16 08:55:53',NULL,NULL,NULL,NULL),
(56,'ALMACENAMIENTO',NULL,0,'almacenamiento','','','','1','0','admin','2024-07-16 09:19:19',NULL,NULL,NULL,NULL),
(57,'CABLES Y CONECTORES',NULL,0,'cables-y-conectores','','','','1','0','admin','2024-07-16 09:19:51',NULL,NULL,NULL,NULL),
(58,'PERIFERICOS',NULL,0,'perifericos','','','','1','0','admin','2024-07-16 09:20:17',NULL,NULL,NULL,NULL),
(59,'FUENTES DE ALIMENTACION',NULL,0,'fuentes-de-alimentacion','','','','1','0','admin','2024-07-16 09:20:38',NULL,NULL,NULL,NULL),
(60,'CAMARAS Y SEGURIDAD',NULL,0,'camaras-y-seguridad','','','','1','0','admin','2024-07-16 09:21:08',NULL,NULL,NULL,NULL),
(61,'REDES Y CONECTIVIDAD',NULL,0,'redes-y-conectividad','','','','1','0','admin','2024-07-16 09:21:29',NULL,NULL,NULL,NULL),
(62,'SONIDO',NULL,0,'sonido','','','','1','0','admin','2024-07-16 09:21:53',NULL,NULL,NULL,NULL),
(63,'ACCESORIOS',NULL,0,'accesorios','','','','1','0','admin','2024-07-16 09:22:18','46749322','2024-08-01 14:33:35',NULL,NULL);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuraciones`
--

DROP TABLE IF EXISTS `configuraciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuraciones` (
  `configuracion_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `variable` varchar(100) NOT NULL,
  `valor` mediumtext DEFAULT NULL,
  `system` int(11) NOT NULL DEFAULT 0,
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`configuracion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuraciones`
--

LOCK TABLES `configuraciones` WRITE;
/*!40000 ALTER TABLE `configuraciones` DISABLE KEYS */;
INSERT INTO `configuraciones` VALUES
(1,'Nombre de la web','website_title','valtec | Tienda',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(2,'Email de envio','email_from','no-reply@valtecgda.com',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(3,'Asunto de email','email_subject','valtec-shop_ecommerce -',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(4,'Email de notificaciones','email_to','no-reply@valtecgda.com',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(5,'Mantenimiento','maintenance','0',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(6,'URL Facebook para la web','url_facebook','https://www.facebook.com/Storegamesperucom-546115698917735/',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(7,'Youtube Usuario','youtube_user','channel/UCEV1IIYPQLIAF--IVMxoKVQ',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(8,'Horario Atención','horario_atencion','L - S de 10am a 8pm - Feriados Horario Normal - Los Pedidos del Domingo se envían el día Lunes.',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(9,'Whatsapp','whatsapp','+593999999999',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(10,'Email Soporte','email_support','soporte@valtecgda.com',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(11,'Google Analytics ID','google_analytics_id',NULL,0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(12,'Redirigir SSL','redirect_ssl','0',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(13,'URL Messenger','url_messenger','https://m.me/Storegamesperu.comps3ps4',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(14,'Email copia ventas','email_sales','hi@eduedu.dev',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(15,'Recaptcha Secret Key','go_secret_key','6LeQZQ0qAAAAADVmQ6CgR9adpAvjgRHvfvVelbfz',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(16,'Recaptcha Site Key','go_site_key','6LeQZQ0qAAAAAGofMbS-m-Na--FmeDFkblBBwhu9',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(17,'Chat Whatsapp','chat_whatsapp','1',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(18,'URL Instagram','url_instagram','https://www.instagram.com/storegamesperups3ps4/',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(19,'Mostrar títulos de productos','mostrar_titulo_producto','0',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(20,'Descripción de la tienda','descripcion_tienda','Somos una tienda virtual que brinda a sus clientes la mejor atención y servicios. Además tenemos promociones cada semana!',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(21,'URL Tiktok','url_tiktok','https://www.tiktok.com/@jhothsa',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(22,'URL Telegram','url_telegram','https://telegram.com',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(23,'Icono Home','icono_home','1',0,'admin','2022-10-13 22:41:35',NULL,NULL,NULL,NULL),
(24,'Mensaje Ok Carrito','mensaje_ok_carrito','Hemos recibido su pedido correctamente y se ha enviado el detalle de compra a su correo. Si usted pagó fuera del horario de atención, el pedido se atenderá durante la siguiente jornada laboral. Debido a la alta demanda por fiestas puede que algunos pedidos sufran algún retraso, no se preocupe, su compra está 100% asegurada y será enviada en orden de llegada.',0,'admin','2022-10-25 10:08:56',NULL,NULL,NULL,NULL),
(25,'Mensaje Fail Carrito','mensaje_fail_carrito','Ocurrió un error al momento de validar su pedido, si el problema persiste, contactar de inmediato para verificar el origen del problema',0,'admin','2022-10-25 10:11:30',NULL,NULL,NULL,NULL),
(26,'Mensaje Pending Carrito','mensaje_pending_carrito','Se está procesando tú pago, en unas horas cuando se valide tu pedido correctamente, nos pondremos en contacto por el Email de Mercado Pago.',0,'admin','2022-11-03 12:05:55',NULL,NULL,NULL,NULL),
(27,'Desarrollador','desarrollador','DESARROLLADO POR FREDDY',0,'admin','2023-12-21 12:53:21',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `configuraciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `descuentos`
--

DROP TABLE IF EXISTS `descuentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `descuentos` (
  `descuento_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cupon` varchar(50) NOT NULL,
  `porcentaje` double(8,2) NOT NULL,
  `usado` int(11) NOT NULL DEFAULT 0,
  `uso` int(11) NOT NULL DEFAULT 0,
  `nro_productos` int(11) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`descuento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descuentos`
--

LOCK TABLES `descuentos` WRITE;
/*!40000 ALTER TABLE `descuentos` DISABLE KEYS */;
INSERT INTO `descuentos` VALUES
(1,'SEP2024',50.00,0,1,1,'1','0','','2024-08-30 21:50:54','admin','2024-08-30 21:53:47',NULL,NULL);
/*!40000 ALTER TABLE `descuentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estilo_tipos`
--

DROP TABLE IF EXISTS `estilo_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estilo_tipos` (
  `estilo_tipo_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`estilo_tipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estilo_tipos`
--

LOCK TABLES `estilo_tipos` WRITE;
/*!40000 ALTER TABLE `estilo_tipos` DISABLE KEYS */;
INSERT INTO `estilo_tipos` VALUES
(1,'Color de texto','0','admin','2022-10-01 23:12:11',NULL,NULL,NULL,NULL),
(2,'Color de fondo','0','admin','2022-10-01 23:12:11',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `estilo_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estilos`
--

DROP TABLE IF EXISTS `estilos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estilos` (
  `estilo_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `estilo_tipo_id` bigint(20) unsigned NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `variable` varchar(100) DEFAULT NULL,
  `elemento` varchar(100) NOT NULL,
  `propiedad` varchar(100) NOT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `posicion` int(11) NOT NULL,
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`estilo_id`),
  KEY `estilos_estilo_tipo_id_foreign` (`estilo_tipo_id`),
  CONSTRAINT `estilos_estilo_tipo_id_foreign` FOREIGN KEY (`estilo_tipo_id`) REFERENCES `estilo_tipos` (`estilo_tipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estilos`
--

LOCK TABLES `estilos` WRITE;
/*!40000 ALTER TABLE `estilos` DISABLE KEYS */;
INSERT INTO `estilos` VALUES
(1,2,'Fondo','body_bg','.style_fondo_bg','background-color','#ffffff',1,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:08',NULL,NULL),
(2,2,'Fondo Header','bg','.style-header-bg','background-color','rgb(255, 255, 255)',2,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:08',NULL,NULL),
(3,1,'Color Icono Menú Móvil','','.mobile-menu-icon','color','#ffffff',3,'1','admin','2022-10-13 21:08:33','admin','2023-04-04 01:02:41',NULL,NULL),
(4,2,'Menu principal','','.style-nav','background-color','#000000',4,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:08',NULL,NULL),
(5,1,'textos de Menu principal (links)','','.as-menu-links-style','color','#080808',5,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(6,2,'Menu principal Desplegable','','.style-nav-dropdown','background-color','#141414',6,'1','admin','2022-10-13 21:08:33','admin','2023-04-04 20:01:25',NULL,NULL),
(7,1,'Menu principal Desplegable (links)','','.style-nav-dropdown','color','#ffffff',7,'1','admin','2022-10-13 21:08:33','admin','2023-04-04 20:01:26',NULL,NULL),
(8,2,'Menu principal Desplegable (hover)','','.style-nav-dropdown:hover','background-color','rgb(243, 103, 27)',8,'1','admin','2022-10-13 21:08:33','admin','2023-04-04 20:01:25',NULL,NULL),
(9,2,'Menu principal Desplegable Móvil','','.style-nav-mobile','background-color','#141414',9,'1','admin','2022-10-13 21:08:33','admin','2023-04-04 18:00:02',NULL,NULL),
(10,1,'Menu principal Desplegable Móvil (links)','','.style-nav-mobile .links-mobile','color','#fff',10,'1','admin','2022-10-13 21:08:33','admin','2023-04-04 18:00:02',NULL,NULL),
(11,1,'Ícono Buscar (Menú Principal)','','.btn-search-mobile i','color','#212529',11,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(12,1,'Ícono Carrito (Menú Principal)','','.btn-cart i','color','#ffffff',12,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(13,1,'Ícono Carrito (Contador)','','.btn-cart .counter','color','#ffffff',13,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(14,2,'Ícono Carrito Contador (fondo)','','.style-nav .carrito .counter','background-color','rgb(243, 103, 27)',14,'1','admin','2022-10-13 21:08:33','admin','2023-04-04 17:50:36',NULL,NULL),
(15,1,'Botón comprar (texto)','','.style-btn-comprar','color','#ffffff',15,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(16,2,'Botón comprar (fondo)','','.style-btn-comprar','background-color','#b13545',16,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:08',NULL,NULL),
(17,2,'Botón Ver Todo Front (fondo)','','.btn-ver-todo','background-color','#000000',17,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:08',NULL,NULL),
(18,1,'Botón Ver Todo Front (texto)','','.btn-ver-todo','color','#ffffff',18,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(19,2,'Flecha Carrousel Izquierda','','.owl-prev','background-color','rgb(63, 63, 189)',19,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:08',NULL,NULL),
(20,2,'Flecha Carrousel Izquierda (icono)','','.btn-carrousel-prev','color','rgb(255, 255, 255)',20,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:08',NULL,NULL),
(21,2,'Flecha Carrousel Derecha','','.owl-next','background-color','rgb(63, 63, 189)',21,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:08',NULL,NULL),
(22,2,'Flecha Carrousel Derecha (icono)','','.btn-carrousel-next','color','rgb(255, 255, 255)',22,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:08',NULL,NULL),
(23,2,'Footer','','.as-footer-style','background-color','rgb(0, 0, 0)',23,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:08',NULL,NULL),
(24,2,'Footer (Copyright)','','.as-copyright-style','background-color','rgb(0, 0, 0)',24,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:08',NULL,NULL),
(25,1,'Footer principal (texto)','','.style-footer','color','rgb(255, 255, 255)',25,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(26,1,'Footer secundario (texto)','','.style-footer-bottom','color','rgb(255, 255, 255)',26,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(27,1,'Menu Footer','','.style-menu-footer','color','rgb(226, 226, 236)',28,'1','admin','2022-10-13 21:08:33','admin','2023-04-05 01:04:56',NULL,NULL),
(28,2,'Efecto banner','','.banner-brand a','background-color','linear-gradient(45deg, rgb(196,255,0) , rgb(0,171,111) )',29,'1','admin','2022-10-13 21:08:33',NULL,NULL,NULL,NULL),
(29,2,'Menú categoría','','.style-category-nav','background-color','#000000',30,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(30,2,'Menú categoría (activa)','','.style-category-nav-active','background-color','rgb(63, 63, 189)',31,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(31,1,'Submenú categoría','','.level2style','color','#000000',32,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(32,1,'Menú categoría links','','.style-category-nav a','color','#ffffff',33,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(33,1,'Menú categoría links (activa)','','.style-category-nav-active a','color','#ffffff',34,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(34,1,'Submenú categoría (activa)','','.level2-active','color','rgb(63, 63, 189)',35,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(35,1,'Redes sociales (icono)','','.as-footer_social .btn-social','color','#b13545',36,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(36,2,'Redes sociales (fondo)','','.as-footer_social .btn-social','background','#fff',37,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(37,1,'Redes sociales (texto al pasar mouse)','','.as-footer_social .btn-social:hover','color','#ffffff',38,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(38,2,'Redes sociales (fondo al pasar mouse)','','.as-footer_social .btn-social:hover','background-color','rgb(1, 1, 86)',39,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(39,1,'Botón pagar carrito (texto)','','.btn-pay-style','color','rgb(255, 255, 255)',40,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(40,2,'Botón pagar carrito (fondo)','','.btn-pay-style','background-color','rgb(63, 63, 189)',41,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(41,1,'Botón seguir comprando (texto)','','.btn-shopping-style','color','rgb(255, 255, 255)',42,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(42,2,'Botón seguir comprando (fondo)','','.btn-shopping-style','background-color','rgb(43, 43, 43)',43,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(43,1,'Botón comprar (agotado)','','.style-btn-agotado','color','rgb(255, 255, 255)',44,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(44,2,'Botón comprar (agotado)','','.style-btn-agotado','background-color','#8B0000',45,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(45,1,'Botón Detalles (texto)','','.style-btn-detalles','color','rgb(0, 0, 0)',46,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(46,2,'Botón Detalles (fondo)','','.style-btn-detalles','background-color','#dfdede',47,'0','admin','2022-10-13 21:08:33','admin','2024-07-11 09:32:09',NULL,NULL),
(47,2,'Fondo Header Top','bg','.style-header-top-bg','background-color','rgb(255, 255, 255)',2,'0','admin','2023-04-03 19:58:52','admin','2024-07-11 09:32:08',NULL,NULL),
(48,2,'Botón Menú (fondo)','bg','.style-btn-menu','background-color','rgb(0, 0, 0)',3,'0','admin','2023-04-03 21:28:37','admin','2024-07-11 09:32:08',NULL,NULL),
(49,2,'Botón Menú (al pasar el ratón)','bg','.style-btn-menu:hover','background-color','#b13545',3,'0','admin','2023-04-04 12:20:18','admin','2024-07-11 09:32:08',NULL,NULL),
(50,2,'Ícono Carrito (fondo)','bg','.btn-cart','background-color','#000000',14,'0','admin','2023-04-04 12:58:20','admin','2024-07-11 09:32:08',NULL,NULL),
(51,2,'Ícono Carrito (al pasar el ratón)','bg','.btn-cart:hover','background-color','#b13545',14,'0','admin','2023-04-04 12:59:16','admin','2024-07-11 09:32:08',NULL,NULL),
(52,1,'textos de Menu principal (links al pasar el ratón)',NULL,'.as-menu-links-style:hover span','color','#ffffff',5,'0','admin','2023-04-04 14:42:07','admin','2024-07-11 09:32:09',NULL,NULL),
(53,2,'Links Menú Principal (al pasar el ratón)','bg','.as-menu-links-style:hover ','background-color','rgb(63, 63, 189)',5,'0','admin','2023-04-04 18:02:46','admin','2024-07-11 09:32:08',NULL,NULL),
(54,1,'Textos del Sub Menú (links)',NULL,'.as-menu-links-lvl2-style span','color','#000',6,'0','admin','2023-04-04 19:05:07','admin','2024-07-11 09:32:09',NULL,NULL),
(55,1,'Textos del Sub Menú (links al pasar el ratón)',NULL,'.as-menu-links-lvl2-style:hover span ','color','rgb(63, 63, 189)',6,'0','admin','2023-04-04 19:13:32','admin','2024-07-11 09:32:09',NULL,NULL),
(56,2,'Botón Cerrar Modal Carrito (fondo)','bg','.btn-close-cart','background-color','rgb(63, 63, 189)',7,'0','admin','2023-04-04 19:22:06','admin','2024-07-11 09:32:08',NULL,NULL),
(57,1,'Botón Cerrar Modal Carrito (texto)',NULL,'.btn-close-cart','color','#ffffff',8,'0','admin','2023-04-04 19:23:40','admin','2024-07-11 09:32:09',NULL,NULL),
(58,2,'Redes Sociales Top header (fondo)','bg','.style-social-links','background-color','#b13545',2,'0','admin','2023-04-05 14:16:00','admin','2024-07-11 09:32:08',NULL,NULL),
(59,1,'Redes Sociales Top header (icono)',NULL,'.style-social-links','color','white',2,'0','admin','2023-04-05 14:19:03','admin','2024-07-11 09:32:09',NULL,NULL),
(60,2,'Redes Sociales Top Header (fondo al pasar el ratón)','bg','.style-social-links:hover','background-color','rgb(1,1,86)',2,'0','admin','2023-04-05 14:22:46','admin','2024-07-11 09:32:08',NULL,NULL),
(61,1,'Redes Sociales Top Header (iconos al pasar el ratón)',NULL,'.style-social-links:hover','color','#fff',2,'0','admin','2023-04-05 14:23:47','admin','2024-07-11 09:32:09',NULL,NULL),
(62,2,'Flecha Subir Arriba (fondo)','bg','.ir-arriba-style','background-color','rgb(1,1,86)',6,'0','admin','2023-04-05 15:15:20','admin','2024-07-11 09:32:08',NULL,NULL),
(63,1,'Fecha Subir Arriba (Color Icono)',NULL,'.ir-arriba-style','color','#fff',7,'0','admin','2023-04-05 15:16:44','admin','2024-07-11 09:32:09',NULL,NULL),
(64,2,'Botón Suscripción (fondo)','bg','.btn-sus-style','background-color','rgb(63,63,189)',8,'0','admin','2023-04-05 15:22:47','admin','2024-07-11 09:32:08',NULL,NULL),
(65,1,'Botón Suscripción (texto)',NULL,'.btn-sus-style','color','#fff',9,'0','admin','2023-04-05 15:23:27','admin','2024-07-11 09:32:09',NULL,NULL),
(66,2,'Botón Suscripción (fondo al pasar el ratón)','bg','.btn-sus-style:hover','background-color','rgb(1,1,86)',10,'0','admin','2023-04-05 15:27:51','admin','2024-07-11 09:32:08',NULL,NULL),
(67,1,'Botón Suscripción (texto al pasar el ratón) ',NULL,'.btn-sus-style:hover','color','#fff',11,'0','admin','2023-04-05 15:28:28','admin','2024-07-11 09:32:09',NULL,NULL),
(68,1,'Titulo Página Categorías, Etiqueta, productos',NULL,'.as-page-title-style','color','rgb(63,63,189)',12,'0','admin','2023-04-05 22:23:05','admin','2024-07-11 09:32:09',NULL,NULL),
(69,2,'Botón Volver al inicio (Fondo)',NULL,'.btn-principal-style','background-color','rgb(63,63,189)',13,'0','admin','2023-04-06 12:54:07','admin','2024-07-11 09:32:08',NULL,NULL),
(70,1,'Botón Volver al inicio (Texto)',NULL,'.btn-principal-style','color','#ffffff',13,'0','admin','2023-04-06 12:58:33','admin','2024-07-11 09:32:09',NULL,NULL),
(71,2,'Botón Búsqueda filtros (Fondo)',NULL,'.btn-buscarfilter-style','background-color','rgb(63,63,189)',14,'0','admin','2023-04-06 13:18:42','admin','2024-07-11 09:32:08',NULL,NULL),
(72,1,'Botón Búsqueda Filtros (Texto)',NULL,'.btn-buscarfilter-style','color','#ffffff',14,'0','admin','2023-04-06 13:21:43','admin','2024-07-11 09:32:09',NULL,NULL),
(73,2,'Botón Búsqueda Filtros (Fondo al pasr el ratón)',NULL,'.btn-buscarfilter-style:hover','background-color','#000',15,'0','admin','2023-04-06 13:25:19','admin','2024-07-11 09:32:08',NULL,NULL),
(74,1,'Botón Búsqueda Filtros (Texto al pasar el ratón) ',NULL,'.btn-buscarfilter-style:hover','color','#ffffff',15,'0','admin','2023-04-06 13:28:05','admin','2024-07-11 09:32:09',NULL,NULL),
(75,2,'Color Slider Precio ',NULL,'.slider-precio-style .noUi-connect','background-color','rgb(63,63,189)',16,'0','admin','2023-04-06 14:03:01','admin','2024-07-11 09:32:08',NULL,NULL),
(76,2,'Etiqueta activa (fondo)',NULL,'.tag-style-style','background-color','rgb(63,63,189)',17,'0','admin','2023-04-06 14:43:43','admin','2024-07-11 09:32:08',NULL,NULL),
(77,1,'Etiqueta activa (texto)',NULL,'.tag-style-style','color','#ffffff',17,'0','admin','2023-04-06 14:44:18','admin','2024-07-11 09:32:09',NULL,NULL),
(78,2,'Categoría Noticia (fondo)',NULL,'.category-noticias-style li a','background-color','rgb(63,63,189)',18,'0','admin','2023-04-06 21:18:35','admin','2024-07-11 09:32:08',NULL,NULL),
(79,1,'Categoría Noticia (texto)',NULL,'.category-noticias-style li a','color','#fff',18,'0','admin','2023-04-06 21:19:03','admin','2024-07-11 09:32:09',NULL,NULL),
(80,1,'Flechas Slider Fotos Producto',NULL,'.slider-nav-style .slick-next:before, .slider-nav-style .slick-prev:before','color','rgb(63,63,189)',19,'0','admin','2023-04-19 13:10:20','admin','2024-07-11 09:32:09',NULL,NULL),
(81,1,'Color Accordiones',NULL,'.accordion-button:not(.collapsed)','color','rgb(63,63,189)',20,'0','admin','2023-04-19 13:39:32','admin','2024-07-11 09:32:09',NULL,NULL),
(82,2,'Breadcrumb Pago (Fondo)',NULL,'.bitem-style','background-color','rgb(63,63,189)',21,'0','admin','2023-04-19 13:56:23','admin','2024-07-11 09:32:08',NULL,NULL),
(83,1,'BreadCrumb Pago (textos)',NULL,'.bitem-style','color','#fff',22,'0','admin','2023-04-19 13:56:58','admin','2024-07-11 09:32:09',NULL,NULL),
(84,2,'Breadcrumb Pago (Flechas)',NULL,'.bline-style','color','rgb(63,63,189)',23,'0','admin','2023-04-19 14:00:14','admin','2024-07-11 09:32:08',NULL,NULL),
(85,2,'Botón pagar (fondo)',NULL,'.btn-pagar-style','background-color','rgb(63,63,189)',24,'0','admin','2023-04-28 12:30:39','admin','2024-07-11 09:32:08',NULL,NULL),
(86,1,'Botón Pagar (texto)',NULL,'.btn-pagar-style','color','#ffffff',24,'0','admin','2023-04-28 12:34:57','admin','2024-07-11 09:32:09',NULL,NULL),
(87,2,'Barra de Progreso Pago',NULL,'.progress-style','background-color','rgb(63,63,189)',25,'0','admin','2023-04-28 13:03:10','admin','2024-07-11 09:32:08',NULL,NULL),
(88,2,'Barra de Progreso activa',NULL,'.progress-step-active','background-color','rgb(63,63,189)',26,'0','admin','2023-04-28 13:07:19','admin','2024-07-11 09:32:09',NULL,NULL);
/*!40000 ALTER TABLE `estilos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro_reclamaciones`
--

DROP TABLE IF EXISTS `libro_reclamaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro_reclamaciones` (
  `libro_reclamacion_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_doc` char(1) NOT NULL DEFAULT '1',
  `nro_documento` varchar(15) NOT NULL,
  `nombre_apellidos` varchar(150) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(25) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `id_bien_contratado` char(1) NOT NULL DEFAULT '1',
  `monto_reclamado` decimal(12,2) NOT NULL,
  `tipo` char(1) NOT NULL DEFAULT '1',
  `detalle_cliente` text NOT NULL,
  `oculto` char(1) NOT NULL DEFAULT '0',
  `fecha_registro` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`libro_reclamacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro_reclamaciones`
--

LOCK TABLES `libro_reclamaciones` WRITE;
/*!40000 ALTER TABLE `libro_reclamaciones` DISABLE KEYS */;
INSERT INTO `libro_reclamaciones` VALUES
(4,'1','0202020202','Demo demo','asdasa','asdasda','hi@eduedu.dev','0',100.00,'1','el producto es erroneo','1','2024-07-18 11:38:10',NULL,NULL);
/*!40000 ALTER TABLE `libro_reclamaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medio_pagos`
--

DROP TABLE IF EXISTS `medio_pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medio_pagos` (
  `medio_pago_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `deposito` char(1) NOT NULL,
  `transferencia` char(1) NOT NULL,
  `billetera_digital` char(1) NOT NULL,
  `pago_online` char(1) NOT NULL,
  `data_value` tinytext NOT NULL,
  `imagen` text DEFAULT NULL,
  `nombre_img` varchar(200) DEFAULT NULL,
  `size_img` varchar(200) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`medio_pago_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medio_pagos`
--

LOCK TABLES `medio_pagos` WRITE;
/*!40000 ALTER TABLE `medio_pagos` DISABLE KEYS */;
INSERT INTO `medio_pagos` VALUES
(1,'BCP','<p>Titular: DANIEL ARANDA YEPEZ<br /><br />\nAhorros Soles N&deg; de cuenta : 19118583259067<br /><br />\n(Transferencias Internet sin cargo)<br /><br />\n(Pagos en ventanilla agregar 7.5 soles)</p>','0','1','0','0','bcp','assets/images/medios_pago/1664290923_1_1470258446-bcp2.png','1664290923_1_1470258446-bcp2.png','4895','0','0','admin','2022-09-27 15:02:07','admin','2022-11-13 21:12:13',NULL,NULL),
(2,'Interbank','Titular: DANIEL ARANDA YEPEZ<br />\nAhorros Soles N° de cuenta : 8983029795772<br />\n(Transferencias Internet sin cargo)<br />\n(Pagos en ventanilla agregar 7.5 soles)','0','1','0','0','interbank','assets/images/medios_pago/1664297581_1_1470258493-interbank.png','1664297581_1_1470258493-interbank.png','7019','0','0','admin','2022-09-27 16:53:05','admin','2022-10-16 05:14:35',NULL,NULL),
(3,'Scotiabank','Titular: Juan alfonso Soto Vargas<br />\nAhorros Soles N° de cuenta : 501-0181302<br />\nNo existen Cargos<br />\n** Al momento de hacer la transferencia Es obligatorio poner nuestro email en el destinatario**<br />\nEmail : ventas@storegamesperu.com','0','1','0','0','scotiabank','assets/images/medios_pago/1664297637_1_1480968305-skotiabank.png','1664297637_1_1480968305-skotiabank.png','8858','0','0','admin','2022-09-27 16:54:11','admin','2022-10-16 05:14:54',NULL,NULL),
(4,'Agente BCP','<p>Titular: Juan alfonso Soto Vargas<br />\r\nAhorros Soles N&deg; de cuenta :191 98967732003<br />\r\n( Pago dentro Lima no tiene cargo )<br />\r\n( Pago Fuera de Lima agregar 9 soles )</p>\r\n\r\n<p><img alt=\"\" src=\"http://lolstore.test:82/assets/images/medios_pago/descarga (2)_1668375545.png\" style=\"height:225px; width:225px\" /></p>','1','0','0','0','agente-bcp','assets/images/medios_pago/1664301812_1_1467824644-bcp-agente.png','1664301812_1_1467824644-bcp-agente.png','9549','0','0','admin','2022-09-27 16:55:16','admin','2023-05-18 12:46:23',NULL,NULL),
(5,'Scotiabank','Titular: Juan alfonso Soto Vargas\nAhorros Soles N° de cuenta : 501-0181302\nNo existen Cargos\n** Al momento de hacer la transferencia Es obligatorio poner nuestro email en el destinatario**\nEmail : ventas@storegamesperu.com','0','1','0','0','scotiabank','assets/images/medios_pago/1665204578_1_1480968305-skotiabank.png','1665204578_1_1480968305-skotiabank.png','8858','0','1','admin','2022-10-08 04:49:39',NULL,NULL,NULL,NULL),
(6,'Continental','Titular: Juan alfonso Soto Vargas<br />\nAhorros Soles N° de cuenta : 0011-0342-0200438124<br />\n(Transferencias Internet fuera de Lima Cargo 9 soles)<br />\n** Al momento de hacer la transferencia Es obligatorio poner nuestro email en el destinatario**<br />\nEmail : ventas@storegamesperu.com','0','1','0','0','continental','assets/images/medios_pago/1665204655_1_1480969358-continental.png','1665204655_1_1480969358-continental.png','11545','0','0','admin','2022-10-08 04:50:56','admin','2022-10-16 05:14:30',NULL,NULL),
(7,'Yape','Número de telefono : +51 987 477 559<br />\nTitular: Juan Soto Vargas<br />\n<br />\n1. Ingresa a tu app y elige la opción Pagar.<br />\n2. Elige nuestro contacto<br />\n3. Ingresa el monto, dale \"Enviar Pago\" y ¡listo!<br />\nObligatario : Al momento de hacer el pago en referencias indicar<br />\nsu numero de whatsapp.','0','0','1','0','yape','assets/images/medios_pago/1665204949_1_1561152641-yape.png','1665204949_1_1561152641-yape.png','37322','0','0','admin','2022-10-08 04:55:51','admin','2022-10-16 05:15:03',NULL,NULL),
(8,'Lukita','<p>N&uacute;mero de telefono : +51 987 477 559<br />\nTitular: Juan Soto Vargas<br />\n<br />\n1. Ingresa a tu app busca y eligue nuestro contacto<br />\n2. Seleccionas pagar<br />\n3. Ingresa el monto, dale &quot;Enviar Pago&quot; y &iexcl;listo!<br />\nObligatario : Al momento de hacer el pago en referencias indicar<br />\nsu numero de whatsapp.</p>','0','0','1','0','lukita','assets/images/medios_pago/1665204979_1_1569357326-lukita.JPG','1665204979_1_1569357326-lukita.JPG','25872','0','0','admin','2022-10-08 04:56:21','admin','2023-04-25 03:30:54',NULL,NULL),
(9,'Paypal','<ul>\r\n	<li>Puedes hacer el pago con tarjeta de cr&eacute;dito, d&eacute;bito o en cuotas.</li>\r\n	<li>Los Pedidos se env&iacute;an dentro de los horarios y d&iacute;as de atenci&oacute;n.</li>\r\n	<li>Cargo adicionales del 20% por usar el procesador de pagos.</li>\r\n</ul>','0','0','0','1','paypal','assets/images/medios_pago/1682444623_1_paypal.png','1682444623_1_paypal.png','5592','1','0','admin','2023-04-25 17:43:45','admin','2023-05-18 13:18:16',NULL,NULL),
(10,'Plin Móvil','<p>N&uacute;mero de telefono : +51 987 477 559<br />\r\nTitular: Juan Soto Vargas<br />\r\n<br />\r\n1. Ingresa a tu app y elige la opci&oacute;n Pagar.<br />\r\n2. Elige nuestro contacto<br />\r\n3. Ingresa el monto, dale &quot;Enviar Pago&quot; y &iexcl;listo!</p>\r\n\r\n<p><img alt=\"\" src=\"http://lolstore.test:82/assets/images/medios_pago/1680646245-qr-plin_1684371730.png\" style=\"height:264px; width:300px\" /></p>','0','0','1','0','plin-movil','assets/images/medios_pago/1684371749_1_1680640291-plin.png','1684371749_1_1680640291-plin.png','6110','0','0','admin','2023-05-17 20:02:50','admin','2023-05-17 22:39:56',NULL,NULL),
(11,'Mercado Pago','<p>&bull;Puedes hacer el pago con tarjeta de cr&eacute;dito, d&eacute;bito o en cuotas.<br />\r\n&bull;Los Pedidos se env&iacute;an dentro de los horarios y d&iacute;as de atenci&oacute;n.<br />\r\n&bull;Cargo adicionales del 10% por usar el procesador de pagos.</p>','0','0','0','1','mercado-pago','assets/images/medios_pago/1684519989_1_Mercado-Pago-Logo.png','1684519989_1_Mercado-Pago-Logo.png','64384','0','0','admin','2023-05-19 13:13:12','admin',NULL,NULL,NULL),
(12,'Izipay','<p>Puedes hacer el pago con tarjeta de cr&eacute;dito, d&eacute;bito o en cuotas. Los Pedidos se env&iacute;an dentro de los horarios y d&iacute;as de atenci&oacute;n.&nbsp;</p>','0','0','0','1','izipay','assets/images/medios_pago/1691781747_1_izipay-logo.png','1691781747_1_izipay-logo.png','39022','0','0','admin','2023-08-11 14:22:29','admin',NULL,NULL,NULL),
(13,'TRANSFERENCIA BANCO PICHINCHA','<p>TRANSFERENCIA BANCO PICHINCHA</p>','1','1','0','0','','assets/images/medios_pago/1720677205_1_profile.png','1720677205_1_profile.png','6779','0','0','admin','2024-07-11 00:53:28','admin',NULL,NULL,NULL),
(14,'KUSHKI','','0','0','0','1','','assets/images/medios_pago/1720711945_1_logo.3a61df33.png','1720711945_1_logo.3a61df33.png','2284','0','0','admin','2024-07-11 10:32:28','admin',NULL,NULL,NULL),
(15,'PayPhone','<h3>Tambi&eacute;n puedes cancelar tus facturas con PayPhone.</h3>','0','0','0','1','payphone','assets/images/medios_pago/1721619420_1_descarga-1.png.png','1721619420_1_descarga-1.png.png','35694','1','0','admin','2024-07-21 22:37:04',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `medio_pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medios_pago_online`
--

DROP TABLE IF EXISTS `medios_pago_online`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medios_pago_online` (
  `medio_pago_online_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `imagen` text DEFAULT NULL,
  `nombre_img` varchar(200) DEFAULT NULL,
  `size_img` varchar(200) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`medio_pago_online_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medios_pago_online`
--

LOCK TABLES `medios_pago_online` WRITE;
/*!40000 ALTER TABLE `medios_pago_online` DISABLE KEYS */;
INSERT INTO `medios_pago_online` VALUES
(1,'mercadopago','Mercado Pago',NULL,NULL,NULL,'1','0','admin','2022-10-27 12:17:46',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `medios_pago_online` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `menu_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `padre` int(11) NOT NULL,
  `icono` text DEFAULT NULL,
  `nombre_icono` varchar(100) DEFAULT NULL,
  `size_icono` varchar(50) DEFAULT NULL,
  `posicion` int(11) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '0',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES
(1,'PS3','categorias/ps3',0,NULL,NULL,NULL,3,'1','1','admin','2023-03-31 18:28:51','admin','2022-10-08 14:13:59',NULL,NULL),
(2,'PS4','categorias/ps4',0,NULL,NULL,NULL,1,'1','1','admin','2023-03-31 18:27:02','admin','2022-10-08 14:14:53',NULL,NULL),
(3,'Todos los juegos','ps3',1,NULL,NULL,NULL,1,'1','0','admin','2022-09-29 04:25:01','admin','2022-10-08 14:13:29',NULL,NULL),
(4,'3 juegos en 1','categorias/ps3/3-Juegos-en-1',1,NULL,NULL,NULL,2,'1','0','admin','2023-03-31 18:28:57','admin','2022-10-08 14:13:41',NULL,NULL),
(5,'Todos los Juegos','categorias/ps4',2,NULL,NULL,NULL,2,'1','0','admin','2023-03-31 18:27:12','admin','2022-10-08 14:14:57',NULL,NULL),
(6,'Todo Setup','#',0,NULL,NULL,NULL,7,'1','1','admin','2023-02-12 05:16:39',NULL,NULL,NULL,NULL),
(7,'PS5','categorias/ps5',0,NULL,NULL,NULL,2,'1','1','admin','2023-03-31 18:28:33','admin','2022-10-08 14:15:14',NULL,NULL),
(8,'Estrenos','categorias/ps4/estrenos',2,NULL,NULL,NULL,1,'1','0','admin','2023-03-31 18:27:20',NULL,NULL,NULL,NULL),
(9,'PACK PS4','#',2,NULL,NULL,NULL,3,'0','0','admin','2022-09-29 16:39:01',NULL,NULL,NULL,NULL),
(20,'PC','categorias/pc',0,NULL,NULL,NULL,4,'1','1','admin','2023-03-31 18:33:01','admin','2022-10-08 14:14:45',NULL,NULL),
(21,'PACK PS3','#',1,NULL,NULL,NULL,4,'1','0','admin','2022-09-29 23:18:42',NULL,NULL,NULL,NULL),
(22,'Todos los juegos','categorias/ps5',7,NULL,NULL,NULL,1,'1','0','admin','2023-03-31 18:27:39','admin','2022-10-08 14:15:22',NULL,NULL),
(23,'Menu Ejemplo','nintendo-switch',0,NULL,NULL,NULL,5,'0','1','admin','2022-10-11 00:53:58','admin','2022-10-11 00:54:25',NULL,NULL),
(24,'SUBMENU EJEMPLO1','3-juegos-en-1',23,NULL,NULL,NULL,1,'1','0','admin','2022-10-11 00:56:01','admin','2022-10-11 00:56:37',NULL,NULL),
(25,'Teclados','categorias/pc/teclados',20,NULL,NULL,NULL,1,'1','0','admin','2023-03-31 18:33:07','admin','2022-10-26 15:19:43',NULL,NULL),
(26,'Opiniones','opiniones',0,NULL,NULL,NULL,10,'1','0','admin','2022-11-07 04:10:10','admin','2022-11-07 05:54:02',NULL,NULL),
(27,'Galería','#',0,'assets/images/menu_iconos/1669156206_1_6915_book_gallery_images_photos_pictures_icon.png','1669156206_1_6915_book_gallery_images_photos_pictures_icon.png','31621',9,'1','0','admin','2022-11-22 22:33:49',NULL,NULL,NULL,NULL),
(28,'galeria sub 1','#',27,'assets/images/menu_iconos/1669159902_1_9023312_chats_circle_fill_icon.png','1669159902_1_9023312_chats_circle_fill_icon.png','456',1,'0','1','admin','2022-11-22 23:31:43',NULL,NULL,NULL,NULL),
(29,'Funkos','categorias/funkos',0,NULL,NULL,NULL,5,'1','1','admin','2023-03-17 05:53:16',NULL,NULL,NULL,NULL),
(33,'Coleccionables','#',0,NULL,NULL,NULL,6,'1','1','admin','2023-02-12 03:30:02',NULL,NULL,NULL,NULL),
(34,'DC','categorias/funkos/dc',29,NULL,NULL,NULL,2,'1','0','admin','2023-03-17 05:59:41',NULL,NULL,NULL,NULL),
(35,'Marvel','categorias/funkos/marvel',29,NULL,NULL,NULL,3,'1','0','admin','2023-03-17 05:59:50',NULL,NULL,NULL,NULL),
(36,'BANDAI','#',33,NULL,NULL,NULL,1,'1','0','admin','2023-02-12 03:30:57',NULL,NULL,NULL,NULL),
(37,'NECA','#',33,NULL,NULL,NULL,2,'1','0','admin','2023-02-12 03:31:13',NULL,NULL,NULL,NULL),
(38,'4 juegos en 1','4-juegos-en-1',1,NULL,NULL,NULL,3,'1','0','admin','2022-09-29 05:28:23','admin','2022-10-08 14:13:48',NULL,NULL),
(40,'Sillas gamer','#',6,NULL,NULL,NULL,1,'1','0','admin','2023-02-12 05:17:07',NULL,NULL,NULL,NULL),
(41,'Luces y Aros','#',6,NULL,NULL,NULL,2,'1','0','admin','2023-02-12 05:17:34',NULL,NULL,NULL,NULL),
(42,'Todos los Funkos','categorias/funkos',29,NULL,NULL,NULL,1,'1','0','admin','2023-03-31 19:07:20',NULL,NULL,NULL,NULL),
(43,'Prueba','#',0,NULL,NULL,NULL,10,'1','1','admin','2024-07-16 09:10:06',NULL,NULL,NULL,NULL),
(44,'Ofertas','#ofertas',0,NULL,NULL,NULL,8,'1','0','admin','2024-07-18 10:41:09',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2014_10_12_100000_create_password_resets_table',1),
(2,'2019_08_19_000000_create_failed_jobs_table',1),
(3,'2019_12_14_000001_create_personal_access_tokens_table',1),
(4,'2022_08_03_052727_create_categorias_table',1),
(5,'2022_08_03_052840_create_productos_table',1),
(6,'2022_08_11_064722_create_tags_table',1),
(7,'2022_08_11_175312_create_producto_m__categorias_table',1),
(8,'2022_08_11_175703_create_producto_m__tags_table',1),
(9,'2022_08_12_200134_create_producto__imagens_table',1),
(10,'2022_08_12_200330_create_producto_codigos_table',1),
(11,'2022_08_23_002946_create_sliders_table',1),
(12,'2022_08_25_002641_create_banner__estilos_table',1),
(13,'2022_08_27_205531_create_bloque_tipos_table',1),
(14,'2022_08_27_214412_create_bloques_table',1),
(15,'2022_09_03_214552_create_banners_table',1),
(16,'2022_09_05_053248_create_pregunta__frecuentes_table',1),
(17,'2022_09_12_000000_create_users_table',1),
(18,'2022_09_24_230828_create_permission_tables',1),
(19,'2022_09_27_041732_create_medio__pagos_table',1),
(20,'2022_09_27_203708_create_monedas_table',1),
(21,'2022_09_28_135904_create_menus_table',1),
(22,'2022_10_01_223347_create_estilo__tipos_table',1),
(23,'2022_10_01_223350_create_estilos_table',1),
(24,'2022_10_13_214419_create_configuracions_table',1),
(25,'2022_10_17_063426_create_descuentos_table',1),
(26,'2022_10_21_003460_create_medio__pago__onlines_table',1),
(27,'2022_10_21_003866_create_ordens_table',1),
(28,'2022_10_21_003872_create_ordens__detalles_table',1),
(29,'2022_10_21_003929_create_ordens__estados_table',1),
(30,'2022_10_21_003930_create_ordens_m__orden__estados_table',1),
(31,'2022_11_09_112329_create_opinions_table',1),
(32,'2022_11_23_151238_create_noticia__categorias_table',1),
(33,'2022_11_24_213450_create_noticia__tags_table',1),
(34,'2022_11_25_174724_create_noticias_table',1),
(35,'2022_11_29_103538_create_noticia_m__noticia__categorias_table',1),
(36,'2022_11_29_103616_create_noticia_m__noticia__tags_table',1),
(37,'2022_11_29_103710_create_noticia__imagens_table',1),
(38,'2023_03_31_194518_create_suscripcions_table',1),
(39,'2023_04_02_195318_create_libro_reclamaciones_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES
(1,'App\\Models\\User',2,NULL,NULL),
(3,'App\\Models\\User',3,NULL,NULL),
(3,'App\\Models\\User',6,NULL,NULL),
(4,'App\\Models\\User',5,NULL,NULL),
(100,'App\\Models\\User',7,NULL,NULL),
(100,'App\\Models\\User',8,NULL,NULL),
(100,'App\\Models\\User',9,NULL,NULL),
(100,'App\\Models\\User',10,NULL,NULL),
(100,'App\\Models\\User',11,NULL,NULL),
(100,'App\\Models\\User',12,NULL,NULL),
(100,'App\\Models\\User',13,NULL,NULL),
(100,'App\\Models\\User',14,NULL,NULL),
(100,'App\\Models\\User',15,NULL,NULL),
(100,'App\\Models\\User',16,NULL,NULL),
(100,'App\\Models\\User',18,NULL,NULL),
(100,'App\\Models\\User',19,NULL,NULL),
(100,'App\\Models\\User',20,NULL,NULL);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monedas`
--

DROP TABLE IF EXISTS `monedas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monedas` (
  `moneda_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codigo` char(10) NOT NULL,
  `prefijo` char(10) DEFAULT NULL,
  `sufijo` char(10) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `tipo_cambio` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`moneda_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monedas`
--

LOCK TABLES `monedas` WRITE;
/*!40000 ALTER TABLE `monedas` DISABLE KEYS */;
INSERT INTO `monedas` VALUES
(1,'Nuevo Sol','PEN','S/.',NULL,'0','0','admin','2022-09-28 03:15:11','admin','2023-04-21 17:44:50','3.76',NULL,NULL),
(2,'Dólares','DOL','$','USD','1','0','admin','2022-09-28 03:47:29',NULL,NULL,'0.00',NULL,NULL);
/*!40000 ALTER TABLE `monedas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticia_categorias`
--

DROP TABLE IF EXISTS `noticia_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticia_categorias` (
  `noticia_categoria_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `noticia_categoria` varchar(40) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `url` text NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registra` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`noticia_categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia_categorias`
--

LOCK TABLES `noticia_categorias` WRITE;
/*!40000 ALTER TABLE `noticia_categorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticia_categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticia_imagens`
--

DROP TABLE IF EXISTS `noticia_imagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticia_imagens` (
  `noticia_imagen_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `noticia_id` bigint(20) unsigned NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `size` varchar(50) NOT NULL,
  `url` text NOT NULL,
  `principal` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`noticia_imagen_id`),
  KEY `noticia_imagens_noticia_id_foreign` (`noticia_id`),
  CONSTRAINT `noticia_imagens_noticia_id_foreign` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`noticia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia_imagens`
--

LOCK TABLES `noticia_imagens` WRITE;
/*!40000 ALTER TABLE `noticia_imagens` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticia_imagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticia_m_noticia_categorias`
--

DROP TABLE IF EXISTS `noticia_m_noticia_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticia_m_noticia_categorias` (
  `noticia_m_noticia_categoria_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `noticia_id` bigint(20) unsigned NOT NULL,
  `noticia_categoria_id` bigint(20) unsigned NOT NULL,
  `oculto` char(1) NOT NULL,
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`noticia_m_noticia_categoria_id`),
  KEY `noticia_m_noticia_categorias_noticia_id_foreign` (`noticia_id`),
  KEY `noticia_m_noticia_categorias_noticia_categoria_id_foreign` (`noticia_categoria_id`),
  CONSTRAINT `noticia_m_noticia_categorias_noticia_categoria_id_foreign` FOREIGN KEY (`noticia_categoria_id`) REFERENCES `noticia_categorias` (`noticia_categoria_id`),
  CONSTRAINT `noticia_m_noticia_categorias_noticia_id_foreign` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`noticia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia_m_noticia_categorias`
--

LOCK TABLES `noticia_m_noticia_categorias` WRITE;
/*!40000 ALTER TABLE `noticia_m_noticia_categorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticia_m_noticia_categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticia_m_noticia_tags`
--

DROP TABLE IF EXISTS `noticia_m_noticia_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticia_m_noticia_tags` (
  `noticia_m_noticia_tag_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `noticia_id` bigint(20) unsigned NOT NULL,
  `noticia_tag_id` bigint(20) unsigned NOT NULL,
  `oculto` char(1) NOT NULL,
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`noticia_m_noticia_tag_id`),
  KEY `noticia_m_noticia_tags_noticia_id_foreign` (`noticia_id`),
  KEY `noticia_m_noticia_tags_noticia_tag_id_foreign` (`noticia_tag_id`),
  CONSTRAINT `noticia_m_noticia_tags_noticia_id_foreign` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`noticia_id`),
  CONSTRAINT `noticia_m_noticia_tags_noticia_tag_id_foreign` FOREIGN KEY (`noticia_tag_id`) REFERENCES `noticia_tags` (`noticia_tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia_m_noticia_tags`
--

LOCK TABLES `noticia_m_noticia_tags` WRITE;
/*!40000 ALTER TABLE `noticia_m_noticia_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticia_m_noticia_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticia_tags`
--

DROP TABLE IF EXISTS `noticia_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticia_tags` (
  `noticia_tag_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `noticia_tag` varchar(40) NOT NULL,
  `url` mediumtext NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registra` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`noticia_tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia_tags`
--

LOCK TABLES `noticia_tags` WRITE;
/*!40000 ALTER TABLE `noticia_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticia_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticias`
--

DROP TABLE IF EXISTS `noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticias` (
  `noticia_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `noticia` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `url` mediumtext NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registra` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`noticia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticias`
--

LOCK TABLES `noticias` WRITE;
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opiniones`
--

DROP TABLE IF EXISTS `opiniones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opiniones` (
  `opinion_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `calificacion` int(11) NOT NULL,
  `facebook_id` varchar(250) NOT NULL,
  `comentario` mediumtext NOT NULL,
  `auth` int(11) NOT NULL DEFAULT 0,
  `fecha_registro` datetime NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`opinion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opiniones`
--

LOCK TABLES `opiniones` WRITE;
/*!40000 ALTER TABLE `opiniones` DISABLE KEYS */;
/*!40000 ALTER TABLE `opiniones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordens`
--

DROP TABLE IF EXISTS `ordens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordens` (
  `orden_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `medio_pago_id` bigint(20) unsigned DEFAULT NULL,
  `nombres` varchar(200) NOT NULL,
  `informacion_adicional` mediumtext NOT NULL,
  `email` varchar(255) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `direccion2` varchar(200) NOT NULL,
  `comentario` mediumtext NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `n_operacion` char(30) NOT NULL,
  `descuento_id` bigint(20) unsigned DEFAULT NULL,
  `comprobante` text NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `descuento` decimal(12,2) DEFAULT NULL,
  `total` decimal(12,2) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`orden_id`),
  KEY `ordens_medio_pago_id_foreign` (`medio_pago_id`),
  KEY `ordens_descuento_id_foreign` (`descuento_id`),
  CONSTRAINT `ordens_descuento_id_foreign` FOREIGN KEY (`descuento_id`) REFERENCES `descuentos` (`descuento_id`),
  CONSTRAINT `ordens_medio_pago_id_foreign` FOREIGN KEY (`medio_pago_id`) REFERENCES `medio_pagos` (`medio_pago_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordens`
--

LOCK TABLES `ordens` WRITE;
/*!40000 ALTER TABLE `ordens` DISABLE KEYS */;
INSERT INTO `ordens` VALUES
(1,15,'Juan Perez','0980150689','hi@eduedu.dev','Bolívar','Guaranda','Sofia Pesantes y Camino Real','alpacahca','asda','2024-08-30 19:10:02','817501',1,'',13.80,6.90,6.90,'102.177.162.56','2024-08-31 00:09:40',NULL,NULL),
(2,9,'Juan Perez','0980150689','hi@eduedu.dev','Bolívar','Guaranda','Sofia Pesantes y Camino Real','alpacahca','jhkhk','2024-08-31 00:11:06','PAYID-M3JF7DA09465430C0448722Y',1,'',77.22,38.61,38.61,'102.177.162.56','2024-08-31 00:10:51',NULL,NULL),
(3,9,'Maria Perez','0980150689','eduardoguastay1999@gmail.com','Bolívar','Guaranda','Sofia Pesantes y Camino Real','alpacahca','kjlkj','2024-08-31 00:17:35','PAYID-M3JGCGA10F525281Y9732220',1,'1725063423_1_ESCU.jpg',78.00,39.00,39.00,'102.177.162.56','2024-08-31 00:17:27',NULL,NULL),
(4,15,'ADMIN ADMIN','997308677','mtavila07@gmail.com','Azuay','Chimbo','LA MAGDALENA','hj','dd','0000-00-00 00:00:00','',NULL,'',42.70,0.00,42.70,'200.24.134.82','2024-08-31 00:46:14',NULL,NULL),
(5,15,'ADMIN ADMIN','997308677','mtavila07@gmail.com','Bolívar','Chimbo','LA MAGDALENA','hj','d','0000-00-00 00:00:00','',NULL,'',13.80,0.00,13.80,'200.24.134.82','2024-09-02 01:20:52',NULL,NULL),
(7,15,'Juan Perez','0980150689','hi@eduedu.dev','Bolívar','Guaranda','sofia pesantes','camino real','casa color verde upc','2024-09-04 10:26:38','670847',NULL,'',77.22,0.00,77.22,'102.177.162.56','2024-09-04 15:26:02',NULL,NULL),
(8,15,'Omar Lema','0999999999','el.omarcito02@gmail.com','Bolívar','Guaranda','232','232','dsd','0000-00-00 00:00:00','',NULL,'',11.00,0.00,11.00,'200.24.134.82','2024-09-05 01:41:18',NULL,NULL),
(9,9,'Omar Lema','0999999999','el.omarcito02@gmail.com','Bolívar','e','zx','xzx','zxz','0000-00-00 00:00:00','',NULL,'',12.28,0.00,12.28,'200.24.134.82','2024-09-05 01:42:29',NULL,NULL),
(10,15,'Omar Lema','0999999999','el.omarcito02@gmail.com','Bolívar','jkk','iou','ghiu','hghj','0000-00-00 00:00:00','',NULL,'',12.28,0.00,12.28,'181.224.197.129','2024-09-05 13:48:30',NULL,NULL);
/*!40000 ALTER TABLE `ordens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordens_detalles`
--

DROP TABLE IF EXISTS `ordens_detalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordens_detalles` (
  `orden_detalle_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orden_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `codigo_producto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`orden_detalle_id`),
  KEY `ordens_detalles_orden_id_foreign` (`orden_id`),
  KEY `ordens_detalles_producto_id_foreign` (`producto_id`),
  CONSTRAINT `ordens_detalles_orden_id_foreign` FOREIGN KEY (`orden_id`) REFERENCES `ordens` (`orden_id`),
  CONSTRAINT `ordens_detalles_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordens_detalles`
--

LOCK TABLES `ordens_detalles` WRITE;
/*!40000 ALTER TABLE `ordens_detalles` DISABLE KEYS */;
INSERT INTO `ordens_detalles` VALUES
(1,1,23,1,13.80,13.80,'0','admin','2024-08-31 00:09:40','',NULL,NULL),
(2,2,14,1,77.22,77.22,'0','admin','2024-08-31 00:10:51','',NULL,NULL),
(3,3,4,1,78.00,78.00,'0','admin','2024-08-31 00:17:27','',NULL,NULL),
(4,4,16,1,2.70,2.70,'0','admin','2024-08-31 00:46:14','',NULL,NULL),
(5,4,13,1,40.00,40.00,'0','admin','2024-08-31 00:46:14','',NULL,NULL),
(6,5,23,1,13.80,13.80,'0','admin','2024-09-02 01:20:52','',NULL,NULL),
(7,7,14,1,77.22,77.22,'0','admin','2024-09-04 15:26:02','',NULL,NULL),
(8,8,12,1,11.00,11.00,'0','admin','2024-09-05 01:41:18','',NULL,NULL),
(9,9,23,1,12.28,12.28,'0','admin','2024-09-05 01:42:29','',NULL,NULL),
(10,10,23,1,12.28,12.28,'0','admin','2024-09-05 13:48:30','',NULL,NULL);
/*!40000 ALTER TABLE `ordens_detalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordens_estados`
--

DROP TABLE IF EXISTS `ordens_estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordens_estados` (
  `orden_estado_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `estado` varchar(100) NOT NULL,
  `oculto` char(1) NOT NULL,
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`orden_estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordens_estados`
--

LOCK TABLES `ordens_estados` WRITE;
/*!40000 ALTER TABLE `ordens_estados` DISABLE KEYS */;
INSERT INTO `ordens_estados` VALUES
(1,'Aprobado','0','admin','2022-10-21 15:40:40',NULL,NULL,NULL,NULL),
(2,'Pendiente','0','admin','2022-10-21 15:40:40',NULL,NULL,NULL,NULL),
(3,'Rechazado','0','admin','2022-10-21 15:40:40',NULL,NULL,NULL,NULL),
(4,'Atendido','0','admin','2022-10-29 16:24:29',NULL,NULL,NULL,NULL),
(5,'Cancelado','0','admin','2023-04-19 18:32:01',NULL,NULL,NULL,NULL),
(6,'En Proceso Pago Online','0','admin','2023-04-22 12:36:51',NULL,NULL,NULL,NULL),
(7,'Pendiente Verificación','0','admin','2023-04-22 18:31:33',NULL,NULL,NULL,NULL),
(8,'Pendiente Mercado Pago','0','admin','2023-05-19 18:56:10',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `ordens_estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordens_m_orden_estados`
--

DROP TABLE IF EXISTS `ordens_m_orden_estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordens_m_orden_estados` (
  `orden_m_orden_estado_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orden_id` bigint(20) unsigned NOT NULL,
  `orden_estado_id` bigint(20) unsigned NOT NULL,
  `estado` char(1) NOT NULL,
  `oculto` char(1) NOT NULL,
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`orden_m_orden_estado_id`),
  KEY `ordens_m_orden_estados_orden_id_foreign` (`orden_id`),
  KEY `ordens_m_orden_estados_orden_estado_id_foreign` (`orden_estado_id`),
  CONSTRAINT `ordens_m_orden_estados_orden_estado_id_foreign` FOREIGN KEY (`orden_estado_id`) REFERENCES `ordens_estados` (`orden_estado_id`),
  CONSTRAINT `ordens_m_orden_estados_orden_id_foreign` FOREIGN KEY (`orden_id`) REFERENCES `ordens` (`orden_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordens_m_orden_estados`
--

LOCK TABLES `ordens_m_orden_estados` WRITE;
/*!40000 ALTER TABLE `ordens_m_orden_estados` DISABLE KEYS */;
INSERT INTO `ordens_m_orden_estados` VALUES
(1,1,6,'0','0','admin','2024-08-31 00:09:40',NULL,NULL),
(2,1,7,'0','0','admin','2024-08-31 00:10:04',NULL,NULL),
(3,1,7,'0','0','admin','2024-08-31 00:10:23',NULL,NULL),
(4,2,6,'0','0','admin','2024-08-31 00:10:51',NULL,NULL),
(5,2,7,'0','0','admin','2024-08-31 00:11:07',NULL,NULL),
(6,3,6,'0','0','admin','2024-08-31 00:17:27',NULL,NULL),
(7,3,7,'0','0','admin','2024-08-31 00:17:36',NULL,NULL),
(8,3,3,'1','0','admin','2024-08-31 00:18:09',NULL,NULL),
(9,1,1,'0','0','admin','2024-08-31 00:18:23',NULL,NULL),
(10,1,4,'1','0','admin','2024-08-31 00:18:28',NULL,NULL),
(11,2,1,'1','0','admin','2024-08-31 00:18:32',NULL,NULL),
(12,4,6,'1','0','admin','2024-08-31 00:46:14',NULL,NULL),
(13,5,6,'1','0','admin','2024-09-02 01:20:52',NULL,NULL),
(14,7,6,'0','0','admin','2024-09-04 15:26:02',NULL,NULL),
(15,7,7,'0','0','admin','2024-09-04 15:26:40',NULL,NULL),
(16,7,7,'1','0','admin','2024-09-04 15:26:59',NULL,NULL),
(17,8,6,'0','0','admin','2024-09-05 01:41:18',NULL,NULL),
(18,8,5,'1','0','Usuario','2024-09-05 01:41:26',NULL,NULL),
(19,9,6,'1','0','admin','2024-09-05 01:42:29',NULL,NULL),
(20,10,6,'1','0','admin','2024-09-05 13:48:30',NULL,NULL);
/*!40000 ALTER TABLE `ordens_m_orden_estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES
('hi@eduedu.dev','$2y$12$2O1LrUBxxGzIX4qCHvmxbufc1jXDvP2AxGrcV9FL5lHsnRdj9rA1m','2024-08-31 00:33:41');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES
(1,'admin.inicio','dashboard','web','2022-09-25 09:28:20','2022-09-25 09:28:20'),
(2,'admin.categorias.index','Listado de Categorias','web','2022-09-25 09:28:20','2022-09-25 09:28:20'),
(3,'admin.categorias.crear','Registro Categoría','web','2022-09-25 09:28:20','2022-09-25 09:28:20'),
(4,'admin.categorias.actualizar','Actualizar Categoría','web','2022-09-25 09:28:20','2022-09-25 09:28:20'),
(5,'admin.categorias.borrar','Eliminar Categoría','web','2022-09-25 09:28:20','2022-09-25 09:28:20'),
(6,'admin.categorias.activar','Activar Categoría','web','2022-09-25 09:28:20','2022-09-25 09:28:20'),
(7,'admin.categorias.desactivar','Desactivar Categoría','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(8,'admin.categorias.show','Mostrar Subcategorías','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(9,'admin.subcategorias.crear','Registro Subcategorías','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(10,'admin.subcategorias.actualizar','Actualizar Subcategorías','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(11,'admin.subcategorias.borrar','Eliminar Subcategorías','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(12,'admin.subcategorias.activar','Activar Subcategorías','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(13,'admin.subcategorias.desactivar','Desactivar Subcategorías','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(14,'admin.productos.index','Listado de Productos','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(15,'admin.productos.crear','Registro de Productos','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(16,'admin.productos.actualizar','Actualizar Productos','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(17,'admin.productos.borrar','Eliminar Productos','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(18,'admin.productos.activar','Activar Productos','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(19,'admin.productos.desactivar','Desactivar Productos','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(20,'admin.productos.agotado','Agotado Productos','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(21,'admin.productos.codigos','Listado de Códigos Productos','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(22,'admin.productos.codigos.crear','Registro de Códigos Productos','web','2022-09-25 09:28:21','2022-09-25 09:28:21'),
(23,'admin.productos.codigos.editar','Actualizar Código Productos','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(24,'admin.productos.codigos.borrar','Eliminar Código Productos','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(25,'admin.sliders.index','Listado de Sliders','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(26,'admin.sliders.crear','Registro de Slider','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(27,'admin.sliders.actualizar','Actualizar Slider','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(28,'admin.sliders.eliminar','Eliminar Slider','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(29,'admin.sliders.activar','Activar Slider','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(30,'admin.sliders.desactivar','Desactivar Slider','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(31,'admin.sliders.popup','Popup Slider','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(32,'admin.banners.index','Listado de Banners','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(33,'admin.banners.crear','Registro de Banner','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(34,'admin.banners.actualizar','Actualizar Banner','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(35,'admin.banners.eliminar','Eliminar Banner','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(36,'admin.banners.activar','Activar Banners','web','2022-09-25 09:28:22','2022-09-25 09:28:22'),
(37,'admin.banners.desactivar','Desactivar Banners','web','2022-09-25 09:28:23','2022-09-25 09:28:23'),
(38,'admin.tags.index','Listado de Tags','web','2022-09-25 09:28:23','2022-09-25 09:28:23'),
(39,'admin.tags.crear','Registro de Tags','web','2022-09-25 09:28:23','2022-09-25 09:28:23'),
(40,'admin.tags.actualizar','Actualizar Tags','web','2022-09-25 09:28:23','2022-09-25 09:28:23'),
(41,'admin.tags.eliminar','Eliminar Tags','web','2022-09-25 09:28:23','2022-09-25 09:28:23'),
(42,'admin.tags.activar','Activar Tags','web','2022-09-25 09:28:23','2022-09-25 09:28:23'),
(43,'admin.tags.desactivar','Desactivar Tags','web','2022-09-25 09:28:23','2022-09-25 09:28:23'),
(44,'admin.disenio.index','Listado de Bloques','web','2022-09-25 09:28:23','2022-09-25 09:28:23'),
(45,'admin.disenio.crear','Registro de Bloque','web','2022-09-25 09:28:23','2022-09-25 09:28:23'),
(46,'admin.disenio.actualizar','Actualizar Bloque','web','2022-09-25 09:28:23','2022-09-25 09:28:23'),
(47,'admin.disenio.eliminar','Eliminar Bloque','web','2022-09-25 09:28:23','2022-09-25 09:28:23'),
(48,'admin.disenio.activar','Activar Bloque','web','2022-09-25 09:28:23','2022-09-25 09:28:23'),
(49,'admin.disenio.desactivar','Desactivar Bloque','web','2022-09-25 09:28:24','2022-09-25 09:28:24'),
(50,'admin.disenio.up','Subir Bloque','web','2022-09-25 09:28:24','2022-09-25 09:28:24'),
(51,'admin.disenio.down','Bajar Bloque','web','2022-09-25 09:28:24','2022-09-25 09:28:24'),
(52,'admin.preguntas.index','Listado de Preguntas Frecuentes','web','2022-09-25 09:28:24','2022-09-25 09:28:24'),
(53,'admin.preguntas.crear','Registro de Preguntas Frecuentes','web','2022-09-25 09:28:24','2022-09-25 09:28:24'),
(54,'admin.preguntas.actualizar','Actualizar Preguntas Frecuentes','web','2022-09-25 09:28:24','2022-09-25 09:28:24'),
(55,'admin.preguntas.eliminar','Eliminar Preguntas Frecuentes','web','2022-09-25 09:28:24','2022-09-25 09:28:24'),
(56,'admin.preguntas.activar','Activar Preguntas Frecuentes','web','2022-09-25 09:28:24','2022-09-25 09:28:24'),
(57,'admin.preguntas.desactivar','Desactivar Preguntas Frecuentes','web','2022-09-25 09:28:24','2022-09-25 09:28:24'),
(58,'admin.usuarios.index','Listado de Usuarios','web','2022-09-25 09:28:24','2022-09-25 09:28:24'),
(59,'admin.usuarios.crear','Registro de Usuario','web','2022-09-25 09:28:24','2022-09-25 09:28:24'),
(60,'admin.usuarios.actualizar','Actualizar Usuario','web','2022-09-25 09:28:24','2022-09-25 09:28:24'),
(61,'admin.usuarios.eliminar','Eliminar Usuario','web','2022-09-25 09:28:24','2022-09-25 09:28:24'),
(62,'admin.usuarios.activar','Activar Usuario','web','2022-09-25 09:28:25','2022-09-25 09:28:25'),
(63,'admin.usuarios.desactivar','Desactivar Usuario','web','2022-09-25 09:28:25','2022-09-25 09:28:25'),
(64,'admin.roles.index','Listado de Roles','web','2022-09-25 09:28:25','2022-09-25 09:28:25'),
(65,'admin.roles.crear','Registro de Rol','web','2022-09-25 09:28:25','2022-09-25 09:28:25'),
(66,'admin.roles.actualizar','Actualizar Rol','web','2022-09-25 09:28:25','2022-09-25 09:28:25'),
(67,'admin.roles.eliminar','Eliminar Rol','web','2022-09-25 09:28:25','2022-09-25 09:28:25'),
(68,'admin.roles.activar','Activar Rol','web','2022-09-25 09:28:25','2022-09-25 09:28:25'),
(69,'admin.roles.desactivar','Desactivar Rol','web','2022-09-25 09:28:25','2022-09-25 09:28:25'),
(70,'admin.medios_pago.index','Listado de Medios de Pago','web','2022-09-27 18:47:19','2022-09-27 18:47:22'),
(71,'admin.medios_pago.crear','Registro de Medios de Pago','web','2022-09-27 18:47:24','2022-09-27 18:47:25'),
(72,'admin.medios_pago.actualizar','Actualizar Medios de Pago','web','2022-09-27 18:47:50','2022-09-27 18:47:51'),
(73,'admin.medios_pago.eliminar','Eliminar Medios de Pago','web','2022-09-27 18:48:04','2022-09-27 18:48:05'),
(74,'admin.medios_pago_activar','Activar Medio de Pago','web','2022-09-27 19:00:23','2022-09-27 19:00:24'),
(75,'admin.medios_pago.desactivar','Desactivar Medio de Pago','web','2022-09-27 19:00:40','2022-09-27 19:00:40'),
(76,'admin.moneda.index','Listado de Monedas','web','2022-09-27 20:31:50','2022-09-27 20:31:51'),
(77,'admin.moneda.crear','Registro de Moneda','web','2022-09-27 20:32:50','2022-09-27 20:32:50'),
(78,'admin.moneda.actualizar','Actualizar Moneda','web','2022-09-27 20:33:11','2022-09-27 20:33:11'),
(79,'admin.moneda.eliminar','Eliminar Moneda','web','2022-09-27 20:33:27','2022-09-27 20:33:27'),
(80,'admin.moneda.activar','Activar Moneda','web','2022-09-27 20:34:02','2022-09-27 20:34:02'),
(81,'admin.moneda.desactivar','Desactivar Moneda','web','2022-09-27 20:34:17','2022-09-27 20:34:17'),
(82,'admin.menu.index','Listado de Menu','web','2022-09-29 05:03:37','2022-09-29 05:03:38'),
(83,'admin.menu.crear','Registro de Menu','web','2022-09-29 05:03:54','2022-09-29 05:03:55'),
(84,'admin.menu.actualizar','Actualizar Menu','web','2022-09-29 05:04:06','2022-09-29 05:04:07'),
(85,'admin.menu.eliminar','Eliminar Menu','web','2022-09-29 05:04:40','2022-09-29 05:04:40'),
(86,'admin.menu.activar','Activar Menu','web','2022-09-29 05:05:07','2022-09-29 05:05:07'),
(87,'admin.menu.desactivar','Desactivar Menu','web','2022-09-29 05:05:22','2022-09-29 05:05:22'),
(91,'admin.menu.up','Subir Posicion Menu','web','2022-09-29 05:08:49','2022-09-29 05:08:49'),
(92,'admin.menu.down','Bajar Posicion Menu','web','2022-09-29 05:09:02','2022-09-29 05:09:02'),
(93,'admin.estilos.index','Listado de Estilos','web','2022-10-02 07:40:17','2022-10-02 07:40:17'),
(94,'admin.estilos.actualizar','Actualizar Estilos','web','2022-10-02 07:40:33','2022-10-02 07:40:33'),
(95,'admin.configuracion.index','Listado de configuraciones','web','2022-10-14 03:32:09','2022-10-17 19:17:15'),
(96,'admin.configuracion.actualizar','Actualizar Configuraciones','web','2022-10-14 03:32:09','2022-10-17 19:17:16'),
(97,'admin.descuentos.index','Listar Descuentos','web','2022-10-17 19:17:02','2022-10-17 19:17:03'),
(98,'admin.descuentos.crear','Registro de Descuentos','web','2022-10-17 19:17:37','2022-10-17 19:17:37'),
(99,'admin.descuentos.actualizar','Actualizar Descuentos','web','2022-10-17 19:18:18','2022-10-17 19:18:18'),
(100,'admin.descuentos.eliminar','Eliminar Descuentos','web','2022-10-17 19:18:37','2022-10-17 19:18:38'),
(101,'admin.descuentos.activar','Activar Descuento','web','2022-10-17 19:18:55','2022-10-17 19:18:55'),
(102,'admin.descuentos.desactivar','Desactivar Descuento','web','2022-10-17 19:19:09','2022-10-17 19:19:09'),
(103,'admin.suscripciones.index','Listado de Suscripciones','web','2023-05-03 05:29:18',NULL),
(104,'admin.suscripciones.eliminar','Eliminar Suscripción','web','2023-05-03 05:29:55',NULL),
(105,'admin.noticias_categorias.index','Listado de Noticias Categorías','web','2023-05-03 05:36:37',NULL),
(106,'admin.noticias_categorias.crear','Registro de Noticias Categorías','web','2023-05-03 05:37:11',NULL),
(107,'admin.noticias_categorias.actualizar','Actualizar Noticia Categoria','web','2023-05-03 05:39:48',NULL),
(108,'admin.noticias_categorias.eliminar','Eliminar Noticia Categoría','web','2023-05-03 05:40:05',NULL),
(109,'admin.noticias_categorias.activar','Activar Noticia Categoría','web','2023-05-03 05:40:50',NULL),
(110,'admin.noticias_categorias.desactivar','Desactivar Noticia Categoría','web','2023-05-03 05:41:08',NULL),
(111,'admin.noticias_categorias.visualizar','Visualizar Noticia Sub Categorías','web','2023-05-03 05:41:40',NULL),
(112,'admin.noticias_subcategorias.crear','Crear Noticias Subcategorías','web','2023-05-03 17:40:31',NULL),
(113,'admin.noticias_subcategorias.actualizar','Actualizar Noticia Subcategoria','web','2023-05-03 18:02:54',NULL),
(114,'admin.noticias_subcategorias.eliminar','Eliminar Noticia Subcategoría','web','2023-05-03 18:03:09',NULL),
(115,'admin.noticias_subcategorias.activar','Activar Noticia Subcategoría','web','2023-05-03 18:03:27',NULL),
(116,'admin.noticias_subcategorias.desactivar','Desactivar Noticia Subcategoría','web','2023-05-03 18:05:13',NULL),
(117,'admin.noticias_etiquetas.index','Listado de Noticias Etiquetas','web','2023-05-03 18:16:10',NULL),
(118,'admin.noticias_etiquetas.crear','Crear Noticia Etiqueta','web','2023-05-03 18:16:41',NULL),
(119,'admin.noticias_etiquetas.actualizar','Actualizar Noticia Etiqueta','web','2023-05-03 18:16:39',NULL),
(120,'admin.noticias_etiquetas.eliminar','Eliminar Noticia Etiqueta','web','2023-05-03 18:16:53',NULL),
(121,'admin.noticias_etiquetas.activar','Activar Noticia Etiqueta','web','2023-05-03 18:17:09',NULL),
(122,'admin.noticias_etiquetas.desactivar','Desactivar Noticia Etiqueta','web','2023-05-03 18:17:25',NULL),
(123,'admin.noticias.index','Listado de Noticias','web','2023-05-03 18:22:09',NULL),
(124,'admin.noticias.crear','Crear Noticia','web','2023-05-03 18:22:30',NULL),
(125,'admin.noticias.actualizar','Actualizar Noticia','web','2023-05-03 18:22:45',NULL),
(126,'admin.noticias.eliminar','Eliminar Noticia','web','2023-05-03 18:22:58',NULL),
(127,'admin.noticias.activar','Activar Noticia','web','2023-05-03 18:23:11',NULL),
(128,'admin.noticias.desactivar','Desactivar Noticia','web','2023-05-03 18:23:23',NULL),
(129,'admin.libro_reclamaciones.index','Listado de Libro de Reclamaciones','web','2023-05-03 18:36:57',NULL),
(130,'admin.libro_reclamaciones.mostrar','Mostrar Libro de Reclamaciones','web','2023-05-03 18:37:26',NULL),
(131,'admin.libro_reclamaciones.eliminar','Eliminar Libro de Reclamaciones','web','2023-05-03 18:37:45',NULL),
(132,'admin.ordenes.index','Listado de Ordenes','web','2024-01-07 18:00:53',NULL),
(133,'admin.ordenes.ver_detalle','Ver Detalle de la Orden','web','2024-01-07 18:02:56',NULL),
(134,'admin.ordenes.visualizar_comprobante','Ver comprobante','web','2024-01-07 18:09:42',NULL),
(135,'admin.ordenes.aprobar_orden','Aprobar Orden','web','2024-01-07 18:10:04',NULL),
(136,'admin.ordenes.rechazar_orden','Rechazar Orden','web','2024-01-07 18:10:16',NULL),
(137,'admin.ordenes.atender_orden','Atender Orden','web','2024-01-07 18:10:28',NULL),
(138,'client','Usuario Cliente','web','2022-09-25 09:28:22','2022-09-25 09:28:22');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pregunta__frecuentes`
--

DROP TABLE IF EXISTS `pregunta__frecuentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pregunta__frecuentes` (
  `pregunta_frecuente_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(255) NOT NULL,
  `respuesta` mediumtext NOT NULL,
  `posicion` int(11) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pregunta_frecuente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pregunta__frecuentes`
--

LOCK TABLES `pregunta__frecuentes` WRITE;
/*!40000 ALTER TABLE `pregunta__frecuentes` DISABLE KEYS */;
INSERT INTO `pregunta__frecuentes` VALUES
(1,'¿CÓMO REALIZO LA COMPRA?','<ol>\n	<li>Ingresas al link del producto preferido y lo agrega al carrito</li>\n	<li>Ingresa sus datos y le aparecer&aacute;n los medios de pago</li>\n	<li>Realiza el pago, adjunto el voucher y listo</li>\n</ol>',2,'1','0','','0000-00-00 00:00:00','46749322','2022-09-16 16:48:34',NULL,NULL),
(2,'¿QUE SIGUE POSTERIOR A REALIZAR LA COMPRA?','<p>Al realizar el registro, autom&aacute;ticamente le llegar&aacute; un email de constancia de compra. Por nuestra parte, un encargado lo recepciona y procede su pedido a su correo.</p>',6,'1','0','','0000-00-00 00:00:00','46749322','2022-09-21 00:33:44',NULL,NULL),
(3,'¿CÚAL ES EL TIEMPO DE ENTREGA Y POR DÓNDE?','<p>Tiempo promedio de env&iacute;o: 2 horas , Contacto oficial: correo que registr&oacute; en su compra.</p>',3,'1','0','','0000-00-00 00:00:00','46749322','2022-09-16 16:47:26',NULL,NULL),
(4,'¿HAY DESCUENTOS?','<p>Contamos con las mejores promociones y si quiere participar en sorteos y cupones de descuento debe estar atento a nuestras redes sociales, estamos publicando constantemente.</p>',4,'1','0','','0000-00-00 00:00:00','46749322','2022-09-16 16:47:31',NULL,NULL),
(7,'¿QUE ES UN JUEGO DIGITAL?','<p>El producto es contenido descargable directamente de la p&aacute;gina oficial de SONY. Es un juego en formato digital 100% original , Le enviamos un perfil (Correo y contrase&ntilde;a) con el juego precargado junto con un VIDEOTUTORIAL, &eacute;ste muestra paso a paso el proceso para que pueda realizar una instalaci&oacute;n en su consola.</p>',5,'1','0','','0000-00-00 00:00:00','46749322','2022-09-16 16:47:35',NULL,NULL),
(8,'¿QUÉ NECESITO PARA DESCARGAR EL JUEGO?','<p>Es indispensable tener conexi&oacute;n a internet y espacio disponible en consola.</p>',1,'1','0','','0000-00-00 00:00:00','46749322','2022-12-21 04:01:35',NULL,NULL),
(9,'¿EXISTEN RESTRICCIONES?','<p>No debe eliminar el juego, usuario parcial o de manera total , Si la compra es secundaria, solo debe jugar con la cuenta que nosotros le enviamos, No debe cambiar los datos de la cuenta , ni agregar datos adicionales.</p>',7,'1','0','','0000-00-00 00:00:00','46749322','2022-09-16 16:47:44',NULL,NULL),
(10,'¿CÚANTO TIEMPO ES LA GARANTÍA?','<p>Garant&iacute;a total 6 meses, posterior a ello se brinda un soporte informativo.</p>',8,'1','0','','0000-00-00 00:00:00','46749322','2022-09-16 16:48:22',NULL,NULL),
(11,'¿EXISTE ALGUNA DIFERENCIA ENTRE LOS JUEGOS DIGITALES Y FÍSICOS?','<p>El juego es el mismo en ambos formatos. La diferencia es que uno es contenido descargable en su consola y el otro es un disco.</p>',9,'1','0','','0000-00-00 00:00:00','46749322','2022-09-16 16:47:54',NULL,NULL),
(12,'¿CÓMO REALIZO LA INSTALACIÓN?','<p>La instalaci&oacute;n lo realiza en su consola. Ingresando a la store oficial de sonny. Se le envia un videotutorial paso a paso con los pasos de instalaci&oacute;n.</p>',10,'1','0','','0000-00-00 00:00:00','46749322','2022-09-16 16:48:00',NULL,NULL),
(13,'¿PODRÉ JUGARLO DE MI CUENTA PERSONAL?','<p>Solo podr&aacute; jugar desde su cuenta personal si usted realiza una compra de un juego en versi&oacute;n PRIMARIA. Esto le permitir&aacute; guardar sus avances y trofeos en tu cuenta personal.</p>',11,'1','0','','0000-00-00 00:00:00','46749322','2022-09-21 00:34:43',NULL,NULL),
(14,'¿QUÉ ES CUENTA PRIMARIA?','<p>Con esta cuenta descargas y puedes disfrutar del juego de cualquier usuario que est&eacute; en tu consola o de tu usuario personal. Los trofeos y avances del juego quedan guardados en tu cuenta personal.</p>',12,'0','0','','0000-00-00 00:00:00',NULL,'2022-09-16 15:47:40',NULL,NULL),
(15,'¿QUÉ ES CUENTA SECUNDARIA?','<p>Con esta cuenta descargas el juego y solo podr&aacute;s jugar de esta cuenta que te enviamos. Adem&aacute;s, necesitas conexi&oacute;n a internet de forma permanente para poder jugar.</p>',13,'0','0','','0000-00-00 00:00:00',NULL,'2022-09-16 15:47:54',NULL,NULL);
/*!40000 ALTER TABLE `pregunta__frecuentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto__imagens`
--

DROP TABLE IF EXISTS `producto__imagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto__imagens` (
  `producto__imagens_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `size` varchar(50) NOT NULL,
  `url` text NOT NULL,
  `principal` char(1) NOT NULL,
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`producto__imagens_id`),
  KEY `producto__imagens_producto_id_foreign` (`producto_id`),
  CONSTRAINT `producto__imagens_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=423 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto__imagens`
--

LOCK TABLES `producto__imagens` WRITE;
/*!40000 ALTER TABLE `producto__imagens` DISABLE KEYS */;
INSERT INTO `producto__imagens` VALUES
(390,1,'1721138556_1_BO6_LP-meta_image.jpg','495863','assets/images/productos/1/1721138556_1_BO6_LP-meta_image.jpg','1','','2024-07-16 09:04:06',NULL,NULL,NULL,NULL),
(391,1,'1721138641_0_este-28-de-mayo-tendremos-trailer-de-accion-real-de-call-of-duty-black-ops-6-cover66543','380714','assets/images/productos/1/1721138641_0_este-28-de-mayo-tendremos-trailer-de-accion-real-de-call-of-duty-black-ops-6-cover665432ae0bbfc.jpg','0','','2024-07-16 09:04:06',NULL,NULL,NULL,NULL),
(392,1,'1721138642_1_1366_521.jpeg','90618','assets/images/productos/1/1721138642_1_1366_521.jpeg','0','','2024-07-16 09:04:06',NULL,NULL,NULL,NULL),
(393,1,'1721138642_2_images2.jpeg','9396','assets/images/productos/1/1721138642_2_images2.jpeg','0','','2024-07-16 09:04:06',NULL,NULL,NULL,NULL),
(394,1,'1721138642_3_images.jpeg','8465','assets/images/productos/1/1721138642_3_images.jpeg','0','','2024-07-16 09:04:06',NULL,NULL,NULL,NULL),
(395,2,'1721139952_1_ADAPTADOR USB NANO INALAMBRICO N 150MBPS TL-WN725N.jpg','7536','assets/images/productos/2/1721139952_1_ADAPTADOR USB NANO INALAMBRICO N 150MBPS TL-WN725N.jpg','1','','2024-07-16 09:25:57',NULL,NULL,NULL,NULL),
(396,3,'1721139993_1_MOUSE GENIUS DX-120 USB Negro G5.jpg','6984','assets/images/productos/3/1721139993_1_MOUSE GENIUS DX-120 USB Negro G5.jpg','1','','2024-07-16 09:28:04',NULL,NULL,NULL,NULL),
(397,4,'1721140128_1_DISCO SOLIDO KINGSTON 480GB A400 SATA3.jpg','5889','assets/images/productos/4/1721140128_1_DISCO SOLIDO KINGSTON 480GB A400 SATA3.jpg','1','','2024-07-16 09:30:19',NULL,NULL,NULL,NULL),
(398,5,'1721140245_1_Camara Wi-fi Rotatoria De Seguridad Para Casa Tap C200.jpg','5695','assets/images/productos/5/1721140245_1_Camara Wi-fi Rotatoria De Seguridad Para Casa Tap C200.jpg','1','','2024-07-16 09:32:46',NULL,NULL,NULL,NULL),
(399,6,'1721313834_1_DISCO SOLIDO ADATA 120GB SU650 SATA 2.5.jpg','7705','assets/images/productos/6/1721313834_1_DISCO SOLIDO ADATA 120GB SU650 SATA 2.5.jpg','1','','2024-07-18 09:43:56',NULL,NULL,NULL,NULL),
(400,7,'1721313922_1_FLASH MEMORY KINGSTON DTX 64GB USB3.2.jpg','3126','assets/images/productos/7/1721313922_1_FLASH MEMORY KINGSTON DTX 64GB USB3.2.jpg','1','','2024-07-18 09:45:26',NULL,NULL,NULL,NULL),
(401,8,'1721313988_1_SSD KINGSTON NV1 250GB M.2 PCIe NVMe SNVS-250G.jpg','8640','assets/images/productos/8/1721313988_1_SSD KINGSTON NV1 250GB M.2 PCIe NVMe SNVS-250G.jpg','1','','2024-07-18 09:46:30',NULL,NULL,NULL,NULL),
(402,9,'1721314062_1_MICRO SD-HC KINGSTON 32GB Clase 10.jpg','8965','assets/images/productos/9/1721314062_1_MICRO SD-HC KINGSTON 32GB Clase 10.jpg','1','','2024-07-18 09:47:46',NULL,NULL,NULL,NULL),
(403,11,'1721314216_1_MICRO SD-HC KINGSTON 128GB Clase 10.jpg','8283','assets/images/productos/11/1721314216_1_MICRO SD-HC KINGSTON 128GB Clase 10.jpg','1','','2024-07-18 09:50:18',NULL,NULL,NULL,NULL),
(404,12,'1721314306_1_FLASH MEMORY KINGSTON Data Travele Exodia DTX 32GB USB 3.2.jpg','2125','assets/images/productos/12/1721314306_1_FLASH MEMORY KINGSTON Data Travele Exodia DTX 32GB USB 3.2.jpg','1','','2024-07-18 09:51:52',NULL,NULL,NULL,NULL),
(405,13,'1721314419_1_SSD KINGSTON 240GB A400 SATA 3 2.5Inc. FOR PC O NOTEBOOK 7mm.jpg','6919','assets/images/productos/13/1721314419_1_SSD KINGSTON 240GB A400 SATA 3 2.5Inc. FOR PC O NOTEBOOK 7mm.jpg','1','','2024-07-18 09:53:43',NULL,NULL,NULL,NULL),
(406,14,'1721314532_1_ADATA HD330 - Disco duro - 1 TB.jpg','4657','assets/images/productos/14/1721314532_1_ADATA HD330 - Disco duro - 1 TB.jpg','1','','2024-07-18 09:55:37',NULL,NULL,NULL,NULL),
(407,15,'1721314640_1_FLASH MEMORY KINGSTON Data Travele Exodia DTX 64GB USB 3.2.jpg','7669','assets/images/productos/15/1721314640_1_FLASH MEMORY KINGSTON Data Travele Exodia DTX 64GB USB 3.2.jpg','1','','2024-07-18 09:57:26',NULL,NULL,NULL,NULL),
(408,16,'1721314707_1_CABLE INT. HDMI 2.0MT 4K.jpg','6052','assets/images/productos/16/1721314707_1_CABLE INT. HDMI 2.0MT 4K.jpg','1','','2024-07-18 09:58:32',NULL,NULL,NULL,NULL),
(409,17,'1721314766_1_CABLE INT. HDMI 3.0MT 4K.jpg','5107','assets/images/productos/17/1721314766_1_CABLE INT. HDMI 3.0MT 4K.jpg','1','','2024-07-18 09:59:29',NULL,NULL,NULL,NULL),
(410,18,'1721314819_1_CABLE DE PODER SERIAL-ATA 15CM..jpg','4229','assets/images/productos/18/1721314819_1_CABLE DE PODER SERIAL-ATA 15CM..jpg','1','','2024-07-18 10:00:23',NULL,NULL,NULL,NULL),
(411,19,'1721314875_1_CABLE DE PODER PARA CPU 1.2MT..jpg','5776','assets/images/productos/19/1721314875_1_CABLE DE PODER PARA CPU 1.2MT..jpg','1','','2024-07-18 10:01:18',NULL,NULL,NULL,NULL),
(412,20,'1721314944_1_CABLE DE PODER TREBOL DE 1.2MT..jpg','4565','assets/images/productos/20/1721314944_1_CABLE DE PODER TREBOL DE 1.2MT..jpg','1','','2024-07-18 10:02:29',NULL,NULL,NULL,NULL),
(413,21,'1721315023_1_Xtech - USB cable - 1.8 m.jpg','6221','assets/images/productos/21/1721315023_1_Xtech - USB cable - 1.8 m.jpg','1','','2024-07-18 10:03:46',NULL,NULL,NULL,NULL),
(414,22,'1721315091_1_Nexxt Solutions - Nexxt - Herramienta de fusión cabeza cable.jpg','3890','assets/images/productos/22/1721315091_1_Nexxt Solutions - Nexxt - Herramienta de fusión cabeza cable.jpg','1','','2024-07-18 10:04:56',NULL,NULL,NULL,NULL),
(415,23,'1721315155_1_Adaptador de RED TP-Link UE200 USB 2.0 Ethernet 100Mbps.jpg','2396','assets/images/productos/23/1721315155_1_Adaptador de RED TP-Link UE200 USB 2.0 Ethernet 100Mbps.jpg','1','','2024-07-18 10:05:57',NULL,NULL,NULL,NULL),
(416,24,'1721315221_1_ADAPTADOR USB 3.0 to RJ45 Gigabit Ethernet UE306 Negro.jpg','6493','assets/images/productos/24/1721315221_1_ADAPTADOR USB 3.0 to RJ45 Gigabit Ethernet UE306 Negro.jpg','1','','2024-07-18 10:07:05',NULL,NULL,NULL,NULL),
(417,25,'1721315319_1_MOUSE GENIUS NX-7005 USB Negro.jpg','4146','assets/images/productos/25/1721315319_1_MOUSE GENIUS NX-7005 USB Negro.jpg','1','','2024-07-18 10:08:43',NULL,NULL,NULL,NULL),
(418,26,'1721315376_1_MOUSE GENIUS NX-7005 USB Rojo New Package.jpg','4857','assets/images/productos/26/1721315376_1_MOUSE GENIUS NX-7005 USB Rojo New Package.jpg','1','','2024-07-18 10:09:39',NULL,NULL,NULL,NULL),
(419,27,'1721315448_1_MOUSE GENIUS SCORPION Spear Gaming USB Negro.jpg','7139','assets/images/productos/27/1721315448_1_MOUSE GENIUS SCORPION Spear Gaming USB Negro.jpg','1','','2024-07-18 10:10:49',NULL,NULL,NULL,NULL),
(420,28,'1721315497_1_MOUSE QUASAD QM-610 Wireless Negro.jpg','1939','assets/images/productos/28/1721315497_1_MOUSE QUASAD QM-610 Wireless Negro.jpg','1','','2024-07-18 10:11:40',NULL,NULL,NULL,NULL),
(421,29,'1721315569_1_COMBO TECLADO-MOUSE QUASAD QC-S7500G Wireless Negro.jpg','6550','assets/images/productos/29/1721315569_1_COMBO TECLADO-MOUSE QUASAD QC-S7500G Wireless Negro.jpg','1','','2024-07-18 10:12:52',NULL,NULL,NULL,NULL),
(422,30,'1721315671_1_TECLADO GENIUS SLIMSTAR 126 Wired USB Negro.jpg','7192','assets/images/productos/30/1721315671_1_TECLADO GENIUS SLIMSTAR 126 Wired USB Negro.jpg','1','','2024-07-18 10:14:36',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `producto__imagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto_codigos`
--

DROP TABLE IF EXISTS `producto_codigos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto_codigos` (
  `producto_codigos_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` char(1) NOT NULL,
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`producto_codigos_id`),
  KEY `producto_codigos_producto_id_foreign` (`producto_id`),
  CONSTRAINT `producto_codigos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=421 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto_codigos`
--

LOCK TABLES `producto_codigos` WRITE;
/*!40000 ALTER TABLE `producto_codigos` DISABLE KEYS */;
INSERT INTO `producto_codigos` VALUES
(420,17,'0001','0001','1','0','','2024-07-21 23:58:35',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `producto_codigos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto_m__categorias`
--

DROP TABLE IF EXISTS `producto_m__categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto_m__categorias` (
  `producto_m__categoria_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned NOT NULL,
  `categoria_id` bigint(20) unsigned NOT NULL,
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registra` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`producto_m__categoria_id`),
  KEY `producto_m__categorias_producto_id_foreign` (`producto_id`),
  KEY `producto_m__categorias_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `producto_m__categorias_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`),
  CONSTRAINT `producto_m__categorias_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=326 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto_m__categorias`
--

LOCK TABLES `producto_m__categorias` WRITE;
/*!40000 ALTER TABLE `producto_m__categorias` DISABLE KEYS */;
INSERT INTO `producto_m__categorias` VALUES
(296,1,55,'0','46749322','2024-07-16 09:04:06',NULL,NULL,NULL,NULL),
(297,2,58,'0','46749322','2024-07-16 09:25:57',NULL,NULL,NULL,NULL),
(298,3,58,'0','46749322','2024-07-16 09:28:04',NULL,NULL,NULL,NULL),
(299,4,56,'0','46749322','2024-07-16 09:30:19',NULL,NULL,NULL,NULL),
(300,5,60,'0','46749322','2024-07-16 09:32:46',NULL,NULL,NULL,NULL),
(301,6,56,'0','46749322','2024-07-18 09:43:56',NULL,NULL,NULL,NULL),
(302,7,56,'0','46749322','2024-07-18 09:45:26',NULL,NULL,NULL,NULL),
(303,8,56,'0','46749322','2024-07-18 09:46:30',NULL,NULL,NULL,NULL),
(304,9,56,'0','46749322','2024-07-18 09:47:46',NULL,NULL,NULL,NULL),
(305,10,56,'0','46749322','2024-07-18 09:48:47',NULL,NULL,NULL,NULL),
(306,11,56,'0','46749322','2024-07-18 09:50:18',NULL,NULL,NULL,NULL),
(307,12,56,'0','46749322','2024-07-18 09:51:52',NULL,NULL,NULL,NULL),
(308,13,56,'0','46749322','2024-07-18 09:53:43',NULL,NULL,NULL,NULL),
(309,14,56,'0','46749322','2024-07-18 09:55:37',NULL,NULL,NULL,NULL),
(310,15,56,'0','46749322','2024-07-18 09:57:26',NULL,NULL,NULL,NULL),
(311,16,57,'0','46749322','2024-07-18 09:58:32',NULL,NULL,NULL,NULL),
(312,17,57,'0','46749322','2024-07-18 09:59:29',NULL,NULL,NULL,NULL),
(313,18,57,'0','46749322','2024-07-18 10:00:23',NULL,NULL,NULL,NULL),
(314,19,57,'0','46749322','2024-07-18 10:01:18',NULL,NULL,NULL,NULL),
(315,20,57,'0','46749322','2024-07-18 10:02:29',NULL,NULL,NULL,NULL),
(316,21,57,'0','46749322','2024-07-18 10:03:46',NULL,NULL,NULL,NULL),
(317,22,57,'0','46749322','2024-07-18 10:04:56',NULL,NULL,NULL,NULL),
(318,23,57,'0','46749322','2024-07-18 10:05:57',NULL,NULL,NULL,NULL),
(319,24,57,'0','46749322','2024-07-18 10:07:05',NULL,NULL,NULL,NULL),
(320,25,58,'0','46749322','2024-07-18 10:08:43',NULL,NULL,NULL,NULL),
(321,26,58,'0','46749322','2024-07-18 10:09:39',NULL,NULL,NULL,NULL),
(322,27,58,'0','46749322','2024-07-18 10:10:49',NULL,NULL,NULL,NULL),
(323,28,58,'0','46749322','2024-07-18 10:11:40',NULL,NULL,NULL,NULL),
(324,29,58,'0','46749322','2024-07-18 10:12:52',NULL,NULL,NULL,NULL),
(325,30,58,'0','46749322','2024-07-18 10:14:36',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `producto_m__categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto_m__tags`
--

DROP TABLE IF EXISTS `producto_m__tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto_m__tags` (
  `producto_m__tag_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned NOT NULL,
  `tag_id` bigint(20) unsigned NOT NULL,
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registra` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`producto_m__tag_id`),
  KEY `producto_m__tags_producto_id_foreign` (`producto_id`),
  KEY `producto_m__tags_tag_id_foreign` (`tag_id`),
  CONSTRAINT `producto_m__tags_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`),
  CONSTRAINT `producto_m__tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto_m__tags`
--

LOCK TABLES `producto_m__tags` WRITE;
/*!40000 ALTER TABLE `producto_m__tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `producto_m__tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `producto_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto` varchar(255) NOT NULL,
  `descripcion_producto` text DEFAULT NULL,
  `precio_compra` decimal(12,2) NOT NULL DEFAULT 0.00,
  `precio_anterior` decimal(12,2) DEFAULT 0.00,
  `precio` decimal(12,2) NOT NULL,
  `precio_oferta` decimal(12,2) DEFAULT 0.00,
  `monedas` int(11) DEFAULT NULL,
  `con_stock` char(1) NOT NULL DEFAULT '0',
  `stock` int(11) DEFAULT NULL,
  `url` text NOT NULL,
  `video` mediumtext DEFAULT NULL,
  `carrousel` char(1) NOT NULL DEFAULT '1',
  `estreno` char(1) NOT NULL DEFAULT '1',
  `oferta` char(1) NOT NULL DEFAULT '1',
  `promo_dia` char(1) NOT NULL DEFAULT '1',
  `agotado` char(1) NOT NULL DEFAULT '0',
  `descuento` char(5) DEFAULT NULL,
  `fecha_finalizacion` datetime DEFAULT NULL,
  `envio_domicilio` char(1) NOT NULL DEFAULT '1',
  `recojo` char(1) NOT NULL DEFAULT '1',
  `contraentrega` char(1) NOT NULL DEFAULT '1',
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registra` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES
(1,'Call of Duty Black OPS 6','<p>call of duty</p>',50.00,0.00,70.00,66.50,0,'0',0,'call-of-duty-black-ops-6','https://www.youtube.com/watch?v=otJXZMVgjaI&t=1s','1','1','1','1','1','5','2024-07-17 09:01:38','0','0','0','1','0','46749322','2024-07-16 09:04:06',NULL,NULL,'123456789',NULL,NULL),
(2,'ADAPTADOR USB NANO INALAMBRICO N 150MBPS TL-WN725N','<p>El adaptador USB Nano inalámbrico N 150Mbps TL-WN725N es un dispositivo que se utiliza para añadir conectividad inalámbrica a un dispositivo que no la posee de forma nativa, como una computadora de escritorio o una laptop.</p>\r\n\r\n<p>Tamaño compacto: Al ser de tipo \"Nano\", es muy pequeño y discreto, ideal para dispositivos portátiles.</p>\r\n\r\n<p>Estándar N 150Mbps: Ofrece una velocidad de conexión de hasta 150Mbps, compatible con el estándar inalámbrico N, lo que proporciona una conexión estable y rápida.</p>\r\n\r\n<p>Marca TP-Link: Este adaptador es fabricado por la reconocida marca TP-Link, conocida por sus productos de redes de calidad.</p>',9.00,0.00,11.00,0.00,0,'1',1,'adaptador-usb-nano-inalambrico-n-150mbps-tl-wn725n',NULL,'1','1','1','1','0','0',NULL,'1','1','1','1','0','46749322','2024-07-16 09:25:57',NULL,NULL,'1111',NULL,NULL),
(3,'MOUSE GENIUS DX-120 USB NEGRO G5','<p>El mouse Genius DX-120 USB en color negro es un dispositivo de entrada que se conecta a trav&eacute;s de un puerto USB. Aqu&iacute; tienes una breve descripci&oacute;n del mouse:</p>\r\n\r\n<p>Marca Genius: Es fabricado por la marca Genius, reconocida por sus perif&eacute;ricos de computadora.</p>\r\n\r\n<p>Modelo DX-120: Este modelo en particular ofrece un dise&ntilde;o ergon&oacute;mico y funcionalidad b&aacute;sica para el uso diario.</p>\r\n\r\n<p>Conexi&oacute;n USB: Se conecta f&aacute;cilmente a tu computadora a trav&eacute;s de un puerto USB, lo que lo hace compatible con la mayor&iacute;a de los dispositivos modernos.</p>\r\n\r\n<p>Color Negro: Su color negro cl&aacute;sico lo hace vers&aacute;til y adecuado para cualquier entorno.</p>',5.50,0.00,7.00,0.00,0,'1',2,'mouse-genius-dx-120-usb-negro-g5',NULL,'1','1','1','1','0','0',NULL,'1','1','1','1','0','46749322','2024-07-16 09:28:04','46749322','2024-07-16 09:33:48','1112',NULL,NULL),
(4,'DISCO SOLIDO KINGSTON 480GB A400 SATA3','<p>El disco s&oacute;lido Kingston A400 de 480GB es un dispositivo de almacenamiento de estado s&oacute;lido con una capacidad de 480 gigabytes. Utiliza la interfaz SATA3 para la conexi&oacute;n a la placa base y ofrece velocidades de transferencia de datos m&aacute;s r&aacute;pidas en comparaci&oacute;n con los discos duros tradicionales.&nbsp;</p>',68.00,0.00,78.00,0.00,0,'1',999,'disco-solido-kingston-480gb-a400-sata3',NULL,'1','1','1','1','0','0',NULL,'1','1','1','1','0','46749322','2024-07-16 09:30:19','46749322','2024-08-28 16:06:28','2222',NULL,NULL),
(5,'CAMARA WI-FI ROTATORIA DE SEGURIDAD PARA CASA TAP C200','<p>La c&aacute;mara Wi-Fi rotatoria de seguridad para casa TAP C200 es un dispositivo de vigilancia que se conecta a trav&eacute;s de Wi-Fi para monitorear y garantizar la seguridad de tu hogar. Al ser rotatoria, puede girar en diferentes direcciones para brindar una mayor cobertura de vigilancia. Este tipo de c&aacute;mara suele ofrecer caracter&iacute;sticas como visi&oacute;n nocturna, detecci&oacute;n de movimiento, notificaciones en tiempo real y almacenamiento en la nube para grabaciones</p>',39.00,0.00,44.00,41.80,0,'1',3,'camara-wi-fi-rotatoria-de-seguridad-para-casa-tap-c200',NULL,'1','1','1','1','0','5',NULL,'1','1','1','1','0','46749322','2024-07-16 09:32:46','46749322','2024-07-18 10:39:08','7777',NULL,NULL),
(6,'DISCO SOLIDO ADATA 120GB SU650 SATA 2.5\"','<p>Disco s&oacute;lido SATA de 120GB, ideal para mejorar el rendimiento de tu PC o port&aacute;til. Ofrece mayor velocidad de lectura/escritura en comparaci&oacute;n con los discos duros tradicionales.</p>',35.00,0.00,41.00,0.00,0,'1',2,'disco-solido-adata-120gb-su650-sata-25',NULL,'1','1','1','1','0','0',NULL,'1','1','1','1','0','46749322','2024-07-18 09:43:56','46749322','2024-07-22 08:00:34','000018',NULL,NULL),
(7,'FLASH MEMORY KINGSTON DTX 64GB USB3.2','<p>Memoria USB 3.2 de 64GB, con alta velocidad de transferencia de datos. Ideal para almacenar y transportar archivos de manera r&aacute;pida y segura.</p>',12.00,0.00,14.00,0.00,0,'1',3,'flash-memory-kingston-dtx-64gb-usb32',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 09:45:26','46749322','2024-07-22 08:00:48','000024',NULL,NULL),
(8,'SSD KINGSTON NV1 250GB M.2 PCIe NVMe SNVS-250G','<p>Unidad de estado sólido M.2 PCIe NVMe de 250GB, ideal para portátiles y PCs. Ofrece un rendimiento superior en comparación con los discos duros tradicionales.</p>',45.00,0.00,52.00,0.00,0,'0',0,'ssd-kingston-nv1-250gb-m2-pcie-nvme-snvs-250g',NULL,'1','1','1','1','1','0',NULL,'1','1','0','0','0','46749322','2024-07-18 09:46:30',NULL,NULL,'000038',NULL,NULL),
(9,'MICRO SD-HC KINGSTON 32GB Clase 10','<p>Tarjeta de memoria microSD de 32GB, Clase 10 para un rendimiento óptimo. Perfecta para dispositivos móviles, cámaras, drones y más.</p>',9.00,0.00,11.00,0.00,0,'0',0,'micro-sd-hc-kingston-32gb-clase-10',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 09:47:46',NULL,NULL,'000039',NULL,NULL),
(10,'MICRO SDC10G2 KINGSTON 64GB Clase 10','<p>Tarjeta de memoria microSD de 64GB, Clase 10 para una mayor capacidad. Ideal para almacenar fotos, videos y otros archivos multimedia.</p>',13.00,0.00,15.00,0.00,0,'0',0,'micro-sdc10g2-kingston-64gb-clase-10',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 09:48:47',NULL,NULL,'000040',NULL,NULL),
(11,'MICRO SD-HC KINGSTON 128GB Clase 10','<p>Tarjeta de memoria microSD de 128GB, Clase 10 para almacenamiento masivo. Perfecta para dispositivos que requieren gran capacidad de almacenamiento.</p>',18.00,0.00,21.00,0.00,0,'1',3,'micro-sd-hc-kingston-128gb-clase-10',NULL,'1','1','1','1','0','0',NULL,'1','1','0','0','0','46749322','2024-07-18 09:50:18',NULL,NULL,'000041',NULL,NULL),
(12,'FLASH MEMORY KINGSTON DATA TRAVELE EXODIA DTX 32GB USB 3.2','<p>Memoria USB 3.2 de 32GB, dise&ntilde;o compacto y resistente. Ideal para transferir y almacenar archivos de manera r&aacute;pida y segura.</p>',9.00,0.00,11.00,0.00,0,'1',7,'flash-memory-kingston-data-travele-exodia-dtx-32gb-usb-32',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 09:51:52','46749322','2024-07-18 11:19:58','000045',NULL,NULL),
(13,'SSD KINGSTON 240GB A400 SATA 3 2.5Inc. FOR PC O NOTEBOOK 7mm','<p>Unidad de estado sólido SATA3 de 240GB, compatible con PC y portátiles. Ofrece un rendimiento mejorado en comparación con los discos duros tradicionales.</p>',35.00,0.00,40.00,0.00,0,'1',1,'ssd-kingston-240gb-a400-sata-3-25inc-for-pc-o-notebook-7mm',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 09:53:43',NULL,NULL,'000046',NULL,NULL),
(14,'ADATA HD330 - DISCO DURO - 1 TB','<p>Disco duro externo de 1TB, ideal para almacenamiento masivo de archivos. Ofrece gran capacidad y facilidad de uso.</p>',68.00,0.00,78.00,77.22,0,'1',0,'adata-hd330-disco-duro-1-tb',NULL,'1','1','1','1','0','1',NULL,'1','1','0','1','0','46749322','2024-07-18 09:55:37','46749322','2024-07-18 10:38:37','000056',NULL,NULL),
(15,'FLASH MEMORY KINGSTON DATA TRAVELE EXODIA DTX 64GB USB 3.2','<p>Memoria USB 3.2 de 64GB, dise&ntilde;o compacto y resistente. Perfecta para almacenar y transportar archivos de manera r&aacute;pida y segura.</p>',45.00,0.00,51.00,0.00,0,'1',6,'flash-memory-kingston-data-travele-exodia-dtx-64gb-usb-32',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 09:57:26','46749322','2024-07-23 09:32:51','000063',NULL,NULL),
(16,'CABLE INT. HDMI 2.0MT 4K','<p>Cable HDMI de 2 metros, compatible con resoluci&oacute;n 4K. Ideal para conectar dispositivos multimedia a pantallas o televisores de alta definici&oacute;n.</p>',4.00,0.00,5.75,0.00,0,'1',998,'cable-int-hdmi-20mt-4k',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 09:58:32','46749322','2024-09-02 01:00:20','000015',NULL,NULL),
(17,'CABLE INT. HDMI 3.0MT 4K','<p>Cable HDMI de 3 metros, compatible con resoluci&oacute;n 4K. Perfecto para conectar dispositivos a pantallas o televisores que admiten 4K.</p>',7.00,0.00,8.00,0.00,0,'1',3,'cable-int-hdmi-30mt-4k',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 09:59:29','46749322','2024-07-22 07:59:57','000016',NULL,NULL),
(18,'CABLE DE PODER SERIAL-ATA 15CM.','<p>Cable de alimentaci&oacute;n SATA de 15cm, para conectar discos duros y unidades &oacute;pticas a la fuente de poder. Dise&ntilde;ado para una instalaci&oacute;n ordenada y segura.</p>',3.00,0.00,3.50,0.00,0,'1',3,'cable-de-poder-serial-ata-15cm',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 10:00:23','46749322','2024-07-22 07:59:21','000029',NULL,NULL),
(19,'CABLE DE PODER PARA CPU 1.2MT.','<p>Cable de alimentaci&oacute;n de CPU de 1.2 metros, para conectar la fuente de poder a la placa madre. Ofrece una conexi&oacute;n s&oacute;lida y confiable.</p>',0.00,0.10,3.50,0.00,0,'1',3,'cable-de-poder-para-cpu-12mt',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 10:01:18','46749322','2024-07-22 08:43:54','000030',NULL,NULL),
(20,'CABLE DE PODER TREBOL DE 1.2MT.','<p>Cable de alimentaci&oacute;n tipo \"trebol\" de 1.2 metros, para conectar dispositivos a la fuente de poder. Dise&ntilde;o flexible y duradero.</p>',3.00,0.00,3.50,0.00,0,'1',2,'cable-de-poder-trebol-de-12mt',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 10:02:29','46749322','2024-07-22 07:59:33','000031',NULL,NULL),
(21,'XTECH - USB CABLE - 1.8 M','<p>Cable USB de 1.8 metros, para conectar perif&eacute;ricos a la computadora. Dise&ntilde;o duradero y compatible con la mayor&iacute;a de dispositivos.</p>',7.00,0.00,8.00,0.00,0,'1',0,'xtech-usb-cable-18-m',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 10:03:46','46749322','2024-07-22 14:59:37','000050',NULL,NULL),
(22,'Nexxt Solutions - Nexxt - Herramienta de fusión cabeza cable','<p>Herramienta para fusionar y reparar cables, útil para mantenimiento y reparación de conexiones.</p>',7.00,0.00,8.00,0.00,0,'0',0,'nexxt-solutions-nexxt-herramienta-de-fusion-cabeza-cable',NULL,'1','1','1','1','1','0',NULL,'1','1','0','1','0','46749322','2024-07-18 10:04:56',NULL,NULL,'000051',NULL,NULL),
(23,'ADAPTADOR DE RED TP-LINK UE200 USB 2.0 ETHERNET 100MBPS','<p>Adaptador USB a Ethernet de 100Mbps, para conectar dispositivos a la red. Ideal para agregar conectividad Ethernet a equipos sin puerto Ethernet.</p>',12.00,0.00,13.80,12.28,0,'1',10991,'adaptador-de-red-tp-link-ue200-usb-20-ethernet-100mbps',NULL,'1','1','1','1','0','11',NULL,'1','1','0','1','0','46749322','2024-07-18 10:05:57','46749322','2024-09-04 00:24:30','000081',NULL,NULL),
(24,'ADAPTADOR USB 3.0 TO RJ45 GIGABIT ETHERNET UE306 NEGRO','<p>Adaptador USB 3.0 a Ethernet Gigabit, para una conexi&oacute;n de red r&aacute;pida. Permite agregar conectividad Ethernet Gigabit a equipos sin puerto Ethernet.</p>',16.00,0.00,18.40,0.00,0,'1',3,'adaptador-usb-30-to-rj45-gigabit-ethernet-ue306-negro',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 10:07:05','46749322','2024-07-22 07:57:48','000082',NULL,NULL),
(25,'MOUSE GENIUS NX-7005 USB Negro','<p>Mouse USB óptico con diseño ambidiestro, para una experiencia cómoda. Sensor óptico de alta precisión y botones programables.</p>',10.00,0.00,11.50,0.00,0,'0',0,'mouse-genius-nx-7005-usb-negro',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 10:08:43',NULL,NULL,'000004',NULL,NULL),
(26,'MOUSE GENIUS NX-7005 USB ROJO NEW PACKAGE','<p>Mouse USB &oacute;ptico con dise&ntilde;o ambidiestro en color rojo, elegante y moderno. Sensor &oacute;ptico de alta precisi&oacute;n y botones programables.</p>',10.00,0.00,11.50,0.00,0,'1',3,'mouse-genius-nx-7005-usb-rojo-new-package',NULL,'1','1','1','1','1','0',NULL,'1','1','0','1','0','46749322','2024-07-18 10:09:39','46749322','2024-07-22 08:01:31','000005',NULL,NULL),
(27,'MOUSE GENIUS SCORPION Spear Gaming USB Negro','<p>Mouse USB gaming con diseño ergonómico, ideal para juegos. Sensor óptico de alta precisión y botones programables.</p>',12.00,0.00,13.80,0.00,0,'0',0,'mouse-genius-scorpion-spear-gaming-usb-negro',NULL,'1','1','1','1','1','0',NULL,'1','1','0','1','0','46749322','2024-07-18 10:10:49',NULL,NULL,'000006',NULL,NULL),
(28,'MOUSE QUASAD QM-610 Wireless Negro','<p>Mouse inalámbrico con receptor nano, para mayor comodidad y movilidad. Sensor óptico preciso y diseño ambidiestro.</p>',6.00,0.00,7.00,0.00,0,'0',0,'mouse-quasad-qm-610-wireless-negro',NULL,'1','1','1','1','1','0',NULL,'1','1','0','1','0','46749322','2024-07-18 10:11:40',NULL,NULL,'000007',NULL,NULL),
(29,'COMBO TECLADO-MOUSE QUASAD QC-S7500G WIRELESS NEGRO','<p>Combo teclado y mouse inal&aacute;mbrico, para una configuraci&oacute;n completa. Teclado de membrana y mouse con sensor &oacute;ptico.</p>',11.00,0.00,12.50,0.00,0,'1',3,'combo-teclado-mouse-quasad-qc-s7500g-wireless-negro',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 10:12:52','46749322','2024-07-22 08:00:11','000008',NULL,NULL),
(30,'TECLADO GENIUS SLIMSTAR 126 WIRED USB NEGRO','<p>Teclado USB con dise&ntilde;o delgado y compacto, ideal para espacios reducidos. Teclas de membrana para una experiencia de escritura c&oacute;moda.</p>',11.00,0.00,13.00,0.00,0,'1',91,'teclado-genius-slimstar-126-wired-usb-negro',NULL,'1','1','1','1','0','0',NULL,'1','1','0','1','0','46749322','2024-07-18 10:14:36','46749322','2024-07-30 10:57:21','000009',NULL,NULL);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES
(1,1,NULL,NULL),
(1,3,NULL,NULL),
(1,4,NULL,NULL),
(2,1,NULL,NULL),
(2,4,NULL,NULL),
(3,1,NULL,NULL),
(3,4,NULL,NULL),
(4,1,NULL,NULL),
(4,4,NULL,NULL),
(5,1,NULL,NULL),
(5,4,NULL,NULL),
(6,1,NULL,NULL),
(6,4,NULL,NULL),
(7,1,NULL,NULL),
(7,4,NULL,NULL),
(8,1,NULL,NULL),
(8,4,NULL,NULL),
(9,1,NULL,NULL),
(9,4,NULL,NULL),
(10,1,NULL,NULL),
(10,4,NULL,NULL),
(11,1,NULL,NULL),
(11,4,NULL,NULL),
(12,1,NULL,NULL),
(12,4,NULL,NULL),
(13,1,NULL,NULL),
(13,4,NULL,NULL),
(14,1,NULL,NULL),
(14,4,NULL,NULL),
(15,1,NULL,NULL),
(15,4,NULL,NULL),
(16,1,NULL,NULL),
(16,4,NULL,NULL),
(17,1,NULL,NULL),
(17,4,NULL,NULL),
(18,1,NULL,NULL),
(18,4,NULL,NULL),
(19,1,NULL,NULL),
(19,4,NULL,NULL),
(20,1,NULL,NULL),
(20,4,NULL,NULL),
(21,1,NULL,NULL),
(21,4,NULL,NULL),
(22,1,NULL,NULL),
(22,4,NULL,NULL),
(23,1,NULL,NULL),
(23,4,NULL,NULL),
(24,1,NULL,NULL),
(24,4,NULL,NULL),
(25,1,NULL,NULL),
(25,3,NULL,NULL),
(25,4,NULL,NULL),
(26,1,NULL,NULL),
(26,3,NULL,NULL),
(26,4,NULL,NULL),
(27,1,NULL,NULL),
(27,3,NULL,NULL),
(27,4,NULL,NULL),
(28,1,NULL,NULL),
(28,3,NULL,NULL),
(28,4,NULL,NULL),
(29,1,NULL,NULL),
(29,3,NULL,NULL),
(29,4,NULL,NULL),
(30,1,NULL,NULL),
(30,3,NULL,NULL),
(30,4,NULL,NULL),
(31,1,NULL,NULL),
(31,3,NULL,NULL),
(31,4,NULL,NULL),
(32,1,NULL,NULL),
(32,3,NULL,NULL),
(32,4,NULL,NULL),
(33,1,NULL,NULL),
(33,3,NULL,NULL),
(33,4,NULL,NULL),
(34,1,NULL,NULL),
(34,3,NULL,NULL),
(34,4,NULL,NULL),
(35,1,NULL,NULL),
(35,3,NULL,NULL),
(35,4,NULL,NULL),
(36,1,NULL,NULL),
(36,3,NULL,NULL),
(36,4,NULL,NULL),
(37,1,NULL,NULL),
(37,3,NULL,NULL),
(37,4,NULL,NULL),
(38,1,NULL,NULL),
(38,3,NULL,NULL),
(38,4,NULL,NULL),
(39,1,NULL,NULL),
(39,3,NULL,NULL),
(39,4,NULL,NULL),
(40,1,NULL,NULL),
(40,3,NULL,NULL),
(40,4,NULL,NULL),
(41,1,NULL,NULL),
(41,3,NULL,NULL),
(41,4,NULL,NULL),
(42,1,NULL,NULL),
(42,3,NULL,NULL),
(42,4,NULL,NULL),
(43,1,NULL,NULL),
(43,4,NULL,NULL),
(44,1,NULL,NULL),
(44,3,NULL,NULL),
(44,4,NULL,NULL),
(45,1,NULL,NULL),
(45,3,NULL,NULL),
(45,4,NULL,NULL),
(46,1,NULL,NULL),
(46,3,NULL,NULL),
(46,4,NULL,NULL),
(47,1,NULL,NULL),
(47,3,NULL,NULL),
(47,4,NULL,NULL),
(48,1,NULL,NULL),
(48,3,NULL,NULL),
(48,4,NULL,NULL),
(49,1,NULL,NULL),
(49,3,NULL,NULL),
(49,4,NULL,NULL),
(50,1,NULL,NULL),
(50,3,NULL,NULL),
(50,4,NULL,NULL),
(51,1,NULL,NULL),
(51,3,NULL,NULL),
(51,4,NULL,NULL),
(52,1,NULL,NULL),
(52,4,NULL,NULL),
(53,1,NULL,NULL),
(53,4,NULL,NULL),
(54,1,NULL,NULL),
(54,4,NULL,NULL),
(55,1,NULL,NULL),
(55,4,NULL,NULL),
(56,1,NULL,NULL),
(56,4,NULL,NULL),
(57,1,NULL,NULL),
(57,4,NULL,NULL),
(58,1,NULL,NULL),
(58,4,NULL,NULL),
(59,1,NULL,NULL),
(59,4,NULL,NULL),
(60,1,NULL,NULL),
(60,4,NULL,NULL),
(61,1,NULL,NULL),
(61,4,NULL,NULL),
(62,1,NULL,NULL),
(62,4,NULL,NULL),
(63,1,NULL,NULL),
(63,4,NULL,NULL),
(64,1,NULL,NULL),
(64,4,NULL,NULL),
(65,1,NULL,NULL),
(65,4,NULL,NULL),
(66,1,NULL,NULL),
(66,4,NULL,NULL),
(67,1,NULL,NULL),
(67,4,NULL,NULL),
(68,1,NULL,NULL),
(68,4,NULL,NULL),
(69,1,NULL,NULL),
(69,4,NULL,NULL),
(70,1,NULL,NULL),
(70,4,NULL,NULL),
(71,1,NULL,NULL),
(71,4,NULL,NULL),
(72,1,NULL,NULL),
(72,4,NULL,NULL),
(73,1,NULL,NULL),
(73,4,NULL,NULL),
(74,1,NULL,NULL),
(74,4,NULL,NULL),
(75,1,NULL,NULL),
(75,4,NULL,NULL),
(76,1,NULL,NULL),
(76,4,NULL,NULL),
(77,1,NULL,NULL),
(77,4,NULL,NULL),
(78,1,NULL,NULL),
(78,4,NULL,NULL),
(79,1,NULL,NULL),
(79,4,NULL,NULL),
(80,1,NULL,NULL),
(80,4,NULL,NULL),
(81,1,NULL,NULL),
(81,4,NULL,NULL),
(82,1,NULL,NULL),
(82,4,NULL,NULL),
(83,1,NULL,NULL),
(83,4,NULL,NULL),
(84,1,NULL,NULL),
(84,4,NULL,NULL),
(85,1,NULL,NULL),
(85,4,NULL,NULL),
(86,1,NULL,NULL),
(86,4,NULL,NULL),
(87,1,NULL,NULL),
(87,4,NULL,NULL),
(91,1,NULL,NULL),
(91,4,NULL,NULL),
(92,1,NULL,NULL),
(92,4,NULL,NULL),
(93,1,NULL,NULL),
(93,4,NULL,NULL),
(94,1,NULL,NULL),
(94,4,NULL,NULL),
(95,1,NULL,NULL),
(95,4,NULL,NULL),
(96,1,NULL,NULL),
(96,4,NULL,NULL),
(97,1,NULL,NULL),
(97,4,NULL,NULL),
(98,1,NULL,NULL),
(98,4,NULL,NULL),
(99,1,NULL,NULL),
(99,4,NULL,NULL),
(100,1,NULL,NULL),
(100,4,NULL,NULL),
(101,1,NULL,NULL),
(101,4,NULL,NULL),
(102,1,NULL,NULL),
(102,4,NULL,NULL),
(103,1,NULL,NULL),
(103,4,NULL,NULL),
(104,1,NULL,NULL),
(104,4,NULL,NULL),
(105,1,NULL,NULL),
(105,4,NULL,NULL),
(106,1,NULL,NULL),
(106,4,NULL,NULL),
(107,1,NULL,NULL),
(107,4,NULL,NULL),
(108,1,NULL,NULL),
(108,4,NULL,NULL),
(109,1,NULL,NULL),
(109,4,NULL,NULL),
(110,1,NULL,NULL),
(110,4,NULL,NULL),
(111,1,NULL,NULL),
(111,4,NULL,NULL),
(112,1,NULL,NULL),
(112,4,NULL,NULL),
(113,1,NULL,NULL),
(113,4,NULL,NULL),
(114,1,NULL,NULL),
(114,4,NULL,NULL),
(115,1,NULL,NULL),
(115,4,NULL,NULL),
(116,1,NULL,NULL),
(116,4,NULL,NULL),
(117,1,NULL,NULL),
(117,4,NULL,NULL),
(118,1,NULL,NULL),
(118,4,NULL,NULL),
(119,1,NULL,NULL),
(119,4,NULL,NULL),
(120,1,NULL,NULL),
(120,4,NULL,NULL),
(121,1,NULL,NULL),
(121,4,NULL,NULL),
(122,1,NULL,NULL),
(122,4,NULL,NULL),
(123,1,NULL,NULL),
(123,4,NULL,NULL),
(124,1,NULL,NULL),
(124,4,NULL,NULL),
(125,1,NULL,NULL),
(125,4,NULL,NULL),
(126,1,NULL,NULL),
(126,4,NULL,NULL),
(127,1,NULL,NULL),
(127,4,NULL,NULL),
(128,1,NULL,NULL),
(128,4,NULL,NULL),
(129,1,NULL,NULL),
(129,4,NULL,NULL),
(130,1,NULL,NULL),
(130,4,NULL,NULL),
(131,1,NULL,NULL),
(131,4,NULL,NULL),
(132,1,NULL,NULL),
(132,4,NULL,NULL),
(133,1,NULL,NULL),
(133,4,NULL,NULL),
(134,1,NULL,NULL),
(134,4,NULL,NULL),
(135,1,NULL,NULL),
(135,4,NULL,NULL),
(136,1,NULL,NULL),
(136,4,NULL,NULL),
(137,1,NULL,NULL),
(137,4,NULL,NULL),
(138,100,NULL,NULL);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `estado` char(1) NOT NULL,
  `oculto` char(1) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'administrador','1','0','web','2022-09-25 09:28:20','2022-09-26 19:41:11'),
(3,'developer','1','0','web','2022-09-25 10:47:07','2022-09-25 10:47:07'),
(4,'admin','1','0','web','2024-07-13 11:01:26','2024-08-23 17:17:35'),
(100,'Client','1','0','web','2024-08-23 17:43:28','2024-08-23 17:43:28');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sliders` (
  `slider_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `link` varchar(150) DEFAULT NULL,
  `popup` char(1) NOT NULL,
  `nombre_img` varchar(200) DEFAULT NULL,
  `size_img` varchar(200) DEFAULT NULL,
  `posicion` int(11) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES
(1,'assets/images/sliders/1664898090_1_1664377384_com14-min (1).png',NULL,'0','1664898090_1_1664377384_com14-min (1).png','1731535',6,'0','1','','2022-10-04 15:41:34','46749322','2022-11-21 22:45:21',NULL,NULL),
(2,'assets/images/sliders/1664898233_1_1664580934_neccomp (1) (1).png',NULL,'0','1664898233_1_1664580934_neccomp (1) (1).png','1083466',7,'0','1','','2022-10-04 15:43:55',NULL,NULL,NULL,NULL),
(3,'assets/images/sliders/1669070763_1_1569510626-book-de-pagina-tt2.jpg',NULL,'0','1669070763_1_1569510626-book-de-pagina-tt2.jpg','130797',3,'0','1','','2022-11-21 22:46:07',NULL,NULL,NULL,NULL),
(4,'assets/images/sliders/1669072664_1_1602018798-color-box.jpg',NULL,'0','1669072664_1_1602018798-color-box.jpg','51564',4,'0','1','','2022-11-21 23:17:48',NULL,NULL,NULL,NULL),
(5,'assets/images/sliders/1680908817_1_banner-principal.png',NULL,'0','1680908817_1_banner-principal.png','1665680',5,'0','1','','2023-04-07 23:06:59',NULL,NULL,NULL,NULL),
(6,'assets/images/sliders/1681063567_1_banner_1.webp',NULL,'0','1681063567_1_banner_1.webp','1251292',1,'0','1','','2023-04-09 18:06:10','46749322','2023-04-09 18:06:18',NULL,NULL),
(7,'assets/images/sliders/1681110079_1_banner_2.webp',NULL,'0','1681110079_1_banner_2.webp','1581636',2,'0','0','','2023-04-10 07:01:22','46749322','2023-04-10 07:01:28',NULL,NULL),
(8,'assets/images/sliders/1703745079_1_abnner.png',NULL,'0','1703745079_1_abnner.png','789502',8,'0','1','','2023-12-28 01:31:20',NULL,NULL,NULL,NULL),
(9,'assets/images/sliders/1725398591_1_1681110079_1_banner_2.webp','https://facebook.com','0','1725398591_1_1681110079_1_banner_2.webp','1581636',9,'0','1','','2024-09-03 21:23:19',NULL,NULL,NULL,NULL),
(10,'assets/images/sliders/1725413323_1_imagen 1.jpg',NULL,'0','1725413323_1_imagen 1.jpg','26975',10,'1','1','','2024-09-04 01:28:52',NULL,NULL,NULL,NULL),
(11,'assets/images/sliders/1725414838_1_Q1n0vXd6RySZWUxeCRXxIA.webp','https://facebook.com','0','1725414838_1_Q1n0vXd6RySZWUxeCRXxIA.webp','551300',10,'1','0','','2024-09-04 01:54:03',NULL,NULL,NULL,NULL),
(12,'assets/images/sliders/1725416337_1_JKKJ.jpg',NULL,'0','1725416337_1_JKKJ.jpg','1764723',11,'1','0','','2024-09-04 01:54:20','46749322','2024-09-04 02:18:59',NULL,NULL),
(13,'assets/images/sliders/1725414916_1_lv7pjmAuQyKyn7uu9n7LWg.jpg',NULL,'0','1725414916_1_lv7pjmAuQyKyn7uu9n7LWg.jpg','204957',12,'1','0','','2024-09-04 01:55:19',NULL,NULL,NULL,NULL),
(14,'assets/images/sliders/1725415126_1_,,,.webp',NULL,'0','1725415126_1_,,,.webp','771398',13,'1','0','','2024-09-04 01:58:48',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suscripcions`
--

DROP TABLE IF EXISTS `suscripcions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suscripcions` (
  `suscripcion_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `oculto` char(1) NOT NULL DEFAULT '0',
  `fecha_registro` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`suscripcion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suscripcions`
--

LOCK TABLES `suscripcions` WRITE;
/*!40000 ALTER TABLE `suscripcions` DISABLE KEYS */;
/*!40000 ALTER TABLE `suscripcions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `tag_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(40) NOT NULL,
  `url` text NOT NULL,
  `nombre_img` varchar(200) NOT NULL,
  `size_img` varchar(50) NOT NULL,
  `img` text NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registra` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES
(26,'Juegos','juegos','1721138667_1_images2.jpeg','9396','assets/images/tags/1721138667_1_images2.jpeg','1','1','admin','2024-07-16 09:04:32','46749322','2024-07-17 20:31:34',NULL,NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `foto_name` text DEFAULT NULL,
  `foto_size` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `oculto` char(1) NOT NULL DEFAULT '0',
  `usuario_registro` varchar(12) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` varchar(12) DEFAULT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(2,'ADMIN','ADMIN','admin','mtavila07@gmail.com','Av. Bolivar Mz K Lt 24','997308677','admin_assets/images/usuarios/1725055360_1_Screenshot 2023-11-17 090120.png','1725055360_1_Screenshot 2023-11-17 090120.png','867214',NULL,'$2y$10$WpIdjv7.z7693CY9X9WabOkT9.KE7yUprjk.wqTs6nrrhyTtdT5Tm','1','0','46749322','2022-09-19 17:28:57','46749322','2024-08-30 22:02:44',NULL,NULL,NULL),
(3,'Robert','Baratheon','robert.baratheon','robert.baratheon@gmail.com','bastión de tormentas','','admin_assets/images/usuarios/1663774886_1_304964458_1133329817395021_2745657667970324604_n.jpg','1663774886_1_304964458_1133329817395021_2745657667970324604_n.jpg','18745',NULL,'$2y$10$0u54GcEjVgJp9iM/jfzEN.0xQMF9FMccd/WbFysHncMnaKbXegrkK','1','0','46749322','2022-09-19 18:00:17','46749322','2022-09-26 16:16:16',NULL,NULL,NULL),
(4,'Brandon','Reyes Prado','xinfelicidadx','especial@gmail.com','ventanilla lml','',NULL,NULL,NULL,NULL,'$2y$10$qU2slbmCwt5qQCnjrgaZzemT3MoPl9hPZfRLhlioeIuJvgu0kuXqy','1','0','46749322','2022-09-23 17:30:57',NULL,NULL,NULL,NULL,NULL),
(5,'omar','xyz','omar','ozyz@gmail.com','gda','099999999',NULL,NULL,NULL,NULL,'$2y$10$woR2n8RrkvwHPeaGDGFareQb.qSaXXPUPsph5gNBr6lcRxUoF2E3a','1','0','46749322','2024-07-13 11:04:11',NULL,NULL,NULL,NULL,NULL),
(17,'Eduardo','Guastay','','eduardo.guastay@devsoftec.com','guaranda','0980150689',NULL,NULL,NULL,NULL,'$2y$12$HDeW75s6y9umIca/fkDj1.obTYCcSFGKBdZNQNT2ArZWKNvaClt5y','0','0','','0000-00-00 00:00:00','46749322','2024-08-30 23:49:53','DnhSGoAiLGGjWDAlIlxxPoyvDujpxD19PkD7Py6qU9geLGsaKxDfZp2UA9vr',NULL,NULL),
(18,'Juan','Perez','hi@eduedu.dev','hi@eduedu.dev','Sofia Pesantes y Camino Real','0980150689',NULL,NULL,NULL,NULL,'$2y$12$zmuunmCWq73hDmKj01jGL.7xiBgAqxOLuZ76vuRXnma/8mTxIwDWK','0','0','','0000-00-00 00:00:00',NULL,NULL,'nan9c7OfktTs3w3uV3KMPtWGg6iYIaK4Xgeg4hgh9ARmSHW8KY1QIMqNxTYD',NULL,NULL),
(19,'Omar','Lema','el.omarcito02@gmail.com','el.omarcito02@gmail.com','Chimbo','0999999999',NULL,NULL,NULL,NULL,'$2y$12$Wsk2GL5R4Bx3t5r7rV0WN.iRkMSJ4XPiyRbChjvaIWdNud05gwZDC','0','0','','0000-00-00 00:00:00',NULL,NULL,'fzWSjwyrgUgGK6UNJgvERYKkXe0Arf6TABMng3Nk8lHCdkMmMg6xcmHZeCxk',NULL,NULL),
(20,'Maria','Perez','eduardoguastay1999@gmail.com','eduardoguastay1999@gmail.com','Sofia Pesantes y Camino Real','0980150689',NULL,NULL,NULL,NULL,'$2y$12$Jc2fdthyuUoo1dU87lNg1ursBwceweySrK914Sn0djJLb78uw9L1C','0','0','','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-09 23:12:19
