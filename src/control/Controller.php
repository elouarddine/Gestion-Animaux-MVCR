<?php

include 'model/Animal.php';

class Controller {
  private $view;
  private $animalsTab;

  public function __construct($view) {
      $this->view = $view;

      $this->animalsTab = array(
          'medor' => new Animal("Médor", "chien", 5),
          'felix' => new Animal("Félix", "chat", 3),
          'denver' => new Animal("Denver", "dinosaure", 150)
      );
  }

  public function getView() {
     return $this->view;
  }
  
 public function showInformation($id) {
    $found = false;  

    foreach ($this->animalsTab as $key => $animal) {
        if ($key === $id) {
            $this->view->prepareAnimalPage($animal);
            $found = true;
            break; 
        }
    }

    if (!$found) {
        $this->view->prepareUnknownAnimalPage();
    }
     
     $this->view->render();
    
  }

 
  public function showList() {
        $this->view->prepareListPage($this->animalsTab);
             $this->view->render();
  }

  
}
  
