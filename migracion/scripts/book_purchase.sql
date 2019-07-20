CREATE TABLE `book_purchase` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `quatity` int(10) UNSIGNED NOT NULL,
  `subtotal` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `books_purchases`
--
ALTER TABLE `book_purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_id` (`purchase_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT de la tabla `books_purchases`
--
ALTER TABLE `book_purchase`
 MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
