<?php

namespace App\Models;

use App\Core\Database;

class Report extends Database
{

    protected $id = null;
    protected $comment_id;
    protected $user_id;

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
     * Get the value of comment_id
     */
    public function getCommentId()
    {
        return $this->comment_id;
    }

    /**
     * Set the value of comment_id
     */
    public function setCommentId($comment_id): void
    {
        $this->comment_id = $comment_id;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId()
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

    public function save()
    {
        parent::save();
    }
}
