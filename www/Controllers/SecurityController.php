<?php

namespace App\Controller;

use App\Model\User as UserModel;
use App\Core\Validator;
use App\Core\View;
use App\Core\Security;


class SecurityController
{
    public function login()
    {
        if(Security::isConnected()) {
            header('location: /');
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

                if(password_verify($password, $hash_password_db)) {
                    $_SESSION["token"] = $token;
                    header('location: /');
                } else {
                    return "password invalid";
                }
            }

        }
        $view = new View("login");
        $view->setTitle("Espace connexion client");
        $view->assign("user", $user);
    }

    public function register()
    {
        $user = new UserModel();
        $view = new View("register");
        $view->setTitle("Espace inscription client");
        $view->assign("user", $user);

        if (!empty($_POST)) {
            $errors = [];
            $result = Validator::run($user->getFormRegister(), $_POST);
            if(empty($result)) {
                $user->setEmail($_POST["email"]);
                $user->setPassword($_POST["password"]);
                $user->setLastname($_POST["lastname"]);
                $user->setFirstname($_POST["firstname"]);
                $user->generateToken();
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
        $view = new View("register");
        $view->setTitle("Espace d'inscription client");
        $view->assign("user",$user);
    }

    public function logout(): void
    {
        unset($_SESSION["token"]);
        header("location: /login");
    }

}
