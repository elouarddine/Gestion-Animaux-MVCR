<?php
require_once("view/View.php");
require_once("control/Controller.php");

class Router {
    public function main(AnimalStorage $storage) {
        $view = new View($this);
        $controller = new Controller($view, $storage);
    
        if (!empty($_GET)) {
            switch ($_GET['action'] ?? '') {
                case 'liste':
                    $controller->showList();
                    break;
                case 'nouveau':
                    $controller->createNewAnimal();
                    break;
                case 'sauverNouveau':
                    $controller->saveNewAnimal($_POST);
                    break;
                default:
                    if (isset($_GET['id'])) {
                        $controller->showInformation($_GET['id']);
                    } else {
                        $controller->showInformation('Inconnu');
                    }
            }
        } else {
            $controller->showHomePage();
        }
        $view->render();
    }

    public function getAnimalCreationURL(){
        return "site.php?action=nouveau";
    } 
    
    public function getAnimalSaveURL(){
       return "site.php?action=sauverNouveau";
    }


    public function homePage() {
      return "site.php";
    }

  
   public function getAnimalListeURL() {
    return "site.php?action=liste";
   }

    public function getAnimalURL($id) {
        return "site.php?id=" . urlencode($id);
    }
}

