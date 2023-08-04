<?php

namespace entity;

class Comment
{

    private $user;
    private $post;
    private $title;
    private $content;
    private $created_at;
    private $updated_at;
    private $is_validated;
    private $id;

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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function setPost($post)
    {
        $this->post = $post;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
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

    public function getIsValidated()
    {
        return $this->is_validated;
    }

    public function setIsValidated($is_validated)
    {
        $this->is_validated = $is_validated;
    }






}