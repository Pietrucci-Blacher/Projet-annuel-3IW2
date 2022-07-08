<?php

namespace App\Core;

class Security
{
    public static function isConnected(): bool
    {
        if(Session::exist('user')){
            $connected = true;
        }else {
            $connected = false;
        }
        return $connected;
    }

    public static function Authorization(array $getRole)
    {
        //Check if user is authorized
    }
}