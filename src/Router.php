<?php
require_once("view/View.php");
require_once("control/Controller.php");

class Router {
    public function main() {
        $view = new View($this);  
        $controller = new Controller($view);

    if(!empty($_GET)){
        
        if (isset($_GET['action']) && $_GET['action'] === "liste") {
            $controller->showList();
        } elseif (isset($_GET['id'])) {
            $controller->showInformation($_GET['id']);
        }
    }
    
    if(empty($_GET)){
       $controller->showInformation('medor');
    }
    
    if (isset($_GET['action']) && $_GET['action'] !== "liste") {
        $controller->showInformation('medor');
    }
    
  }


    public function getAnimalURL($id) {
        return "site.php?id=" . urlencode($id);
    }
}

?>

