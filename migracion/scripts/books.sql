--
-- Estructura de tabla para la tabla `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `total_pages` int(10) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `cover_img_url` varchar(255) DEFAULT NULL,
  `year_published` int(10) UNSIGNED DEFAULT NULL,
  `genre_id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `publisher_id` int(10) UNSIGNED NOT NULL,
  `language_id` int(10) UNSIGNED NOT NULL,
  `ranking` int(10) UNSIGNED NOT NULL,
  `resena` text,
  `isbn` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `books`
--

INSERT INTO `books` (`id`, `title`, `total_pages`, `price`, `cover_img_url`, `year_published`, `genre_id`, `author_id`, `publisher_id`, `ranking`, `resena`, `isbn`, `language_id`) VALUES
(1, 'Luciérnagas en frascos', 112, '450.00', '../img/mr_luciernagas.png', 2019, 1, 1, 1, 11, 'Mágicos como luciérnagas liberadas en un descampado, los poemas de Mercedes Romero se tejen en santa clara, el punto más fácil y universal, aunque también el más efectivo. Profundos y despojados, su brevedad no es sino la condensación necesaria del brillo de la palabra urgente. \'\'...Y es que Luciérnagas en frascos es un libro, pero también una linterna en cada cueva\'\' del prólogo de Irene X.', 9789871882960, 1),
(2, 'Templanza (Irma)', 112, '300.00', '../img/js_templanza.png', 2019, 1, 2, 2, 12, 'La historia de Irma, se hilvana y se enreda de forma revirada, provocante. Va y viene en el tiempo, en las formas, en la narrativa que propone, y mediante el juego literario de “borrón y cuenta nueva” construye un código con quienes leen. Este recurso, a la vez, destruye y reconstruye el texto a cada paso. Todo eso llega al lector o lectora con humor, soberbia, dolor, o todo eso por igual. La historia de Irma se enlaza con la historia de otras tres mujeres, que aparecen con fugacidad y dejan saber algo que ya el prólogo del libro nos anticipa: Irma ya es todo un mundo, pero se trata de la primera entrega en una saga que se las trae.', 9789871497904, 1),
(3, 'La muerte del padre', 504, '945.00', '../img/kok_lamuerte.png', 2016, 1, 3, 3, 13, 'Karl Ove Knausgard esta luchando con su tercera novela casi diez anos despues de que su padre se emborrachara hasta morir. Quiere que sea una obra maestra, pero le atormentan las dudas. La mente de Karl Ove deambula entre sus frustraciones actuales y su relacion con su familia y el pasado, cuando su padre tenia la misma edad que el ahora. Era un nino serio y angustiado, con un hermano mas feliz y menos complicado que el, una madre apacible y carinosa pero casi invisible, y un padre distante e imprevisible, cuya muerte prematura suscito en el emociones contradictorias que aun no ha conseguido aceptar. La muerte del padre es la primera novela de las seis que conforman Mi lucha. Knausgard se embarca en una exploracion proustiana y desmenuza la historia de su propia vida hasta obtener las «particulas elementales». El resultado es una historia universal de los combates que todos debemos librar, una novela tan profunda como absorbente escrita como si la propia vida de su autor estuviera en juego.', 9788433977908, 1),
(4, 'Mentiras consentidas', 560, '899.00', '../img/hr_mentiras.png', 2019, 1, 4, 4, 14, 'Los días de Sebastian Bergman en la Unidad de Homicidios han terminado y ahora dedica su tiempo a impartir conferencias y a escribir libros. Tras los acontecimientos vividos en Castigos justificados, lleva meses sin noticias de Vanja y la única persona del equipo con quien tiene contacto esporádico es Úrsula. Vanja tampoco sigue en la Unidad: ahora trabaja como investigadora criminal en Uppsala. Desde el mes pasado, está investigando una serie de abusos a mujeres. Cuando una de las víctimas muere, la Unidad de Homicidios pasará a encargarse del caso y, muy pronto, también Sebastian Bergman. Reunidos, el equipo debe dejar de lado sus problemas y conflictos personales para atrapar al brutal asesino que sigue atemorizando Uppsala. Todo se complica cuando las pistas indican que las víctimas no han sido seleccionadas al azar. ¿Pero cuál es la conexión entre ellas? ¿Y quién se está tomando tantas molestias para que no se establezca dicha conexión?', 9789504966197, 1),
(5, 'Cocina Japonesa', 224, '1799.00', '../img/sp_cocinajaponesa.png', 2019, 2, 5, 5, 15, 'El placer de un buen sushi, el calor reconfortante del ramen o el intenso sabor del pollo al teriyaki... Somos muchos los que nos hemos dejado seducir por la tradición culinaria de Japón. Este elegante recetario nos ayudará a llevar los platos más fascinantes de la cultura nipona a nuestra mesa. Gracias a las propuestas, alternativas para los ingredientes y consejos de esta completa guía, podrás sorprenderte con un plato nuevo cada día. Además, incluye apuntes de viaje por Japón, para conocer las raíces de su cultura gastronómica y su filosofía a la hora de preparar y presentar los platos. Una cocina saludable y ligera, que proporciona energía y fuerza para cada día.', 9788417338107, 1),
(6, 'Cocina India vegana', 276, '1800.00', '../img/rh_cocinaindia.png', 2017, 2, 6, 6, 16, 'El libro definitivo de cocina india apto para veganos.', 9788484455950, 1),
(7, 'Sinceramente', 600, '599.00', '../img/cfk_sinceramente.png', 2019, 3, 7, 7, 1, 'Este libro no es autobiográfico ni tampoco una enumeración de logros personales o políticos, es una mirada y una reflexión retrospectiva para desentrañar algunos hechos y capítulos de la historia reciente y cómo han impactado en la vida de los argentinos y en la mía también.', 9789500763035, 1),
(8, 'Aventura Zombie en Movydrill', 148, '469.00', '../img/rob_zombie.png', 2018, 4, 8, 8, 2, '¿Hay algo más divertido que un cómic sobre zombies? ¡Sí, obvio! Cuando el cómic está protagonizado por Robleis, Thiago y Rushlai. Los tres hermanos se enfrentarán a un montón de zombies hambrientos, a un temible villano y en medio de todo esto habrá mucha acción, diversión y nuevos amigos. Amigueros: ¿están listos para la aventura?', 9789877362480, 1),
(9, 'Equilibrio', 304, '759.00', '../img/dlr_equilibrio.png', 2019, 5, 9, 4, 3, 'Con rigor, erudición, y a la vez con didactismo y amenidad, armado de literaturas, pero también de estudios técnicos de última generación, López Rosetti nos explica cómo pensamos, cómo sentimos y cómo tomamos decisiones, en un largo y minucioso escaneo de nuestras conductas y nuestros grandes malentendidos. El resultado es un análisis clínico completo de la maquinaria secreta que nos maneja.', 9789504965893, 1),
(10, 'Dime, ¿quién es como Dios?', 816, '999.00', '../img/fb_comodios.png', 2019, 1, 10, 9, 4, 'Una mujer extraordinaria, que atraviesa la siniestra Guerra de los Balcanes en los años 90 del siglo XX, trata de luchar contra sus fantasmas y encuentra la redención en el amor. Esta historia se cuenta en dos volúmenes: Aquí hay dragones. La historia de La Diana I y Dime, ¿quién es como Dios? La historia de La Diana II.', 9789877391244, 1),
(11, 'Y ahora, qué?', 264, '499.00', '../img/ak_ahoraque.png', 2019, 3, 11, 10, 5, 'Lejos del análisis puramente económico en el que muchas veces se lo quiere encasillar, en este libro Axel Kicillof se presta, cómodo y reflexivo, al juego de exponer y argumentar sus ideas políticas y a mirar el país de manera crítica pero también propositiva. Lo hace en diálogo con destacados y destacadas periodistas, interlocutores incisivos y nada complacientes, y el resultado son conversaciones apasionantes y reveladoras.', 9789876299008, 1),
(12, 'A dos metros de ti', 288, '479.00', '../img/rl_adosmetros.png', 2019, 4, 12, 11, 6, 'La novela que ahora llega a la pantalla grande protagonizada por Cole Sprouse y Haley Lu Richardson ¿Puedes amar a alguien que no puedes tocar? Stella y Will tienen la misma enfermedad pulmonar, en el mismo hospital. Cuando se enamoran, recuperan la alegría de vivir, pero hay un problema: por el peligro de contagio, no pueden acercarse a menos de dos metros sin arriesgar sus vidas.', 9789871997381, 1),
(13, 'Rota se camina igual', 240, '590.00', '../img/lp_rota.png', 2018, 5, 13, 1, 7, 'Este libro es un viaje al interior de las emociones, con el que podemos identificarnos y hacernos carne a través de las heridas del desamor, del abandono, de las pérdidas, de la soledad y de la desolación. Lorena Pronsky nos muestra cómo puede volverse a construir un nuevo mundo, aún con esas grietas que la vida nos impone.', 9789871882878, 1),
(14, 'Recuerdos que mienten un poco', 863, '999.00', '../img/is_recuerdos.png', 2019, 1, 14, 7, 8, 'Las memorias del Indio Solari, creador y líder de Patricio Rey y sus Redonditos de Ricota, desde sus orígenes en Paraná hace 70 años hasta hoy, atravesando la historia de sus bandas disco por disco, sus comienzos, sus influencias, su independencia militante, su compleja relación con los medios, sus polémicas, y su presente personal y artístico.', 9789500762533, 1),
(15, 'Los compas y el diamantito legendario', 240, '669.00', '../img/tim_loscompas.png', 2019, 4, 15, 12, 9, 'Mike, Timba y Trolli se merecen unas vacaciones, así que lo han preparado todo para pasar unos días de descanso en una isla tranquila y alejada del ajetreo diario. De manera accidental, encontrarán un pergamino que los pondrá sobre la pista de un extraño tesoro, relacionado con viejas leyendas locales que nos hablan de criaturas mágicas, profecías antiguas y batallas entre gigantes y caballeros. Sin haberlo buscado, los compas se verán envueltos en una aventura épica que quizá los convierta en héroes.', 9789508701459, 1),
(16, 'Teoría King Kong', 176, '429.00', '../img/dv_teoria.png', 2018, 3, 16, 13, 10, 'Teoría King Kong es uno de los grandes libros de referencia del feminismo y de la teoría de género, un incisivo ensayo en el que Despentes comparte su propia experiencia para hablarnos sin tapujos ni concesiones sobre la prostitución, la violación, la represión del deseo, la maternidad y la pornografía, y para contribuir al derrumbe de los cimientos patriarcales de la sociedad actual. Puedes empezar a leer las primeras páginas.', 9789877690095, 1);

--
-- Indices de la tabla `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publisher_id` (`publisher_id`),
  ADD KEY `books_ibfk_3_idx` (`author_id`),
  ADD KEY `genre_id` (`genre_id`) USING BTREE,
  ADD KEY `language_id` (`language_id`) USING BTREE;

  --
  -- AUTO_INCREMENT de la tabla `books`
  --
  ALTER TABLE `books`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
