<?php

namespace App\Core;

use App\Core\Config;

class View
{
    private $view;
    private $template;
    private array $data = [];
    public string $title;

    public function __construct($view, $template = "front")
    {
        $this->setView($view);
        $this->setTemplate($template);
    }

    public function setView($view):void
    {
        $this->view = strtolower($view);
    }

    public function setTitle(string $title):void
    {
        $this->title = Config::getInstance()->get('name') . ' - ' . ucfirst(strtolower($title));
    }

    public function setTemplate($template):void
    {
        $this->template = strtolower($template);
        if(file_exists("View/templates/{$this->template}.tpl.php")) {
            $this->template = "View/templates/{$this->template}.tpl.php";
        } else {
            //Erreur Ges Template Inexistant
        }
    }

    public function assign($key, $value):void
    {
        $this->data[$key] = $value;
    }

    public function includePartial($name, $config):void
    {
        if(!file_exists("View/partial/".$name.".partial.php"))
        {
            die("partial ".$name." 404");
        }
        include "View/partial/".$name.".partial.php";
    }

    public function __destruct()
    {
        extract($this->data);
        include $this->template;
    }

}