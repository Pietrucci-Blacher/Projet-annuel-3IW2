<?php

namespace App\Controller;

use App\Core\View;
use App\Models\Comment;
use App\Models\Report;

class CommentsController
{
  public function main()
  {
    $view = new View("comments/main", "back");
    $view->assign("title", "Chiperz - Commentaires");
    $reportModel = new Report();
    $comment = new Comment();
    $comments = $comment->findAll();
    $headersComments = ["Date", "Produit", "Texte", "Ajouté par", "Nbre de signalements", ""];
    $view->assign("headersComments", $headersComments);
    $view->assign("comments", $comments);
    $view->assign("reportModel", $reportModel);

    if(isset($_POST["id"])){
      $comment->delete($_POST["id"]);
      header('location: /admin/comments');
    }
  }

  public function add() {
    $view = new View("comments/add", "front");
    

    if(isset($_POST["comment"])){
      $comment = new Comment();
      $comment->setText(htmlspecialchars($_POST["text"]));
      $comment->setProductId(htmlspecialchars($_POST["product_id"]));
      $comment->setUserId(htmlspecialchars($_POST["user_id"]));
      $comment->save();
      header('location: /product?id='.htmlspecialchars($_POST["product_id"]));
    }
  }
}