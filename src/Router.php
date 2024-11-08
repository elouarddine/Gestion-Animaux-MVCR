<?php
include 'view/View.php';
include 'control/Controller.php';
class Router {
  
  public function main() {

    $controller = new Controller(new View());
    $controller->showInformation("medor");

  }
  
}


