<?php

namespace App\Core;

class View
{
    private string $template;
    private string $view;
    private array $data;

    public function __construct($view, $template = "front")
    {
        $this->setView($view);
        $this->setTemplate($template);
    }


    public function setView(string $view){
        $this->view = strtolower($view);
    }

    public function setTemplate(string $template){
        $this->template = strtolower($template);
    }

    public function assign(string $key, string $value):void
    {
        $this->data[$key] = $value;
    }

    public function __destruct()
    {
        extract($this->data);
        include "Views/templates/".$this->template.".tpl.php";
    }

}