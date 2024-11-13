<?php
require_once("AnimalStorage.php");
require_once("Animal.php");

class AnimalStorageStub implements AnimalStorage {
    private $animals;

    public function __construct() {
        $this->animals = array(
            'medor' => new Animal("Médor", "chien", 5),
            'felix' => new Animal("Félix", "chat", 3),
            'denver' => new Animal("Denver", "dinosaure", 150)
        );
    }

    public function read($id) {
        foreach ($this->animals as $key => $animal) {
            if ($key === $id) {
                return $animal;
            }
        }
        return null;
    }

    public function readAll() {
        return $this->animals;
    }
}

