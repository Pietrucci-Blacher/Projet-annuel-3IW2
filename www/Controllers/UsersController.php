<?php

namespace App\Controller;

use App\Core\View;

class UsersController
{
  public function users()
  {
    $view = new View("users", "back");
  }
}