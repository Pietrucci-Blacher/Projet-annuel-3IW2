<?php

namespace App\Controller;

use App\Core\View;
use App\Models\Product;

class ProductsController
{
  public function main()
  {
    $view = new View("products/main", "back");

    var_dump($_SESSION);

    $product = new Product();
    $products = $product->findAll();

    // SELECT * FROM chiperz_category RIGHT JOIN chiperz_product ON chiperz_category.id = chiperz_product.category_id
    $view->assign("products", $products);
  }

  public function add()
  {
    $view = new View("products/add", "back");

    $product = new Product();
    $view->assign("product", $product);

    // Todo: Validation des champs du formulaire 

    if (!empty($_POST)) {
      $product->setName($_POST["name"]);
      $product->setDescription($_POST["description"]);
      $product->setPrice($_POST["price"]);
      $product->setQuantity($_POST["quantity"]);
      // $product->setCategoryId($_POST["category_id"]);
      $product->save();
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
      $view->assign("product", $product);
    } else {
      header('location: /admin/products');
    }

    if (!empty($_GET["id"]) && !empty($_POST)) {
      $update = $productModel->update($productModel->getTable(), [
        'name' => "'{$_POST["name"]}'",
        'description' => "'{$_POST["description"]}'",
        'price' => $_POST["price"],
        'quantity' => $_POST["quantity"],
        // 'category_id' => $_POST["category_id"]
      ])->where("id", $_GET["id"])->getQuery();

      $productModel->executeQuery($update);

      header('location: /admin/products');
    }
  }
}
