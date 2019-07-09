<?php

class Book
{
   private $id;
   private $title;
   private $total_pages;
   private $price;
   private $cover_img_url;
   private $year_published;
   private $language_id;
   private $genre_id;
   private $author_id;
   private $publisher_id;

   public function __construct(int $id, string $title, int $total_pages, float $price, string $cover_img_url, int $year_published, int $language_id, int $genre_id, int $author_id, int $publisher_id) {
      $this->id = $id;
      $this->title = $title;
      $this->total_pages = $total_pages;
      $this->price = $price;
      $this->cover_img_url = $cover_img_url;
      $this->year_published = $year_published;
      $this->language_id = $language_id;
      $this->genre_id = $genre_id;
      $this->author_id = $author_id;
      $this->publisher_id = $publisher_id;
   }

   public function getId() : int {
      return $this->id;
   }

   public function getTitle() : string {
      return $this->title;
   }

   public function getTotalPages() : int {
      return $this->total_pages;
   }

   public function getPrice() : float {
      return $this->price;
   }

   public function getCoverImgUrl() : string {
      return $this->cover_img_url;
   }

   public function getYearPublished() : int {
      return $this->year_published;
   }

   public function getLanguageId() : int {
      return $this->language_id;
   }

   public function getGenreId() : int {
      return $this->genre_id;
   }

   public function getAuthorId() : int {
      return $this->author_id;
   }

   public function getPublisherId() : int {
      return $this->publisher_id;
   }

   private static function createInstance(array $row) : Book {
      $book = new Book(
         $row['id'],
         $row['title'],
         $row['total_pages'],
         $row['price'],
         $row['cover_img_url'],
         $row['year_published'],
         $row['language_id'],
         $row['genre_id'],
         $row['author_id'],
         $row['publisher_id']
      );
      return $book;
   }

   private static function createArray(array $rows) : array {
      $books = [];
      foreach ($rows as $row) {
         $books[] = self::createInstance($row);
      }
      return $books;
   }

   public static function selectAll(StorageInterface $storage) : array {
      if ($storage instanceof DbStorage) {
         $storage->setQuery('SELECT * FROM books');
         $rows = $storage->select();
      }
      elseif ($storage instanceOf JsonStorage) {
         $rows = $storage->select();
      }
      else {
         $rows = [];
      }

      $books = self::createArray($rows);
      return $books;
   }

   public static function select(StorageInterface $storage, int $id) : ?Book {
      if ($storage instanceof DbStorage) {
         $storage->setQuery('SELECT * FROM books WHERE id = :id');
         $rows = $storage->select([ 'id' => $id ]);
      }
      elseif ($storage instanceOf JsonStorage) {
         $rows = $storage->select([ 'id' => $id ]);
      }
      else {
         $rows = [];
      }

      if ($rows) {
         $book = self::createInstance($rows[0]);
         return $book;
      }
      return null;
   }

   public static function find(StorageInterface $storage, string $keywords) {
      if ($storage instanceof DbStorage) {
         $storage->setQuery('SELECT title, total_pages, price, year_published,
            languages.name AS language,
            genres.name AS genre,
            CONCAT(authors.first_name, ' ', authors.last_name) AS author,
            publishers.name AS publisher
            FROM books
            INNER JOIN languages ON languages.id = books.language_id
            INNER JOIN genres ON genres.id = books.genre_id
            INNER JOIN authors ON authors.id = books.author_id
            INNER JOIN publishers ON publishers.id = books.publisher_id
            WHERE books.title LIKE :keywords
            OR CONCAT(authors.first_name, ' ', authors.last_name) LIKE :keywords
            OR publishers.name LIKE :keywords
         ');
         $rows = $storage->select([ 'id' => $id ]);
      }
      elseif ($storage instanceOf JsonStorage) {
         $rows = $storage->select([ 'id' => $id ]);
      }
      else {
         $rows = [];
      }

      if ($rows) {
         $book = self::createInstance($rows[0]);
         return $book;
      }
      return null;
   }

   public static function insert(StorageInterface $storage, array $datos) : ?Book {
      if ($storage instanceof DbStorage) {
         $storage->setQuery('INSERT INTO books
            (title, total_pages, price, cover_img_url,
            year_published, language_id, genre_id, author_id,
            publisher_id)
            VALUES (:title, :total_pages, :price,
            :cover_img_url, :year_published, :language_id,
            :genre_id, :author_id, :publisher_id)'
         );
         $exito = $storage->insert($datos);
      }
      elseif ($storage instanceOf JsonStorage) {
         $exito = $storage->insert($datos);
      }
      else {
         $exito = false;
      }

      if ($exito) {
         $datos['id'] = $storage->getLastInsertId();
         $book = self::createInstance($datos);
         return $book;
      }
      return null;
   }
}
