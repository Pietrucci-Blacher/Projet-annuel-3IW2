<?php

namespace App\Models ;
use App\Core\Database ;

class Article extends Database
{

    protected $user_id = null;
    protected $title;
    protected $autor;
    protected $categories;
    protected $comments;
    protected $likes;
    protected $date;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int|null
     */
    public function getArticleId(): ?int
    {
        return $this->article_id;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function setTitle(): string
    {
        //return $this->media_url;
    }

    /**
     * @return mixed
     */
    public function getAutor(): string
    {
        return $this->autor;
    }

    /**
     * @return mixed
     */
    public function setAutor(): string
    {
        //return $this->media_name;
    }

    /**
     * @return mixed
     */
    public function getCategories(): string
    {
        return $this->categories;
    }

    /**
     * @return mixed
     */
    public function setCategories(): string
    {
        //return $this->media_name;
    }

    /**
     * @return mixed
     */
    public function getComments(): string
    {
        return $this->comments;
    }

    /**
     * @return mixed
     */
    public function setComments(): string
    {
        //return $this->media_name;
    }

    /**
     * @return mixed
     */
    public function getLikes(): string
    {
        return $this->likes;
    }

    /**
     * @return mixed
     */
    public function setLikes(): string
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

    public function getFormArticle(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/dashboard/articles",
                "uploadform" => "multipart/form-data",
                "submit" => "Ajouter l'article"
            ],
            "inputs" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "Titre ...",
                    "id" => "titleArticle",
                    "class" => "inputTitleAticle",
                    "required" => true,
                    "min" => 2,
                    "max" => 50,
                    "error" => "erreur sur le titre",
                ],
                "textarea" => [
                  "type" => "text",
                  "placeholder" => "Description ...",
                  "id" => "DescriptionArticle",
                  "class" => "inputDescriptioniAticle",
                  "required" => true,
                  "min" => 2,
                  "max" => 50,
                  "error" => "erreur sur la description",
                ],

            ],
        ];
    }
}
