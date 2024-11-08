<?php
include 'view/View.php';
class Router {
  
  public function main() {

    //$view = new View();
    $controler = new Controler();

    $id = 'medor';

    if ( !empty($_GET) && isset($_GET['id']) ){
      $id = htmlspecialschars($_GET['id']);
    }
      

    $controler->showInformation($id);
    //$view->prepareAnimalPage("Médor", "Chien");
    //$view->render();
  }
  
}


