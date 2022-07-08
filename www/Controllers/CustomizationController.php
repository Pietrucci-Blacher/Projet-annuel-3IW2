<?php

namespace App\Controller;

use App\Core\View;

class CustomizationController
{
  public function customization()
  {
    $view = new View("customization", "back");
  }
}