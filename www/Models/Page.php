<?php

namespace App\Models;

use App\Core\Database;

class Page extends Database
{

  protected $id = null;
  protected $name;
  protected $content;

  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Get the value of id
   */
  public function getId(): ?int
  {
    return $this->id;
  }

  /**
   * Get the value of name
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Set the value of name
   */
  public function setName($name): void
  {
    $this->name = $name;
  }

  /**
   * Get the value of content
   */
  public function getContent(): string
  {
    return $this->content;
  }

  /**
   * Set the value of content
   */
  public function setContent($content): void
  {
    $this->content = $content;
  }

  /* Save in database */
  public function save()
  {
    parent::save();
  }

  public function getFormPage($value = []): array
  {
    return [
      "config" => [
        "method" => "POST",
        "action" => "",
        "submit" => !empty($value) ? "Modifier" : "Ajouter",
      ],
      "inputs" => [
        "name" => [
          "label" => "Nom",
          "value" => $value["name"] ?? "",
          "type" => "text",
          "placeholder" => "Nom de la page ...",
          "id" => "page_name",
          "class" => "page_name",
          "min" => 3,
          "max" => 50,
          "error" => "Le nom de la page doit être entre 3 et 50 caractères",
          "required" => true
        ],
        "wysiwyg" => [
          "label" => "Contenu",
          "value" => $value["wysiwyg"] ?? "",
          "type" => "wysiwyg",
          "placeholder" => "Contenu de la page...",
          "id" => "page_content",
          "class" => "page_content",
          "min" => 0,
          "max" => 10000,
          "error" => "Le contenu de la page ne doit pas dépasser 10000 caractères",
          "required" => false,
        ],
      ]
    ];
  }
}