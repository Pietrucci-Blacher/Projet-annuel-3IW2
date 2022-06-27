<?php

namespace App\Core;

class Config
{
    private static $_instance;
    private $settings = [];

    private function __construct()  // private constructor
    {
        $this->settings = $this->getConfigfromFile();
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }

    public function getConfigfromFile()
    {
        return require('config.php');
    }

    public function get($key)
    {
        foreach ($this->settings as $index => $value) {
            if(array_key_exists($key, $this->settings[$index])){
                return $this->settings[$index][$key];
            }
        }
        return null;
    }
}