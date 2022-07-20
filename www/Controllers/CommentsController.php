<?php

namespace App\Controller;

use App\Core\View;
use App\Models\Comment;

class CommentsController
{
  public function main()
  {
    $view = new View("comments/main", "back");

    $comment = new Comment();
    $comments = $comment->findAll();
    $headersComments = ["Date", "Produit", "Texte", "Ajouté par", "Nbre de signalements", ""];
    $view->assign("headersComments", $headersComments);
    $view->assign("comments", $comments);

    if(isset($_POST["id"])){
      $comment->delete($_POST["id"]);
      header('location: /admin/comments');
    }
  }

  public function add() {
    $view = new View("comments/add", "front");

    if(isset($_POST["comment"])){
      $comment = new Comment();
      $comment->setText($_POST["text"]);
      $comment->setProductId($_POST["product_id"]);
      $comment->setUserId($_POST["user_id"]);
      $comment->save();
      header('location: /product?id='.$_POST["product_id"]);
    }
  }
}