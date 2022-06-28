<?php

namespace App\Controller;

use App\Core\View;
use App\Models\Media as MediaModel;
use App\Models\Article as ArticleModel;
use App\Models\User as UserModel;

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

    public function articles(){
        $articles = new ArticleModel();
        $articleList = $articles->findAll([],[],true);
        $articlesView = new View("articles");
        $articlesView->assign("articles",$articleList);
    }

    public function users(){
        $users = new UserModel();
        $userList = $users->findAll([],[],true);
        $usersView = new View("users");
        $usersView->assign("users",$userList);
    }
}
