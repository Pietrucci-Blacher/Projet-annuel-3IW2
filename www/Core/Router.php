<?php

namespace App\Core;

use App\Core\Security;

class Router
{
    public const ROUTE_FILE = 'routes.yml';
    private $routes = [];
    private $uri;
    private $controller;
    private $action;
    private $routeRoles;
    public $error;



    public function __construct($uri)
    {
        $this->setUri($uri);
        if (file_exists(self::ROUTE_FILE)) {
            $this->routes = yaml_parse_file(self::ROUTE_FILE);
            $page = $this->routes[$this->uri];

            if (!empty($page) && !empty($page["controller"]) && !empty($page["action"])) {
                $this->controller = $page['controller'];
                $this->action = $page['action'];
                if (!empty($page['roles'])) {
                    $this->routeRoles = $page['roles'];
                }
                $this->checkRoute();
            }
        } else {
            //Appel au Controller de Error
            $this->error = "Le fichier de route n'existe pas";
            echo "erreur";
        }
    }

    //Getter
    public function getController()
    {
        return $this->controller;
    }

    //Getter
    public function getAction()
    {
        return $this->action;
    }
    //Getter
    public function getRouteRoles()
    {
        return $this->routeRoles;
    }

    public function getCurrentRoute()
    {
        return $this->routes[$this->uri];
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    public function getAllRoutes()
    {
        return yaml_parse_file(self::ROUTE_FILE);
    }

    public function checkRoute()
    {
        $current_controller = "Controllers/" . ucfirst(strtolower($this->getController())) . "Controller.php";
        if (file_exists($current_controller)) {
            include $current_controller;
            $controller_class = "App\\Controller\\" . ucfirst($this->getController()) . "Controller";
            if (class_exists($controller_class)) {
                $classObj = new $controller_class();
                if (method_exists($classObj, $this->getAction())) {
                    $execAction = $this->getAction();
                    //Vérification du role
                    if (!Security::isAuthorized($this->getRouteRoles())) {
                        header('location: /');
                    }

                    //Vérification du setup ici
                    /*if(!Config::getInstance()->get('app_setup')){
                        header('location: /setup', 303);
                    }*/

                    $classObj->$execAction();
                } else {
                    //Controller Erreur
                }
            } else {
                //Controller Erreur
            }
        } else {
            //Controller Erreur
        }
    }
}