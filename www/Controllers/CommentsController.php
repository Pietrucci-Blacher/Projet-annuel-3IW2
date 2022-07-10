<?php

namespace App\Controller;

use App\Core\View;

class CommentsController
{
  public function main()
  {
    $view = new View("comments/main", "back");
  }
}