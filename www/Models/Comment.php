<?php

namespace App\Models;

use App\Core\Database;

class Comment extends Database
{

    protected $id = null;
    protected $text;
    protected $user_id;
    protected $product_id;
    protected $createdAt;


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
     * Get the value of text
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set the value of text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getUserName(): string
    {
        $user = new User();
        $user = $user->find(['id' => $this->user_id]);

        return $user["firstname"] . " " . $user["lastname"][0] . ".";
    }

    /**
     * Get the value of product_id
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     */
    public function setProductId($product_id): void
    {
        $this->product_id = $product_id;
    }

    public function getProductName(): string
    {
        $product = new Product();
        $product = $product->find(['id' => $this->product_id]);

        return $product["name"];
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function save()
    {
        parent::save();
    }

    public function getFormAddComment() {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "uploadform" => "multipart/form-data",
                "submit" => "Ajouter",
            ],
            "inputs" => [
                "text" => [
                    "type" => "text",
                    "name" => "text",
                    "value" => "",
                    "placeholder" => "Votre commentaire",
                ],
            ],
        ];
    }
}
