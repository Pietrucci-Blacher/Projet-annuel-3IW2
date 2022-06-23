<?php
namespace App\Controller;
use App\Core\Router;
use App\Core\View;

class SitemapController{
    public function generate(){
        $sitemapview = new View("sitemap");
    }
}