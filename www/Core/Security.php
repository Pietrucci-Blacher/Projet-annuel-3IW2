<?php

namespace App\Core;

class Security
{
    public static function isConnected(){
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            $connected = true;
        }else {
            $connected = false;
        }
        return $connected;
    }
}