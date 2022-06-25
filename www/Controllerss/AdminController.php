<?php

namespace App\Controller;

use App\Core\View;


class AdminController
{
    public function dashboard()
    {

        $firstname = "Yves";
        $lastname = "SKRZYPCZYK";

        $view = new View("dashboard", "back");
        $view->assign("firstname", $firstname);
        $view->assign("lastname", $lastname);

    }
}