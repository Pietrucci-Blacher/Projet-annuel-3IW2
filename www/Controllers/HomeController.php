<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Session;
use App\Models\Page;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Report;

class HomeController
{

  public function main()
  {
    $view = new View("home/main", "front");
    $view->assign("title", "Chiperz - Accueil");

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
      $reportModel = new Report();
      $comment = new Comment();
      $comments = $comment->findAll([
        "product_id" => htmlspecialchars($_GET["id"])
      ]);
      $productDetail = $product->find(["id" => htmlspecialchars($_GET["id"])]);

      $commentModel = new Comment();
      $view->assign('commentModel', $commentModel);

      $view->assign('productDetail', $productDetail);
      $view->assign('comments', $comments);
      $view->assign('reportModel', $reportModel);
    }

    $view->assign('products', $products);

    // add comment
    if(isset($_POST["text"]) && isset($_GET["id"])) {
      $comment = new Comment();
      $comment->setText(htmlspecialchars($_POST["text"]));
      $comment->setProductId(htmlspecialchars($_GET["id"]));
      $comment->setUserId(htmlspecialchars($_SESSION["user"]["id"]));
      $comment->save();
      header('location: /product?id='.htmlspecialchars($_GET["id"]));
    }

    // delete comment
    if(isset($_POST["id"])){
      $comment->delete($_POST["id"]);
      header('location: /');
    }

    if(isset($_POST["reportCommentId"]) && isset($_POST["reportUserId"])) {
      $report = new Report();
      $reportFind = $report->find([
        "comment_id" => htmlspecialchars($_POST["reportCommentId"]),
        "user_id" => htmlspecialchars($_POST["reportUserId"])
      ]);

      if(empty($reportFind)) {
        // pas de report

        $report->setCommentId(htmlspecialchars($_POST["reportCommentId"]));
        $report->setUserId(htmlspecialchars($_POST["reportUserId"]));
        $report->save();
        header('location: /product?id='.htmlspecialchars($_GET["id"]));
      } 
    }
  }



  public function contact()
  {
    $view = new View("home/contact", "front");
  }
}
