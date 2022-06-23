<?php

namespace App\Core;

class Security {
	public static function isConnected(): bool
    {
        if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
            $connected = true;
        }else {
            $connected = false;
        }
        return $connected;
	}

	public static function isAdmin() {

	}

}