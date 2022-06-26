<?php

namespace App\Models ;
use App\Core\Database ;

class Media extends Database
{

    protected $user_id = null;
    protected $media_url;
    protected $media_name;
    protected $date;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }


    /**
     * @return mixed
     */
    public function getMedia_url(): string
    {
        return $this->media_url;
    }

    /**
     * @return mixed
     */
    public function setMedia_url(): string
    {
        //return $this->media_url;
    }

    /**
     * @return mixed
     */
    public function getMedia_name(): string
    {
        return $this->media_name;
    }

    /**
     * @return mixed
     */
    public function setMedia_name(): string
    {
        //return $this->media_name;
    }

    /**
     * @return mixed
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function setDate(): string
    {
        //return $this->media_name;
    }






    public function save()
    {
        parent::save();
    }
}
