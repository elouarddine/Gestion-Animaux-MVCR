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
        $this->view->prepareAnimalCreationPage();
    }

    public function saveNewAnimal(array $data){

        $nom = $data['nom'];
        $espece = $data['espece'];
        $age = $data['age'];

        if ( empty($nom) || is_numeric($nom) ) {
            $this->view->prepareAnimalCreationPage($data,"Nom invalide");
        }
        else if (empty($espece) || is_numeric($espece)){
            $this->view->prepareAnimalCreationPage($data,"Espece invalide");
        }
        else if ( !is_numeric($age) || $age < 0){
            $this->view->prepareAnimalCreationPage($data,"Age invalide");
        }
        else{
            $animalBuilder = new AnimalBuilder();
            $animal = $animalBuilder->setNom($nom)->setEspece($espece)->setAge($age)->build();

            $this->storage->create($animal);
            $this->view->prepareAnimalPage($animal);
        }
    }


}

