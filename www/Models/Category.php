<?php

namespace App\Models;

use App\Core\Database;

class Category extends Database
{

    protected $id = null;
    protected $name;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $email
     */
    public function setName($name): void
    {
        $this->name = trim($name);
    }

    public function save()
    {
        parent::save();
    }

    public function getFormCategory($value = []): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "submit" => isset($value) ? "Modifier" : "Ajouter",
            ],
            "inputs" => [
                "name" => [
                    "label" => "Nom",
                    "value" => $value["name"] ?? "",
                    "type" => "text",
                    "placeholder" => "Nom de la catégorie ...",
                    "id" => "category_name",
                    "class" => "category_name",
                    "min" => 3,
                    "max" => 50,
                    "error" => "Le nom de la catégorie doit au moins contenir 3 caractères",
                    "required" => true
                ],
            ]
        ];
    }
}