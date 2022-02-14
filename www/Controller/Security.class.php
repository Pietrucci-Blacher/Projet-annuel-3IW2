<?php

namespace App\Controller;

use App\Model\User as UserModel;
use App\Core\Validator;
use App\Core\View;

class Security
{
    public function login()
    {
        $user = new UserModel();
        if(!empty($_POST)){
            $result = Validator::run($user->getFormLogin(), $_POST); 
            print_r($result);
            if(empty($result)){
                $email = $_POST["email"];
                $password = $_POST["password"];
                
                $data = $user->find(['email' => $email]);
                $hash_password_db = $data["password"];

                if(password_verify($password, $hash_password_db)) {
                    header('location: /');
                } else {
                    return "password invalid";
                }
            }

        }
        $view = new View("login");
        $view->assign("title", "Espace connexion client - Chiperz");
        $view->assign("user", $user);
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

    public function logout()
    {
        
    }
}
