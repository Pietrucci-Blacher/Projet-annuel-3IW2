<?php

namespace App\Controller;

use App\Core\View;

class PagesController
{
  public function pages()
  {
    $view = new View("pages", "back");
  }
}