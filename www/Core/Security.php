<?php

namespace App\Core;

class Security
{
    public static function isConnected()
    {
        if (Session::exist('user')) {
            $connected = true;
        } else {
            $connected = false;
        }
        return $connected;
    }

    public static function isAuthorized($roles)
    {
        if (empty($roles)) {
            return true;
        }

        return in_array($_SESSION['user']['role'], $roles);
    }
}