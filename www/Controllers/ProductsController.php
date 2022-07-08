<?php

namespace App\Controller;

use App\Core\View;

class ProductsController
{
  public function products()
  {
    $view = new View("products", "back");
  }
}