<?php

class View {
    public $title;
    public $content;
    private $router;  


    public function __construct($router) {
        $this->router = $router;
    }

    public function render() {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>{$this->title}</title>
        </head>
        <body>
            <h1>{$this->title}</h1>
            <p>{$this->content}</p>
        </body>
        </html>";
    }

    public function prepareTestPage() {
        $this->title = "Page de Test";
        $this->content = "Ceci est le contenu de la page de test.";
    }

    public function prepareAnimalPage(Animal $animal) {
        $this->title = "Page sur " . $animal->getNom();
        $this->content = $animal->getNom() . " est un " . $animal->getEspece() . " de " . $animal->getAge() . " ans.";
    }

    public function prepareUnknownAnimalPage() {
        $this->title = "Animal inconnu";
        $this->content = "Désolé, cet animal est inconnu.";
    }

    

    public function prepareListPage(array $animals) {
        $this->title = "Liste des Animaux";
        $this->content = "<ul>";
        foreach ($animals as $id => $animal) {
            $url = $this->router->getAnimalURL($id);
            $this->content .= "<li><a href=\"$url\">" . htmlspecialchars($animal->getNom()) . "</a></li>";
        }
        $this->content .= "</ul>";
    }
}

?>

