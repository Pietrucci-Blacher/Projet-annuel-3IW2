<?php
namespace App;
use App\Core\Router;

use App\Core\AutoLoader;
use App\Core\Config;

require 'Core/AutoLoader.php';

AutoLoader::init();

session_start();

if(Config::getInstance()->get("dev_debug")) {
    ini_set('display_errors', 1);
}else{
    ini_set('display_errors', 0);
}

$uri = strtok($_SERVER["REQUEST_URI"],'?');

$router = new Router($uri);