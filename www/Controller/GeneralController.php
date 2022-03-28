<?php

namespace App\Controller;

use App\Core\View;
use App\Core\JWT\JWT;

class GeneralController {

    public function home()
    {
        echo "Welcome";
        
    }

    public function contact()
    {
        $view = new View("contact");
    }
}

?>