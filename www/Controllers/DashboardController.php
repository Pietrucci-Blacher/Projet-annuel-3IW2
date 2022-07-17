<?php

namespace App\Controller;

use App\Core\View;
use App\Models\User as UserModel;
use App\Core\Session;


class DashboardController
{
    public function main()
    {

        if(!Session::get('user')) {
            header('Location: /login');
        }

        $user = new UserModel();
        $user = $user->find(['token' => Session::get('user')["token"]]);

        $firstname = $user["firstname"];
        $lastname = $user["lastname"];

        $view = new View("dashboard/main", "back");
        $view->assign("firstname", $firstname);
        $view->assign("lastname", $lastname);

    }
}