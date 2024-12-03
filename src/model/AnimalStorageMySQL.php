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
        $result = $this->connexion->query($requete);
        $tableaux = $result->fetchAll(PDO::FETCH_ASSOC); // FETCH_ASSOC indique au PDO de renvoyez le résultat sous forme de tableau associatif

        $return = [];
        foreach ($tableaux as $tab) {
            $return[$tab['id']] = new Animal($tab['name'], $tab['species'], $tab['age']);
        }
        //var_dump($return);
        return $return;
    }
    
    public function create(Animal $a) {
        try {
            $requete = "INSERT INTO animals (name, species, age) VALUES (:name, :species, :age)";
            $result = $this->connexion->prepare($requete);
    
            // Utilisation correcte des noms des colonnes et des paramètres
            $result->bindValue(':name', $a->getNom(), PDO::PARAM_STR);
            $result->bindValue(':species', $a->getEspece(), PDO::PARAM_STR);
            $result->bindValue(':age', $a->getAge(), PDO::PARAM_INT);
    
            // Exécution de la requête
            $result->execute();
    
            // Retourne l'ID de l'enregistrement inséré pour vérifier que tout fonctionne
            return $this->connexion->lastInsertId();
        } catch (PDOException $e) {
            // Loggez l'erreur plutôt que de l'afficher directement (ex: syslog, fichier de log)
            error_log("Erreur d'enregistrement: " . $e->getMessage());
            return false;
        }
    }
    
    public function delete($id){
        //throw new Exception("not yet Implemented");
        try {
            $requete = "DELETE FROM animals WHERE id = :id";
            $stmt = $this->connexion->prepare($requete);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur de suppression: " . $e->getMessage();
            return false;
        }
    }
    public function update($id, Animal $a){
        //throw new Exception("not yet Implemented");
        try {
            $requete = "UPDATE animals SET name = :name, species = :species, age = :age WHERE id = :id";
            $result = $this->connexion->prepare($requete);
            $result->bindValue(':name', $a->getNom(), PDO::PARAM_STR);
            $result->bindValue(':species', $a->getEspece(), PDO::PARAM_STR);
            $result->bindValue(':age', $a->getAge(), PDO::PARAM_INT);
    
            // Exécution de la requête
            $result->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur de modification: " . $e->getMessage();
            return false;
        }
    }

}
