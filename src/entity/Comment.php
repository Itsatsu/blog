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

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id):void
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

    /**
     * @param int $user
     * @return void
     */
    public function setUser(int $user):void
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

    /**
     * @param int $post
     * @return void
     */
    public function setPost(int $post):void
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

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title):void
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

    /**
     * @param string $content
     * @return void
     */
    public function setContent(string $content):void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     * @return void
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed|null
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param $updated_at
     * @return void
     */
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

    /**
     * @param bool $is_validated
     * @return void
     */
    public function setIsValidated(bool $is_validated):void
    {
        $this->is_validated = $is_validated;
    }
}