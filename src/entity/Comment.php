<?php

namespace entity;

class Comment
{

    private int $user;
    private int $post;
    private string $title;
    private string $content;
    private $created_at;
    private $updated_at;
    private bool $is_validated;
    private int $id;

    public function __construct( $user, $post, $title, $content, $created_at = null, $updated_at = null, $is_validated = null,  $id = null)
    {
        $this->user = $user;
        $this->post = $post;
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->is_validated = $is_validated;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    public function setId($id):void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user):void
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getPost():int
    {
        return $this->post;
    }

    public function setPost($post):void
    {
        $this->post = $post;
    }

    /**
     * @return string
     */
    public function getTitle():string
    {
        return $this->title;
    }

    public function setTitle($title):void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent():string
    {
        return $this->content;
    }

    public function setContent($content):void
    {
        $this->content = $content;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return bool
     */
    public function getIsValidated():bool
    {
        return $this->is_validated;
    }

    public function setIsValidated($is_validated):void
    {
        $this->is_validated = $is_validated;
    }
}