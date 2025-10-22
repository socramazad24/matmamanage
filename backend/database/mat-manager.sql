-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2024 a las 01:44:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mat-manager`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoriamateriales`
--

CREATE TABLE `auditoriamateriales` (
  `idR_material` varchar(10) NOT NULL,
  `idMaterial` varchar(8) NOT NULL,
  `materialName` varchar(15) NOT NULL,
  `description` varchar(30) NOT NULL,
  `costoUnitario` int(10) NOT NULL,
  `cantidadMaterial` int(10) NOT NULL,
  `proveedor` varchar(15) NOT NULL,
  `Action` varchar(15) NOT NULL,
  `idPedido` varchar(10) NOT NULL,
  `date_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auditoriamateriales`
--

INSERT INTO `auditoriamateriales` (`idR_material`, `idMaterial`, `materialName`, `description`, `costoUnitario`, `cantidadMaterial`, `proveedor`, `Action`, `idPedido`, `date_reg`) VALUES
('R01876', 'N001', 'cemento', 'cemento secado rapido', 30000, 9, '', 'actualizado', '', '2023-11-22'),
('R09518', 'N001', 'cemento', 'cemento secado rapido', 30000, 10, 'argo', 'insertado', '', '2023-11-22'),
('R11013', 'P010', 'cobre', 'material conductor', 10000, 10, 'PR004', 'eliminado', '', '2024-06-03'),
('R11473', 'P010', 'cobre', 'material conductor', 10000, 10, 'PR004', 'eliminado', '', '2024-06-03'),
('R26097', 'N001', 'cemento', 'cemento secado rapido', 30000, 9, 'argo', 'actualizado', '', '2023-11-22'),
('R31103', 'P010', 'cobre', 'material conductor', 10000, 10, 'PR004', 'eliminado', '', '2024-06-03'),
('R32745', 'N001', 'cemento', 'cemento secado rapido', 30000, 15, 'argo', 'actualizado', '', '2023-11-22'),
('R47843', 'P010', 'cobre', 'material conductor', 10000, 10, 'PR004', 'insertado', '', '2024-06-03'),
('R50650', 'P010', 'cobre', 'material conductor', 10000, 10, 'PR004', 'insertado', 'P010', '2024-06-05'),
('R56619', 'P010', 'cobre', 'material conductor', 10000, 10, 'PR004', 'insertado', 'P010', '2024-06-05'),
('R59956', 'P010', 'cobre', 'material conductor', 10000, 10, 'PR004', 'eliminado', '', '2024-06-03'),
('R74508', 'MAT001', 'Material Test', 'Descripción de prueba', 10, 100, 'PROV001', 'insertado', 'PED001', '0000-00-00'),
('R79356', 'P010', 'cobre', 'material conductor', 10000, 10, 'PR004', 'insertado', 'P010', '2024-06-05'),
('R81384', 'P010', 'cobre', 'material conductor', 10000, 10, 'PR004', 'insertado', '', '2024-06-03'),
('R86620', 'P010', 'cobre', 'material conductor', 10000, 10, 'PR004', 'eliminado', 'P010', '2024-06-05'),
('R91964', 'P010', 'cobre', 'material conductor', 10000, 10, 'PR004', 'eliminado', 'P010', '2024-06-05'),
('R92986', 'P111', 'pintura verde', 'base de agua', 10000, 100, 'PR004', 'insertado', 'P111', '0000-00-00'),
('R93124', 'P023', 'varillas', 'varillas de acero', 100000, 20, 'PR004', 'insertado', 'P023', '2024-06-05'),
('R96169', 'P010', 'cobre', 'material conductor', 10000, 10, 'PR004', 'insertado', '', '2024-06-03'),
('R98428', 'N001', 'cemento', 'cemento secado rapido', 30000, 15, 'argo', 'actualizado', '', '2023-11-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialpedidos`
--

CREATE TABLE `historialpedidos` (
  `idRegPedido` varchar(10) NOT NULL,
  `idPedido` varchar(10) NOT NULL,
  `nameProovedor` varchar(20) NOT NULL,
  `material` varchar(30) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `precioUnitario` int(10) NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `accion` varchar(20) NOT NULL,
  `date_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historialpedidos`
--

INSERT INTO `historialpedidos` (`idRegPedido`, `idPedido`, `nameProovedor`, `material`, `Description`, `cantidad`, `precioUnitario`, `Estado`, `accion`, `date_reg`) VALUES
('RP02859', 'P023 ', 'PR004', 'varillas', 'varillas de acero', 20, 100000, 'Recibido', 'Actualizado', '2024-06-05'),
('RP14851', 'P005 ', 'megamex', 'cobre', '', 100, 100000, '', 'agredado', '2024-05-02'),
('RP21927', 'P010 ', 'cobre', 'cobre', '', 10, 10000, 'Recibido', 'Actualizado', '2024-05-30'),
('RP45013', 'P010 ', 'cobre', 'cobre', '', 10, 10000, '', 'agredado', '2024-05-30'),
('RP49710', 'P111 ', 'PR004', 'pintura verde', 'base de agua', 100, 10000, 'Pendiente', 'Registrado', '2024-06-11'),
('RP65029', 'P004 ', 'argo', 'CEMENTO', '', 30, 30000, '', 'eliminado', '2023-11-22'),
('RP77167', 'P023 ', 'PR004', 'varillas', 'varillas de acero', 20, 100000, 'Pendiente', 'Registrado', '2024-06-05'),
('RP83389', 'P001 ', 'PR001', 'cemento', '', 20, 30000, '', 'actualizado', '2023-11-22'),
('RP88471', 'P111 ', 'PR004', 'pintura verde', 'base de agua', 100, 10000, 'Recibido', 'Actualizado', '2024-06-11'),
('RP95088', 'P002 ', 'cobre', 'cobre conductor', '', 10, 5000, '', 'eliminado', '2023-11-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialproveedores`
--

CREATE TABLE `historialproveedores` (
  `idRegProveedor` varchar(10) NOT NULL,
  `idProveedor` varchar(10) NOT NULL,
  `nameProveedor` varchar(30) NOT NULL,
  `materiales` varchar(30) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `accion` varchar(30) NOT NULL,
  `date_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historialproveedores`
--

INSERT INTO `historialproveedores` (`idRegProveedor`, `idProveedor`, `nameProveedor`, `materiales`, `telefono`, `correo`, `direccion`, `accion`, `date_reg`) VALUES
('0', 'PR0011', 'metro', 'cemento', '3231411', 'argox@argox.com', 'mareigua', 'agregado', '2024-05-07'),
('R43821', 'PR008', 'ceramica', 'cemento', '3231411', 'argox@argox.com', 'mareigua', 'eliminado', '2024-05-02'),
('R36305', 'PR0011', 'metro', 'cemento', '3231411', 'argox@argox.com', 'mareigua', 'eliminado', '2024-05-07'),
('R67064', 'PR002', 'metro', 'cobre', '3231411', 'metro@metro.com', 'la paz', 'eliminado', '2024-05-01'),
('R02034', 'PR001', 'argox', 'cemento', '32314', 'argox@argox.com', 'mareigua', 'eliminado', '2024-05-01'),
('R83349', 'PR003', 'matro', 'hierro', '3231411', 'metro@metro.com', 'la paz', 'eliminado', '2024-05-01'),
('R80770', 'PR004', 'metro', 'cobre', '3231411', 'argox@argox.com', 'la paz', 'agregado', '2024-05-30'),
('R78908', '123', 'Proveedor 2', 'Material 2', '987654321', 'proveedor2@example.com', 'Direccion 2', 'agregado', '2024-06-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialusers`
--

CREATE TABLE `historialusers` (
  `idRegUser` varchar(10) NOT NULL,
  `idEmployee` varchar(10) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `accion` varchar(20) NOT NULL,
  `date_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historialusers`
--

INSERT INTO `historialusers` (`idRegUser`, `idEmployee`, `firstName`, `lastName`, `username`, `password`, `email`, `phone`, `role`, `accion`, `date_reg`) VALUES
('R33172', '1198', 'silva', 'silba', 'silva', '2401', 'silva@silva.com', 12345, 'bodeguero', 'agregado', '2024-05-02'),
('R50976', '11930400', 'checo', 'sanche', 'checo', '2401', 'checo@checo.com', 12345, 'gerente', 'agregado', '2024-05-02'),
('R74717', '11930400', 'checo', 'sanche', 'checo', '2401', 'checo@checo.com', 12345, 'bodeguero', 'actualizado', '2024-05-07'),
('R74922', '1198', 'silva', 'silba', 'silva', '2401', 'silva@silva.com', 12345, 'bodeguero', 'agregado', '2024-05-02'),
('R78996', '11930400', 'checo', 'sanche', 'checo', '2401', 'marcosdp242@gmail.com', 12345, 'gerente', 'agregado', '2024-05-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `idMaterial` varchar(8) NOT NULL,
  `MaterialName` varchar(15) NOT NULL,
  `Description` varchar(30) NOT NULL,
  `costoUnitario` int(10) NOT NULL,
  `cantidadMaterial` int(10) NOT NULL,
  `idProveedor` varchar(15) NOT NULL,
  `idPedido` varchar(10) NOT NULL,
  `date_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`idMaterial`, `MaterialName`, `Description`, `costoUnitario`, `cantidadMaterial`, `idProveedor`, `idPedido`, `date_reg`) VALUES
('MAT001', 'Material Test', 'Descripción de prueba', 10, 100, 'PROV001', 'PED001', '0000-00-00'),
('N001', 'cemento', 'cemento secado rapido', 30000, 15, 'argo', '', '2023-11-22'),
('P010', 'cobre', 'material conductor', 10000, 10, 'PR004', 'P010', '2024-06-05'),
('P023', 'varillas', 'varillas de acero', 100000, 20, 'PR004', 'P023', '2024-06-05'),
('P111', 'pintura verde', 'base de agua', 10000, 100, 'PR004', 'P111', '0000-00-00');

--
-- Disparadores `materiales`
--
DELIMITER $$
CREATE TRIGGER `TR_REG_MATERIALS` AFTER INSERT ON `materiales` FOR EACH ROW BEGIN
INSERT INTO `auditoriamateriales`(`idR_material`, `idMaterial`, `materialName`, `description`, `costoUnitario`, `cantidadMaterial`, `proveedor`,`action`,`idPedido`, `date_reg`)
 VALUES (CONCAT('R', LPAD(FLOOR(RAND() * 100000), 5, '0')),NEW.idMaterial,NEW.materialName,NEW.description,NEW.costoUnitario,NEW.cantidadMaterial,NEW.idProveedor,'insertado',NEW.idPedido,NEW.date_reg);
 
 UPDATE `pedidos`
    SET `Estado` = 'Recibido'
    WHERE `idPedido` = NEW.idPedido;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_REG_MATERIALS_Delete` BEFORE DELETE ON `materiales` FOR EACH ROW INSERT INTO `auditoriamateriales`(`idR_material`, `idMaterial`, `materialName`, `description`, `costoUnitario`, `cantidadMaterial`, `proveedor`,`action`, `idPedido`,`date_reg`)
 VALUES (CONCAT('R', LPAD(FLOOR(RAND() * 100000), 5, '0')),OLD.idMaterial,OLD.materialName,OLD.description,OLD.costoUnitario,OLD.cantidadMaterial,OLD.idProveedor,'eliminado',OLD.idPedido,OLD.date_reg)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_REG_MATERIALS_UPDATE` BEFORE UPDATE ON `materiales` FOR EACH ROW INSERT INTO `auditoriamateriales`(`idR_material`, `idMaterial`, `materialName`, `description`, `costoUnitario`, `cantidadMaterial`, `proovedor`,`action`,`idPedido`, `date_reg`)
 VALUES (CONCAT('R', LPAD(FLOOR(RAND() * 100000), 5, '0')),NEW.idMaterial,NEW.materialName,NEW.description,NEW.costoUnitario,NEW.cantidadMaterial,NEW.idProveedor,'actualizado',NEW.idPedido,NEW.date_reg)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materialesproveedor`
--

CREATE TABLE `materialesproveedor` (
  `id` varchar(10) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `proveedor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` varchar(10) NOT NULL,
  `idProveedor` varchar(20) NOT NULL,
  `MaterialName` varchar(50) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `cantidadMaterial` int(10) NOT NULL,
  `costoUnitario` int(10) NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `fecha_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `idProveedor`, `MaterialName`, `Description`, `cantidadMaterial`, `costoUnitario`, `Estado`, `fecha_reg`) VALUES
('P001 ', 'PR001', 'cemento', '', 20, 30000, '', '2023-11-22'),
('P003 ', 'megamex', 'pegamento extra fuerte', '', 30, 20000, '', '2023-11-22'),
('P005 ', 'megamex', 'cobre', '', 100, 100000, '', '2024-05-02'),
('P010 ', 'cobre', 'cobre', '', 10, 10000, 'Recibido', '2024-05-30'),
('P023 ', 'PR004', 'varillas', 'varillas de acero', 20, 100000, 'Recibido', '2024-06-05'),
('P111 ', 'PR004', 'pintura verde', 'base de agua', 100, 10000, 'Recibido', '2024-06-11');

--
-- Disparadores `pedidos`
--
DELIMITER $$
CREATE TRIGGER `TR_REG_PEDIDOS_DELETE` BEFORE DELETE ON `pedidos` FOR EACH ROW INSERT INTO `historialpedidos`(`idRegPedido`, `idPedido`, `nameProovedor`, `material`,`Description`, `cantidad`, `precioUnitario`,`Estado`,`accion`, `date_reg`) VALUES (CONCAT('RP', LPAD(FLOOR(RAND() * 100000), 5, '0')),OLD.idPedido,OLD.idProveedor,OLD.MaterialName,OLD.Description,OLD.cantidadMaterial,OLD.costoUnitario,OLD.Estado,'eliminado',OLD.fecha_reg)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_REG_PEDIDOS_INSERT` AFTER INSERT ON `pedidos` FOR EACH ROW INSERT INTO `historialpedidos`(`idRegPedido`, `idPedido`, `nameProovedor`, `material`,`Description`, `cantidad`, `precioUnitario`,`Estado`,`accion`, `date_reg`) VALUES (CONCAT('RP', LPAD(FLOOR(RAND() * 100000), 5, '0')),NEW.idPedido,NEW.idProveedor,NEW.MaterialName,NEW.Description,NEW.cantidadMaterial,NEW.costoUnitario,NEW.Estado,'Registrado',NEW.fecha_reg)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_REG_PEDIDOS_UPDATE` BEFORE UPDATE ON `pedidos` FOR EACH ROW INSERT INTO `historialpedidos`(`idRegPedido`, `idPedido`, `nameProovedor`, `material`,`Description`, `cantidad`, `precioUnitario`,`Estado`,`accion`, `date_reg`) VALUES (CONCAT('RP', LPAD(FLOOR(RAND() * 100000), 5, '0')),NEW.idPedido,NEW.idProveedor,NEW.MaterialName,NEW.Description,NEW.cantidadMaterial,NEW.costoUnitario,NEW.Estado,'Actualizado',NEW.fecha_reg)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proovedores`
--

CREATE TABLE `proovedores` (
  `idProveedor` varchar(10) NOT NULL,
  `nameProveedor` varchar(20) NOT NULL,
  `materiales` varchar(50) NOT NULL,
  `telefono` int(10) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `date_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proovedores`
--

INSERT INTO `proovedores` (`idProveedor`, `nameProveedor`, `materiales`, `telefono`, `correo`, `direccion`, `date_reg`) VALUES
('123', 'Proveedor 2', 'Material 2', 987654321, 'proveedor2@example.com', 'Direccion 2', '2024-06-11'),
('PR004', 'metro', 'cobre', 3231411, 'argox@argox.com', 'la paz', '2024-05-30');

--
-- Disparadores `proovedores`
--
DELIMITER $$
CREATE TRIGGER `RG_DELETE_PROVEEDOR` BEFORE DELETE ON `proovedores` FOR EACH ROW INSERT INTO `historialproveedores`(`idRegProveedor`, `idProveedor`, `nameProveedor`, `materiales`, `telefono`, `correo`, `direccion`, `accion`, `date_reg`) 
VALUES (CONCAT('R', LPAD(FLOOR(RAND() * 100000), 5, '0')),OLD.idProveedor,OLD.nameProveedor,OLD.materiales,OLD.telefono,OLD.correo,OLD.direccion,'eliminado',OLD.date_reg)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `RG_REGISTRO_PROVEEDOR` AFTER INSERT ON `proovedores` FOR EACH ROW INSERT INTO `historialproveedores`(`idRegProveedor`, `idProveedor`, `nameProveedor`, `materiales`, `telefono`, `correo`, `direccion`, `accion`, `date_reg`) 
VALUES (CONCAT('R', LPAD(FLOOR(RAND() * 100000), 5, '0')),NEW.idProveedor,NEW.nameProveedor,NEW.materiales,NEW.telefono,NEW.correo,NEW.direccion,'agregado',NEW.date_reg)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `RG_UPDATE_PROVEEDOR` BEFORE UPDATE ON `proovedores` FOR EACH ROW INSERT INTO `historialproveedores`(`idRegProveedor`, `idProveedor`, `nameProveedor`, `materiales`, `telefono`, `correo`, `direccion`, `accion`, `date_reg`) 
VALUES (CONCAT('R', LPAD(FLOOR(RAND() * 100000), 5, '0')),NEW.idProveedor,NEW.nameProveedor,NEW.materiales,NEW.telefono,NEW.correo,NEW.direccion,'actualizado',NEW.date_reg)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `idEmployee` varchar(10) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` int(10) NOT NULL,
  `role` varchar(20) NOT NULL,
  `date_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idEmployee`, `firstName`, `lastName`, `username`, `password`, `email`, `phone`, `role`, `date_reg`) VALUES
('1193', 'marcos', 'daza', 'marcos', '2401', 'marcosdp@gmail.com', 324564, 'administrador', '2023-11-22'),
('11930400', 'checo', 'sanche', 'checo', '2401', 'checo@checo.com', 12345, 'bodeguero', '2024-05-07'),
('1195', 'sialem', 'smith', 'ssayko', '2401', 'kanbdska@gmail.com', 2465464, 'gerente', '2023-11-22'),
('1196', 'pepi', 'perez', 'pepin', '2401', 'chechales@hola.com', 465456, 'bodeguero', '2023-11-22');

--
-- Disparadores `users`
--
DELIMITER $$
CREATE TRIGGER `TR_REG_USERS_DELETE` BEFORE DELETE ON `users` FOR EACH ROW INSERT INTO `historialusers`(`idRegUser`, `idEmployee`, `firstName`, `lastName`, `username`, `password`, `email`, `phone`, `role`, `accion`, `date_reg`) VALUES (CONCAT('R', LPAD(FLOOR(RAND() * 100000), 5, '0')),old.idEmployee,old.firstName,old.lastName,old.username,old.password,old.email,old.phone,old.role,'eliminado',old.date_reg)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_REG_USERS_INSERT` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO `historialusers`(`idRegUser`, `idEmployee`, `firstName`, `lastName`, `username`, `password`, `email`, `phone`, `role`, `accion`, `date_reg`) VALUES (CONCAT('R', LPAD(FLOOR(RAND() * 100000), 5, '0')),NEW.idEmployee,NEW.firstName,NEW.lastName,NEW.username,NEW.password,NEW.email,NEW.phone,NEW.role,'agregado',NEW.date_reg)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_REG_USERS_UPDATE` BEFORE UPDATE ON `users` FOR EACH ROW INSERT INTO `historialusers`(`idRegUser`, `idEmployee`, `firstName`, `lastName`, `username`, `password`, `email`, `phone`, `role`, `accion`, `date_reg`) VALUES (CONCAT('R', LPAD(FLOOR(RAND() * 100000), 5, '0')),NEW.idEmployee,NEW.firstName,NEW.lastName,NEW.username,NEW.password,NEW.email,NEW.phone,NEW.role,'actualizado',NEW.date_reg)
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoriamateriales`
--
ALTER TABLE `auditoriamateriales`
  ADD PRIMARY KEY (`idR_material`);

--
-- Indices de la tabla `historialpedidos`
--
ALTER TABLE `historialpedidos`
  ADD PRIMARY KEY (`idRegPedido`);

--
-- Indices de la tabla `historialusers`
--
ALTER TABLE `historialusers`
  ADD PRIMARY KEY (`idRegUser`);

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`idMaterial`),
  ADD KEY `idProveedor` (`idProveedor`),
  ADD KEY `idPedido` (`idPedido`);

--
-- Indices de la tabla `materialesproveedor`
--
ALTER TABLE `materialesproveedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor` (`proveedor`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `idProveedor` (`idProveedor`);

--
-- Indices de la tabla `proovedores`
--
ALTER TABLE `proovedores`
  ADD PRIMARY KEY (`idProveedor`),
  ADD KEY `materiales` (`materiales`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idEmployee`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
