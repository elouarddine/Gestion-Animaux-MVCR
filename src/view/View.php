<?php
class View {
  private $title;
  private $content;

  public function getTitle() {
     return $this->title;
  }
  public function getContent() {
     return $this->content;
  }
  
  public function setTitle($title) {
      $this->title = $title;
  }
  public function setContent($content) {
      $this->content = $content;
  }
 
  public function render() {
      echo "<!DOCTYPE html> 
           <html lang='fr'>
           <head>
              <title>Page sur {$this->title}</title>
           </head>
           <body>
                <h1>Page sur{$this->title}</h1>
                <div>
                  {$this->title} est un animal de l'espèce {$this->content}
                </div>
           </body>
</html>";
  }

  public function prepareTestPage(){
      $this->setTitle("Le Titre de View");
      $this->setContent("Le Contenu de View");
  }

  public function prepareAnimalPage($name, $species){
      $this->setTitle($name);
      $this->setContent($species);
  }

}

