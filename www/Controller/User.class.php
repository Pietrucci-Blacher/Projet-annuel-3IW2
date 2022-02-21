<?php

namespace App\Controller;

// use App\Core\BaseSQL;
use App\Core\Validator;
use App\Core\View;
use App\Model\User as UserModel;

class User{

    public function login()
    {
        $user = new UserModel();
        print_r($_POST);


        $view = new View("login");
        $view->assign("title", "Espace connexion client - Chiperz");
        $view->assign("user", $user);
    }

    public function logout()
    {
        echo "Se deco";
    }

    public function register()
    {
        $user = new UserModel();
        if( !empty($_POST)){
            $result = Validator::run($user->getFormRegister(), $_POST);
            if(empty($result)) {
                $user->setEmail($_POST["email"]);
                $user->setPassword($_POST["password"]);
                $user->setLastname($_POST["lastname"]);
                $user->setFirstname($_POST["firstname"]);
                $user->save();
            }
        }
        $view = new View("register");
        $view->assign("user",$user);
    }

}