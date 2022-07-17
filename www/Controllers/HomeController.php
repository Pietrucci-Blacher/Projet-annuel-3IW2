<?php

namespace App\Controller;

use App\Core\View;
use App\Models\Page;
use App\Models\Product;
use App\Models\Comment;

class HomeController
{

  public function main()
  {
    $view = new View("home/main", "front");

    $page = new Page();
    $pages = $page->findAll();

    $navigation = [];
    foreach ($pages as $page) {
      $navigation[] = [
        "id" => $page->getId(),
        "name" => $page->getName()
      ];
    }

    $view->assign('navigation', $navigation);

    $product = new Product();
    $products = $product->findAll(["is_published" => 1]);

    $uri = $_SERVER['REQUEST_URI'];

    if (basename(parse_url($uri, PHP_URL_PATH)) == "product" && isset($_GET["id"])) {
      $comment = new Comment();
      $comments = $comment->findAll([
        "product_id" => $_GET["id"]
      ]);
      $productDetail = $product->find(["id" => $_GET["id"]]);

      $view->assign('productDetail', $productDetail);
      $view->assign('comments', $comments);
    }

    $view->assign('products', $products);
  }

  public function contact()
  {
    $view = new View("home/contact", "front");
  }
}
