<?php
include 'view/View.php';
include 'control/Controller.php';
class Router {
  
  public function main() {

    $controller = new Controller(new View());


    $id = 'medor';

    if ( !empty($_GET) && isset($_GET['id']) ){
      $id = !empty(htmlspecialchars($_GET['id'])) ? htmlspecialchars($_GET['id']) : 'medor';
    }
      

    $controller->showInformation($id);

  }
  
}


