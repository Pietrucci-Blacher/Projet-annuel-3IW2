<?php

namespace App\Controller;

use App\Core\View;

class CustomizationController
{
  public function main()
  {
    $view = new View("customization/main", "back");
  }
}