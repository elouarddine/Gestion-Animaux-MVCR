<?php

require_once("model/Animal.php");
require_once("model/AnimalStorage.php");
require_once('/users/qach211/private/mysql_config.php');

class AnimalStorageMySQL implements AnimalStorage {

    private PDO $connexion;

    public function __construct(PDO $connexion) {
        $this->connexion = $connexion;
    }

    // Récupère un animal par son ID
    public function read($id): ?Animal {
        $requete = "SELECT * FROM animals WHERE id = :id";
        $stmt = $this->connexion->prepare($requete);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // indique au PDO que le paramètre lié dans la requête SQL préparée doit être traité comme un entier (integer).
        $stmt->execute();
        $tab = $stmt->fetch(PDO::FETCH_ASSOC); // FETCH_ASSOC indique au PDO de renvoyez le résultat sous forme de tableau associatif

        if ($tab) {
            return new Animal($tab['name'], $tab['species'], $tab['age']);
        }
        return null; // Retourne null si aucun animal trouvé
    }

    // Récupère tous les animaux
    public function readAll(): array {
        $requete = "SELECT * FROM animals";
        $stmt = $this->connexion->query($requete);
        $tableaux = $stmt->fetchAll(PDO::FETCH_ASSOC); // FETCH_ASSOC indique au PDO de renvoyez le résultat sous forme de tableau associatif

        $return = [];
        foreach ($tableaux as $tab) {
            $return[$tab['id']] = new Animal($tab['name'], $tab['species'], $tab['age']);
        }
        //var_dump($return);
        return $return;
    }
    
    public function create(Animal $a){
        throw new Exception("not yet Implemented");
    }
    public function delete($id){
        throw new Exception("not yet Implemented");
    }
    public function update($id, Animal $a){
        throw new Exception("not yet Implemented");
    }

}
