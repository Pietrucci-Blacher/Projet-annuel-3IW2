<?php

namespace App\Controller;

use App\Core\View;
use App\Models\User;

class UsersController
{
  public function main()
  {
    $user = new User();
    $users = $user->findAll();

    $view = new View("users/main", "back");
    $view->assign('users', $users);

    $headers = ["id", "Nom", "Prénom", "Compte confirmé", "Role"];
    $view->assign('headers', $headers);
  }

  public function edit()
  {
    $view = new View("users/edit", "back");

    $userModel = new User();
    $view->assign('userModel', $userModel);
    var_dump($_GET["id"]);
    if (!empty($_GET["id"])) {
      $user = $userModel->find(['id' => $_GET['id']]);
      $view->assign('user', $user);
    } else {
      header('location: /admin/users');
    }

    if (!empty($_GET['id']) && !empty($_POST)) {
      $update = $userModel->update($userModel->getTable(), [
        'firstname' => "'{$_POST['firstname']}'",
        'lastname' => "'{$_POST['lastname']}'",
        'email' => "'{$_POST['email']}'"
      ])->where('id', $_GET['id'])->getQuery();

      $userModel->executeQuery($update);

      header('location: /admin/users');
    }
    $view->assign('user', $user);
  }
}