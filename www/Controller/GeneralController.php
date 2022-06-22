<?php

namespace App\Controller;

use App\Core\View;

class GeneralController {

    public function home(): View
    {
        return new View('homepage');
        
    }

}
