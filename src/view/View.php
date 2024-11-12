<?php

class View {
    public $title;
    public $content;
    
    
    public function getTitle() {
      return $this->title;
    }

    public function getContent() {
      return $this->content;
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

}

?>
