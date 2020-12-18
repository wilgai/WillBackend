-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2020 at 01:25 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wiltecno`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`Id`, `nombre`) VALUES
(1, 'Comunicacion');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `Id` int(11) NOT NULL,
  `codigo_articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `idFactura` varchar(30) NOT NULL,
  `itbis` int(11) NOT NULL,
  `IdInventario` int(11) NOT NULL,
  `ref` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detalle_factura`
--

INSERT INTO `detalle_factura` (`Id`, `codigo_articulo`, `cantidad`, `precio`, `idFactura`, `itbis`, `IdInventario`, `ref`) VALUES
(4, 2, 1, '7331', 'FAC976555', 0, 0, ''),
(5, 3, 1, '7281', 'FAC416518', 0, 0, ''),
(6, 4, 1, '5656', 'FAC334569', 0, 0, ''),
(7, 2, 1, '7331', 'FAC665744', 0, 2, ''),
(8, 4, 2, '5656', 'FAC616232', 0, 4, ''),
(9, 3, 1, '7281', 'FAC130268', 0, 3, ''),
(11, 2, 1, '7331', 'FAC846121', 0, 2, ''),
(15, 5, 10, '1441', 'FAC758499', 0, 0, ''),
(16, 5, 1, '1441', 'FAC615979', 0, 9, '');

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

CREATE TABLE `factura` (
  `Id` int(11) NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `codigoCliente` varchar(50) NOT NULL,
  `tipoDocumento` varchar(30) NOT NULL,
  `ncf` varchar(50) NOT NULL,
  `referencia` varchar(30) NOT NULL,
  `descuento` decimal(10,0) NOT NULL,
  `detalle` varchar(100) NOT NULL,
  `totaln` decimal(10,0) NOT NULL,
  `itbistot` decimal(10,0) NOT NULL,
  `fecha` datetime NOT NULL,
  `OrderNumber` varchar(30) NOT NULL,
  `metPago` varchar(50) NOT NULL,
  `suplidor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `factura`
--

