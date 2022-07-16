<?php


namespace App\Core;

use App\Core\Security;
use App\Core\Helpers;
use App\Core\Config;

class Router
{
    public const ROUTE_FILE = 'routes.yml';
    private $routes = [];
    private  $uri;
    private $controller;
    private  $action;
    private  $role;
    public $error;


    public function __construct($uri)
    {
        $this->setUri($uri);
        if (file_exists(self::ROUTE_FILE)) {
            $this->routes = yaml_parse_file(self::ROUTE_FILE);
            if (!empty($this->routes[$this->uri]) && !empty($this->routes[$this->uri]["controller"]) && !empty($this->routes[$this->uri]["action"])) {
                $this->controller = $this->routes[$this->uri]['controller'];
                $this->action = $this->routes[$this->uri]['action'];
                $this->role = $this->routes[$this->uri]['roles'];
                $this->checkRoute();
            }
        } else {
            die('Erreur le fichier de routes n\'existe pas');
        }

    }

    //Getter
    public function getController(): string
    {
        return $this->controller;
    }

    //Getter
    public function getAction(): string
    {
        return $this->action;
    }

    //Getter
    public function getRole(): array
    {
        return $this->role;
    }

    public function getCurrentRoute(): array
    {
        return $this->routes[$this->uri];
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    public static function getAllRoutes(): array
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
                    //Security::Authorization($this->getRole());
                    if(!Config::getInstance()->get('app_setup') && $this->uri !== '/setup'){
                            header('Location: /setup',303);
                    }elseif(Config::getInstance()->get('app_setup') && $this->uri !== '/setup'){
                            header('Location: /login', 303);
                    }
                    $classObj->$execAction();
                } else {
                    //Controller Erreur
                }
            } else {
                //Controller Erreur
            }
        } else {
        }
            //Controller Erreur
    }
}
