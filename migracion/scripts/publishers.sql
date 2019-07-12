--
-- Estructura de tabla para la tabla `publishers`
--

CREATE TABLE `publishers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `publishers`
--

INSERT INTO `publishers` (`id`, `name`) VALUES
(1, 'Hojas del Sur'),
(2, 'El Colectivo'),
(3, 'Anagrama'),
(4, 'Planeta'),
(5, 'Gr.Ilustrados'),
(6, 'Gaia Ediciones'),
(7, 'Sudamericana'),
(8, 'Altea'),
(9, 'Suma de Letras'),
(10, 'Siglo XXI Editores Argentina'),
(11, 'Nube de Tinta'),
(12, 'Martínez Roca'),
(13, 'Literatura Random House');

--
-- Indices de la tabla `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de la tabla `publishers`
--
ALTER TABLE `publishers`
 MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
