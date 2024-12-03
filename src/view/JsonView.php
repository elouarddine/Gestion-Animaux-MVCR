<?php
class JsonView {
    private function setHeaders() {
        header("Access-Control-Allow-Origin: *"); // Remplace * par l'origine spécifique si nécessaire
        header('Content-Type: application/json; charset=UTF-8');
    }

    public function prepareListPage($animals) {
        // Renvoie une représentation JSON de la liste des noms des animaux
        $this->setHeaders();
        $result = [];
        foreach ($animals as $id => $animal) {
            $result[] = ['id' => $id, 'nom' => $animal->getNom()];
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function prepareAnimalPage($animal) {
        // Renvoie une représentation JSON des détails d'un animal
        $this->setHeaders();
        $result = [
            'nom' => $animal->getNom(),
            'espece' => $animal->getEspece(),
            'age' => $animal->getAge(),
        ];
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function renderError($message) {
        // Renvoie un message d'erreur en JSON
        $this->setHeaders();
        $result = ['error' => $message];
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
}
?>