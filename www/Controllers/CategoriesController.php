<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Session;
use App\Models\Category;

class CategoriesController
{
  public function add()
  {
    $view = new View("categories/add", "back");

    $category = new Category();
    $view->assign("category", $category);

    // Todo: Validation des champs du formulaire 

    if (!empty($_POST)) {
      $category->setName($_POST["name"]);
      $category->save();
      Session::addMessage("ADD_CATEGORY_SUCCESS", "La catégorie a bien été ajouté", "success");
      header('location: /admin/products');
    }
  }

  public function edit()
  {
    $view = new View("categories/edit", "back");

    $categoryModel = new Category();
    $view->assign("categoryModel", $categoryModel);

    if (!empty($_GET["id"])) {
      $category = $categoryModel->find(['id' => $_GET["id"]]);
      $view->assign("category", $category);
    } else {
      header('location: /admin/products');
    }

    if (!empty($_GET["id"]) && !empty($_POST)) {
      $update = $categoryModel->update($categoryModel->getTable(), [
        'name' => "'{$_POST["name"]}'",
      ])->where("id", $_GET["id"])->getQuery();

      $categoryModel->executeQuery($update);
      Session::addMessage("EDIT_CATEGORY_SUCCESS", "La catégorie a bien été modifié", "success");

      header('location: /admin/products');
    }
  }
}
