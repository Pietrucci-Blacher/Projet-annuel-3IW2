<?php

namespace App\Controller;

use App\Core\View;
use App\Models\User as UserModel;
use App\Core\Session;


class AdminController
{
    public function dashboard()
    {

        $user = new UserModel();
        $user = $user->find(['token' => Session::get('user')["token"]]);

        $firstname = $user["firstname"];
        $lastname = $user["lastname"];

        $view = new View("dashboard", "back");
        $view->assign("firstname", $firstname);
        $view->assign("lastname", $lastname);

    }
}