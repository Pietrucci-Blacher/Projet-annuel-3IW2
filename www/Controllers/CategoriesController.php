<?php

namespace App\Controller;

use App\Core\View;

class CategoriesController
{
  public function categories()
  {
    $view = new View("categories", "back");
  }
}