INSERT INTO `factura` (`Id`, `usuario_registro`, `codigoCliente`, `tipoDocumento`, `ncf`, `referencia`, `descuento`, `detalle`, `totaln`, `itbistot`, `fecha`, `OrderNumber`, `metPago`, `suplidor`) VALUES
(1670254510, 78, 'Juan Jose', 'Factura', '', '', '0', '', '7281', '0', '2020-12-16 00:00:00', 'FAC130268', 'Efectivo', 0),
(209960549, 78, '0', 'Compra', '', '', '0', '', '4525', '0', '2020-12-15 00:00:00', 'FAC334569', 'Efectivo', 9),
(395033868, 78, '0', 'Compra', '', '', '0', '', '5825', '0', '2020-12-15 00:00:00', 'FAC416518', 'Efectivo', 9),
(1796827812, 78, 'Jose pena', 'Factura', '', '', '0', '', '1441', '0', '2020-12-16 00:00:00', 'FAC615979', 'Efectivo', 0),
(723632914, 78, 'Pedro', 'Factura', '', '', '0', '', '11312', '0', '2020-12-16 00:00:00', 'FAC616232', 'Efectivo', 0),
(1744965166, 78, 'Maria Tereza', 'Factura', '', '', '0', '', '7331', '0', '2020-12-16 00:00:00', 'FAC665744', 'Efectivo', 0),
(885157782, 78, '', 'Compra', '', '', '0', '', '11530', '0', '2020-12-16 00:00:00', 'FAC758499', 'Efectivo', 9),
(1994439833, 78, 'Will', 'Factura', '', '', '0', '', '7331', '0', '2020-12-16 00:00:00', 'FAC846121', 'Efectivo', 0),
(1948410684, 78, '0', 'Compra', '', '', '0', '', '5865', '0', '2020-12-15 00:00:00', 'FAC976555', 'Efectivo', 9);

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE `inventario` (
  `Id` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `PrecioCompra` decimal(10,0) NOT NULL,
  `Ganancia` decimal(10,0) NOT NULL,
  `PrecioVenta` decimal(10,0) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Itbis` decimal(10,0) NOT NULL,
  `ref` varchar(50) NOT NULL,
  `IdFactura` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventario`
--

INSERT INTO `inventario` (`Id`, `IdProducto`, `PrecioCompra`, `Ganancia`, `PrecioVenta`, `Cantidad`, `Fecha`, `Itbis`, `ref`, `IdFactura`) VALUES
(2, 2, '5865', '20', '7331', 8, '0000-00-00', '2020', '', 'FAC976555'),
(3, 3, '5825', '20', '7281', 9, '0000-00-00', '2020', '', 'FAC416518'),
(4, 4, '4525', '20', '5656', 9, '0000-00-00', '2020', '', 'FAC334569'),
(9, 5, '1153', '20', '1441', 9, '2020-12-16', '0', '', 'FAC758499');

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE `marca` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marca`
--

INSERT INTO `marca` (`Id`, `nombre`) VALUES
(1, 'Samsung'),
(2, 'Apple');

-- --------------------------------------------------------

--
-- Table structure for table `modelo`
--

CREATE TABLE `modelo` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modelo`
--

INSERT INTO `modelo` (`Id`, `nombre`, `marca`) VALUES
(1, 'A10', 1),
(2, 'X max', 2);

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `codigo_suplidor` int(11) NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_actualizacion` date NOT NULL,
  `tipo_impuesto` varchar(30) NOT NULL,
  `estado` bit(1) NOT NULL,
  `codigo_categoria` int(11) NOT NULL,
  `referencia_interna` varchar(30) NOT NULL,
  `referencia_suplidor` varchar(30) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `oferta` bit(1) NOT NULL,
  `modificar_precio` bit(1) NOT NULL,
  `acepta_descuento` bit(1) NOT NULL,
  `detalle` varchar(100) NOT NULL,
  `codigo_marca` int(11) NOT NULL,
  `porciento_beneficio` int(11) NOT NULL,
  `porciento_minimo` int(11) NOT NULL,
  `modelo` int(11) NOT NULL,
  `Codigo` varchar(30) NOT NULL,
  `garantia` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`Id`, `nombre`, `codigo_suplidor`, `usuario_registro`, `fecha_registro`, `fecha_actualizacion`, `tipo_impuesto`, `estado`, `codigo_categoria`, `referencia_interna`, `referencia_suplidor`, `foto`, `oferta`, `modificar_precio`, `acepta_descuento`, `detalle`, `codigo_marca`, `porciento_beneficio`, `porciento_minimo`, `modelo`, `Codigo`, `garantia`) VALUES
(2, 'Samsung Galaxy a10', 9, 4, '2020-11-05', '2020-11-05', 'Itbis', b'1', 1, 'SA001212232523', 'SA001212232523', 'imagen.png', b'1', b'1', b'1', '', 1, 20, 15, 1, 'E1401122522556552', 0),
(3, 'Samsung Galaxy S10 Plus', 9, 4, '2020-11-05', '2020-11-05', 'Itbis', b'1', 1, 'SA001212232523', 'SA001212232523', 'imagen.png', b'1', b'1', b'1', '', 1, 20, 15, 1, 'E1401122522556552', 0),
(4, 'Samsung Galaxy A31', 9, 4, '2020-11-05', '2020-11-05', 'Itbis', b'1', 1, 'SA001212232523', 'SA001212232523', 'imagen.png', b'1', b'1', b'1', '', 1, 20, 15, 1, 'E1401122522556552', 0),
(5, 'Iphone x max 64gb', 9, 0, '0000-00-00', '0000-00-00', 'Itbis', b'1', 1, '', '', '', b'0', b'0', b'0', '', 1, 0, 0, 1, '5256352525', 0);

-- --------------------------------------------------------

--
-- Table structure for table `suplidor`
--

CREATE TABLE `suplidor` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `rnc` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `web` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `logo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suplidor`
--

INSERT INTO `suplidor` (`Id`, `nombre`, `rnc`, `direccion`, `telefono`, `correo`, `web`, `tipo`, `logo`) VALUES
(6, 'guouogogo', '', 'Santo Domingo', '8299392939', 'gdggdfgfg@gmail.com', '', '4', 'https://firebasestorage.googleapis.com/v0/b/willtechno-8b6a9.appspot.com/o/suplidores%2F1605009358251.png?alt=media&amp;token=0dbf7295-93b2-4bb3-9626-ea13156b6b3c'),
(7, 'rfhtfghg', '14525452', 'Santo Domingo', '8554525452', 'loordajhsdjdf@hotmail.com', '', '4', ''),
(8, 'guouogogok', '12532512', 'Santo Domingo', '8554525452', 'loorhdajhsdjdf@hotmail.com', '', '4', 'https://firebasestorage.googleapis.com/v0/b/willtechno-8b6a9.appspot.com/o/suplidores%2F1605033686374.png?alt=media&amp;token=bcb890c6-fce5-4b3c-9081-14e0cdd37c7b'),
(9, 'Burger king', '1000122525', '3400 Joyce ln', '19408084007', 'lorimecrwilgay23@gmail.comc', '', '5', 'https://firebasestorage.googleapis.com/v0/b/willtechno-8b6a9.appspot.com/o/suplidores%2F1605132866826.png?alt=media&amp;token=48f4a665-1a27-4368-8471-166af8fb3a97');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `identificacion` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL,
  `contrasena` int(50) NOT NULL,
  `sexo` varchar(30) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `estado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`Id`, `nombre`, `direccion`, `identificacion`, `telefono`, `correo`, `usuario`, `tipo_usuario`, `contrasena`, `sexo`, `foto`, `estado`) VALUES
