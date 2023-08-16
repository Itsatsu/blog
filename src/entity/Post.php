<?php

namespace entity;

class Post
{
    private int $categorie;
    private int $user;
    private string $title;
    private string $content;
    private string $subtitle;
    private $created_at;
    private $updated_at;
    private bool $is_validated;
    private int $id;

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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCategorie(): int
    {
        return $this->categorie;
    }


    public function setCategorie($categorie): void
    {
        $this->categorie = $categorie;
    }

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }


    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getSubtitle(): string
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

    /**
     * @return bool
     */
    public function getIsValidated(): bool
    {
        return $this->is_validated;
    }

    public function setIsValidated($is_validated): void
    {
        $this->is_validated = $is_validated;
    }
}