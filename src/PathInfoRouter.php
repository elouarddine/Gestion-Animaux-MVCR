<?php
require_once("view/View.php");
require_once("control/Controller.php");

class PathInfoRouter {
    public function main(AnimalStorage $storage) {
        // Récupérer le feedback s'il y en a dans la session
        $feedback = "";
        if (isset($_SESSION['feedback'])) {
            $feedback = $_SESSION['feedback'];
            $_SESSION['feedback'] = "";
        }
    
        // Initialiser la vue et le contrôleur
        $view = new View($this, $feedback);
        $controller = new Controller($view, $storage);
    
        $path = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : '';
    
        // Découpe les segments du path
        $segments = explode('/', $path);
    
        // Prendre uniquement le dernier segment
        $lastSegment = end($segments); // dernier segment de l'URL
        var_dump($lastSegment);
        // Si PATH_INFO est vide ou contient seulement "site.php" (c'est-à-dire la racine), afficher la page d'accueil
        if (empty($path) || $path === "site.php") {
            $controller->showHomePage();
        } else {
            // Routage basé sur le dernier segment
            switch ($lastSegment) {
                case 'site.php':
                    echo "WAZABI WA DINI L'ACCEUIL";
                    $controller->showHomePage();
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
                    // Si le segment est un ID, afficher les informations de l'animal
                    $controller->showInformation($lastSegment);
                    break;
            }
        }
    
        // Rendu de la vue
        $view->render();
    }
    
    // Fonction de redirection avec message de feedback
    public function POSTredirect($url, $feedback) {
        $_SESSION['feedback'] = $feedback;
        header("Location: " . $url, true, 303);
        exit();
    }

    // Générer une URL RESTful pour créer un nouvel animal
    public function getAnimalCreationURL() {
        return "site.php/nouveau";
    }

    // Générer une URL RESTful pour sauvegarder un nouvel animal
    public function getAnimalSaveURL() {
        return "site.php/sauverNouveau";
    }

    // Générer une URL RESTful pour la page d'accueil
    public function homePage() {
        return "site.php";
    }

    // Générer une URL RESTful pour la liste des animaux
    public function getAnimalListeURL() {
        return "site.php/liste";
    }

    // Générer une URL RESTful pour afficher un animal spécifique
    public function getAnimalURL($id) {
        return "site.php/" . urlencode($id);
    }
}
?>
