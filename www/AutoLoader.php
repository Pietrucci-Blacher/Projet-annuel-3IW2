<?php
namespace App\Core;

class AutoLoader{

    public static function init(): void
    {
        spl_autoload_register(function($class){
            $class = str_ireplace("App\\", "", $class);
            $class = str_ireplace("\\", "/", $class);
            if(file_exists($class.".php")){
                include $class.".php";
            }
        });
    }
}