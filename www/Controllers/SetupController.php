<?php
namespace App\Controller;

use App\Core\Config;
use App\Core\View;
use App\Models\Page;
use App\Core\Database;
use App\Core\Validator;
use App\Core\Router;

class SetupController
{
    public function setup()
    {
        $view = new View('setup');
        $view->setTitle('Setup de l\'application');

        if ($_POST) {
            $websitename = htmlspecialchars($_POST['websitename']);
            $emailadmin = htmlspecialchars($_POST['emailadmin']);
            $dbname = htmlspecialchars($_POST['dbname']);
            $dblogin = htmlspecialchars($_POST['dblogin']);
            $dbpwd = $_POST['dbpwd'];
            $dbadress = htmlspecialchars($_POST['dbadress']);
            $dbprefix = htmlspecialchars($_POST['dbprefix']);
            $datavalid = true;
            if ($datavalid) {
                $config = Config::getInstance();
                $config->saveConfig(['app_name' =>$websitename, 'app_email' => $emailadmin,'db_name' => $dbname,  'db_login' => $dblogin, 'db_pwd' => $dbpwd, 'db_host' => $dbadress, 'db_prefix' => $dbprefix, 'app_setup' => true]);
                $this->initAllPages();
            }

        }
    }



    public function initAllPages()
    {
        $pages = new Page;
        $routes = Router::getAllRoutes();
        foreach ($routes as $route => $value) {
            if($route == '/'){
                $pages->setName('Index');
            }else{
                $routename = str_replace('/', '', $route);
                $pages->setName($routename);
            }
            $pages->setLink($route);
            $pages->setIndex(1);
            $pages->save();
        }

    }


    public function formGeninfo()
    {
        return [
            "config"=>[
                "method"=>"POST",
                "uploadform" => false,
                "action"=>"",
                "submit"=>"S'inscrire"
            ],
            "inputs" => [

            ]
        ];
    }




}