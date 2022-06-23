<?php

namespace App\Core;

class Config
{
    private array $settings = [];
    private static Config $_instance;

    private function __construct()  // private constructor
    {
        $this->settings = $this->getConfigfromFile();
    }

    public static function getInstance(): Config
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }

   public function getConfigfromFile(): bool|array
    {
        return require('config.php');
    }

    public function get($key)
    {
        if (!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }

}