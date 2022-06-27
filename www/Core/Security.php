<?php

namespace App\Core;

class Security
{
    public static function isConnected(){
        if(Session::exist('user')){
            $connected = true;
        }else {
            $connected = false;
        }
        return $connected;
    }

    public static function Authorization(string $getRole)
    {
        //Check if user is authorized
    }
}