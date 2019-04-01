-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: sgp
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `bairro`
--

DROP TABLE IF EXISTS `bairro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bairro` (
  `codigoBairro` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valorFrete` double DEFAULT NULL,
  `codigoCidade` int(11) NOT NULL,
  PRIMARY KEY (`codigoBairro`),
  KEY `FK_Bairro_1` (`codigoCidade`),
  CONSTRAINT `FK_Bairro_1` FOREIGN KEY (`codigoCidade`) REFERENCES `cidade` (`codigoCidade`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bairro`
--

LOCK TABLES `bairro` WRITE;
/*!40000 ALTER TABLE `bairro` DISABLE KEYS */;
INSERT INTO `bairro` VALUES (1,'Centro',1.5,1),(2,'Lagoinha',5,1);
/*!40000 ALTER TABLE `bairro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `codigoCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`codigoCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'decoração'),(2,'iluminação'),(3,'materiais de contrução');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cidade`
--

DROP TABLE IF EXISTS `cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cidade` (
  `codigoCidade` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valorFrete` double DEFAULT NULL,
  PRIMARY KEY (`codigoCidade`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cidade`
--

LOCK TABLES `cidade` WRITE;
/*!40000 ALTER TABLE `cidade` DISABLE KEYS */;
INSERT INTO `cidade` VALUES (1,'Belo Horizonte','MG',0);
/*!40000 ALTER TABLE `cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `codigoCliente` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` bigint(20) NOT NULL,
  `situacao` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`codigoCliente`),
  UNIQUE KEY `cliente_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'caio','caio@gmail.com','$2y$10$3D5htO4k8gUPmHmDcwfCKuhoTL72qCX81UrJTGZ.KcDtV0AYoMY6K',31995213213,'A',NULL,'2019-03-31 23:54:40','2019-03-31 23:54:40'),(2,'caio 2','caio2@caio','$2y$10$W.ZeU0lh83ldMdPYTiq5bOw0Q0T7CHWR74KibBG1FQVo5cQI.okZu',12345678,'A',NULL,'2019-04-01 04:38:12','2019-04-01 04:38:12');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `codigoEndereco` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complemento` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  `codigoBairro` int(11) NOT NULL,
  PRIMARY KEY (`codigoEndereco`),
  KEY `FK_Endereco_1` (`codigoBairro`),
  CONSTRAINT `FK_Endereco_1` FOREIGN KEY (`codigoBairro`) REFERENCES `bairro` (`codigoBairro`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (1,'log 1','117','comp 1',NULL,1),(2,'log 1','117','comp 1',NULL,1);
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrega`
--

DROP TABLE IF EXISTS `entrega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrega` (
  `codigoEntrega` int(11) NOT NULL AUTO_INCREMENT,
  `situacao` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigoPedido` int(11) NOT NULL,
  `codigoEndereco` int(11) NOT NULL,
  `codigoEntregador` int(11) NOT NULL,
  PRIMARY KEY (`codigoEntrega`),
  KEY `FK_Entrega_1` (`codigoPedido`),
  KEY `FK_Entrega_2` (`codigoEndereco`),
  KEY `FK_Entrega_3` (`codigoEntregador`),
  CONSTRAINT `FK_Entrega_1` FOREIGN KEY (`codigoPedido`) REFERENCES `pedido` (`codigoPedido`),
  CONSTRAINT `FK_Entrega_2` FOREIGN KEY (`codigoEndereco`) REFERENCES `endereco` (`codigoEndereco`),
  CONSTRAINT `FK_Entrega_3` FOREIGN KEY (`codigoEntregador`) REFERENCES `entregador` (`codigoEntregador`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrega`
--

LOCK TABLES `entrega` WRITE;
/*!40000 ALTER TABLE `entrega` DISABLE KEYS */;
INSERT INTO `entrega` VALUES (1,'A',1,1,1),(2,'A',2,2,1);
/*!40000 ALTER TABLE `entrega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entregador`
--

DROP TABLE IF EXISTS `entregador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entregador` (
  `codigoEntregador` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inicioJornadaTrabalho` int(11) NOT NULL,
  `fimJornadaTrabalho` int(11) NOT NULL,
  `codigoEstabelecimento` int(11) DEFAULT '1',
  PRIMARY KEY (`codigoEntregador`),
  KEY `FK_Entregador_1` (`codigoEstabelecimento`),
  CONSTRAINT `FK_Entregador_1` FOREIGN KEY (`codigoEstabelecimento`) REFERENCES `estabelecimento` (`codigoEstabelecimento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entregador`
--

LOCK TABLES `entregador` WRITE;
/*!40000 ALTER TABLE `entregador` DISABLE KEYS */;
INSERT INTO `entregador` VALUES (1,'Entregador 1',0,1440,1);
/*!40000 ALTER TABLE `entregador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estabelecimento`
--

DROP TABLE IF EXISTS `estabelecimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estabelecimento` (
  `codigoEstabelecimento` int(11) NOT NULL DEFAULT '1',
  `razaoSocial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomeFantasia` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` bigint(20) DEFAULT NULL,
  `inicioJornadaFuncionamento` int(11) NOT NULL,
  `fimJornadaFuncionamento` int(11) NOT NULL,
  `diasFuncionamento` int(11) NOT NULL,
  `identidadeVisual` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`codigoEstabelecimento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estabelecimento`
--

LOCK TABLES `estabelecimento` WRITE;
/*!40000 ALTER TABLE `estabelecimento` DISABLE KEYS */;
INSERT INTO `estabelecimento` VALUES (1,'SGP','SGP',12345678901234,0,1440,127,'G');
/*!40000 ALTER TABLE `estabelecimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionario` (
  `codigoFuncionario` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `administrador` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`codigoFuncionario`),
  UNIQUE KEY `funcionario_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario`
--

LOCK TABLES `funcionario` WRITE;
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2019_03_24_215723_create_bairro_table',1),(3,'2019_03_24_215723_create_categoria_table',1),(4,'2019_03_24_215723_create_cidade_table',1),(5,'2019_03_24_215723_create_cliente_table',1),(6,'2019_03_24_215723_create_endereco_table',1),(7,'2019_03_24_215723_create_entrega_table',1),(8,'2019_03_24_215723_create_entregador_table',1),(9,'2019_03_24_215723_create_estabelecimento_table',1),(10,'2019_03_24_215723_create_funcionario_table',1),(11,'2019_03_24_215723_create_pagamento_table',1),(12,'2019_03_24_215723_create_pedido_produto_table',1),(13,'2019_03_24_215723_create_pedido_table',1),(14,'2019_03_24_215723_create_produto_table',1),(15,'2019_03_24_215723_create_telefone_cliente_table',1),(16,'2019_03_24_215723_create_telefone_entregador_table',1),(17,'2019_03_24_215723_create_telefone_estabelecimento_table',1),(18,'2019_03_24_215723_create_telefone_funcionario_table',1),(19,'2019_03_24_215725_add_foreign_keys_to_bairro_table',1),(20,'2019_03_24_215725_add_foreign_keys_to_endereco_table',1),(21,'2019_03_24_215725_add_foreign_keys_to_entrega_table',1),(22,'2019_03_24_215725_add_foreign_keys_to_entregador_table',1),(23,'2019_03_24_215725_add_foreign_keys_to_pagamento_table',1),(24,'2019_03_24_215725_add_foreign_keys_to_pedido_produto_table',1),(25,'2019_03_24_215725_add_foreign_keys_to_pedido_table',1),(26,'2019_03_24_215725_add_foreign_keys_to_produto_table',1),(27,'2019_03_24_215725_add_foreign_keys_to_telefone_cliente_table',1),(28,'2019_03_24_215725_add_foreign_keys_to_telefone_entregador_table',1),(29,'2019_03_24_215725_add_foreign_keys_to_telefone_estabelecimento_table',1),(30,'2019_03_24_215725_add_foreign_keys_to_telefone_funcionario_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagamento`
--

DROP TABLE IF EXISTS `pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagamento` (
  `codigoPagamento` int(11) NOT NULL AUTO_INCREMENT,
  `valor` double NOT NULL,
  `situacao` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigoPedido` int(11) NOT NULL,
  PRIMARY KEY (`codigoPagamento`),
  KEY `FK_Pagamento_1` (`codigoPedido`),
  CONSTRAINT `FK_Pagamento_1` FOREIGN KEY (`codigoPedido`) REFERENCES `pedido` (`codigoPedido`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagamento`
--

LOCK TABLES `pagamento` WRITE;
/*!40000 ALTER TABLE `pagamento` DISABLE KEYS */;
INSERT INTO `pagamento` VALUES (1,51,'A',1),(2,51,'A',2);
/*!40000 ALTER TABLE `pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `codigoPedido` int(11) NOT NULL AUTO_INCREMENT,
  `valorTotal` double NOT NULL,
  `formaPagamento` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacoes` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `situacao` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizacao` datetime DEFAULT NULL,
  `codigoCliente` int(11) NOT NULL,
  PRIMARY KEY (`codigoPedido`),
  KEY `FK_Pedido_1` (`codigoCliente`),
  CONSTRAINT `FK_Pedido_1` FOREIGN KEY (`codigoCliente`) REFERENCES `cliente` (`codigoCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (1,51,'D','obs 1','A','2019-04-01 02:07:09','2019-04-01 02:07:09',1),(2,51,'D','obs 1','A','2019-04-01 02:19:42','2019-04-01 02:19:42',1);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_produto`
--

DROP TABLE IF EXISTS `pedido_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido_produto` (
  `codigoProduto` int(11) NOT NULL,
  `codigoPedido` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  KEY `FK_pedido_produto_1` (`codigoProduto`),
  KEY `FK_pedido_produto_2` (`codigoPedido`),
  CONSTRAINT `FK_pedido_produto_1` FOREIGN KEY (`codigoProduto`) REFERENCES `produto` (`codigoProduto`),
  CONSTRAINT `FK_pedido_produto_2` FOREIGN KEY (`codigoPedido`) REFERENCES `pedido` (`codigoPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_produto`
--

LOCK TABLES `pedido_produto` WRITE;
/*!40000 ALTER TABLE `pedido_produto` DISABLE KEYS */;
INSERT INTO `pedido_produto` VALUES (1,1,1),(2,1,1),(6,1,2),(1,2,1),(2,2,1),(6,2,2);
/*!40000 ALTER TABLE `pedido_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `codigoProduto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valorUnitario` double NOT NULL,
  `quantidadeEstoque` int(11) NOT NULL DEFAULT '1',
  `codigoCategoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigoProduto`),
  KEY `FK_Produto_1` (`codigoCategoria`),
  CONSTRAINT `FK_Produto_1` FOREIGN KEY (`codigoCategoria`) REFERENCES `categoria` (`codigoCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (1,'Tinta Acrílica Branco','Tinta Acrílica Fosca Coralar Econômica Branco 18L Coral.','P01',10,10,1),(2,'Tinta Acrílica Verde','Tinta Acrílica Fosca Coralar Econômica Verde 18L Coral.','P02',11,10,1),(3,'Tinta Acrílica Azul','Tinta Acrílica Fosca Coralar Econômica Azul 18L Coral.','P03',12,10,1),(4,'Vaso de flores','Vaso de flores de argila com 10 centímetros de altura.','P04',13,10,1),(5,'Tinta Látex Branco','Tinta Látex Maxx PVA 18 Litros Branco Neve Suvinil.','P05',14,10,1),(6,'Tinta Látex Verde','Tinta Látex Maxx PVA 18 Litros Verde Neve Suvinil.','P06',15,10,1),(7,'Tinta Látex Azul','Tinta Látex Maxx PVA 18 Litros Azul Neve Suvinil.','P07',16,10,1),(8,'Lâmpada Eletrônica Fluorescente 15W','Lâmpada Eletrônica Fluorescente com 50W de potência.','P08',17,10,2),(9,'Lâmpada Eletrônica Fluorescente 50W','Lâmpada Eletrônica Fluorescente com 100W de potência.','P09',18,10,2),(10,'Tijolo','Bloco Cerâmico 11,5x14x24cm Nova Conquista','P10',0.75,10,3);
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefone_cliente`
--

DROP TABLE IF EXISTS `telefone_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefone_cliente` (
  `telefoneCliente` bigint(20) NOT NULL,
  `codigoCliente` int(11) NOT NULL,
  KEY `FK_telefone_cliente_1` (`codigoCliente`),
  CONSTRAINT `FK_telefone_cliente_1` FOREIGN KEY (`codigoCliente`) REFERENCES `cliente` (`codigoCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefone_cliente`
--

LOCK TABLES `telefone_cliente` WRITE;
/*!40000 ALTER TABLE `telefone_cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefone_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefone_entregador`
--

DROP TABLE IF EXISTS `telefone_entregador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefone_entregador` (
  `telefoneEntregador` bigint(20) NOT NULL,
  `codigoEntregador` int(11) NOT NULL,
  KEY `FK_telefone_entregador_1` (`codigoEntregador`),
  CONSTRAINT `FK_telefone_entregador_1` FOREIGN KEY (`codigoEntregador`) REFERENCES `entregador` (`codigoEntregador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefone_entregador`
--

LOCK TABLES `telefone_entregador` WRITE;
/*!40000 ALTER TABLE `telefone_entregador` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefone_entregador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefone_estabelecimento`
--

DROP TABLE IF EXISTS `telefone_estabelecimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefone_estabelecimento` (
  `telefoneEstabelecimento` bigint(20) NOT NULL,
  `codigoEstabelecimento` int(11) NOT NULL,
  KEY `FK_telefone_estabelecimento_1` (`codigoEstabelecimento`),
  CONSTRAINT `FK_telefone_estabelecimento_1` FOREIGN KEY (`codigoEstabelecimento`) REFERENCES `estabelecimento` (`codigoEstabelecimento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefone_estabelecimento`
--

LOCK TABLES `telefone_estabelecimento` WRITE;
/*!40000 ALTER TABLE `telefone_estabelecimento` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefone_estabelecimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefone_funcionario`
--

DROP TABLE IF EXISTS `telefone_funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefone_funcionario` (
  `telefoneFuncionario` bigint(20) DEFAULT NULL,
  `codigoFuncionario` int(11) NOT NULL,
  KEY `FK_telefone_funcionario_1` (`codigoFuncionario`),
  CONSTRAINT `FK_telefone_funcionario_1` FOREIGN KEY (`codigoFuncionario`) REFERENCES `funcionario` (`codigoFuncionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefone_funcionario`
--

LOCK TABLES `telefone_funcionario` WRITE;
/*!40000 ALTER TABLE `telefone_funcionario` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefone_funcionario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-01  1:49:30
