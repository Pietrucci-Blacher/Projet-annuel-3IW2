<?php
namespace App\Core;

class Session{
    public static function create(): void
    {
        if(session_status() == PHP_SESSION_DISABLED){
            session_start();
        }
    }

}