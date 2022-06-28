<?php
namespace App\Controller;
use App\Core\View;
use App\Core\Config;

class SeoController{
    public function displayRobots(): void
    {
        $view = new View('robots', 'blank');
        $view->assign('forbiddenCrawlUrls', Config::getInstance()->get('forbiddenCrawl'));
    }

    public function displaySitemap(): void
    {
        $view = new View("sitemap", 'blank');
    }
}