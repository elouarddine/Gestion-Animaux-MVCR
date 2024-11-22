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
        
    }

    public function showHomePage(){
        $this->view->prepareHomePage();
        

    }

    public function showList() {
        $this->view->prepareListPage($this->storage->readAll());
        
    }

    public function createNewAnimal(){
        $this->view->prepareAnimalCreationPage();
    }

    public function saveNewAnimal(array $data){
        $nom = $data['nom'];
        $espece = $data['espece'];
        $age = $data['age'];
        $animal = new Animal($nom, $espece, $age);
        $this->storage->create($animal);
        $this->view->prepareAnimalPage($animal);
    }


}

