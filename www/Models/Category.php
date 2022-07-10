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

}
