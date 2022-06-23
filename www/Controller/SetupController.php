<?php
namespace App\Controller;

use App\Core\View;
use App\Core\Database;
use App\Model\User as UserModel;

class SetupController{
    public function init(){
        $view = new View("installer");
    }

    public function firstForm(){

    }
}