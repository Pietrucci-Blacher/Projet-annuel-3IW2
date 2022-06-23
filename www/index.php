<?php
namespace App;
use App\Core\AutoLoader;
require "conf.inc.php";
require "Autoloader.php";

AutoLoader::init();

session_start();

$uri = $_SERVER["REQUEST_URI"];

$routeFile = "routes.yml";
if(!file_exists($routeFile)){
    die("Le fichier ".$routeFile." n'existe pas");
}

$routes = yaml_parse_file($routeFile);


if( empty($routes[$uri]) || empty($routes[$uri]["controller"])  || empty($routes[$uri]["action"]) ){
        die("Page 404");
}

$controller = ucfirst(strtolower($routes[$uri]["controller"]));
$action = strtolower($routes[$uri]["action"]);

// $controller = User ou $controller = Global
// $action = login ou $action = logout ou $action = home

$controllerFile = "Controller/".$controller."Controller.php";
if(!file_exists($controllerFile)){
    die("Le controller ".$controllerFile." n'existe pas");
}
include $controllerFile;

$controller = "App\\Controller\\".$controller."Controller";
if( !class_exists($controller) ){
   die("La classe ".$controller." n'existe pas");
}

$objectController = new $controller();

if( !method_exists($objectController, $action) ){
    die("La methode ".$action." n'existe pas");
}

$objectController->$action();




