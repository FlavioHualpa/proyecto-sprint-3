<?php

  class User
  {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $countryCode;
    private $birthDate;
    private $sex;
    private $avatarUrl;
    private $password;
    private $creationDate;

    public function __construct(int $id, string $firstName, string $lastName, string $email, string $countryCode, string $birthDate, string $sex, string $avatarUrl, string $password, string $creationDate) {
      $this->id = $id;
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->email = $email;
      $this->countryCode = $countryCode;
      $this->birthDate = $birthDate;
      $this->sex = $sex;
      $this->avatarUrl = $avatarUrl;
      $this->password = $password;
      $this->creationDate = $creationDate;
    }

    public function getId() : int {
      return $this->id;
    }

    public function getFirstName() : string {
      return $this->firstName;
    }

    public function getLastName() : string {
      return $this->lastName;
    }

    public function getEmail() : string {
      return $this->email;
    }

    public function getCountryCode() : string {
      return $this->countryCode;
    }

    public function getBirthDate() : string {
      return $this->birthDate;
    }

    public function getCreationDate() : string {
      return $this->creationDate;
    }

    public function getSex() : string {
      return $this->sex;
    }

    public function getAvatarUrl() : string {
      return $this->avatarUrl;
    }

    public function getPassword() : string {
      return $this->password;
    }
  }
