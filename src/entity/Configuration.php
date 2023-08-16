<?php

namespace entity;
class Configuration
{
    private $id;
    private $fullname;
    private $title;
    private $slogan;
    private $color_primary;
    private $color_secondary;
    private $github;
    private $linkedin;
    private $x;
    private $path;
    private $file_name;

    public function __construct($fullname, $title, $slogan, $color_primary, $color_secondary, $github = null, $linkedin = null, $x = null, $path = null, $file_name =null, $id = null)
    {
        $this->fullname = $fullname;
        $this->title = $title;
        $this->slogan = $slogan;
        $this->color_primary = $color_primary;
        $this->color_secondary = $color_secondary;
        $this->path = $path;
        $this->file_name = $file_name;
        $this->id = $id;
        $this->github = $github;
        $this->linkedin = $linkedin;
        $this->x = $x;

    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFullname():string
    {
        return $this->fullname;
    }

    public function setFullname($fullname): void
    {
        $this->fullname = $fullname;
    }

    /**
     * @return string
     */
    public function getTitle():string
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
    public function getSlogan():string
    {
        return $this->slogan;
    }

    public function setSlogan($slogan): void
    {
        $this->slogan = $slogan;
    }


    /**
     * @return string
     */
    public function getColorPrimary():string
    {
        return $this->color_primary;
    }

    public function setColorPrimary($color_primary): void
    {
        $this->color_primary = $color_primary;
    }

    /**
     * @return string
     */
    public function getColorSecondary():string
    {
        return $this->color_secondary;
    }

    public function setColorSecondary($color_secondary): void
    {
        $this->color_secondary = $color_secondary;
    }

    /**
     * @return string
     */
    public function getPath():string
    {
        return $this->path;
    }

    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getFileName():string
    {
        return $this->file_name;
    }

    public function setFileName($file_name): void
    {
        $this->file_name = $file_name;
    }

    /**
     * @return string
     */
    public function getGithub():string
    {
        return $this->github;
    }

    public function setGithub($github): void
    {
        $this->github = $github;
    }

    /**
     * @return string
     */
    public function getLinkedin():string
    {
        return $this->linkedin;
    }

    public function setLinkedin($linkedin): void
    {
        $this->linkedin = $linkedin;
    }

    /**
     * @return string
     */
    public function getX():string
    {
        return $this->x;
    }

    public function setX($x): void
    {
        $this->x = $x;
    }



}