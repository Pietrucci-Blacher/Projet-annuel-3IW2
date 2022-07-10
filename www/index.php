<?php
namespace App;
use App\Core\Router;

require "conf.inc.php";


function myAutoloader($class){
    //$class = App\Core\CleanWords
    $class = str_ireplace("App\\", "", $class);
    //$class = Core\CleanWords
    $class = str_ireplace("\\", "/", $class);
    //$class = Core/CleanWords
    if(file_exists($class.".php")){
        include $class.".php";
    }
}

spl_autoload_register("App\myAutoloader");

session_start();

$uri = strtok($_SERVER["REQUEST_URI"],'?');

$router = new Router($uri);
