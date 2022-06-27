<?php
namespace App\Controller;
use App\Core\Database;
use App\Core\Router;
use App\Core\View;

class SeoController{
    public function displayRobots(): void
    {
        $view = new View("robots");
    }

    public function displaySitemap(): void
    {
        $view = new View("sitemap");
    }
}