<?php

namespace entity;

class Post
{
    private $categorie;
    private $user;
    private $title;
    private $content;
    private $subtitle;
    private $created_at;
    private $updated_at;
    private $is_validated;
    private $id;

    public function __construct($categorie, $user, $title, $content, $subtitle, $created_at, $updated_at, $is_validated, $id = null)
    {
        $this->categorie = $categorie;
        $this->user = $user;
        $this->title = $title;
        $this->content = $content;
        $this->subtitle = $subtitle;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->is_validated = $is_validated;
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    public function getCategorie()
    {
        return $this->categorie;
    }


    public function setCategorie($categorie): void
    {
        $this->categorie = $categorie;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title): void
    {
        $this->title = $title;
    }


    public function getContent()
    {
        return $this->content;
    }


    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function setSubtitle($subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function getIsValidated()
    {
        return $this->is_validated;
    }

    public function setIsValidated($is_validated): void
    {
        $this->is_validated = $is_validated;
    }




}