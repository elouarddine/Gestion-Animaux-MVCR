<?php

class AnimalBuilder {
    private $data;
    private $error;

    // Define constants for field names
    const NAME_REF = 'nom';
    const SPECIES_REF = 'espece';
    const AGE_REF = 'age';

    public function __construct($data) {
        $this->data = $data;
        $this->error = "";
    }

    public function getData() { return $this->data; }
    public function getError() { return $this->error; }
    public function pasErreur(){ 
        return $this->isValid();
    }
    
    public function isValid() {
        if (empty($this->data)) {
            $this->error = "Données vides";
            return false; // Early return for better flow control
        }

        // Check for required fields using constants
        if (!isset($this->data[self::NAME_REF])) {
            $this->error = "Nom n'existe pas dans les données";
            return false;
        } elseif (!isset($this->data[self::SPECIES_REF])) {
            $this->error = "Espece n'existe pas dans les données";
            return false;
        } elseif (!isset($this->data[self::AGE_REF])) {
            $this->error = "Age n'existe pas dans les données";
            return false;
        }

        $nom = $this->data[self::NAME_REF];
        $espece = $this->data[self::SPECIES_REF];
        $age = $this->data[self::AGE_REF];

        if (empty($nom) || is_numeric($nom)) {
            $this->error = "Nom invalide";
            return false;
        } elseif (empty($espece) || is_numeric($espece)) {
            $this->error = "Espece invalide";
            return false;
        } elseif (!is_numeric($age) || $age < 0) {
            $this->error = "Age invalide";
            return false;
        }

        return true; // Return true if all validations pass
    }

    public function createAnimal() {
        $nom = $this->data[self::NAME_REF];
        $espece = $this->data[self::SPECIES_REF];
        $age = $this->data[self::AGE_REF];
        
        return new Animal($nom, $espece, $age);
    }
}

?>