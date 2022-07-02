<?php
namespace App\Controller;

use App\Core\Config;

class SetupController{
    public function setup()
    {

    }

    //Check if the app is setup
    public static function isSetup(): bool
    {
        return (bool)Config::getInstance()->get('setup');
    }
}