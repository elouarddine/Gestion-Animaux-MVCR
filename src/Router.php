<?php
include 'view/View.php';
class Router {
  
  public function main() {
      
    $view = new View();
    $view->prepareAnimalPage("Médor", "Chien");
    $view->render();
  }
  
}


