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


        $view = new View("auth/login", "blank");
        $view->assign("title", "Chiperz - Connexion");
        $view->assign("user", $user);



        if (!empty($_POST)) {
            $errors = [];

            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);

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
        $view = new View("auth/register", "blank");
        $view->assign("title", "Chiperz - Inscription");
        $view->assign("user", $user);

        if (!empty($_POST)) {
            $errors = [];
            $result = Validator::run($user->getFormRegister(), $_POST);

            var_dump($result);
            die();

            if (empty($result)) {
                $token = str_shuffle(md5(uniqid()));

                $data = $user->find(['email' => htmlspecialchars($_POST["email"])]);
                if (!empty($data)) {
                    $errors[] = "Cet email est déjà utilisé";
                    $view->assign("errors", $errors);
                }

                $user->setEmail(htmlspecialchars($_POST["email"]));
                $user->setPassword(htmlspecialchars($_POST["password"]));
                $user->setLastname(htmlspecialchars($_POST["lastname"]));
                $user->setFirstname(htmlspecialchars($_POST["firstname"]));
                $user->setToken($token);
                $user->save();

                $email = htmlspecialchars($_POST["email"]);
                $from = ['email' => "chiperz.esgi@gmail.com", 'name' => "Chiperz"];
                $to = ['email' => $email, 'name' => "user"];
                $subject = 'Chiperz - Création de votre compte';
                $link = 'http://' . $_SERVER['HTTP_HOST'];
                $confirm_link = $link . '/register?token=' . $token;

                $email = Helpers::mailer($from, $to, $subject, $confirm_link, true);
                if ($email['error']) {
                    echo $email["error_message"];
                }

                header('location: /login');
            } else {
                $view->assign("errors", $result);
            }
        }

        if (!empty($_GET["token"])) {

            $sql = $user->select($user->getTable(), ["*"])->where("token", htmlspecialchars($_GET["token"]))->getQuery();
            $result = $user->fetchQuery($sql);
            if (empty($result)) {
                // if token not found, redirect to login
                header('location: /login');
            } else {
                // if token found, set user status to 1 then redirect to login
                $update = $user->update($user->getTable(), ["status" => 1])->where("id", $result[0]["id"])->getQuery();
                $user->executeQuery($update);

                header('location: /login');
            }
        }
    }

    public function resetPassword() {
        $user = new UserModel();
        $view = new View("auth/forgotPassword", "blank");
        $view->assign("title", "Chiperz - Mot de passe oublié");
        $view->assign("user", $user);
        
        $view->assign("emailSent", false);

        if(!empty($_POST["email"]) && empty($_GET)) {
            $errors = [];
            $result = Validator::run($user->getFormResetPassword(), $_POST);

            if(empty($result)) {
                $data = $user->find(['email' => htmlspecialchars($_POST["email"])]);
                if(!empty($data)) {
                    $token = str_shuffle(md5(uniqid()));
                    $update = $user->update($user->getTable(), ["reset_token" => "'{$token}'"])->where("id", $data["id"])->getQuery();
                    $user->executeQuery($update);

                    // send email with token
                    $email = htmlspecialchars($_POST["email"]);
                    $from = ['email' => "chiperz.esgi@gmail.com", 'name' => "Chiperz"];
                    $to = ['email' => $email, 'name' => "user"];
                    $subject = 'Chiperz - Réinitialisation de votre mot de passe';
                    $link = 'http://' . $_SERVER['HTTP_HOST'];
                    $confirm_link = $link . '/forgot-password?token=' . $token;
    
                    $email = Helpers::mailer($from, $to, $subject, $confirm_link, true);
                    if ($email['error']) {
                        echo $email["error_message"];
                    }

                    $view->assign("emailSentMsg", "Un email vous a été envoyé");
                    
                } else {
                    $errors[] = "Aucun compte n'est lié à cet email";
                    $view->assign("errors", $errors);
                }
            }
        }

        if(!empty($_GET)) {
            $token = htmlspecialchars($_GET["token"]);
            $data = $user->find(['reset_token' => $token]);
            if(!empty($data)) {
                $view->assign("emailSent", true);
            } else {
                header('location: /login');
            }
        }

        if(!empty($_POST["password"]) && !empty($_GET)) {
            $token = htmlspecialchars($_GET["token"]);
            $errors = [];
            $result = Validator::run($user->getFormNewPassword(), $_POST);

            if(empty($result)) {
                if($_POST["password"] == $_POST["passwordConfirm"]) {
                    $data = $user->find(['reset_token' => $token]);
                    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                    $update = $user->update($user->getTable(), ["password" => "'".$hashed_password."'", "reset_token" => "NULL"])->where("reset_token", $token)->getQuery();
                    
                    $user->executeQuery($update);
                    header('location: /login');
                } else {
                    $errors[] = "Les mots de passe ne correspondent pas";
                    $view->assign("errors", $errors);
                }
            } else {
                $view->assign("errors", $result);
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('location: /login');
    }
}