(78, 'Wilgai Lorimer', '', '5fb07jdea17efcf', '9408084007', 'klldgkgkgkgm@gmail.com', 'Lorimer12', 'User', 123456, 'Hombre', 'https://firebasestorage.googleapis.com/v0/b/wilgaisoft-4db06.appspot.com/o/Users%2FWhatsApp-Image-2020-07-28-at-6.28.png_1608000781136?alt=media&amp;token=dce5d582-6d13-4c82-988c-e3a347c1580c', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `clave_Producto` (`codigo_articulo`),
  ADD KEY `id_factura` (`idFactura`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`OrderNumber`),
  ADD KEY `clave_usuario` (`usuario_registro`);

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `claveProducto` (`IdProducto`),
  ADD KEY `OrderId` (`IdFactura`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `clave_Modelo` (`modelo`),
  ADD KEY `clave_Marca` (`codigo_marca`),
  ADD KEY `Codigo_sup` (`codigo_suplidor`),
  ADD KEY `idCategoria` (`codigo_categoria`);

--
-- Indexes for table `suplidor`
--
ALTER TABLE `suplidor`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modelo`
--
ALTER TABLE `modelo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suplidor`
--
ALTER TABLE `suplidor`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `clave_Producto` FOREIGN KEY (`codigo_articulo`) REFERENCES `producto` (`Id`),
  ADD CONSTRAINT `id_factura` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`OrderNumber`);

--
-- Constraints for table `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `clave_usuario` FOREIGN KEY (`usuario_registro`) REFERENCES `usuario` (`Id`);

--
-- Constraints for table `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `OrderId` FOREIGN KEY (`IdFactura`) REFERENCES `factura` (`OrderNumber`),
  ADD CONSTRAINT `claveProducto` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`Id`);

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `Codigo_sup` FOREIGN KEY (`codigo_suplidor`) REFERENCES `suplidor` (`Id`),
  ADD CONSTRAINT `clave_Marca` FOREIGN KEY (`codigo_marca`) REFERENCES `marca` (`Id`),
  ADD CONSTRAINT `clave_Modelo` FOREIGN KEY (`modelo`) REFERENCES `modelo` (`Id`),
  ADD CONSTRAINT `idCategoria` FOREIGN KEY (`codigo_categoria`) REFERENCES `categoria` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
