<?php

namespace App\Core;

class Router
{
    private static $routes = [];
    private static $params = [];

    public function __construct(mixed $uri)
    {
        $this->uri = $uri;
    }

}
