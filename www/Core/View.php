<?php

namespace App\Core;

class View
{
    private $view;
    private $template;
    private $data = [];
    private $title;

    public function __construct($view, $template = "front")
    {
        $this->setView($view);
        $this->setTemplate($template);
    }

    public function setView($view): void
    {
        $this->view = strtolower($view);
    }

    public function setTemplate($template): void
    {
        $this->template = strtolower($template);
        if (file_exists("Views/templates/{$this->template}.tpl.php")) {
            $this->template = "Views/templates/{$this->template}.tpl.php";
        } else {
            die('Erreur Template inexistant');
        }
    }

    public function assign($key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function includePartial($name, $config): void
    {
        if (!file_exists("Views/partial/" . $name . ".partial.php")) {
            die("partial " . $name . " 404");
        }
        include "Views/partial/" . $name . ".partial.php";
    }

    public function setTitle(string $title):void
    {
        $this->title = Config::getInstance()->get('app_name') . ' - ' . ucfirst(strtolower($title));
    }


    public function __destruct()
    {
        extract($this->data);
        include $this->template;
    }
}