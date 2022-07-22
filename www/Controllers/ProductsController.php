<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Session;
use App\Core\Validator;
use App\Models\Product;
use App\Models\Category;

class ProductsController
{
  public function main()
  {
    $view = new View("products/main", "back");
    $view->assign("title", "Chiperz - Produits");
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
    $view->assign("title", "Chiperz - Ajouter un produit");

    $product = new Product();
    $view->assign("product", $product);


    // Todo: Validation des champs du formulaire 

    if (!empty($_POST)) {



      $image = $_FILES["product_image"]["tmp_name"];
      $data = base64_encode(file_get_contents(addslashes($image)));
      $product->setImage($data);


      $product->setName(htmlspecialchars($_POST["name"]));
      $product->setDescription(htmlspecialchars($_POST["description"]));
      $product->setPrice(htmlspecialchars($_POST["price"]));
      $product->setQuantity(htmlspecialchars($_POST["quantity"]));
      $product->setCategoryId(htmlspecialchars($_POST["category_id"]));
      $_POST["is_published"] && $product->setIsPublished(htmlspecialchars($_POST["is_published"]));
      $product->save();

      Session::addMessage("ADD_PRODUCT_SUCCESS", "Le produit a bien été ajouté", "success");
      header('location: /admin/products');
    }
  }

  public function edit()
  {
    $view = new View("products/edit", "back");
    $view->assign("title", "Chiperz - Modifier un produit");

    $productModel = new Product();
    $view->assign("productModel", $productModel);

    if (!empty($_GET["id"])) {
      $product = $productModel->find(['id' => htmlspecialchars($_GET["id"])]);
      if (!empty($product)) {
        $view->assign("product", $product);
      } else {
        Session::addMessage("EDIT_PRODUCT_ERROR", "Le produit n'existe pas", "error");
        header('location: /admin/products');
      }
    } else {
      header('location: /admin/products');
    }

    // delete product
    if (isset($_POST["delete"]) && isset($_POST["id"])) {
      $product = $productModel->find(['id' => htmlspecialchars($_POST["id"])]);
      if (!empty($product)) {
        $productModel->delete($_POST["id"]);
        Session::addMessage("DELETE_PRODUCT_SUCCESS", "Le produit a bien été supprimé", "success");
        header('location: /admin/products');
      }
    }

    // update product
    if (!empty($_GET["id"]) && !empty($_POST)) {

      if (!empty($_FILES["product_image"]["name"])) {
        // if image uploaded
        if ($_FILES["product_image"]["type"] == "image/jpeg" || $_FILES["product_image"]["type"] == "image/png") {
          $image = $_FILES["product_image"]["tmp_name"];
          $data = base64_encode(file_get_contents(addslashes($image)));
          $update = $productModel->update($productModel->getTable(), [
            'name' => htmlspecialchars("'{$_POST["name"]}'"),
            'description' => htmlspecialchars("'{$_POST["description"]}'"),
            'price' => htmlspecialchars($_POST["price"]),
            'quantity' => htmlspecialchars($_POST["quantity"]),
            'category_id' => htmlspecialchars($_POST["category_id"]),
            'image' => "'{$data}'",
            'is_published' => isset($_POST["is_published"]) ? htmlspecialchars($_POST["is_published"]) : 0,
          ])->where("id", htmlspecialchars($_GET["id"]))->getQuery();
          $productModel->executeQuery($update);
          Session::addMessage("EDIT_PRODUCT_SUCCESS", "Le produit a bien été modifié", "success");
          header('location: /admin/products');
        }
      } else {
        $update = $productModel->update($productModel->getTable(), [
          'name' => htmlspecialchars("'{$_POST["name"]}'"),
          'description' => htmlspecialchars("'{$_POST["description"]}'"),
          'price' => htmlspecialchars($_POST["price"]),
          'quantity' => htmlspecialchars($_POST["quantity"]),
          'category_id' => htmlspecialchars($_POST["category_id"]),
          'is_published' => isset($_POST["is_published"]) ? htmlspecialchars($_POST["is_published"]) : 0,
        ])->where("id", htmlspecialchars($_GET["id"]))->getQuery();

        $productModel->executeQuery($update);

        Session::addMessage("EDIT_PRODUCT_SUCCESS", "Le produit a bien été modifié", "success");
        header('location: /admin/products');
      }
    }
  }
}
