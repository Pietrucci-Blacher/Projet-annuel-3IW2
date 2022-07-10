<?php

namespace App\Controller;

use App\Core\View;

class PagesController
{
  public function main()
  {
    $view = new View("pages/main", "back");
  }
}