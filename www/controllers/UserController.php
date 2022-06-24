<?php

namespace App\Controller;

// use App\Core\BaseSQL;
use App\Core\Validator;
use App\Core\View;
use App\Models\User as UserModel;

class UserController
{

    public function login()
    {
        $user = new UserModel();
        if (!empty($_POST)) {
            $result = Validator::run($user->getFormLogin(), $_POST);
            print_r($result);
            if (empty($result)) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $data = $user->find(['email' => $email]);
                $token = $data["token"];
                $hash_password_db = $data["password"];

                if (password_verify($password, $hash_password_db)) {
                    $_SESSION["token"] = $token;
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

    public function logout()
    {
        echo "Se deco";
    }

    public function register()
    {
        $user = new UserModel();
        if (!empty($_POST)) {
            $result = Validator::run($user->getFormRegister(), $_POST);
            if (empty($result)) {
                $user->setEmail($_POST["email"]);
                $user->setPassword($_POST["password"]);
                $user->setLastname($_POST["lastname"]);
                $user->setFirstname($_POST["firstname"]);
                $user->generateToken();
                $user->save();
            }
        }
        $view = new View("register");
        $view->assign("user", $user);
    }
}
