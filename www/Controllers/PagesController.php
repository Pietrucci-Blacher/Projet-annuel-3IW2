<?php

namespace App\Controller;

use App\Core\View;
use App\Models\Page;

class PagesController
{
  public function main()
  {
    $pageModel = new Page();
    $pages = $pageModel->findAll();
    $view = new View('pages/main', 'front');
    $view->assign('pages', $pages);

    $navigation = [];
    foreach ($pages as $page) {
      $navigation[] = [
        "id" => $page->getId(),
        "name" => $page->getName()
      ];
    }

    $view->assign('navigation', $navigation);

    if (!empty($_GET["id"])) {
      $page = $pageModel->find(['id' => $_GET["id"]]);
      $view->assign("page", $page);
    } else {
      echo ('no id');
      // header('location: /');
    }
  }

  public function admin()
  {
    $page = new Page();
    $pages = $page->findAll();
    $tableHeaders = ['id', 'Nom', 'Taille du contenu'];

    $view = new View("pages/admin", "back");
    $view->assign('tableHeaders', $tableHeaders);
    $view->assign('pages', $pages);
  }

  public function add()
  {
    $view = new View("pages/add", "back");

    $page = new Page();
    $view->assign("page", $page);

    // Todo: Validation des champs du formulaire 
    if (!empty($_POST)) {
      $page->setName($_POST["name"]);
      $page->setContent($_POST["wysiwyg"]);
      $page->save();
      header('location: /admin/pages');
    }
  }

  public function edit()
  {
    $view = new View("pages/edit", "back");

    $pageModel = new page();
    $view->assign("pageModel", $pageModel);

    if (!empty($_GET["id"])) {
      $page = $pageModel->find(['id' => $_GET["id"]]);
      $view->assign("page", $page);
    } else {
      header('location: /admin/pages');
    }

    if (!empty($_GET["id"]) && !empty($_POST)) {
      $update = $pageModel->update($pageModel->getTable(), [
        'name' => "'{$_POST["name"]}'",
        'content' => "'{$_POST["wysiwyg"]}'",
      ])->where("id", $_GET["id"])->getQuery();

      $pageModel->executeQuery($update);

      header('location: /admin/pages');
    }
  }
}