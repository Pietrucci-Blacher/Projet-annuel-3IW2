<?php

namespace App\Core;

class Config
{
    private array $settings = [];
    private static $_instance;

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }

    function getConfigfromIni(): bool|array
    {
        return parse_ini_file('app.ini');
    }

    private function __construct()  // private constructor
    {
        $this->settings = $this->getConfigfromIni();
    }

    public function get($key)
    {
        if (!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }

}