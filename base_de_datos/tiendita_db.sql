-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-11-2026 a las 15:14:49
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendita_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`id`, `nombre`, `tipo`) VALUES
(1, 'Nuevo', 'success'),
(2, 'Oferta', 'danger'),
(3, 'Edición limitada', 'warning'),
(4, 'Últimas unidades', 'dark'),
(5, 'Envío gratis', 'info');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formas_pago`
--

CREATE TABLE `formas_pago` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formas_pago`
--

INSERT INTO `formas_pago` (`id`, `titulo`) VALUES
(3, 'Envío y retiro'),
(2, 'Financiación en cuotas'),
(1, 'Pago único con tarjeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `orden` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `producto_id`, `ruta`, `alt`, `orden`) VALUES
(1, 1, 'tortuga-ninja.jpg', 'Figura de colección de Raphael', 1),
(2, 1, 'robocop-detalle-1.jpg', 'Detalle de la figura de Raphael', 2),
(3, 1, 'robocop-detalle-2.jpg', 'Figura de Raphael vista completa', 3),
(4, 2, 'robocop.jpg', 'Figura de colección de RoboCop', 1),
(5, 2, 'robocop-detalle-1.jpg', 'Detalle de la figura de RoboCop', 2),
(6, 2, 'robocop-detalle-2.jpg', 'Figura de RoboCop vista completa', 3),
(7, 3, 'espadachin-azul.jpg', 'Figura de colección del Espadachín Sombrío', 1),
(8, 3, 'espadachin-azul-detalle-1.jpeg', 'Detalle de la figura del Espadachín Sombrío', 2),
(9, 3, 'espadachin-azul-detalle-2.jpeg', 'Figura del Espadachín Sombrío vista completa', 3),
(10, 4, 'mazinger.jpg', 'Figura de colección de Mazinger Z', 1),
(11, 4, 'robocop-detalle-1.jpg', 'Detalle de la figura de Mazinger Z', 2),
(12, 4, 'robocop-detalle-2.jpg', 'Figura de Mazinger Z vista completa', 3),
(13, 5, 'he-man.jpg', 'Figura de colección de He-Man', 1),
(14, 5, 'robocop-detalle-1.jpg', 'Detalle de la figura de He-Man', 2),
(15, 5, 'robocop-detalle-2.jpg', 'Figura de He-Man vista completa', 3),
(16, 6, 'maestro-artes-marciales.jpg', 'Figura de colección del Maestro Roshi', 1),
(17, 6, 'robocop-detalle-1.jpg', 'Detalle de la figura del Maestro Roshi', 2),
(18, 6, 'robocop-detalle-2.jpg', 'Figura del Maestro Roshi vista completa', 3),
(19, 7, 'depredador.jpg', 'Figura de colección del Depredador', 1),
(20, 7, 'robocop-detalle-1.jpg', 'Detalle de la figura del Depredador', 2),
(21, 7, 'robocop-detalle-2.jpg', 'Figura del Depredador vista completa', 3),
(22, 8, 'mago.jpg', 'Figura de colección de un orco', 1),
(23, 8, 'robocop-detalle-1.jpg', 'Detalle de la figura del orco', 2),
(24, 8, 'robocop-detalle-2.jpg', 'Figura del orco vista completa', 3),
(25, 9, 'venusaur.jpg', 'Figura de colección de Venusaur', 1),
(26, 9, 'venusaur-detalle-1.jpg', 'Detalle de la figura de Venusaur', 2),
(27, 9, 'venusaur-detalle-2.jpg', 'Figura de Venusaur vista completa', 3),
(28, 10, 'charizard.jpg', 'Figura de colección de Charizard', 1),
(29, 10, 'charizard-detalle-1.jpg', 'Detalle de la figura de Charizard', 2),
(30, 10, 'charizard-detalle-2.jpg', 'Figura de Charizard vista completa', 3),
(31, 11, 'pegajoso.jpg', 'Figura de colección de Pegajoso', 1),
(32, 11, 'pegajoso-detalle-1.jpg', 'Detalle de la figura de Pegajoso', 2),
(33, 11, 'pegajoso-detalle-2.jpg', 'Figura de Pegajoso vista completa', 3),
(34, 12, 'deadpool.jpg', 'Figura de colección de Deadpool', 1),
(35, 12, 'deadpool-detalle-1.jpg', 'Detalle de la figura de Deadpool', 2),
(36, 12, 'deadpool-detalle-2.jpg', 'Figura de Deadpool vista completa', 3),
(37, 13, 'cheetara.jpg', 'Figura de colección de Cheetara', 1),
(38, 13, 'cheetara-detalle-1.jpg', 'Detalle de la figura de Cheetara', 2),
(39, 13, 'cheetara-detalle-2.jpg', 'Figura de Cheetara vista completa', 3),
(40, 14, 'freezer.jpg', 'Figura de colección de Freezer', 1),
(41, 14, 'freezer-detalle-1.jpg', 'Detalle de la figura de Freezer', 2),
(42, 14, 'freezer-detalle-2.jpg', 'Figura de Freezer vista completa', 3),
(43, 15, 'terminator-t800.jpg', 'Figura de colección de Terminator T-800', 1),
(44, 15, 'terminator-t800-detalle-1.jpg', 'Detalle de la figura de Terminator T-800', 2),
(45, 15, 'terminator-t800-detalle-2.jpg', 'Figura de Terminator T-800 vista completa', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `altura_cm` decimal(4,1) NOT NULL,
  `acabado` varchar(150) NOT NULL,
  `base_incluida` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `edicion` varchar(50) NOT NULL,
  `descripcion_extendida` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `altura_cm`, `acabado`, `base_incluida`, `edicion`, `descripcion_extendida`) VALUES
(1, 'Raphael', 'Figura impresa en 3D y pintada a mano. Edición limitada coleccionista de 18 cm de alto.', 574977.00, 18.0, 'Pintura acrílica verde y roja pintada a mano', 1, 'Edición limitada', 'Figura de Raphael inspirada en las Tortugas Ninja, impresa en 3D y terminada con pintura acrílica verde y roja aplicada a mano. Sus detalles cuidadosamente trabajados la convierten en una pieza ideal para coleccionistas y fanáticos de los héroes mutantes.'),
(2, 'RoboCop', 'Figura impresa en 3D y pintada a mano. Réplica detallada del policía cibernético de Detroit, 20 cm de alto.', 735977.00, 24.0, 'Pintura acrílica pintada a mano', 1, 'Edición limitada', 'Réplica de RoboCop con una presencia imponente y detalles inspirados en el clásico policía cibernético de Detroit. Está impresa en 3D y pintada a mano con un acabado acrílico que resalta la armadura, el casco y el equipamiento de la figura.'),
(3, 'Espadachín Sombrío', 'Figura impresa en 3D y pintada a mano. Guerrero de abrigo negro y katana, 19 cm de alto.', 528977.00, 19.0, 'Pintura acrílica con detalles metalizados', 0, 'Edición especial', 'El Espadachín Sombrío combina una pose dinámica con detalles metalizados que destacan su abrigo, su espada y su silueta de guerrero. Es una figura de edición especial, impresa en 3D y pintada a mano para lograr un acabado único.'),
(4, 'Mazinger Z', 'Figura impresa en 3D y pintada a mano. El clásico robot rojo y negro del anime, 21 cm de alto.', 804977.00, 21.0, 'Pintura acrílica roja, negra y gris', 1, 'Edición clásica', 'Mazinger Z recrea al clásico robot con sus característicos colores rojo, negro y gris. La figura está impresa en 3D y cuidadosamente pintada a mano, logrando una pieza sólida y llamativa para exhibir en cualquier colección.'),
(5, 'He-Man', 'Figura impresa en 3D y pintada a mano. El héroe de Eternia con su espada de poder, 20 cm de alto.', 367977.00, 23.0, 'Pintura acrílica con acabado mate', 0, 'Edición de colección', 'Figura de He-Man inspirada en el poderoso héroe de Eternia, con una postura firme y detalles que evocan su aspecto clásico. Su acabado mate y la pintura acrílica aplicada a mano le dan una apariencia sobria y auténtica.'),
(6, 'Maestro Roshi', 'Figura impresa en 3D y pintada a mano. El sabio maestro de artes marciales con su bastón, 17 cm de alto.', 459977.00, 17.0, 'Pintura acrílica pintada a mano', 1, 'Edición artesanal', 'Figura del Maestro Roshi inspirada en el reconocido maestro de artes marciales. Su diseño destaca la expresión del personaje, sus rasgos característicos y el acabado pintado a mano, convirtiéndola en una pieza artesanal ideal para los seguidores del anime.'),
(7, 'Depredador', 'Figura impresa en 3D y pintada a mano. El cazador alienígena con armadura y armas, 22 cm de alto.', 850977.00, 22.0, 'Pintura acrílica con detalles metalizados', 1, 'Edición premium', 'Figura del Depredador con una estética imponente y detalles metalizados que resaltan su armadura, máscara y equipamiento. La pieza está impresa en 3D y pintada a mano para representar la presencia amenazante del legendario cazador alienígena.'),
(8, 'Orco', 'Figura impresa en 3D y pintada a mano. Pequeño hechicero de sombrero rojo y báculo mágico, 15 cm de alto.', 413977.00, 15.0, 'Pintura acrílica en tonos verdes y rojos', 1, 'Edición fantástica', 'El Orco es una figura fantástica de aspecto robusto, con expresión característica y una combinación de tonos verdes y rojos aplicada con pintura acrílica. Su acabado artesanal la convierte en una pieza original para colecciones inspiradas en la fantasía.'),
(9, 'Venusaur', 'Figura impresa en 3D y pintada a mano. Criatura de planta con una gran flor en el lomo, 20 cm de alto.', 689977.00, 20.0, 'Pintura acrílica en verdes, rosas y turquesa', 1, 'Edición de colección', 'Figura de Venusaur con la flor del lomo completamente abierta y hojas talladas una por una. Está impresa en 3D y pintada a mano en capas de verde y rosa para darle volumen y profundidad.'),
(10, 'Charizard', 'Figura impresa en 3D y pintada a mano. Dragón naranja con las alas abiertas y llama en la cola, 25 cm de alto.', 879977.00, 25.0, 'Pintura acrílica con detalles translúcidos en la llama', 1, 'Edición premium', 'Charizard aparece en pose de vuelo, con las alas desplegadas y la cola encendida. La llama está pintada con veladuras translúcidas que imitan el fuego, y el cuerpo combina tonos naranjas y crema aplicados a mano.'),
(11, 'Pegajoso', 'Figura impresa en 3D y pintada a mano. El fantasma verde y glotón de Los Cazafantasmas, 14 cm de alto.', 319977.00, 14.0, 'Pintura acrílica verde con barniz brillante efecto baba', 0, 'Edición fantástica', 'Figura de Pegajoso flotando con la boca abierta, lista para devorar todo a su paso. El barniz brillante sobre la pintura verde le da el aspecto pegajoso que lo hizo famoso entre los fanáticos del cine de los 80.'),
(12, 'Deadpool', 'Figura impresa en 3D y pintada a mano. El mercenario bocón con sus dos katanas, 21 cm de alto.', 649977.00, 21.0, 'Pintura acrílica roja y negra mate', 1, 'Edición especial', 'Deadpool posa con una katana en cada mano y su actitud desafiante de siempre. El traje está pintado a mano en rojo y negro mate, con costuras y correas marcadas para resaltar cada detalle.'),
(13, 'Cheetara', 'Figura impresa en 3D y pintada a mano. La guerrera más veloz de los ThunderCats con su bastón, 22 cm de alto.', 539977.00, 22.0, 'Pintura acrílica con manchas de guepardo pintadas a mano', 1, 'Edición clásica', 'Figura de Cheetara en plena carrera, con su bastón extendido y el cabello al viento. Las manchas de guepardo están pintadas a mano una por una, lo que hace que cada pieza sea ligeramente distinta.'),
(14, 'Freezer', 'Figura impresa en 3D y pintada a mano. El emperador del espacio en su forma final, 19 cm de alto.', 769977.00, 19.0, 'Pintura acrílica blanca y violeta perlada', 1, 'Edición especial', 'Freezer aparece en su forma final, de pie y con los brazos cruzados en actitud amenazante. Su acabado perlado en blanco y violeta, aplicado a mano, le da el brillo característico del villano.'),
(15, 'Terminator T-800', 'Figura impresa en 3D y pintada a mano. El endoesqueleto metálico de ojos rojos, 24 cm de alto.', 789977.00, 24.0, 'Pintura acrílica cromada con detalles rojos', 1, 'Edición limitada', 'Endoesqueleto del T-800 con su estructura metálica a la vista y los ojos rojos encendidos. La pintura cromada aplicada a mano reproduce el brillo del metal y resalta cada pieza mecánica.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_etiqueta`
--

CREATE TABLE `producto_etiqueta` (
  `id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `etiqueta_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_etiqueta`
--

INSERT INTO `producto_etiqueta` (`id`, `producto_id`, `etiqueta_id`) VALUES
(1, 1, 3),
(2, 2, 1),
(3, 2, 3),
(4, 3, 2),
(5, 3, 4),
(6, 4, 1),
(7, 4, 5),
(8, 5, 2),
(9, 6, 1),
(10, 7, 1),
(11, 7, 5),
(12, 9, 1),
(13, 10, 1),
(14, 10, 3),
(15, 11, 2),
(16, 12, 1),
(17, 12, 5),
(18, 13, 3),
(19, 14, 1),
(20, 15, 2),
(21, 15, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_pagos`
--

CREATE TABLE `producto_pagos` (
  `id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `forma_pago_id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_pagos`
--

INSERT INTO `producto_pagos` (`id`, `producto_id`, `forma_pago_id`, `descripcion`) VALUES
(49, 1, 1, 'Pagá con tarjeta de crédito o débito mediante una plataforma segura.'),
(50, 1, 2, 'Podés abonar en hasta 3 cuotas sin interés según la entidad bancaria.'),
(51, 1, 3, 'Envío protegido a todo el país o retiro en un punto acordado.'),
(52, 2, 1, 'Aceptamos tarjetas de crédito y débito con pago seguro.'),
(53, 2, 2, 'Hasta 3 cuotas sin interés según el banco.'),
(54, 2, 3, 'Envío nacional con seguimiento o retiro en un punto acordado.'),
(55, 3, 1, 'Comprá de forma segura con tarjetas de crédito o débito.'),
(56, 3, 2, 'Disponible en hasta 3 cuotas sin interés.'),
(57, 3, 3, 'El producto se entrega embalado y protegido para evitar daños.'),
(58, 4, 1, 'Pago protegido mediante tarjetas de crédito y débito.'),
(59, 4, 2, 'Hasta 3 cuotas sin interés según las condiciones del banco.'),
(60, 4, 3, 'Enviamos la figura con embalaje reforzado y número de seguimiento.'),
(61, 5, 1, 'Aceptamos tarjetas de crédito y débito de las principales entidades.'),
(62, 5, 2, 'Podés financiar tu compra en hasta 3 cuotas sin interés.'),
(63, 5, 3, 'Retiro acordado o envío seguro a domicilio.'),
(64, 6, 1, 'Realizá tu pago de manera rápida y segura con tarjeta.'),
(65, 6, 2, 'Ofrecemos hasta 3 cuotas sin interés en bancos seleccionados.'),
(66, 6, 3, 'La figura se envía cuidadosamente protegida para su conservación.'),
(67, 7, 1, 'Pago seguro con tarjetas de crédito y débito.'),
(68, 7, 2, 'Hasta 3 cuotas sin interés según el banco emisor.'),
(69, 7, 3, 'Envío nacional con seguimiento y embalaje especial.'),
(70, 8, 1, 'Podés pagar con tarjeta de crédito o débito de forma segura.'),
(71, 8, 2, 'Disponible en hasta 3 cuotas sin interés.'),
(72, 8, 3, 'Envío protegido o retiro coordinado con el comprador.'),
(73, 9, 1, 'Aceptamos tarjetas de crédito y débito con pago seguro.'),
(74, 9, 2, 'Hasta 3 cuotas sin interés según el banco.'),
(75, 9, 3, 'Envío nacional con seguimiento o retiro en un punto acordado.'),
(76, 10, 1, 'Pago seguro con tarjetas de crédito y débito.'),
(77, 10, 2, 'Podés financiar tu compra en hasta 3 cuotas sin interés.'),
(78, 10, 3, 'Enviamos la figura con embalaje reforzado y número de seguimiento.'),
(79, 11, 1, 'Pagá con tarjeta de crédito o débito mediante una plataforma segura.'),
(80, 11, 2, 'Disponible en hasta 3 cuotas sin interés.'),
(81, 11, 3, 'Retiro acordado o envío seguro a domicilio.'),
(82, 12, 1, 'Comprá de forma segura con tarjetas de crédito o débito.'),
(83, 12, 2, 'Hasta 3 cuotas sin interés según el banco emisor.'),
(84, 12, 3, 'Envío nacional con seguimiento y embalaje especial.'),
(85, 13, 1, 'Realizá tu pago de manera rápida y segura con tarjeta.'),
(86, 13, 2, 'Ofrecemos hasta 3 cuotas sin interés en bancos seleccionados.'),
(87, 13, 3, 'La figura se envía cuidadosamente protegida para su conservación.'),
(88, 14, 1, 'Pago protegido mediante tarjetas de crédito y débito.'),
(89, 14, 2, 'Hasta 3 cuotas sin interés según las condiciones del banco.'),
(90, 14, 3, 'Envío protegido a todo el país o retiro en un punto acordado.'),
(91, 15, 1, 'Aceptamos tarjetas de crédito y débito de las principales entidades.'),
(92, 15, 2, 'Podés abonar en hasta 3 cuotas sin interés según la entidad bancaria.'),
(93, 15, 3, 'El producto se entrega embalado y protegido para evitar daños.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('superadmin','admin','usuario') NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vistas`
--

CREATE TABLE `vistas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `activa` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `restringida` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vistas`
--

INSERT INTO `vistas` (`id`, `nombre`, `titulo`, `activa`, `restringida`) VALUES
(1, 'home', 'Inicio', 1, 0),
(2, 'products', 'Nuestros productos', 1, 0),
(3, 'detalle', 'Detalle del producto', 1, 0),
(4, 'process', 'Nuestro proceso', 1, 0),
(5, 'contact', 'Contactanos', 1, 0),
(6, '404', 'Página no encontrada', 1, 0),
(7, 'test', 'Test', 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `formas_pago`
--
ALTER TABLE `formas_pago`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titulo` (`titulo`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `producto_id` (`producto_id`,`orden`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_etiqueta`
--
ALTER TABLE `producto_etiqueta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `producto_id` (`producto_id`,`etiqueta_id`),
  ADD KEY `etiqueta_id` (`etiqueta_id`);

--
-- Indices de la tabla `producto_pagos`
--
ALTER TABLE `producto_pagos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `producto_id` (`producto_id`,`forma_pago_id`),
  ADD KEY `forma_pago_id` (`forma_pago_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `vistas`
--
ALTER TABLE `vistas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `formas_pago`
--
ALTER TABLE `formas_pago`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `producto_etiqueta`
--
ALTER TABLE `producto_etiqueta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `producto_pagos`
--
ALTER TABLE `producto_pagos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vistas`
--
ALTER TABLE `vistas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_etiqueta`
--
ALTER TABLE `producto_etiqueta`
  ADD CONSTRAINT `producto_etiqueta_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_etiqueta_ibfk_2` FOREIGN KEY (`etiqueta_id`) REFERENCES `etiquetas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_pagos`
--
ALTER TABLE `producto_pagos`
  ADD CONSTRAINT `producto_pagos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_pagos_ibfk_2` FOREIGN KEY (`forma_pago_id`) REFERENCES `formas_pago` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
