<?php
require_once("model/Animal.php");
require_once("model/AnimalBuilder.php");
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
        $this->view->prepareAnimalCreationPage(new AnimalBuilder($_POST));
    }

    public function saveNewAnimal(array $data){

        $animalBuilder = new AnimalBuilder($data);
        
        if($animalBuilder->pasErreur()){
            $animal = $animalBuilder->createAnimal();
            $id=$this->storage->create($animal);
            $this->view->displayAnimalCreationSuccess($id); // Assurez-vous que getNom() renvoie l'ID ou une valeur unique
        }
        else{
            $this->view->prepareAnimalCreationPage($animalBuilder);
        }
    }


}

