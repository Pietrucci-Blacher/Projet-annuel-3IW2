<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Media as MediaModel;

class AdminController
{
    public function dashboard()
    {
        $firstname = "Yves";
        $lastname = "SKRZYPCZYK";

        $view = new View("dashboard", "back");
        $view->assign("firstname", $firstname);
        $view->assign("lastname", $lastname);

    }
    public function medias(){
        $medias = new MediaModel();
        $mediaList = $medias->findAll([],[],true);
        $mediasView = new View("medias");
        $mediasView->assign("medias",$mediaList);
    }
}
