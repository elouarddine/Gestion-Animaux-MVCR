<?php

class View {
    private $title;
    private $content;
    private $router;  
    private $menu;  


    public function __construct($router) {
        $this->router = $router;
        $this->menu = array(
            "Accueil" => $this->router->homePage(),
            "Liste d'animaux" => $this->router->getAnimalListeURL(),
            "creer" => $this->router->getAnimalCreationURL(),
        );

    }


    public function getMenu() {
        return $this->menu;
      }
  
    public function prepareAnimalCreationPage(AnimalBuilder $builder) {

        $data = $builder->getData();
        $error = $builder->getError();

        $nom = isset($data[AnimalBuilder::NAME_REF]) ? htmlspecialchars($data[AnimalBuilder::NAME_REF]) : '';
        $espece = isset($data[AnimalBuilder::SPECIES_REF]) ? htmlspecialchars($data[AnimalBuilder::SPECIES_REF]) : '';
        $age = isset($data[AnimalBuilder::AGE_REF]) ? htmlspecialchars($data[AnimalBuilder::AGE_REF]) : '';
    
        $this->title = "Ajouter votre Animal";
    
        $s = '<form action="' . $this->router->getAnimalSaveURL() . '" method="POST">' . "\n";
        $s .= "<label for='name'>Nom:</label>
                <input type='text' placeholder='nom' name='nom' value='" . $nom. "' />
                <label for='espece'>Espece :</label>
                <input type='text' placeholder='espece' name='espece' value='" . $espece. "' />
                <label for='age'>Age :</label>
                <input type='number' placeholder='age' name='age' value='" . $age. "' />
                <button type='submit'>Envoyer !</button>
                </form>
                <p style='color:red;'>".$error."</p>";
    
        $this->content = $s;
    }

    public function displayAnimalCreationSuccess($id) {
        // Redirige vers la page de l'animal nouvellement créé avec un message de feedback ignoré pour l'instant
        $this->router->POSTredirect($this->router->getAnimalURL($id), 'Animal créé avec succès !');
    }
    
    public function prepareTestPage() {
        $this->title = "Page de Test";
        $this->content = "Ceci est le contenu de la page de test.";
    }

    public function prepareHomePage() {
        $this->title = "Page d'Accueil";
        $this->content = "Bienvenu dans notre site web.";
    }

    public function prepareAnimalPage(Animal $animal) {
        $this->title = "Page sur " . $animal->getNom();
        $this->content = $animal->getNom() . " est un " . $animal->getEspece() . " de " . $animal->getAge() . " ans.";
    }

    public function prepareUnknownAnimalPage() {
        $this->title = "Animal inconnu";
        $this->content = "Désolé, cet animal est inconnu.";
    }

    public function prepareListPage(array $animals) {
        $this->title = "Liste des Animaux";
        $this->content = "<ul>";
        foreach ($animals as $id => $animal) {
            $url = $this->router->getAnimalURL($id);
            $this->content .= "<li><a href=\"$url\">" . htmlspecialchars($animal->getNom()) . "</a></li>";
        }
        $this->content .= "</ul>";
    }

    public function prepareUnexpectedErrorPage(Exception $e=null) {
        $this->title = "Erreur";
        $this->content = "Une erreur inattendue s'est produite.".$e;
    }

    public function prepareDebugPage($variable) {
        $this->title = 'Debug';
        $this->content = '<pre>'.htmlspecialchars(var_export($variable, true)).'</pre>';
    }

    public function render() {
        if ($this->title === null || $this->content === null) {
            $this->prepareUnexpectedErrorPage();
        }
        
        ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $this->title; ?></title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="skin/screen.css" />
</head>
<body>
    <nav class="menu">
        <ul>
<?php
foreach ($this->getMenu() as $text => $link) {
    echo "<li><a href=\"$link\">$text</a></li>";
}
?>
        </ul>
    </nav>
    <main>
        <h1><?php echo $this->title; ?></h1>
<?php
echo $this->content;
?>
    </main>
</body>
</html>
<?php 

    }

}

?>