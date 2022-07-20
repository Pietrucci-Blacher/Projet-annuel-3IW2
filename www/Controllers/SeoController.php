<?php
namespace App\Controller;

use App\Core\View;
use App\Core\Config;
use App\Models\Page as PageModel;

class SeoController
{
    public function displayRobots(): void
    {
        $view = new View('seo/robots', 'emptypage');
        $view->assign('forbiddenCrawlUrls', Config::getInstance()->get('app_forbiddenCrawl'));
    }

    public function displaySitemap(): void
    {
        $page = new PageModel;
        $datas = $page->findAll(['indexing' => 1]);
        $view = new View("seo/sitemap", 'emptypage');
        $view->assign('indexinglinks', $datas);

    }
}
