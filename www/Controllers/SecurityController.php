<?php

namespace App\Controller;

use App\Models\User as UserModel;
use App\Core\Validator;
use App\Core\View;
use App\Core\Security;
use App\Core\Helpers;

session_start();

class SecurityController
{
    public function login()
    {
        if (Security::isConnected()) {
            header('location: /admin/dashboard');
        }

        $user = new UserModel();
        if (!empty($_POST)) {
            $result = Validator::run($user->getFormLogin(), $_POST);
            print_r($result);
            if (empty($result)) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $data = $user->find(['email' => $email]);
                $hash_password_db = $data["password"];

                if (password_verify($password, $hash_password_db)) {
                    $_SESSION['user'] = $data["token"];
                    header('location: /admin');
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

        if (Security::isConnected()) {
            header('location: /admin/dashboard');
        }

        $user = new UserModel();
        // $user->select("esgi_user", ["token"]);
        // $test = $user->select("esgi_user", ["token"])->where("lastname", "LI")->getQuery();
        // echo $test;
        // die();

        if (!empty($_POST)) {
            $result = Validator::run($user->getFormRegister(), $_POST);
            if (empty($result)) {
                $token = str_shuffle(md5(uniqid()));

                $email = "li.benjamin75@gmail.com";
                $from = ['email' => "chiperz.esgi@gmail.com", 'name' => "toto"];
                $to = ['email' => $email, 'name' => "benjamin"];
                $subject = 'Chiperz Création de votre compte';
                $link = 'http://' . $_SERVER['HTTP_HOST'];
                $confirm_link = $link . '/register?token=' . $token;

                $email = Helpers::mailer($from, $to, $subject, ['[appname]', '[firstname]', '[email]', '[link]', '[confirm_link]'], ["Chiperz", ucfirst("benjamin"), $to['email'], $link, $confirm_link], true, 'registered');
                if ($email['error']) {
                    echo $email["error_message"];
                }

                // $user->select("esgi_user", ["token"])


                $user->setEmail($_POST["email"]);
                $user->setPassword($_POST["password"]);
                $user->setLastname($_POST["lastname"]);
                $user->setFirstname($_POST["firstname"]);
                $user->setToken($token);
                $user->save();

                header('location: /login');
            }
        }
        $view = new View("register");
        $view->assign("user", $user);
    }

    public function logout()
    {
        session_destroy();
        header('location: /login');
    }
}
