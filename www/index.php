<?php
namespace App;
use App\Core\AutoLoader;
use App\Core\Router;
use App\Core\Config;

require "Core/AutoLoader.php";
ini_set('display_errors', 1);
AutoLoader::init();

session_start();

echo 'ok';

$uri = $_SERVER["REQUEST_URI"];


if(Config::getInstance()->get("debug")) {
    ini_set('display_errors', 1);
}else{
    ini_set('display_errors', 0);
}

$router = new Router($uri);

//$routes = yaml_parse_file($routeFile);


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