<?php
namespace App\Controller;
use App\Core\View;
use App\Core\Config;
use App\Models\Page as PageModel;

class SeoController{
    public function displayRobots(): void
    {
        $view = new View('robots', 'blank');
        $view->assign('forbiddenCrawlUrls', Config::getInstance()->get('app_forbiddenCrawl'));
    }

    public function displaySitemap(): void
    {
        $page = new PageModel;
        $datas = $page->findAll(['indexing' => 1]);
        $view = new View("sitemap", 'blank');
        $view->assign('indexinglinks', $datas);

    }
}