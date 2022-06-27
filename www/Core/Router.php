?php

namespace App\Core;

class Router
{
    public const ROUTE_FILE = 'routes.yml';
    private array $routes = [];
    private string $uri;
    private string $controller;
    private string $action;
    private string $role;



    public function __construct($uri){
        $this->setUri($uri);
        if(file_exists(self::ROUTE_FILE)){
            $this->routes = yaml_parse_file(self::ROUTE_FILE);
            if(!empty($this->routes[$this->uri]) && !empty($this->routes[$this->uri]["controller"]) && !empty($this->routes[$this->uri]["action"])){
                $this->controller = $this->routes[$this->uri]['controller'];
                $this->action = $this->routes[$this->uri]['action'];
                $this->role = $this->routes[$this->uri]['role'];
            }
        }else{
            die('Routes file' . self::ROUTE_FILE . ' not found');
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
    public function getRole(): string
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

    public function getAllRoutes(): array
    {
        return yaml_parse_file('routes.yml');
    }
}
