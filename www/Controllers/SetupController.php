<?php
namespace App\Controller;

use App\Core\Config;
use App\Core\View;
use App\Model\Page;
use App\Core\Database;
use App\Core\Validator;
use App\Core\Router;

class SetupController
{
    public function setup()
    {
        $view = new View('setup');
        $view->setTitle('Setup de l\'application');
        print_r($_POST);

        if($_POST){
            $websitename = htmlspecialchars($_POST['websitename']);
            $emailadmin = htmlspecialchars($_POST['emailadmin']);
            $pwd = htmlspecialchars($_POST['pwd']);
            $confpass = htmlspecialchars($_POST['confpass']);
            $dbname = htmlspecialchars($_POST['dbname']);
            $dblogin = htmlspecialchars($_POST['dblogin']);
            $dbadress = htmlspecialchars($_POST['dbadress']);
            $dbprefix = htmlspecialchars($_POST['dbprefix']);
            $datavalid = true;
            if($datavalid){
                $config = Config::getInstance();
                $config->set('app_name', $websitename);
                $config->set('app_email', $emailadmin);
                $config->set('db_name', $dbname);
                $config->set('db_login', $dblogin);
                $config->set('db_adress', $dbadress);
                $config->set('db_prefix', $dbprefix);

                $this->initAllPages();
            }



        }

    }

    public function initAllPages()
    {
        $pages = new Page;


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

    //Generate a function formDatabaseinfos

    //Generate a save function for config.php
    public function set($key, $valueset)
    {
        foreach ($this->settings as $index => $value) {
            if(array_key_exists($key, $this->settings[$index])){
                $this->settings[$index][$key] = $valueset;
            }
        }
        return null;
    }
    public function saveConfig()
    {
        //open config.php
        $fp = fopen('config.php', 'a+');
        //write the config.php

    }

}