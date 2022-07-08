<?php

namespace App\Controller;

use App\Core\View;

class GeneralController {

    public function home():void
    {
        $view = new View('homepage');
        $view->setTitle('Page d\'accueil');
    }

}


