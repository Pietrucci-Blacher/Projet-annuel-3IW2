<?php
use App\Core\Database;

class Image extends Database
{
    protected $id;
    protected $name;
    protected $path;
    protected $created_at;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function save()
    {
        parent::save();
    }

}