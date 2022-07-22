<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Session;
use App\Core\Validator;
use App\Models\User;

class UsersController
{
  public function main()
  {
    $user = new User();
    $users = $user->findAll();

    $view = new View("users/main", "back");
    $view->assign("title", "Chiperz - Utilisateurs");
    $view->assign('users', $users);

    $headers = ["id", "Nom", "Prénom", "Email", "Compte confirmé", "Role"];
    $view->assign('headers', $headers);
  }

  public function edit()
  {
    $view = new View("users/edit", "back");
    $view->assign("title", "Chiperz - Modifier un utilisateur");

    $userModel = new User();
    $view->assign('userModel', $userModel);
    if (!empty($_GET["id"])) {
      $user = $userModel->find(['id' => htmlspecialchars($_GET['id'])]);
      if(!empty($user)) {
        $view->assign('user', $user);
      } else {
        Session::addMessage("EDIT_USER_NOT_FOUND", "L'utilisateur n'existe pas", "error");
        header('location: /admin/users');
      }
    } else {
      header('location: /admin/users');
    }

    if (!empty($_GET['id']) && !empty($_POST)) {
      $update = $userModel->update($userModel->getTable(), [
        'firstname' => htmlspecialchars("'{$_POST['firstname']}'"),
        'lastname' => htmlspecialchars("'{$_POST['lastname']}'"),
        'email' => htmlspecialchars("'{$_POST['email']}'"),
        'role' => htmlspecialchars("'{$_POST['role']}'"),
      ])->where('id', htmlspecialchars($_GET['id']))->getQuery();

      $userModel->executeQuery($update);
      Session::addMessage("EDIT_USER_SUCCESS", "L'utilisateur a bien été modifié", "success");

      header('location: /admin/users');
    }
    $view->assign('user', $user);
  }
}