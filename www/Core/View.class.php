<?php

namespace App\Core;

class View
{
    private $view;
    private $template;
    private $data = [];

    public function __construct($view, $template = "back")
    {
        $this->setView($view);
        $this->setTemplate($template);
    }

    public function setView($view):void
    {
        $this->view = strtolower($view);
    }

    public function setTemplate($template):void
    {
        $this->template = strtolower($template);
    }

    public function assign($key, $value):void
    {
        $this->data[$key] = $value;
    }

    public function includePartial($name, $config):void
    {
        if(!file_exists("views/partial/".$name.".partial.php"))
        {
            die("partial ".$name." 404");
        }
        include "views/partial/".$name.".partial.php";
    }

    public function setTitle($title):void{
        $this->title = is_string($title) ? $title : null; 
    }

    public function __destruct()
    {
        //Array ( [firstname] => Yves )
        extract($this->data);
        include "views/".$this->template.".tpl.php";
    }

}