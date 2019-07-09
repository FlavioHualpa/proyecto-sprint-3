<?php

class BookSearch
{
   private $id;
   private $title;
   private $total_pages;
   private $price;
   private $cover_img_url;
   private $year_published;
   private $language;
   private $genre;
   private $author;
   private $publisher;

   public function __construct(int $id, string $title, int $total_pages, float $price, string $cover_img_url, int $year_published, string $language, string $genre, string $author, string $publisher) {
      $this->id = $id;
      $this->title = $title;
      $this->total_pages = $total_pages;
      $this->price = $price;
      $this->cover_img_url = $cover_img_url;
      $this->year_published = $year_published;
      $this->language = $language;
      $this->genre = $genre;
      $this->author = $author;
      $this->publisher = $publisher;
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

   public function getLanguage() : string {
      return $this->language;
   }

   public function getGenre() : string {
      return $this->genre;
   }

   public function getAuthor() : string {
      return $this->author;
   }

   public function getPublisher() : string {
      return $this->publisher;
   }

   private static function createInstance(array $row) : BookSearch {
      $book = new BookSearch(
         $row['id'],
         $row['title'],
         $row['total_pages'],
         $row['price'],
         $row['cover_img_url'],
         $row['year_published'],
         $row['language'],
         $row['genre'],
         $row['author'],
         $row['publisher']
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
         $storage->setQuery('SELECT books.id, title, total_pages,
            price, cover_img_url, year_published,
            languages.name AS language,
            genres.name AS genre,
            CONCAT(authors.first_name, " ", authors.last_name) AS author,
            publishers.name AS publisher
            FROM books
            INNER JOIN languages ON languages.id = books.language_id
            INNER JOIN genres ON genres.id = books.genre_id
            INNER JOIN authors ON authors.id = books.author_id
            INNER JOIN publishers ON publishers.id = books.publisher_id'
         );
         $rows = $storage->select();
      }
      elseif ($storage instanceOf JsonStorage) {
         $rows = [];
      }
      else {
         $rows = [];
      }

      $books = self::createArray($rows);
      return $books;
   }

   public static function select(StorageInterface $storage, int $id) : ?BookSearch {
      if ($storage instanceof DbStorage) {
         $storage->setQuery('SELECT books.id, title, total_pages,
            price, cover_img_url, year_published,
            languages.name AS language,
            genres.name AS genre,
            CONCAT(authors.first_name, " ", authors.last_name) AS author,
            publishers.name AS publisher
            FROM books
            INNER JOIN languages ON languages.id = books.language_id
            INNER JOIN genres ON genres.id = books.genre_id
            INNER JOIN authors ON authors.id = books.author_id
            INNER JOIN publishers ON publishers.id = books.publisher_id
            WHERE id = :id'
         );
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

   public static function find(StorageInterface $storage, string $keywords) : array {
      if ($storage instanceof DbStorage) {
         $storage->setQuery('SELECT books.id, title, total_pages,
            price, cover_img_url, year_published,
            languages.name AS language,
            genres.name AS genre,
            CONCAT(authors.first_name, " ", authors.last_name) AS author,
            publishers.name AS publisher
            FROM books
            INNER JOIN languages ON languages.id = books.language_id
            INNER JOIN genres ON genres.id = books.genre_id
            INNER JOIN authors ON authors.id = books.author_id
            INNER JOIN publishers ON publishers.id = books.publisher_id
            WHERE books.title LIKE :keywords
            OR CONCAT(authors.first_name, " ", authors.last_name) LIKE :keywords
            OR publishers.name LIKE :keywords'
         );
         $rows = $storage->select([
            'keywords' => '%' . $keywords .'%'
         ]);
      }
      elseif ($storage instanceOf JsonStorage) {
         $rows = [];
      }
      else {
         $rows = [];
      }

      if ($rows) {
         $books = self::createArray($rows);
         return $books;
      }
      return null;
   }

   public static function insert(StorageInterface $storage, array $datos) : ?BookSearch {
      throw new \Exception("No se puede insertar BookSearch en la base de datos", 1);
   }
}
