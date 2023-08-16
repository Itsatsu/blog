<?php

namespace entity;

class Post
{
    private int $categorie;
    private int $user;
    private string $title;
    private string $content;
    private string $subtitle;
    private mixed $created_at;
    private mixed $updated_at;
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

    /**
     *@return void
     * @param int $id
     */
    public function setId(int $id): void
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

    /**
     * @param int $categorie
     * @return void
     */
    public function setCategorie(int $categorie): void
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

    /**
     *@param int $user
     * @return void
     */
    public function setUser(int $user): void
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

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
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

    /**
     * @param string $content
     * @return void
     */
    public function setContent(string $content): void
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

    /**
     * @param string $subtitle
     * @return void
     */
    public function setSubtitle(string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt():mixed
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     * @return void
     */
    public function setCreatedAt(mixed $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     *@param mixed $updated_at
     * @return void
     */
    public function setUpdatedAt(mixed $updated_at): void
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

    /**
     * @param bool $is_validated
     * @return void
     */
    public function setIsValidated(bool $is_validated): void
    {
        $this->is_validated = $is_validated;
    }
}