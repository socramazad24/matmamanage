-- Script de configuración de la base de datos para XAMPP
-- Ejecutar este script en phpMyAdmin

-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS `mat-manager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `mat-manager`;

-- Tabla de empleados/usuarios
CREATE TABLE IF NOT EXISTS `employee` (
  `idEmployee` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` enum('administrador','gerente','bodeguero') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idEmployee`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar usuario administrador por defecto
-- Usuario: admin, Contraseña: admin123
INSERT INTO `employee` (`username`, `password`, `name`, `role`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador', 'administrador');

-- Tabla de materiales
CREATE TABLE IF NOT EXISTS `materials` (
  `idMaterial` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(20) NOT NULL,
  `min_stock` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMaterial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de proveedores
CREATE TABLE IF NOT EXISTS `providers` (
  `idProvider` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact` varchar(100),
  `phone` varchar(20),
  `email` varchar(100),
  `address` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProvider`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de pedidos
CREATE TABLE IF NOT EXISTS `orders` (
  `idOrder` int(11) NOT NULL AUTO_INCREMENT,
  `idMaterial` int(11) NOT NULL,
  `idProvider` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('pendiente','recibido','cancelado') NOT NULL DEFAULT 'pendiente',
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `received_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idOrder`),
  KEY `idMaterial` (`idMaterial`),
  KEY `idProvider` (`idProvider`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`idMaterial`) REFERENCES `materials` (`idMaterial`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`idProvider`) REFERENCES `providers` (`idProvider`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
