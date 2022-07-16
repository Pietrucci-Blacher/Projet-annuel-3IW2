<?php

namespace App\Models;

use App\Core\Database;

class Page extends Database
{
    public $id;
    public $name;
    public $link;
    public $indexing;
    public $createdAt;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param int $index
     */
    public function setIndex($index)
    {
        $this->indexing = $index;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->indexing;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function save()
    {
        parent::save();
    }
}