<?php
namespace App\Controller;

use App\Core\Config;
use App\Core\Helpers;
use App\Core\Session;
use App\Core\SetupDatabase;
use App\Core\View;
use App\Models\Page;
use App\Core\Database;
use App\Core\Validator;
use App\Core\Router;

class SetupController
{
    public function setup()
    {
        $view = new View('setup', "blank");
        $view->setTitle('Setup de l\'application');

        $_SESSION['setup_step'] = 1;
        if ($_POST) {
            $websitename = htmlspecialchars($_POST['websitename']);
            $emailadmin = htmlspecialchars($_POST['emailadmin']);
            $logo = Helpers::upload('Public/assets/image/logo');
            $datavalid = Validator::run($this->FirstForm(), $_POST);
            if ($datavalid) {
                $config = Config::getInstance();
                $config->saveConfig(['app_name' => $websitename, 'app_email' => $emailadmin]);
                $databaseSetup = new SetupDatabase();
                if(Session::get('SUCESS_CREATE_DATABASE')){
                $this->initAllPages();
                }
            }

        }
    }
/*$dbname = htmlspecialchars($_POST['dbname']);
$dblogin = htmlspecialchars($_POST['dblogin']);
$dbpwd = $_POST['dbpwd'];
$dbadress = htmlspecialchars($_POST['dbadress']);
$dbprefix = htmlspecialchars($_POST['dbprefix']);
$datavalid = Validator::run($this->*/

    public function initAllPages()
    {
        $pages = new Page;
        $routes = Router::getAllRoutes();
        foreach ($routes as $route => $value) {
            if ($route == '/') {
                $pages->setName('Index');
            } else {
                $routename = str_replace('/', '', $route);
                $pages->setName($routename);
            }
            $pages->setLink($route);
            $pages->setIndex(1);
            $pages->save();
        }

    }


    public function FirstForm()
    {
        return [
            "config" => [
                "method" => "POST",
                "uploadform" => true,
                "action" => "",
                "submit" => "Suivant"
            ],
            "inputs" => [
                "websitename" => [
                    "type" => "text",
                    "label" => "Nom du site",
                    "name" => "websitename",
                    "placeholder" => "Nom du site",
                    "required" => true,
                    "validation" => [
                        "required" => "Le nom du site est obligatoire"
                    ]
                ],
                "emailadmin" => [
                    "type" => "email",
                    "label" => "Email de l'administrateur",
                    "name" => "emailadmin",
                    "placeholder" => "Email de l'administrateur",
                    "required" => true,
                    "validation" => [
                        "required" => "L'email de l'administrateur est obligatoire"
                    ]
                ],
                "app_logo" => [
                    "type" => "file",
                    "label" => "Logo de l'application",
                    "name" => "app_logo",
                    "placeholder" => "Logo de l'application",
                    "required" => true,
                    "validation" => [
                        "required" => "Le logo de l'application est obligatoire"
                    ]
                ],
            ]
        ];
    }

    public function SecondForm()
    {
        return [
            "config" => [
                "method" => "POST",
                "uploadform" => false,
                "action" => "",
                "submit" => "Soumettre"
            ],
            "inputs" => [
                "db_name" => [
                    "type" => "text",
                    "label" => "Nom de la base de données",
                    "name" => "dbname",
                    "placeholder" => "Nom de la base de données",
                    "required" => true,
                    "validation" => [
                        "required" => "Le nom de la base de données est obligatoire"
                    ]
                ],
                "db_login" => [
                    "type" => "text",
                    "label" => "Login de la base de données",
                    "name" => "dblogin",
                    "placeholder" => "Login de la base de données",
                    "required" => true,
                    "validation" => [
                        "required" => "Le login de la base de données est obligatoire"
                    ]
                ],
                "db_pwd" => [
                    "type" => "password",
                    "label" => "Mot de passe de la base de données",
                    "name" => "dbpwd",
                    "placeholder" => "Mot de passe de la base de données",
                    "required" => true,
                    "validation" => [
                        "required" => "Le mot de passe de la base de données est obligatoire"
                    ]
                ],
                "db_adress" => [
                    "type" => "text",
                    "label" => "Adresse de la base de données",
                    "name" => "dbadress",
                    "placeholder" => "Adresse de la base de données",
                    "required" => true,
                    "validation" => [
                        "required" => "L'adresse de la base de données"
                    ]
                ],
                "db_host" => [
                    "type" => "text",
                    "label" => "Host de la base de données",
                    "name" => "dbhost",
                    "placeholder" => "Host de la base de données",
                    "required" => true,
                    "validation" => [
                        "required" => "Le host de la base de données"
                    ]
                ],
                "db_prefix" => [
                    "type" => "text",
                    "label" => "Préfix de la base de données",
                    "name" => "dbprefix",
                    "placeholder" => "Préfix de la base de données",
                    "required" => true,
                    "validation" => [
                        "required" => "Le prefix de la base de données"
                    ]
                ],
            ]
        ];
    }
}