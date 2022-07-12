<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Session;
use App\Models\Product;
use App\Models\Category;

class ProductsController
{
  public function main()
  {
    $view = new View("products/main", "back");
    $product = new Product();
    $products = $product->findAll();
    $headersProducts = ["Nom", "Description", "Catégorie", "Prix", "Quantité", "Publié"];

    $category = new Category();
    $categories = $category->findAll();
    $headersCategories = ["Nom"];

    $view->assign("products", $products);
    $view->assign("headersProducts", $headersProducts);

    $view->assign("categories", $categories);
    $view->assign("headersCategories", $headersCategories);
  }

  public function add()
  {
    $view = new View("products/add", "back");

    $product = new Product();
    $view->assign("product", $product);


    // Todo: Validation des champs du formulaire 

    if (!empty($_POST)) {
      $image = $_FILES["product_image"]["tmp_name"];
      $data = base64_encode(file_get_contents(addslashes($image)));
      $product->setImage($data);


      $product->setName($_POST["name"]);
      $product->setDescription($_POST["description"]);
      $product->setPrice($_POST["price"]);
      $product->setQuantity($_POST["quantity"]);
      $product->setCategoryId($_POST["category_id"]);
      $product->save();

      Session::addMessage("ADD_PRODUCT_SUCCESS", "Le produit a bien été ajouté", "success");
      header('location: /admin/products');
    }
  }

  public function edit()
  {
    $view = new View("products/edit", "back");

    $productModel = new Product();
    $view->assign("productModel", $productModel);


    if (!empty($_GET["id"])) {
      $product = $productModel->find(['id' => $_GET["id"]]);
      if(!empty($product)) {
        $view->assign("product", $product);
      } else {
        Session::addMessage("EDIT_PRODUCT_ERROR", "Le produit n'existe pas", "error");
        header('location: /admin/products');
      }
    } else {
      header('location: /admin/products');
    }

    if (isset($_POST["delete"]) && isset($_POST["id"])) {
      $product = $productModel->find(['id' => $_POST["id"]]);
      if(!empty($product)) {
        $productModel->delete($_POST["id"]);
        Session::addMessage("DELETE_PRODUCT_SUCCESS", "Le produit a bien été supprimé", "success");
        header('location: /admin/products');
      }
    }

    if (!empty($_GET["id"]) && !empty($_POST)) {
      if (!empty($_FILES["product_image"]["name"])) {

        if ($_FILES["product_image"]["type"] == "image/jpeg" || $_FILES["product_image"]["type"] == "image/png") {
          $image = $_FILES["product_image"]["tmp_name"];
          $data = base64_encode(file_get_contents(addslashes($image)));
          $update = $productModel->update($productModel->getTable(), [
            'name' => "'{$_POST["name"]}'",
            'description' => "'{$_POST["description"]}'",
            'price' => $_POST["price"],
            'quantity' => $_POST["quantity"],
            'category_id' => $_POST["category_id"],
            'image' => "'{$data}'",
          ])->where("id", $_GET["id"])->getQuery();
          $productModel->executeQuery($update);
          Session::addMessage("EDIT_PRODUCT_SUCCESS", "Le produit a bien été modifié", "success");
          header('location: /admin/products');
        } else {
          Session::addMessage("EDIT_PRODUCT_IMAGE_ERROR", "Votre image doit être au format jpeg ou png", "error");
        }
      } else {
        $update = $productModel->update($productModel->getTable(), [
          'name' => "'{$_POST["name"]}'",
          'description' => "'{$_POST["description"]}'",
          'price' => $_POST["price"],
          'quantity' => $_POST["quantity"],
          'category_id' => $_POST["category_id"],
        ])->where("id", $_GET["id"])->getQuery();

        $productModel->executeQuery($update);

        Session::addMessage("EDIT_PRODUCT_SUCCESS", "Le produit a bien été modifié", "success");
        header('location: /admin/products');
      }
    }



  }
}
