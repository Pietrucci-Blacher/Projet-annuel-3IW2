<?php

namespace App\Controller;

use App\Core\View;

class CommentsController
{
  public function comments()
  {
    $view = new View("comments", "back");
  }
}