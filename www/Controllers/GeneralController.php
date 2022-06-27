<?php

namespace App\Controller;

use App\Core\View;

class GeneralController {

    public function home(): View
    {
        return new View('homepage');
    }

    public function error(): View
    {
        return new View('error');
    }

}
