<?php
require_once("view/View.php");
require_once("control/Controller.php");

class PathInfoRouter {
    public function main(AnimalStorage $storage) {
        $feedback = "";
        if (isset($_SESSION['feedback'])) {
            $feedback = $_SESSION['feedback'];
            $_SESSION['feedback'] = "";
        }

        $view = new View($this, $feedback);
        $controller = new Controller($view, $storage);

        $path = $_SERVER['PATH_INFO'] ?? '/';
        $path = trim($path, '/');
        $parts = explode('/', $path);

        if (empty($parts[0])) {
            $controller->showHomePage();
        } elseif ($parts[0] === 'liste') {
            $controller->showList();
        } elseif ($parts[0] === 'nouveau') {
            $controller->createNewAnimal();
        } elseif ($parts[0] === 'sauverNouveau') {
            $controller->saveNewAnimal($_POST);
        } elseif ($parts[0] === 'delete' && isset($parts[1])) {
            $controller->deleteAnimal($parts[1]);
        } elseif ($parts[0] === 'update' && isset($parts[1])) {
            $controller->updateAnimal($parts[1]);
        } elseif (isset($parts[0])) {
            $controller->showInformation($parts[0]);
        } else {
            $controller->showHomePage();
        }

        $view->render();
    }

    public function POSTredirect($url, $feedback) {
        $_SESSION['feedback'] = $feedback;
        header("Location: " . $url, true, 303);
    }

    public function getAnimalCreationURL() {
        return "site.php/nouveau";
    }

    public function getAnimalSaveURL() {
        return "site.php/sauverNouveau";
    }

    public function homePage() {
        return "site.php/";
    }

    public function getAnimalListeURL() {
        return "site.php/liste";
    }

    public function getAnimalURL($id) {
        return "site.php/" . urlencode($id);
    }

    public function getAnimalUpdateURL($id) {
        return "site.php/update/" . urlencode($id);
    }

    public function getAnimalDeleteURL($id) {
        return "site.php/delete/" . urlencode($id);
    }
}
