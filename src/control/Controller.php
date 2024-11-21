<?php
require_once("model/Animal.php");
require_once("model/AnimalStorage.php");

class Controller {
    private $view;
    private $storage;

    public function __construct($view, AnimalStorage $storage) {
        $this->view = $view;
        $this->storage = $storage;
    }

    public function showInformation($id) {
        $animal = $this->storage->read($id);
        if ($animal !== null) {
            $this->view->prepareAnimalPage($animal);
        } else {
            $this->view->prepareUnknownAnimalPage();
        }
        $this->view->render();
    }

    public function showHomePage(){
        $this->view->prepareHomePage();
        $this->view->render();

    }

    public function showList() {
        $this->view->prepareListPage($this->storage->readAll());
        $this->view->render();
    }
}

