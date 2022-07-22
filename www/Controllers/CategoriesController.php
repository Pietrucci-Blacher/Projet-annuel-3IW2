<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Session;
use App\Core\Validator;
use App\Models\Category;

class CategoriesController
{
  public function add()
  {
    $view = new View("categories/add", "back");
    $view->assign("title", "Chiperz - Ajouter une catégorie");

    

    $category = new Category();
    $view->assign("category", $category);

    // Todo: Validation des champs du formulaire 

    if (!empty($_POST)) {
      $result = Validator::run($category->getFormCategory(), $_POST);
      if(empty($result)) {
        $category->setName(htmlspecialchars($_POST["name"]));
        $category->save();
        Session::addMessage("ADD_CATEGORY_SUCCESS", "La catégorie a bien été ajouté", "success");
        header('location: /admin/products');
      } else {
        $view->assign("errors", $result);
      }

    }
  }

  public function edit()
  {
    $view = new View("categories/edit", "back");
    $view->assign("title", "Chiperz - Modifier une catégorie");

    $categoryModel = new Category();
    $view->assign("categoryModel", $categoryModel);

    if (!empty($_GET["id"])) {
      $category = $categoryModel->find(['id' => $_GET["id"]]);
      $view->assign("category", $category);
    } else {
      header('location: /admin/products');
    }

    if (!empty($_GET["id"]) && !empty($_POST)) {
      $result = Validator::run($categoryModel->getFormCategory(), $_POST);
      if(empty($result)) {
        $update = $categoryModel->update($categoryModel->getTable(), [
          'name' => "'{$_POST["name"]}'",
        ])->where("id", $_GET["id"])->getQuery();
  
        $categoryModel->executeQuery($update);
        Session::addMessage("EDIT_CATEGORY_SUCCESS", "La catégorie a bien été modifié", "success");
  
        header('location: /admin/products');

      } else {
        $view->assign("errors", $result);
      }

    }
  }
}
