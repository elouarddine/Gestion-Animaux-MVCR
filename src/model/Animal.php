<?php

class Animal {
  private $nom;
  private $espece;
  private $age;

  public function __construct(string $nom ,string $espece ,int $age) {
      $this->nom = $nom;
      $this->espece = $espece;
      $this->age = $age;

  }
  public function getNom(): string {
    return $this->nom;
  }
  public function getEspece(): string {
    return $this->espece;
  }
  public function getAge(): int {
    return $this->age;
}

}