<?php

namespace App\Controller;

use App\Models\User as UserModel;
use App\Core\Validator;
use App\Core\View;
use App\Core\Security;
use App\Core\Helpers;
use App\Core\Session;

class SecurityController
{
    public function login()
    {
        if (Security::isConnected()) {
            header('location: /admin/dashboard');
        }

        $user = new UserModel();


        $view = new View("login");
        $view->setTitle("Espace connexion client");
        $view->assign("user", $user);



        if (!empty($_POST)) {
            $errors = [];

            $email = $_POST["email"];
            $password = $_POST["password"];

            $data = $user->find(['email' => $email]);

            if (!is_null($data)) {

                $hash_password_db = $data["password"];

                if (!password_verify($password, $hash_password_db)) {
                    $errors[] = "Mail ou mot de passe incorrect";
                    $view->assign("errors", $errors);
                } else {
                    if ($data["status"] == 1) {
                        Session::add('user', $data);
                        header('location: /admin/dashboard');
                    } else {
                        $errors[] = "Votre compte n'est pas activé";
                        $view->assign("errors", $errors);
                    }
                }
            } else {
                $errors[] = "Aucun compte n'est lié à cet email";
                $view->assign("errors", $errors);
            }
        }
    }

    public function register()
    {
        if (Security::isConnected()) {
            header('location: /admin/dashboard');
        }
        $user = new UserModel();
        $view = new View("register");
        $view->setTitle("Espace inscription client");
        $view->assign("user", $user);

        if (!empty($_POST)) {
            $errors = [];
            $result = Validator::run($user->getFormRegister(), $_POST);
            if (empty($result)) {
                $token = str_shuffle(md5(uniqid()));

                $data = $user->find(['email' => $_POST["email"]]);
                if (!empty($data)) {
                    $errors[] = "Cet email est déjà utilisé";
                    $view->assign("errors", $errors);
                }

                $user->setEmail($_POST["email"]);
                $user->setPassword($_POST["password"]);
                $user->setLastname($_POST["lastname"]);
                $user->setFirstname($_POST["firstname"]);
                $user->setToken($token);
                $user->save();

                $email = $_POST["email"];
                $from = ['email' => "chiperz.esgi@gmail.com", 'name' => "toto"];
                $to = ['email' => $email, 'name' => "benjamin"];
                $subject = 'Chiperz Création de votre compte';
                $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
                $confirm_link = $link . '/register?token=' . $token;

                $email = Helpers::mailer($from, $to, $subject, ['[appname]', '[firstname]', '[email]', '[link]', '[confirm_link]'], ["Chiperz", ucfirst("benjamin"), $to['email'], $link, $confirm_link], true, 'registered');
                if ($email['error']) {
                    echo $email["error_message"];
                }

                header('location: /login');
            } else {
                $view->assign("errors", $result);
            }
        }

        if (!empty($_GET["token"])) {

            $sql = $user->select($user->getTable(), ["*"])->where("token", $_GET["token"])->getQuery();
            $result = $user->fetchQuery($sql);
            if (!empty($result)) {
                // if token found, set user status to 1 then redirect to login
                $update = $user->update($user->getTable(), ["status" => 1])->where("id", $result[0]["id"])->getQuery();
                $user->executeQuery($update);
            }
            header('location: /login');
        }
    }

    public function logout()
    {
        session_destroy();
        header('location: /login');
    }
}
