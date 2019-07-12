--
-- Estructura de tabla para la tabla `authors`
--

CREATE TABLE `authors` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `last_name`) VALUES
(1, 'Mercedes', 'Romero'),
(2, 'Julieta', 'Santos'),
(3, 'Karl', 'Ove Knausgard'),
(4, '', 'Hjorth & Rosenfeldt'),
(5, 'Paul', 'Stevan'),
(6, 'Richa', 'Hingle'),
(7, 'Cristina', 'Fernández de Kirchner'),
(8, '', 'Robleis'),
(9, 'Daniel', 'López Rosetti'),
(10, 'Florencia', 'Bonelli'),
(11, 'Axel', 'Kicillof'),
(12, 'Rachael', 'Lippincott'),
(13, 'Lorena', 'Pronsky'),
(14, 'Indio', 'Solari'),
(15, 'Timba', 'Vk'),
(16, 'Virginie', 'Despentes');

--
-- Indices de la tabla `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

  --
  -- AUTO_INCREMENT de la tabla `authors`
  --
  ALTER TABLE `authors`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
