<?php
namespace App;
use App\Core\AutoLoader;
use App\Core\Router;
use App\Core\Config;

require "Core/AutoLoader.php";
AutoLoader::init();

session_start();

if(Config::getInstance()->get("debug")) {
    ini_set('display_errors', 1);
}else{
    ini_set('display_errors', 0);
}

$uriExploded = explode('?', $_SERVER['REQUEST_URI']);
$uri = $uriExploded[0];

$router = new Router($uri);


