<?php
namespace App\Controller;

use App\Core\Config;
use App\Core\View;
use App\Model\Page;
use App\Core\Validator;
use App\Core\Router;

class SetupController
{
    public function setup()
    {
        $view = new View('setup');
        $view->setTitle('Setup de l\'application');

        if($_POST){
            $websitename = htmlspecialchars($_POST['websitename']);

        }

    }

    public function initAllPages()
    {

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

}