<?php

namespace App\Models;

use App\Core\Database;
use App\Models\Category;
use App\Models\Comment;

class Product extends Database
{

    protected $id = null;
    protected $name;
    protected $description;
    protected $price;
    protected $quantity;
    protected $category_id;
    protected $image = null;
    protected $is_published = 0;


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
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * Get the value of price
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * Get the value of categoryId
     */
    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }
    
    /**
     * Set the value of categoryId
     */
    public function setCategoryId($category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * Get the value of is_published
     */
    public function getIsPublished(): ?int
    {
        return $this->is_published;
    }

    /**
     * Set the value of is_published
     */
    public function setIsPublished($is_published): void
    {
        $this->is_published = $is_published;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategoryName(): string
    {
        $category = new Category();
        $category = $category->find(['id' => $this->category_id]);
        if(!$category["name"]) {
            return "Aucune catégorie";
        }
        return $category["name"];
    }

    public function save()
    {
        parent::save();
    }

    public function getFormProduct($value = null, $actionType = null): array
    {
        $category = new Category();


        $categories = $category->findAll();

        $options = [];
        foreach($categories as $category) {
            $options[] = [
                "id" => $category->getId(),
                "name" => $category->getName(),
                "value" => $category->getId(),
                "selected" => $category->getId() == $value["category_id"]
            ];  
        }


        $item = [
            [
                "id" => "is_published",
                "name" => "is_published",
                "value" => 1,
            ]
        ];


        if($actionType == "delete") {
            return [
                "config" => [
                    "method" => "POST",
                    "action" => "",
                    "uploadform" => "multipart/form-data",
                    "submit" => "Supprimer",
                    "class" => "delete",
                ],
                "inputs" => [
                    "delete" => [
                        "type" => "hidden",
                        "name" => "delete",
                        "value" => "true",
                    ],
                    "id" => [
                        "type" => "hidden",
                        "name" => "id",
                        "value" => $value["id"],
                    ],
                ],
            ];
        }

        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "uploadform" => "multipart/form-data",
                "submit" => isset($value) ? "Modifier" : "Ajouter",
            ],
            "inputs" => [
                "name" => [
                    "label" => "Nom",
                    "value" => $value["name"] ?? "",
                    "type" => "text",
                    "placeholder" => "Nom du produit ...",
                    "id" => "product_name",
                    "class" => "product_name",
                    "min" => 3,
                    "max" => 50,
                    "error" => "Le nom du produit doit au moins contenir 3 caractères et ne doit pas dépasser 50 caractères",
                    "required" => true
                ],
                "description" => [
                    "label" => "Description",
                    "value" => $value["description"] ?? "",
                    "type" => "text",
                    "placeholder" => "Description du produit ...",
                    "id" => "product_description",
                    "class" => "product_description",
                    "min" => 3,
                    "max" => 100,
                    "error" => "La description du produit doit au moins contenir 3 caractères et ne doit pas dépasser 100 caractères",
                    "required" => true,
                ],
                "price" => [
                    "label" => "Prix",
                    "value" => $value["price"] ?? "",
                    "type" => "number",
                    "placeholder" => "Prix du produit ...",
                    "id" => "product_price",
                    "class" => "product_price",
                    "step" => "0.01",
                    "min" => 0,
                    "max" => 100,
                    "error" => "Le prix doit être compris entre 0 et 100",
                    "required" => true,
                ],
                "quantity" => [
                    "label" => "Quantité",
                    "value" => $value["quantity"] ?? "",
                    "type" => "number",
                    "placeholder" => "Quantité du produit ...",
                    "id" => "product_quantity",
                    "class" => "product_quantity",
                    "min" => 0,
                    "max" => 999,
                    "error" => "La quantité doit être compris entre 0 et 999",
                    "required" => true,
                ],
                "select" => [
                    "label" => "Catégorie",
                    "options" => $options,
                    "type" => "select",
                    "id" => "category_id",
                    "class" => "category_id",
                    "error" => "La catégorie doit être sélectionnée",
                    "required" => true,
                ],
                "upload" => [
                    "label" => "Image",
                    "name" => "product_image",
                    "data" => $value["image"] ?? "",
                    "type" => "file",
                    "id" => "product_image",
                    "class" => "product_image",
                    "error" => "L'image doit être sélectionnée",
                    "required" => false,
                ],
                "checkboxes" => [
                    "label" => "Publié",
                    "items" => $item,
                    "checked" => $value["is_published"] ? true : false,
                    "type" => "checkbox",
                    "id" => "product_published",
                    "class" => "product_published",
                    "required" => false,
                ],
            ]
        ];
    }
}