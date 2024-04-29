Script para criação das tabelas:

CREATE DATABASE `contact_manager` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

CREATE TABLE `campaings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_campains_idcampains` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `campaing_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campain_id_idx` (`campaing_id`),
  CONSTRAINT `campain_id` FOREIGN KEY (`campaing_id`) REFERENCES `campaings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=74869 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

