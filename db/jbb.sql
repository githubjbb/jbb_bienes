-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-02-2021 a las 21:53:59
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jbb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(10) NOT NULL,
  `numero_inventario` varchar(10) NOT NULL,
  `fk_id_dependencia` int(10) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `numero_serial` varchar(30) NOT NULL,
  `fk_id_tipo_equipo` int(1) NOT NULL,
  `estado_equipo` tinyint(1) NOT NULL COMMENT '1:Activo;2:Inactivo',
  `observacion` text NOT NULL,
  `qr_code_img` varchar(250) NOT NULL,
  `qr_code_encryption` varchar(60) NOT NULL,
  `fecha_adquisicion` date DEFAULT NULL,
  `valor_comercial` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `numero_inventario`, `fk_id_dependencia`, `marca`, `modelo`, `numero_serial`, `fk_id_tipo_equipo`, `estado_equipo`, `observacion`, `qr_code_img`, `qr_code_encryption`, `fecha_adquisicion`, `valor_comercial`) VALUES
(1, '14853', 7, 'Chevrolet ', '2017', '3GNFL7E51HS559955', 1, 1, 'Inventario Yezid ', 'images/equipos/QR/1_qr_code.png', '1FDs8vd21acPIz8bqrhKApdqdTjuxgBTJrs2eS1UmEwlwiwSdbc', '2016-10-12', 98205975),
(2, '14854', 7, 'Nissan', '2017', '3N6CD33B2ZK365122', 1, 1, 'Inventario Yezid ', 'images/equipos/QR/2_qr_code.png', '2jnpWRXLbDdCG8v9QrKJGlR84UXIKqzkhNH9CLm7eScoSMxWn0k', '2016-10-12', 106070140),
(3, '16901', 7, 'Toyota', '2007', '9FH11UJ9079012119', 1, 1, 'Inventario Yezid', 'images/equipos/QR/3_qr_code.png', '3e0L1EUhaZIM0OZ9tdkon8brO7Auo7jL58GE7wg6V1GvqFwinHb', '2006-10-12', 35550000),
(4, '16989', 7, 'Toyota- Hilux', '1996', 'RN1067012769', 1, 1, 'Inventario Yezid', 'images/equipos/QR/4_qr_code.png', '4XnvRyFKtJVZPPzzyRdPYzr1QkgpYtoP0kENJh5D8mQHESej8y4', '1995-10-12', 5400000),
(5, '17129', 7, 'Volkswagen', '2018', '9536G8247JR812344', 1, 1, 'Inventario Yezid', 'images/equipos/QR/5_qr_code.png', '5PiIEUliY7PzZdS0ZDyUCaMNPfv25S1wQ1AlKAwxMlrdNH3N4mM', '2017-10-12', 145443776),
(6, '17710', 7, 'Renault', '2020', '93YMAF4CELJ079626', 1, 1, 'Inventario Yezid', 'images/equipos/QR/6_qr_code.png', '6jxt7Cevdl0j5MHgHuUZh93iOWBxbOTTyXG1FHKKaJuLBwasNvY', '2019-10-12', 252542668),
(7, '17615', 7, 'Chevrolet ', '2020', '9GDFVR345LB008406', 1, 1, 'Inventaro Yezid', 'images/equipos/QR/7_qr_code.png', '7sVXiSAcnge43sw3X0d1p4N8IHCo4LLAlN5cfX5ZRz6kuvJgAc0', '2019-10-12', 215769798),
(8, 'JBB-210002', 7, 'IHM Ignacio Gomez', '15H - 2 4 - Bomba Centrifuga', '97500330', 2, 1, 'Requiere cambió de tablero. La tubería de descarga presenta fuga, requiere cambio de todos los acoples de descarga. Requiere nueva base de soporte.						\r\n						\r\n						', 'images/equipos/QR/8_qr_code.png', '8o55FZnUiVhnFLtO0Jjvg22gMuuvdhVNuo5ukma8YWP2Ba9Plpq', '1989-10-12', 0),
(9, 'JBB-210001', 7, 'Pedrollo', 'CP 21OC - Bomba Centrifuga', '03-15', 2, 1, 'Se encuentra embebida en el concreto, por lo cúal no es posible desmontar. En caso de un correctivo es necesario demoler la base. En el momento no presenta inconvenientes.			\r\n			', 'images/equipos/QR/9_qr_code.png', '9yco2AL3eLHezXBQkPUqqmVGMCEEaDsX0Sq1NDMoDpS8TQxXBn5', '1989-10-12', 0),
(10, 'JBB-210003', 7, 'Pedrollo', 'Dm 20 N - Bomba Sumergible', '100522', 2, 1, 'Requiere embobinado nuevo', 'images/equipos/QR/10_qr_code.png', '10ofiGdyY9pVD6clvzxPHYk4mDakVn67mg6yRlK6wMonBWf1hnZz', '2017-10-12', 0),
(11, 'JBB-210004', 7, 'Pedrollo', 'JC Rm 1B - Bomba centrífuga ', 'Esta borrado', 2, 1, 'Completamente inoperante. Se encuentra totalmente sulfatada. Requiere cambio de capacitor. Embobinado nuevo. Ventilador nuevo. Tornillería nueva', 'images/equipos/QR/11_qr_code.png', '11UUIhnssFMIHN6qK83skU61GCQVfkT6PDnY1wBe3CPevu5Ywt6r', '2014-10-12', 0),
(12, 'JBB-210005', 7, 'Altamira (no fue posible verificar)', 'Se desconoce - Bomba Sumergible', 'Se desconoce', 2, 1, '', 'images/equipos/QR/12_qr_code.png', '12yWLEH7E1LN91xRJJJrbLLRWA0ZMGt737bimakfMpNT8Jgw8y3W', '2016-10-12', 0),
(13, 'JBB-210006', 7, 'Altamira', 'MSQA4 23230', '2200007892-0148', 2, 2, 'Bomba inactica. Sistema electrónico completo. Bomba fuera de servicio. Requiere cambio de motor.', 'images/equipos/QR/13_qr_code.png', '13tZiwQ19BfJvn9BT7mWFVJA8LzNMDgWOEmWu39rVo1D5dG14xad', '2018-10-12', 0),
(14, '13584', 7, 'Dankoff Solar Pumps', 'SunCentric 7324 Bomba Autocenbante', '100012161', 2, 1, ' Las escobillas se encuentra en un 50 % de uso ', 'images/equipos/QR/14_qr_code.png', '14QebZK62XSOjtCPDRyCusQiKitjrb3YmO4vh3hiDT2MFuATKKAs', '0000-00-00', 0),
(15, 'JBB-210007', 7, 'Barnes', '34NH203DS Bomba Sumergible', '1803049', 2, 1, 'Aunque funcionan correctamente. Realizar limpieza y revisión de aceite cada 6 meses', 'images/equipos/QR/15_qr_code.png', '15AtRpIITaDUlMWpgq3xJ9UeyqOSfGTCmJXlZ5UDEDCFmSDhw6aj', '2018-10-12', 0),
(16, '009027', 7, 'IHM Ignacio Gomez', '15H - 2 4 Bomba Centrifuga', '96D0875', 2, 1, 'La bomba enciende y no presenta fugas, sin embargo el sistema de riego se encuentra inoperante. Se desconoce funcionamiento del resto del sistema.', 'images/equipos/QR/16_qr_code.png', '16VUuV32a7wk4Mj8bAJffQ7xToLuDPGStiwihNyV5i7kqBbeYH13', '1999-10-12', 0),
(17, 'JBB-210008', 7, 'IHM Ignacio Gomez', 'MS22-5TW Bomba Sumergible', '83550', 2, 1, 'Aunque funcionan correctamente, el agua que maneja la bomba genera un desgaste generalizado de todos lo componentes.', 'images/equipos/QR/17_qr_code.png', '17mBVeitPbo5vH1iQqbzKVPqQvQzmvzcVLKI9alvCz7mBNUPv6eR', '2016-10-12', 0),
(18, 'JBB-210009', 7, 'IHM Ignacio Gomez', 'MS22-5TW Bomba Sumergible', '83555', 2, 1, 'Aunque funcionan correctamente, el agua que maneja la bomba genera un desgaste generalizado de todos lo componentes.', 'images/equipos/QR/18_qr_code.png', '18GJbv7FUjPWJNhleXtxkFQbGsiZPjH8c1fuzWiCdG3LIS0tUHYe', '0000-00-00', 0),
(19, 'JBB-210010', 7, 'IHM Ignacio Gomez', '5X20 2525TW Bomba Centrifuga', '16160804', 2, 1, 'Equipo fuera de funcionamiento. Fuga en el sistema Requiere urgente cambio de presostatos. Cambio de acoples con manguera en tubería flexible 1/8\"', 'images/equipos/QR/19_qr_code.png', '19ZRJAggAeAWhtS9cZZgTFNOUWVjvERMcDtRT3j8t2T2MMggWSOp', '2016-10-12', 0),
(20, 'JBB-210011', 7, 'IHM Ignacio Gomez', 'VMSS4 60 Bomba Centrifuga', '0012816942', 2, 1, 'Equipo fuera de funcionamiento. No se obervan fugas. La humedad esta oxidando las piezas, aunque se encuentran en buen estado.', 'images/equipos/QR/20_qr_code.png', '204p6TPZODj5gPeo4BrkpvlcPNLgzMZm3dmjp7Q7V3EKLaBTIQ1C', '2016-10-12', 0),
(21, 'JBB-210012', 7, 'Pedrollo', 'Pump top 2 Bomba Sumergible', 'Esta borrado', 2, 1, 'La bomba se encuentra en óptimo estado. En caso de requerir desocupar la fuente es necesario dañar el tapón existente.  ', 'images/equipos/QR/21_qr_code.png', '21RMNhh1FpTTfxd4u5cD1BlAhM0pUHNCu7ZFnhTiaAZc0ZnrW7YP', '2016-10-12', 0),
(22, '011773', 7, 'Evans', '101645 Bomba Centrigufa Autocebante', '7955770000033', 2, 1, 'Se encuentra en buen estado el motor, se recomienda cambiar empaque y sello mecánico aunque funciona bien porqué esta pegado.', 'images/equipos/QR/22_qr_code.png', '22iZEgnJfPxAWQIw1J6uvVQZv1vHz6CNulbbwYo0Q8EEky5eos71', '2008-10-12', 0),
(23, 'JBB-210013', 7, 'Pedrollo', 'Pump top 2 Bomba Sumergible', 'I6ID6H20', 2, 1, 'La bomba funciona, el capacitor tiene carga 10 ?f. Sin embargo el tablero no recibe corriente.', 'images/equipos/QR/23_qr_code.png', '23Y1ngGgRuLdESzi99KVsH9vMp4twnGBJpXvHsOhwKd3y787zkeH', '2016-10-12', 0),
(24, 'JBB-210014', 7, 'Se desconoce', 'Se desconoce - Bomba Sumergible', 'Se desconoce', 2, 1, 'No funciona, no recibe corriente, probablemente quemada, se recomienda cambiar, no se justifica reparación.', 'images/equipos/QR/24_qr_code.png', '24jm39nYsHGsJHVtHlIIjdzPUpnBMSdGJOIuSJg5rtPYxiUSnDAO', '0000-00-00', 0),
(25, '011917', 7, 'Pentair', 'Intelliflo vs +SVRS Bomba Centrifuga', 'E333872', 2, 1, 'La bomba se encuentra en óptimo estado. ', 'images/equipos/QR/25_qr_code.png', '25gg8qbZ0X0vdm6KZkRLlObuL4Zyrdlm80EI4LPo7Ms4GY8l8jp1', '2016-10-12', 0),
(26, 'JBB-210015', 7, 'Pedrollo', 'Pkm 60 Bomba Autocebante', '000902', 2, 1, 'Se encuentra fuera de uso el biodigestor.', 'images/equipos/QR/26_qr_code.png', '26srwmlZcqthyW0gngRGfrfH48A4ypaPbxMMFeVINS6OsgGAQQoO', '2016-10-12', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_control_combustible`
--

CREATE TABLE `equipos_control_combustible` (
  `id_equipo_control_combustible` int(10) NOT NULL,
  `fk_id_equipo_combustible` int(10) NOT NULL,
  `kilometros_actuales` varchar(10) NOT NULL,
  `cantidad` varchar(20) NOT NULL,
  `fecha_combustible` datetime NOT NULL,
  `fk_id_operador_combustible` int(10) NOT NULL,
  `tipo_consumo` tinyint(4) NOT NULL,
  `valor` float NOT NULL,
  `labor_realizada` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_control_combustible`
--

INSERT INTO `equipos_control_combustible` (`id_equipo_control_combustible`, `fk_id_equipo_combustible`, `kilometros_actuales`, `cantidad`, `fecha_combustible`, `fk_id_operador_combustible`, `tipo_consumo`, `valor`, `labor_realizada`) VALUES
(1, 22, '100', '1 cartucho', '2021-02-02 10:12:56', 3, 2, 10000, 'Se engraso la bomba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_detalle_bomba`
--

CREATE TABLE `equipos_detalle_bomba` (
  `id_equipo_detalle_bomba` int(10) NOT NULL,
  `fk_id_equipo_bomba` int(10) NOT NULL,
  `dimension` varchar(50) NOT NULL,
  `motor_frecuencia` varchar(20) NOT NULL,
  `motor_velocidad` varchar(20) NOT NULL,
  `motor_voltaje` varchar(10) NOT NULL,
  `potencia` varchar(10) NOT NULL,
  `consumo` varchar(10) NOT NULL,
  `hmax` varchar(10) NOT NULL,
  `succion` varchar(10) NOT NULL,
  `salida` varchar(30) NOT NULL,
  `qmax` varchar(10) NOT NULL,
  `color` varchar(30) NOT NULL,
  `peso` varchar(10) NOT NULL,
  `caracteristicas` text NOT NULL,
  `condiciones_operacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_detalle_bomba`
--

INSERT INTO `equipos_detalle_bomba` (`id_equipo_detalle_bomba`, `fk_id_equipo_bomba`, `dimension`, `motor_frecuencia`, `motor_velocidad`, `motor_voltaje`, `potencia`, `consumo`, `hmax`, `succion`, `salida`, `qmax`, `color`, `peso`, `caracteristicas`, `condiciones_operacion`) VALUES
(1, 8, '40x25x30 cm', '60 Hz', '3375 rpm', '220 V', '2,4 Hp', '7A', '45 m', '1,5\"', '1,5\"', '90 It/min', 'Naranja', '20 kg', 'En hierro', 'Funciona para succionar agua del reservorio y el túnel de propagación.\r\nSe activa manualmente 3 veces por semana durante una hora. 					'),
(2, 9, '40x25x30 cm', '60 Hz', '3450 rpm', '220 V', '3 Hp', '6,4 A', '45 m', '1,5\"', '1\"', '250 gpm ', 'Azul', '25,3 kg', 'En hierro', 'Funciona para succionar agua del reservorio y regar el invernadero.\r\nSe activa manualmente 3 veces por semana durante una hora. 									\r\n			'),
(3, 10, 'h=34 x d=20 cm', '60 Hz', '3450 rpm ', '220 V', '1 Hp', '5 A', '19 mts', '', '1.5\"', '250 It/min', 'Plata metálico ', '10 kg', 'Bomba sumergible metálica para aguas ligeramente turbias', 'Funciona para evacuar fluidos del biodigestor (posiblemente lixiviados).\r\nNo se encuentra en uso. El biodigestor está fuera de funcionamiento.'),
(4, 11, '37x18x18 cm', '60 Hz', '3455 rpm', '110 V', '0,7 Hp', '6,6 A', '41 m', '1\"', '1\"', '50 It/min', 'Azul', '12 kg', 'En acero', 'La función consiste en circular agua en el sud cerca al lago principal.\r\nTotalmente inoperante. Tablero de encendido sin energía.'),
(5, 12, '', '60 Hz', '', '', 'Hp', '', '', 'N.A.', '1\"', 'gpm', 'Metálico', 'kg', 'En acero', 'Funciona evacuar las aguas que recibe de la zona y regar el herbal (función que no realiza).\r\nPermanece inundada. Requiere de otros equipos para poder evacuar el agua.'),
(6, 13, 'h= 1m x d= 10cm', '60 Hz', '3450rpm', '230V', '2 Hp', '7,6 A', '150m', 'N.A.', '4\"', '', 'Metálico', '15 kg', 'En acero\r\nBomba sumergible tipo bala', 'Funciona para regar el sector de páramo (función que no realiza).\r\nEstos equipo diseñado para operar en condición vertical. Opera en sentido horizontal.'),
(7, 14, '45.7x30.5x25.4 cm', '', '', '12 vdc', '12 gpm', '118 watts', '', '1.25\"', '1\"', '', 'Verde Esmeralda', '20 kg', 'Cabeza máxima: 3 msnm\r\nNo se recomienda para sistemas presurizados\r\nRango de voltaje: 10 A 45 V', 'Funciona por corriente directa de acuerdo a la radiación solar que reciba el panel.\r\nPor la orientación del panel recibe luz directa en la mañana, aunque la vegetación impide en gran medida la llegada de luz solar.'),
(8, 15, 'h=54 d=33 cm', '60 Hz', '3450', '230', '2 Hp', '9 A', '21 m', '3\"', '3\"', '1000 It/mi', 'Azul', '41 kg', 'En hierro\r\nsumergible para aguas negras', 'Funciona para generar la fuente en medio del lago principal del jardín botánico.'),
(9, 16, '40 x 25 x 27 cm', '60 Hz', '3375 rpm', '220 V', '2,4 Hp', '7A', '45 m', '1,5\"', '1,5\"', '90 It/min', 'Naranja', '25 kg', 'En hierro', 'Funciona para succionar agua un tanque enterrado y regardar los invernaderos detrás de científica. Fuera de funcionamiento.'),
(10, 17, '58 x 42 x 82 cm', '60 Hz', '1750 rpm', '220 V', '5 Hp', '', '15 m', '4\"', '4\"', '600 gpm ', 'Naranja', '120 kg', 'En hierro', 'Funciona evacuar las aguas que recibe el pozo eyector del Hebario. Se activa activa automaticamente cuando el flotador indica demasiada agua en el pozo. Alterna con otra bomba. Las aguas que evacuan presentan un color rojizo probablemente por la alta cantidad de hierro que contienen.'),
(11, 18, '58 x 42 x 82 cm', '60 Hz', '1750 rpm', '220 V', '5 Hp', '', '15 m', '4\"', '4\"', '600 gpm', 'Naranja', '120 kg', 'En hierro', 'Funciona evacuar las aguas que recibe el pozo eyector del Hebario. Se activa activa automaticamente cuando el flotador indica demasiada agua en el pozo. Alterna con otra bomba. Las aguas que evacuan presentan un color rojizo probablemente por la alta cantidad de hierro que contienen.'),
(12, 19, '80 x 52 x 52 cm', '60 Hz', '3500 rpm', '220 V', '25Hp', '70 A', '73 m', '2,5\"', '2\" (con cono para tubería 3\")', '420 gpm', 'Rojo', '164 kg', 'En hierro', 'Bomba principal del sistema contraincendio del herbario'),
(13, 20, '104 x 34 x 40 cm', '60 Hz', '3470 rpm ', '220 V', '3Hp', '9', '85 m', '1,25\"', '1,25\"', '35 gpm', 'Rojo', '69 kg', 'En hierro', 'Bomba Jockey del sistema contraincendio del herbario.'),
(14, 21, 'h=26 x d=15 cm', '60 Hz', '3450 rpm', '220 V', '0,5 Hp', '0,37 kw', '360 It/s', '', '', '15,5 mts', 'Blanca con azul', '5 kg', 'Bomba sumergible plástica para aguas lluvias sin componentes abrasivos', 'Funciona para impulsar el agua verticalmente de la fuente de la rosaleda.      \r\nSe activa manualmente a las 7:00 am aprox y se apaga antes de las 4:00 pm.'),
(15, 22, '45.7x30.5x25.4 cm', '60 Hz', '3500 rpm ', '220v', '0,75 Hp', '0,56 kw', '25 m', '1.25\"', '1\"', '172 It/min', 'Naranja', '15 kg', '', 'Principalmente en la noche para reemplazar la bomba de luz solar o en algún evento específico.'),
(16, 23, 'h=26 x d=15 cm', '60 Hz', '3450 rpm', '220 V', '0,5 Hp', '0,37 kw', '15, 5 mts', '', '', '360 It/s', 'Blanco con azul', '5 kg', 'Bomba sumergible plástica para aguas lluvias sin componentes abrasivos.', 'Funciona para impulsar el agua verticamente de la fuente de la olla.\r\nDebería tener un reloj para funcionar por horario pero se encuentra fuera de servicio, tanto el reloj como la fuente.'),
(17, 24, 'h=34 x d=17 cm', '60 Hz', 'Se desconoce', 'Se descono', '0,5 Hp', 'Se descono', '6 mts', '', '', '9000 It/hr', 'Verde y negro', '5 kg', 'Bomba sumergible plástica para aguas lluvias.', 'Funciona para impulsar el agua verticalmente de la fuente del fundador.\r\nDebería tener un reloj para funcionar por horario pero se encuentra fuera de servicio, tanto el reloj como la fuente.'),
(18, 25, '60 x 27 x 33 cm', '60 Hz', '450 a 3450 rpm', '220 V', '3 Hp', '3,2 kw', '30 m', '2\"', '2\"', '100 gpm', 'Blanco hueso', '25 kg', 'Cuenta con sistema de alivio de vacío de seguridad (SVRS).\r\nTermoplástico de polipropileno relleno de vidrio con insertos de latón roscados.', 'Funciona para impulsar el agua en arco de 5 salidas de tubería en la fuente de la entrada principal del Jardín Botánico. Aunque tiene sistema automático, se activa manualmente a las 7:00 am aprox y se apaga antes de las 4:00 pm. Los filtros con que cuenta el sistema completo no están en uso.'),
(19, 26, '21x12x15 cm', '60 Hz', '', '220', '0,5 Hp', '118 watts', '40m', '0,5\"', '1\"', '6 bar', 'Azul', '5 kg', 'Rango de voltaje: 10 A 45 V    ', 'Funciona para impulsar el agua  a un calentador y mantener la circulación de agua caliente en un sistema cerrado con un serpentin que permite calentar el el fluido que inyectan al biodigestor.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_detalle_vehiculo`
--

CREATE TABLE `equipos_detalle_vehiculo` (
  `id_equipo_detalle_vehiculo` int(10) NOT NULL,
  `fk_id_equipo` int(10) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `linea` varchar(50) NOT NULL,
  `color` varchar(30) NOT NULL,
  `fk_id_clase_vechiculo` tinyint(1) NOT NULL,
  `fk_id_tipo_carroceria` tinyint(1) NOT NULL,
  `combustible` tinyint(1) NOT NULL COMMENT '1:Gasolina; 2: Diesel',
  `capacidad` varchar(20) NOT NULL,
  `servicio` varchar(20) NOT NULL,
  `numero_motor` varchar(30) NOT NULL,
  `multas` tinyint(1) NOT NULL COMMENT '1:Si; 2:No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_detalle_vehiculo`
--

INSERT INTO `equipos_detalle_vehiculo` (`id_equipo_detalle_vehiculo`, `fk_id_equipo`, `placa`, `linea`, `color`, `fk_id_clase_vechiculo`, `fk_id_tipo_carroceria`, `combustible`, `capacidad`, `servicio`, `numero_motor`, `multas`) VALUES
(2, 3, 'OBI160', 'Land Cruiser', 'Blanco Artico', 2, 3, 1, '5 personas', 'Oficial', '3433948', 2),
(3, 1, 'OKZ805', 'Captiva Sport', 'Gris mercurio', 1, 1, 1, '5 pasajeros', 'Oficial', 'CHS559955', 2),
(4, 2, 'OKZ764', 'NP300 FRONTIER', 'Blanco', 1, 2, 2, '5 pasajeros', 'Oficial', 'YD25-648189P', 2),
(5, 4, 'BHH611', 'Hilux', 'Roja Bordeaux perlad', 1, 2, 1, '6 personas ', 'Oficial', '4160354', 2),
(6, 5, 'OLO377', 'Constellation-31-330', 'Blanco Geada', 3, 4, 2, '10000 Kg/P', 'Oficial', '0154865A174859', 2),
(7, 6, 'GCW769', 'Nuevo Master', 'Blanco Calma', 4, 5, 1, '20', 'Oficial', 'M9TC678C031094', 2),
(8, 7, 'GCW724', 'FVR', 'Blanco Calma', 5, 6, 2, '2', 'Oficial', '6HK1-224577', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_fotos`
--

CREATE TABLE `equipos_fotos` (
  `id_equipo_foto` int(10) NOT NULL,
  `fk_id_equipo_foto` int(10) NOT NULL,
  `fk_id_user_ef` int(10) NOT NULL,
  `equipo_foto` varchar(250) NOT NULL,
  `fecha_foto` date NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_fotos`
--

INSERT INTO `equipos_fotos` (`id_equipo_foto`, `fk_id_equipo_foto`, `fk_id_user_ef`, `equipo_foto`, `fecha_foto`, `descripcion`) VALUES
(3, 1, 1, 'images/equipos/formulario_equipos.png', '2021-01-19', 'Imagen principal'),
(4, 11, 1, 'images/equipos/SUDS_1.png', '2021-01-22', 'Imagen principal'),
(5, 12, 1, 'images/equipos/SUDS_2.png', '2021-01-22', 'Imagen principal'),
(6, 13, 1, 'images/equipos/SUDS_3.png', '2021-01-22', 'Imagen principal'),
(9, 14, 1, 'images/equipos/PERGOLA_SOLAR.png', '2021-01-22', 'Imagen Principal'),
(10, 15, 1, 'images/equipos/LAGO_PRINCIPAL.png', '2021-01-23', 'Imagen Principal'),
(11, 16, 1, 'images/equipos/INVERNADERO.png', '2021-01-23', 'Imagen Principal'),
(12, 17, 1, 'images/equipos/HERBARIO.png', '2021-01-23', 'Imagen Principal'),
(13, 18, 1, 'images/equipos/HERBARIO_2.png', '2021-01-23', 'Imagen Principal'),
(14, 19, 1, 'images/equipos/HERBARIO_CONTRAINCENDIOS_1.png', '2021-01-23', 'Imagen Principal'),
(15, 20, 1, 'images/equipos/HERBARIO_CONTRAINCENDIOS_2.png', '2021-01-23', 'Imagen Principal'),
(16, 21, 1, 'images/equipos/FUENTE_ROSALEDA.png', '2021-01-24', 'Imagen Principal'),
(17, 9, 1, 'images/equipos/TUNEL_DE_PROPAGACION_INVERNADERO_1.png', '2021-01-24', 'Imagen Principal'),
(18, 8, 1, 'images/equipos/TUNEL_DE_PROPAGACION_INVERNADERO.png', '2021-01-24', 'Imagen Principal'),
(19, 10, 1, 'images/equipos/SUMERGIBLE_COMPOSTAJE_BIODIGESTOR.png', '2021-01-24', 'Imagen Principal'),
(20, 22, 1, 'images/equipos/PERGOLA_SOLAR1.png', '2021-01-24', 'Imagen Principal'),
(21, 23, 1, 'images/equipos/FUENTE_OLLA.png', '2021-01-25', 'Imagen Principal'),
(22, 24, 1, 'images/equipos/FUENTE_FUNDADOR.png', '2021-01-25', 'Imagen Principal'),
(23, 25, 1, 'images/equipos/FUENTE_EXTERNA.png', '2021-01-25', 'Imagen Principal'),
(24, 26, 1, 'images/equipos/ELECTRO_BOMBA_BIODIGESTOR_COMPOSTAJE.png', '2021-01-25', 'Imagen Principal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_localizacion`
--

CREATE TABLE `equipos_localizacion` (
  `id_equipo_localizacion` int(10) NOT NULL,
  `fk_id_equipo_localizacion` int(10) NOT NULL,
  `fk_id_user_localizacion` int(10) NOT NULL,
  `localizacion` varchar(200) NOT NULL,
  `fecha_localizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_localizacion`
--

INSERT INTO `equipos_localizacion` (`id_equipo_localizacion`, `fk_id_equipo_localizacion`, `fk_id_user_localizacion`, `localizacion`, `fecha_localizacion`) VALUES
(1, 1, 0, 'Ibague- Barrio palermo - Manzana 8', '2020-12-24'),
(2, 1, 0, 'Bogotá - Jardin Botanico', '2020-12-18'),
(3, 1, 0, 'Taller del centro - CAD', '2021-01-19'),
(4, 1, 1, 'Jardín Botánico', '2021-01-19'),
(5, 9, 1, 'Cuarto junto al reservorio detrás del túnel de propagación', '2020-10-02'),
(6, 8, 1, 'Cuarto junto al reservorio detrás del tunel de propagación', '2020-10-12'),
(7, 10, 1, 'Zona de Compostaje, biodigestor.', '2020-01-21'),
(8, 11, 1, 'Sud Cerca al lago principal', '2020-02-27'),
(9, 12, 1, 'Sud Herbal', '2020-02-26'),
(10, 13, 1, 'Sud páramo', '2020-02-26'),
(11, 14, 1, 'Pérgola entre el restaurante y el rosario', '2020-01-17'),
(12, 15, 1, 'Centro del Lago Principal', '2020-05-02'),
(13, 16, 1, 'Cuarto de máquinas invernadero científica', '2020-10-02'),
(14, 17, 1, 'Pozo eyector Herbario', '2020-01-22'),
(15, 18, 1, 'Pozo eyector Herbario', '2020-11-01'),
(16, 19, 1, 'Cuarto subterráneo de máquinas Herbario', '2020-02-26'),
(17, 20, 1, 'Cuarto subterráneo de máquinas Herbario', '2020-02-26'),
(18, 21, 1, 'Fuente de la Olla', '2020-01-24'),
(19, 22, 1, 'Pérgola entre el restaurante y el rosario', '2020-01-24'),
(20, 23, 1, 'Fuente de la Olla', '2020-01-30'),
(21, 24, 1, 'Fuente del Fundador', '2020-01-27'),
(22, 25, 1, 'Cuarto de bombas detrás de la fuente externa.', '2020-01-31'),
(23, 26, 1, 'Biodigestor en la zona de Compostaje', '2020-01-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_poliza`
--

CREATE TABLE `equipos_poliza` (
  `id_equipo_poliza` int(10) NOT NULL,
  `fk_id_equipo_poliza` int(10) NOT NULL,
  `fk_id_user_poliza` int(10) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `numero_poliza` varchar(30) NOT NULL,
  `estado_poliza` tinyint(4) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_poliza`
--

INSERT INTO `equipos_poliza` (`id_equipo_poliza`, `fk_id_equipo_poliza`, `fk_id_user_poliza`, `fecha_inicio`, `fecha_vencimiento`, `numero_poliza`, `estado_poliza`, `descripcion`) VALUES
(1, 22, 1, '2021-02-01', '2021-02-28', '456789', 0, 'Nueva póliza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inspection_vehiculos`
--

CREATE TABLE `inspection_vehiculos` (
  `id_inspection_vehiculos` int(10) NOT NULL,
  `fk_id_user_responsable` int(10) NOT NULL,
  `fk_id_equipo_vehiculo` int(10) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `horas_actuales_vehiculo` int(10) NOT NULL,
  `radiador` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tapa` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_refrigeracion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tension_correa_ventilacion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `manometro_temperatura` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `persiana` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `signature` varchar(100) NOT NULL,
  `comments` text NOT NULL,
  `tanque_combustible` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `indicador` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tuberia_baja_presion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `grifo` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `vaso_sedimentacion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `filtro_aire` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `filtro_combustible` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `prefiltro` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `filtro_aire_tipo_seco` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `pre_calentador` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `acelerador_manual` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `acelerador_aire` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `ahogador` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `consumo_acpm` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tapon_carter` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_aceite_motor` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bayoneta` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `presion_aceite_motor` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `indicador_presion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tapa_drenaje_caja` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bombillo_tablero` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_aceite_direccion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bomba_hidraulica` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bateria` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_electrolito` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bornes_bateria` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `terminales` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `seguro_bateria` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `caja` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tapa_celdas` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `conexiones_alternador` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `regulador_corriente` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `indicador_tablero` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `luz_testigo` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `horometro` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `interruptor` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `farolas_delanteras` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `farolas_traseras` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `pedal_embrague` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tolerancia_pedal` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `engrase_sistema` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_aceite` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `palanca_baja` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `palanca_alta` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `selector_velocidad` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `esfera_palanca` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `palanca` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `barra_tiro` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bloqueador` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_aceite_diferencial` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bayoneta_diferencial` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `pesas_delanteras` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `pesas_traseras` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `pernos_delanteros` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `palanca_control_posicion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `palanca_control_automatico` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_aceite_hidraulico` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bayoneta_hidraulico` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tuberia_conduccion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `radiador_enfriado` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `brazos_levante` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `cadenas_tensoras` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `mangueras` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tonillo_nivelados` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `guardafangos` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `asiento` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `capot` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `caja_direccion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `brazo_direccion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `barra_principal` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `soporte_delantero` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tolerancia_frenos` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `freno_mano` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tapa_rueda_delantera` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `rines_traseros` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `rines_delanteros` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_correctivo`
--

CREATE TABLE `mantenimiento_correctivo` (
  `id_correctivo` int(10) NOT NULL,
  `fecha` datetime NOT NULL,
  `fk_id_equipo_correctivo` int(10) NOT NULL,
  `fk_id_user_correctivo` int(10) NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `consideracion` text CHARACTER SET latin1 NOT NULL,
  `estado` int(1) NOT NULL COMMENT '1:Nuevo;2:En Proceso;3:Finalizado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mantenimiento_correctivo`
--

INSERT INTO `mantenimiento_correctivo` (`id_correctivo`, `fecha`, `fk_id_equipo_correctivo`, `fk_id_user_correctivo`, `descripcion`, `consideracion`, `estado`) VALUES
(1, '2021-02-01 02:03:54', 1, 1, 'El motor no arranca', 'Revisar con el fabricante', 2),
(2, '2021-02-01 13:08:40', 2, 1, 'Se rompio el vidrio del copiloto', 'Ir al almacen y cambiar.', 3),
(3, '2021-02-01 13:19:03', 16, 1, 'El cable de alimentación se rompio', 'EL cambio lo podemos hacer en la entidad', 3),
(4, '2021-02-01 14:11:34', 2, 1, 'Llanta trasera derecha pinchada', 'Esto se puede arreglarar en la entidad', 3),
(5, '2021-02-01 18:18:33', 2, 1, 'Es necesario cambiar los frenos, tienen un ruido extraño cuando se usan.', 'Que es provedor los revise si a se requiere el cambio.', 3),
(6, '2021-02-01 20:43:19', 1, 1, 'Motor con gotera de aceite', 'Revisar con el fabricante', 3),
(7, '2021-02-03 14:16:31', 1, 1, 'La silla del copiloto se daño', 'Revisar con el proveedor', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_correctivo_fotos`
--

CREATE TABLE `mantenimiento_correctivo_fotos` (
  `id_foto_danio` int(10) NOT NULL,
  `fk_id_correctivo` int(10) NOT NULL,
  `ruta_foto` varchar(250) NOT NULL,
  `fecha_foto_danio` date NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_preventivo`
--

CREATE TABLE `mantenimiento_preventivo` (
  `id_preventivo` int(10) NOT NULL,
  `fk_id_tipo_equipo_preventivo` int(1) NOT NULL,
  `fk_id_user_preventivo` int(10) NOT NULL,
  `frecuencia` varchar(200) NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mantenimiento_preventivo`
--

INSERT INTO `mantenimiento_preventivo` (`id_preventivo`, `fk_id_tipo_equipo_preventivo`, `fk_id_user_preventivo`, `frecuencia`, `descripcion`, `estado`) VALUES
(1, 1, 1, 'Cada 8mil kilometros', 'Cambio de aceite cada 8mil kilometros', 1),
(2, 1, 1, 'Cada 50 horas', 'Engrasado cada 50 horas', 1),
(3, 1, 1, 'Cada 2 años', 'Limpieza deposito ACPM', 1),
(4, 2, 1, 'Cada vez que se opera', 'Limpieza del motor', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_trabajo`
--

CREATE TABLE `orden_trabajo` (
  `id_orden_trabajo` int(10) NOT NULL,
  `fecha_asignacion` date NOT NULL,
  `fk_id_mantenimiento` int(10) NOT NULL,
  `fk_id_equipo_ot` int(10) NOT NULL,
  `tipo_mantenimiento` tinyint(4) NOT NULL COMMENT '1:Correctivo;2:Preventivo',
  `fk_id_user_orden` int(10) NOT NULL,
  `fk_id_user_encargado` int(10) NOT NULL,
  `informacion_adicional` text NOT NULL,
  `estado_actual` int(1) NOT NULL COMMENT '1:Asignada;2:Solucionada;3:Cancelada'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_trabajo`
--

INSERT INTO `orden_trabajo` (`id_orden_trabajo`, `fecha_asignacion`, `fk_id_mantenimiento`, `fk_id_equipo_ot`, `tipo_mantenimiento`, `fk_id_user_orden`, `fk_id_user_encargado`, `informacion_adicional`, `estado_actual`) VALUES
(1, '2021-02-01', 1, 1, 1, 1, 4, 'Se realizo el cambio de motor.', 2),
(2, '2021-02-01', 1, 1, 2, 1, 4, 'Solicitar al proveedor cambio de aceite de acuerdo al contraro vigente.', 1),
(3, '2021-02-01', 2, 2, 1, 1, 4, 'Realizar el cambio del vidrio lo mas pronto posible', 1),
(4, '2021-02-01', 1, 3, 2, 1, 4, 'Se realizo el cambio de aceite a los 45mil kilometros', 2),
(5, '2021-02-01', 3, 16, 1, 1, 4, 'Se cambio el cable por uno nuevo.', 2),
(6, '2021-02-01', 4, 2, 1, 1, 4, 'Este vehículo se va a rematar', 3),
(7, '2021-02-01', 5, 2, 1, 1, 4, 'Se cambiaron las pastillas de frenos', 2),
(8, '2021-02-01', 1, 3, 2, 1, 4, 'Se necesita realizar cambio de aceite', 1),
(9, '2021-02-01', 6, 1, 1, 1, 4, 'Se reparo el motor', 2),
(10, '2021-02-01', 4, 22, 2, 1, 4, 'Esta bomba se vendio', 3),
(11, '2021-02-03', 7, 1, 1, 1, 4, 'Se instalo la silla', 2),
(12, '2021-02-03', 2, 4, 2, 1, 4, 'este equipo no se debe engrasar', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_trabajo_estado`
--

CREATE TABLE `orden_trabajo_estado` (
  `id_orden_trabajo_estado` int(10) NOT NULL,
  `fk_id_orden_trabajo_estado` int(10) NOT NULL,
  `fk_id_user_ote` int(10) NOT NULL,
  `fecha_registro_estado` datetime NOT NULL,
  `informacion_adicional_estado` text NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_trabajo_estado`
--

INSERT INTO `orden_trabajo_estado` (`id_orden_trabajo_estado`, `fk_id_orden_trabajo_estado`, `fk_id_user_ote`, `fecha_registro_estado`, `informacion_adicional_estado`, `estado`) VALUES
(1, 1, 1, '2021-02-01 02:13:07', 'Solucionar lo antes posible, se necesita el correcto funcionamiento del vehículo', 1),
(2, 1, 1, '2021-02-01 03:40:52', 'Se realizo diagnostico del equipo, y toma tres dias repararlo', 1),
(3, 1, 1, '2021-02-01 03:46:56', 'Se realizo el cambio de motor.', 2),
(4, 2, 1, '2021-02-01 12:48:22', 'Solicitar al proveedor cambio de aceite de acuerdo al contraro vigente.', 1),
(5, 3, 1, '2021-02-01 13:11:03', 'Realizar el cambio del vidrio lo mas pronto posible', 1),
(6, 4, 1, '2021-02-01 13:16:47', 'Llevar al proveedor para realizar cambio de acuerdo a contrato', 1),
(7, 4, 1, '2021-02-01 13:17:48', 'Se realizo el cambio de aceite a los 45mil kilometros', 2),
(8, 5, 1, '2021-02-01 13:19:28', 'Por favor realizar el cambio el dia de hoy.', 1),
(9, 6, 1, '2021-02-01 14:13:28', 'Esto se debe solucionar el dia de hoy', 1),
(10, 6, 1, '2021-02-01 14:15:39', 'El dia de hoy no hay personal disponible', 1),
(14, 5, 1, '2021-02-01 17:29:15', 'Se cambio el cable por uno nuevo.', 2),
(15, 6, 1, '2021-02-01 18:09:05', 'Este vehículo se va a rematar', 3),
(16, 7, 1, '2021-02-01 18:19:32', 'El dia de hoy se lleva el vehículo para revisarlo.', 1),
(17, 7, 1, '2021-02-01 18:20:50', 'Se cambiaron las pastillas de frenos', 2),
(18, 8, 1, '2021-02-01 19:36:51', 'Se necesita realizar cambio de aceite', 1),
(19, 9, 1, '2021-02-01 20:44:34', 'Se requiere que se solucione lo antes posible', 1),
(20, 9, 1, '2021-02-01 20:47:17', 'El motor necesita reparacion, demora 4 dias', 1),
(21, 9, 1, '2021-02-01 20:48:03', 'Se reparo el motor', 2),
(22, 10, 1, '2021-02-01 20:52:29', 'Por favor realizarlo el dia de hoy', 1),
(23, 10, 1, '2021-02-01 20:53:16', 'Esta bomba se vendio', 3),
(24, 11, 1, '2021-02-03 14:17:36', 'La silla se debe cambiar por una nueva', 1),
(25, 11, 1, '2021-02-03 14:18:59', 'La silla se compro y llega en 4 dias', 1),
(26, 11, 1, '2021-02-03 14:19:34', 'La siila llego, el proveedor la instala mañana', 1),
(27, 11, 1, '2021-02-03 14:19:51', 'Se instalo la silla', 2),
(28, 12, 1, '2021-02-03 14:24:56', 'Por favor engrasar el vehículo', 1),
(29, 12, 1, '2021-02-03 14:26:34', 'este equipo no se debe engrasar', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_clase_vehiculo`
--

CREATE TABLE `param_clase_vehiculo` (
  `id_clase_vechiculo` tinyint(1) NOT NULL,
  `clase_vehiculo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_clase_vehiculo`
--

INSERT INTO `param_clase_vehiculo` (`id_clase_vechiculo`, `clase_vehiculo`) VALUES
(1, 'Camioneta'),
(2, 'Campero'),
(3, 'Volqueta '),
(4, 'Van'),
(5, 'Camión');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_dependencias`
--

CREATE TABLE `param_dependencias` (
  `id_dependencia` int(10) NOT NULL,
  `dependencia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_dependencias`
--

INSERT INTO `param_dependencias` (`id_dependencia`, `dependencia`) VALUES
(1, 'Dirección'),
(2, 'Oficina Asesora Jurídica'),
(3, 'Oficina de Control Interno'),
(4, 'Oficina Asesora de Planeación'),
(5, 'Secretaría General y de Control Disciplinario'),
(6, 'Subdirección Científica'),
(7, 'Subdirección Técnica Operativa'),
(8, 'Oficina de Arborización Urbana'),
(9, 'Subdirección Educativa y Cultural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_menu`
--

CREATE TABLE `param_menu` (
  `id_menu` int(3) NOT NULL,
  `menu_name` varchar(50) NOT NULL,
  `menu_url` varchar(200) NOT NULL DEFAULT '0',
  `menu_icon` varchar(50) NOT NULL,
  `menu_order` int(1) NOT NULL,
  `menu_type` tinyint(1) NOT NULL COMMENT '1:Left; 2:Top',
  `menu_state` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Active; 2:Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_menu`
--

INSERT INTO `param_menu` (`id_menu`, `menu_name`, `menu_url`, `menu_icon`, `menu_order`, `menu_type`, `menu_state`) VALUES
(1, 'Configuración', '', 'fa-gear', 2, 2, 1),
(2, '', '', 'fa-user', 6, 2, 1),
(3, 'Equipos', '', 'fa-truck', 1, 2, 1),
(4, 'Administrar acceso sistema', '', 'fa-cogs', 5, 2, 1),
(5, 'Dashboard ADMIN', 'dashboard/admin', 'fa-dashboard', 1, 1, 1),
(6, 'Manuales', '', 'fa-book ', 4, 2, 1),
(7, 'Mantenimiento', '', 'fa-wrench', 3, 1, 1),
(8, 'Calendario', 'dashboard/calendar', 'fa-calendar', 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_menu_access`
--

CREATE TABLE `param_menu_access` (
  `id_access` int(3) NOT NULL,
  `fk_id_menu` int(3) NOT NULL,
  `fk_id_link` int(3) NOT NULL,
  `fk_id_role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_menu_access`
--

INSERT INTO `param_menu_access` (`id_access`, `fk_id_menu`, `fk_id_link`, `fk_id_role`) VALUES
(14, 1, 4, 1),
(1, 1, 4, 99),
(15, 1, 5, 1),
(2, 1, 5, 99),
(16, 1, 6, 1),
(3, 1, 6, 99),
(34, 2, 19, 1),
(28, 2, 19, 99),
(35, 2, 20, 1),
(29, 2, 20, 99),
(36, 2, 21, 1),
(30, 2, 21, 99),
(37, 2, 22, 1),
(31, 2, 22, 99),
(18, 3, 7, 1),
(7, 3, 7, 99),
(38, 3, 17, 1),
(26, 3, 17, 99),
(39, 3, 18, 1),
(27, 3, 18, 99),
(4, 4, 1, 99),
(5, 4, 2, 99),
(6, 4, 3, 99),
(9, 4, 8, 99),
(10, 4, 9, 99),
(17, 5, 0, 1),
(20, 5, 0, 99),
(25, 6, 12, 1),
(11, 6, 12, 99),
(12, 6, 13, 99),
(13, 6, 14, 99),
(23, 7, 15, 1),
(21, 7, 15, 99),
(33, 8, 0, 1),
(32, 8, 0, 99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_menu_links`
--

CREATE TABLE `param_menu_links` (
  `id_link` int(3) NOT NULL,
  `fk_id_menu` int(3) NOT NULL,
  `link_name` varchar(100) NOT NULL,
  `link_url` varchar(200) NOT NULL,
  `link_icon` varchar(50) NOT NULL,
  `order` int(1) NOT NULL,
  `date_issue` datetime NOT NULL,
  `link_state` tinyint(1) NOT NULL COMMENT '1:Active;2:Inactive',
  `link_type` tinyint(1) NOT NULL COMMENT '1:System URL;2:Complete URL; 3:Divider; 4:Complete URL, Videos; 5:Complete URL, Manuals'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_menu_links`
--

INSERT INTO `param_menu_links` (`id_link`, `fk_id_menu`, `link_name`, `link_url`, `link_icon`, `order`, `date_issue`, `link_state`, `link_type`) VALUES
(1, 4, 'Enlaces Menú', 'access/menu', 'fa-link', 1, '2020-11-18 19:45:31', 1, 1),
(2, 4, 'Enlaces Submenú', 'access/links', 'fa-link', 2, '2020-11-18 19:45:31', 1, 1),
(3, 4, 'Acceso Roles', 'access/role_access', 'fa-puzzle-piece', 4, '2020-11-18 19:45:31', 1, 1),
(4, 1, 'Usuarios', 'settings/employee/1', 'fa-users', 1, '2020-11-19 06:13:07', 1, 1),
(5, 1, '----------', 'DIVIDER', 'fa-hand-o-up', 2, '2020-11-19 07:07:22', 1, 3),
(6, 1, 'Proveedores', 'settings/company', 'fa-building', 3, '2020-11-19 07:08:43', 1, 1),
(7, 3, 'Buscar', 'equipos', 'fa-search', 1, '2020-11-20 01:29:59', 1, 1),
(8, 4, '----------', 'DIVIDER', 'fa-pin', 3, '2020-12-01 17:19:46', 1, 3),
(9, 4, 'Descripción Roles', 'dashboard/rol_info', 'fa-info', 5, '2020-12-01 17:22:23', 1, 1),
(12, 6, 'Manual de Usuario', 'http://[::1]/jbb/files/MANUAL_DE_USUARIO.pdf', 'fa-hand-o-up', 1, '2020-12-01 19:04:26', 1, 5),
(13, 6, 'Cargar Manuales', 'access/manuals', 'fa-book', 25, '2020-12-01 19:10:25', 1, 1),
(14, 6, 'DIVIDER', '----------', 'fa-pin', 24, '2020-12-01 19:11:24', 1, 3),
(15, 7, 'Preventivo', 'mantenimiento/preventivo', 'fa-wrench', 1, '2020-12-11 12:13:55', 1, 1),
(16, 7, 'Correctivo', 'mantenimiento/correctivo', 'fa-wrench', 2, '2020-12-11 12:14:41', 2, 1),
(17, 3, '----------', 'DIVIDER', 'fa_pruebas', 2, '2021-01-15 02:29:48', 1, 3),
(18, 3, 'Equipos Inactivos', 'equipos/inactivos', 'fa-unlink', 3, '2021-01-15 02:32:20', 1, 1),
(19, 2, 'Perfil Usuario', 'usuarios/detalle', 'fa-user', 1, '2021-01-15 03:02:00', 1, 1),
(20, 2, 'Cambiar Contraseña', 'usuarios', 'fa-lock', 2, '2021-01-15 03:07:14', 1, 1),
(21, 2, '----------', 'DIVIDER', 'fa-borrar', 3, '2021-01-15 03:09:40', 1, 3),
(22, 2, 'Salir', 'menu/salir', 'fa-sign-out', 4, '2021-01-15 03:10:36', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_proveedores`
--

CREATE TABLE `param_proveedores` (
  `id_proveedor` int(3) NOT NULL,
  `nombre_proveedor` varchar(120) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `numero_celular` varchar(12) NOT NULL,
  `email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_proveedores`
--

INSERT INTO `param_proveedores` (`id_proveedor`, `nombre_proveedor`, `contacto`, `numero_celular`, `email`) VALUES
(1, 'Proveedor', 'Xxxxx Xxxxxxx', '3156666666', 'xxxxxx@xxxx.gov.co');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_role`
--

CREATE TABLE `param_role` (
  `id_role` int(1) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `style` varchar(50) NOT NULL,
  `dashboard_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_role`
--

INSERT INTO `param_role` (`id_role`, `role_name`, `description`, `style`, `dashboard_url`) VALUES
(1, 'Administrador', 'Se encarga de comfiguracion del sistema. Cargar tabla de Usuarios, tabla de proveedores', 'text-warning', 'dashboard/admin'),
(2, 'Usuario Consulta', 'Solo tiene acceso a ver información en el sistema. No puede editar ni adicionar nada.', 'text-green', 'dashboard/encargado'),
(3, 'Encargado', 'Usuarios que van a realizar el mantenimiento a los equipos.', 'text-danger', 'dashboard/encargado'),
(4, 'Supervisor', 'Carga en el sistema el plan de mantenimiento, asigna los mantenimientos a los encargados y realiza control de los mantenimientos', 'text-info', 'dashboard/supervisor'),
(5, 'Operador - Conductor', 'Conductores de vehículos, falta definir su rol en el sistema', 'text-violeta', 'dashboard/conductor'),
(99, 'SUPER ADMIN', 'Con acceso a todo el sistema, encargaado de tablas parametricas del sistema', 'text-success', 'dashboard/admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_tipo_carroceria`
--

CREATE TABLE `param_tipo_carroceria` (
  `id_tipo_carroceria` tinyint(1) NOT NULL,
  `tipo_carroceria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_tipo_carroceria`
--

INSERT INTO `param_tipo_carroceria` (`id_tipo_carroceria`, `tipo_carroceria`) VALUES
(1, 'Wagon'),
(2, 'Doble cabina'),
(3, 'Cabinado'),
(4, 'Platon'),
(5, 'Station Wagon'),
(6, 'Volco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_tipo_equipos`
--

CREATE TABLE `param_tipo_equipos` (
  `id_tipo_equipo` int(1) NOT NULL,
  `tipo_equipo` varchar(50) NOT NULL,
  `formulario_especifico` varchar(50) NOT NULL,
  `metodo_guardar` varchar(50) NOT NULL,
  `enlace_inspeccion` varchar(100) NOT NULL,
  `formulario_inspeccion` varchar(100) NOT NULL,
  `tabla_inspeccion` varchar(100) NOT NULL,
  `id_tabla_inspeccion` varchar(100) NOT NULL,
  `icono` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_tipo_equipos`
--

INSERT INTO `param_tipo_equipos` (`id_tipo_equipo`, `tipo_equipo`, `formulario_especifico`, `metodo_guardar`, `enlace_inspeccion`, `formulario_inspeccion`, `tabla_inspeccion`, `id_tabla_inspeccion`, `icono`) VALUES
(1, 'Vehículos', 'equipos_detalle_vehiculo', 'guardarInfoEspecificaVehiculo', '/inspection/add_vehiculos_inspection', 'form_1_vehiculos', 'inspection_vehiculos', 'id_inspection_vehiculos', 'fa-car'),
(2, 'Bomba', 'equipos_detalle_bomba', 'guardarInfoEspecificaBomba', '/inspection/add_vehiculos_inspection', '', '', '', 'fa-bomb'),
(3, 'Maquinaria', 'equipos_detalle_vehiculo', 'guardarInfoEspecificaVehiculo', '/inspection/vehiculos', 'form_1_vehiculos', 'inpection_vehiculos', 'id_inspection_vehiculos', 'fa-truck'),
(4, 'Equipo', '', '', '', '', '', '', 'fa-legal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `log_user` varchar(50) NOT NULL,
  `movil` varchar(12) NOT NULL,
  `email` varchar(70) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `state` int(1) NOT NULL DEFAULT 0 COMMENT '0: newUser; 1:active; 2:inactive',
  `fk_id_user_role` int(1) NOT NULL DEFAULT 7 COMMENT '99: Super Admin;',
  `photo` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `first_name`, `last_name`, `log_user`, `movil`, `email`, `password`, `state`, `fk_id_user_role`, `photo`) VALUES
(1, 'Benjamin', 'Motta', 'Bmottag', '4034089921', 'benmotta@gmail.com', '25446782e2ccaf0afdb03e5d61d0fbb9', 1, 99, 'images/usuarios/thumbs/1.JPG'),
(2, 'Administrador', 'Administrador', 'admin', '234523425', 'admin@gmail.com', '25f9e794323b453885f5181f1b624d0b', 1, 1, ''),
(3, 'Pedro', 'Manrrique', 'pmanrrique', '3015549911', 'pmanrrique@gmail.com', '25f9e794323b453885f5181f1b624d0b', 0, 5, ''),
(4, 'Encargado', 'Encargado', 'encargado', '3156123456', 'encargado@jbb.com.co', 'e10adc3949ba59abbe56e057f20f883e', 0, 3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_llave_contraseña`
--

CREATE TABLE `usuarios_llave_contraseña` (
  `id_llave` int(10) NOT NULL,
  `fk_id_user_ulc` int(10) NOT NULL,
  `email_user` varchar(70) NOT NULL,
  `llave` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`),
  ADD UNIQUE KEY `numero_unidad` (`numero_inventario`),
  ADD UNIQUE KEY `qr_code_encryption` (`qr_code_encryption`),
  ADD KEY `estado_equipo` (`estado_equipo`),
  ADD KEY `fk_id_dependencia` (`fk_id_dependencia`) USING BTREE,
  ADD KEY `fk_id_tipo_equipo` (`fk_id_tipo_equipo`);

--
-- Indices de la tabla `equipos_control_combustible`
--
ALTER TABLE `equipos_control_combustible`
  ADD PRIMARY KEY (`id_equipo_control_combustible`),
  ADD KEY `fk_id_equipo_combustible` (`fk_id_equipo_combustible`),
  ADD KEY `fk_id_conductor_combustible` (`fk_id_operador_combustible`);

--
-- Indices de la tabla `equipos_detalle_bomba`
--
ALTER TABLE `equipos_detalle_bomba`
  ADD PRIMARY KEY (`id_equipo_detalle_bomba`),
  ADD KEY `fk_id_equipo_bomba` (`fk_id_equipo_bomba`);

--
-- Indices de la tabla `equipos_detalle_vehiculo`
--
ALTER TABLE `equipos_detalle_vehiculo`
  ADD PRIMARY KEY (`id_equipo_detalle_vehiculo`),
  ADD KEY `fk_id_clase_vechiculo` (`fk_id_clase_vechiculo`),
  ADD KEY `fk_id_tipo_carroceria` (`fk_id_tipo_carroceria`),
  ADD KEY `fk_id_equipo` (`fk_id_equipo`);

--
-- Indices de la tabla `equipos_fotos`
--
ALTER TABLE `equipos_fotos`
  ADD PRIMARY KEY (`id_equipo_foto`),
  ADD KEY `fk_id_equipo_foto` (`fk_id_equipo_foto`),
  ADD KEY `fk_id_user_ef` (`fk_id_user_ef`);

--
-- Indices de la tabla `equipos_localizacion`
--
ALTER TABLE `equipos_localizacion`
  ADD PRIMARY KEY (`id_equipo_localizacion`),
  ADD KEY `fk_id_equipo_localizacion` (`fk_id_equipo_localizacion`),
  ADD KEY `fk_id_user_localizacion` (`fk_id_user_localizacion`);

--
-- Indices de la tabla `equipos_poliza`
--
ALTER TABLE `equipos_poliza`
  ADD PRIMARY KEY (`id_equipo_poliza`),
  ADD KEY `fk_id_equipo_poliza` (`fk_id_equipo_poliza`),
  ADD KEY `fk_id_user_poliza` (`fk_id_user_poliza`);

--
-- Indices de la tabla `inspection_vehiculos`
--
ALTER TABLE `inspection_vehiculos`
  ADD PRIMARY KEY (`id_inspection_vehiculos`),
  ADD KEY `fk_id_user_responsable` (`fk_id_user_responsable`),
  ADD KEY `fk_id_equipo_vehiculo` (`fk_id_equipo_vehiculo`);

--
-- Indices de la tabla `mantenimiento_correctivo`
--
ALTER TABLE `mantenimiento_correctivo`
  ADD PRIMARY KEY (`id_correctivo`),
  ADD KEY `fk_id_equipo` (`fk_id_equipo_correctivo`),
  ADD KEY `fk_id_user_correctivo` (`fk_id_user_correctivo`);

--
-- Indices de la tabla `mantenimiento_correctivo_fotos`
--
ALTER TABLE `mantenimiento_correctivo_fotos`
  ADD PRIMARY KEY (`id_foto_danio`),
  ADD KEY `fk_id_correctivo` (`fk_id_correctivo`);

--
-- Indices de la tabla `mantenimiento_preventivo`
--
ALTER TABLE `mantenimiento_preventivo`
  ADD PRIMARY KEY (`id_preventivo`),
  ADD KEY `fk_id_tipo_equipo_preventivo` (`fk_id_tipo_equipo_preventivo`),
  ADD KEY `fk_id_user_preventivo` (`fk_id_user_preventivo`);

--
-- Indices de la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  ADD PRIMARY KEY (`id_orden_trabajo`),
  ADD KEY `fk_id_mantenimiento` (`fk_id_mantenimiento`),
  ADD KEY `tipo_mantenimiento` (`tipo_mantenimiento`),
  ADD KEY `fk_id_user_orden` (`fk_id_user_orden`),
  ADD KEY `fk_id_user_encargado` (`fk_id_user_encargado`),
  ADD KEY `fk_id_equipo_ot` (`fk_id_equipo_ot`);

--
-- Indices de la tabla `orden_trabajo_estado`
--
ALTER TABLE `orden_trabajo_estado`
  ADD PRIMARY KEY (`id_orden_trabajo_estado`),
  ADD KEY `fk_id_orden_trabajo_estado` (`fk_id_orden_trabajo_estado`),
  ADD KEY `fk_id_user_ote` (`fk_id_user_ote`);

--
-- Indices de la tabla `param_clase_vehiculo`
--
ALTER TABLE `param_clase_vehiculo`
  ADD PRIMARY KEY (`id_clase_vechiculo`);

--
-- Indices de la tabla `param_dependencias`
--
ALTER TABLE `param_dependencias`
  ADD PRIMARY KEY (`id_dependencia`);

--
-- Indices de la tabla `param_menu`
--
ALTER TABLE `param_menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `menu_type` (`menu_type`);

--
-- Indices de la tabla `param_menu_access`
--
ALTER TABLE `param_menu_access`
  ADD PRIMARY KEY (`id_access`),
  ADD UNIQUE KEY `indice_principal` (`fk_id_menu`,`fk_id_link`,`fk_id_role`),
  ADD KEY `fk_id_menu` (`fk_id_menu`),
  ADD KEY `fk_id_role` (`fk_id_role`),
  ADD KEY `fk_id_link` (`fk_id_link`);

--
-- Indices de la tabla `param_menu_links`
--
ALTER TABLE `param_menu_links`
  ADD PRIMARY KEY (`id_link`),
  ADD KEY `fk_id_menu` (`fk_id_menu`),
  ADD KEY `link_type` (`link_type`);

--
-- Indices de la tabla `param_proveedores`
--
ALTER TABLE `param_proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `param_role`
--
ALTER TABLE `param_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `param_tipo_carroceria`
--
ALTER TABLE `param_tipo_carroceria`
  ADD PRIMARY KEY (`id_tipo_carroceria`);

--
-- Indices de la tabla `param_tipo_equipos`
--
ALTER TABLE `param_tipo_equipos`
  ADD PRIMARY KEY (`id_tipo_equipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `log_user` (`log_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `perfil` (`fk_id_user_role`);

--
-- Indices de la tabla `usuarios_llave_contraseña`
--
ALTER TABLE `usuarios_llave_contraseña`
  ADD PRIMARY KEY (`id_llave`),
  ADD KEY `fk_id_user_ulc` (`fk_id_user_ulc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `equipos_control_combustible`
--
ALTER TABLE `equipos_control_combustible`
  MODIFY `id_equipo_control_combustible` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `equipos_detalle_bomba`
--
ALTER TABLE `equipos_detalle_bomba`
  MODIFY `id_equipo_detalle_bomba` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `equipos_detalle_vehiculo`
--
ALTER TABLE `equipos_detalle_vehiculo`
  MODIFY `id_equipo_detalle_vehiculo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `equipos_fotos`
--
ALTER TABLE `equipos_fotos`
  MODIFY `id_equipo_foto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `equipos_localizacion`
--
ALTER TABLE `equipos_localizacion`
  MODIFY `id_equipo_localizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `equipos_poliza`
--
ALTER TABLE `equipos_poliza`
  MODIFY `id_equipo_poliza` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inspection_vehiculos`
--
ALTER TABLE `inspection_vehiculos`
  MODIFY `id_inspection_vehiculos` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_correctivo`
--
ALTER TABLE `mantenimiento_correctivo`
  MODIFY `id_correctivo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_correctivo_fotos`
--
ALTER TABLE `mantenimiento_correctivo_fotos`
  MODIFY `id_foto_danio` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_preventivo`
--
ALTER TABLE `mantenimiento_preventivo`
  MODIFY `id_preventivo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  MODIFY `id_orden_trabajo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `orden_trabajo_estado`
--
ALTER TABLE `orden_trabajo_estado`
  MODIFY `id_orden_trabajo_estado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `param_clase_vehiculo`
--
ALTER TABLE `param_clase_vehiculo`
  MODIFY `id_clase_vechiculo` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `param_dependencias`
--
ALTER TABLE `param_dependencias`
  MODIFY `id_dependencia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `param_menu`
--
ALTER TABLE `param_menu`
  MODIFY `id_menu` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `param_menu_access`
--
ALTER TABLE `param_menu_access`
  MODIFY `id_access` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `param_menu_links`
--
ALTER TABLE `param_menu_links`
  MODIFY `id_link` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `param_proveedores`
--
ALTER TABLE `param_proveedores`
  MODIFY `id_proveedor` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `param_role`
--
ALTER TABLE `param_role`
  MODIFY `id_role` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `param_tipo_carroceria`
--
ALTER TABLE `param_tipo_carroceria`
  MODIFY `id_tipo_carroceria` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `param_tipo_equipos`
--
ALTER TABLE `param_tipo_equipos`
  MODIFY `id_tipo_equipo` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios_llave_contraseña`
--
ALTER TABLE `usuarios_llave_contraseña`
  MODIFY `id_llave` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`fk_id_dependencia`) REFERENCES `param_dependencias` (`id_dependencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipos_ibfk_2` FOREIGN KEY (`fk_id_tipo_equipo`) REFERENCES `param_tipo_equipos` (`id_tipo_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipos_control_combustible`
--
ALTER TABLE `equipos_control_combustible`
  ADD CONSTRAINT `equipos_control_combustible_ibfk_1` FOREIGN KEY (`fk_id_equipo_combustible`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipos_detalle_bomba`
--
ALTER TABLE `equipos_detalle_bomba`
  ADD CONSTRAINT `equipos_detalle_bomba_ibfk_1` FOREIGN KEY (`fk_id_equipo_bomba`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipos_detalle_vehiculo`
--
ALTER TABLE `equipos_detalle_vehiculo`
  ADD CONSTRAINT `equipos_detalle_vehiculo_ibfk_1` FOREIGN KEY (`fk_id_equipo`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipos_detalle_vehiculo_ibfk_2` FOREIGN KEY (`fk_id_tipo_carroceria`) REFERENCES `param_tipo_carroceria` (`id_tipo_carroceria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipos_detalle_vehiculo_ibfk_3` FOREIGN KEY (`fk_id_clase_vechiculo`) REFERENCES `param_clase_vehiculo` (`id_clase_vechiculo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipos_fotos`
--
ALTER TABLE `equipos_fotos`
  ADD CONSTRAINT `equipos_fotos_ibfk_1` FOREIGN KEY (`fk_id_equipo_foto`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipos_localizacion`
--
ALTER TABLE `equipos_localizacion`
  ADD CONSTRAINT `equipos_localizacion_ibfk_1` FOREIGN KEY (`fk_id_equipo_localizacion`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipos_poliza`
--
ALTER TABLE `equipos_poliza`
  ADD CONSTRAINT `equipos_poliza_ibfk_1` FOREIGN KEY (`fk_id_equipo_poliza`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inspection_vehiculos`
--
ALTER TABLE `inspection_vehiculos`
  ADD CONSTRAINT `inspection_vehiculos_ibfk_1` FOREIGN KEY (`fk_id_equipo_vehiculo`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mantenimiento_correctivo`
--
ALTER TABLE `mantenimiento_correctivo`
  ADD CONSTRAINT `mantenimiento_correctivo_ibfk_1` FOREIGN KEY (`fk_id_equipo_correctivo`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mantenimiento_correctivo_fotos`
--
ALTER TABLE `mantenimiento_correctivo_fotos`
  ADD CONSTRAINT `mantenimiento_correctivo_fotos_ibfk_1` FOREIGN KEY (`fk_id_correctivo`) REFERENCES `mantenimiento_correctivo` (`id_correctivo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mantenimiento_preventivo`
--
ALTER TABLE `mantenimiento_preventivo`
  ADD CONSTRAINT `mantenimiento_preventivo_ibfk_1` FOREIGN KEY (`fk_id_tipo_equipo_preventivo`) REFERENCES `param_tipo_equipos` (`id_tipo_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  ADD CONSTRAINT `orden_trabajo_ibfk_1` FOREIGN KEY (`fk_id_equipo_ot`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_trabajo_estado`
--
ALTER TABLE `orden_trabajo_estado`
  ADD CONSTRAINT `orden_trabajo_estado_ibfk_1` FOREIGN KEY (`fk_id_orden_trabajo_estado`) REFERENCES `orden_trabajo` (`id_orden_trabajo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `param_menu_access`
--
ALTER TABLE `param_menu_access`
  ADD CONSTRAINT `param_menu_access_ibfk_1` FOREIGN KEY (`fk_id_role`) REFERENCES `param_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `param_menu_access_ibfk_2` FOREIGN KEY (`fk_id_menu`) REFERENCES `param_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `param_menu_links`
--
ALTER TABLE `param_menu_links`
  ADD CONSTRAINT `param_menu_links_ibfk_1` FOREIGN KEY (`fk_id_menu`) REFERENCES `param_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
