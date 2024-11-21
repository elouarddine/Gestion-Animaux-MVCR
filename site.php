<?php


/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
set_include_path("./src");

/* Inclusion des classes utilisées dans ce fichier */


require_once("model/AnimalStorageSession.php");
session_start();
require_once("Router.php");


/*
 * Cette page est simplement le point d'arrivée de l'internaute
 * sur notre site. On se contente de créer un routeur
 * et de lancer son main.
 */
$storage = new AnimalStorageSession();
$router = new Router();
$router->main($storage);
?>
