CREATE TABLE `genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Ficción y Literatura'),
(2, 'Gastronomía'),
(3, 'Ciencias'),
(4, 'Infantil y Juvenil'),
(5, 'Autoayuda'),
(6, 'Idioma Inglés');

--
-- Indices de la tabla `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

  --
  -- AUTO_INCREMENT de la tabla `genres`
  --
  ALTER TABLE `genres`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
