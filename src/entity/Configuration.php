<?php

namespace entity;
class Configuration
{
    private int $id;
    private string $fullname;
    private string $title;
    private string $slogan;
    private string $color_primary;
    private string $color_secondary;
    private string $github;
    private string $linkedin;
    private string $x;
    private string $path;
    private string $file_name;

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

    /**
     * @return void
     * @param  int  $id
     */
    public function setId(int $id): void
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

    /**
     * @return void
     * @param  string  $fullname
     */
    public function setFullname(string $fullname): void
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

    /**
     * @return void
     * @param  string  $title
     */
    public function setTitle(string $title): void
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

    /**
     * @return void
     * @param  string  $slogan
     */
    public function setSlogan(string $slogan): void
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

    /**
     * @return void
     * @param  string  $color_primary
     */
    public function setColorPrimary(string $color_primary): void
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

    /**
     * @return void
     * @param  string  $color_secondary
     */
    public function setColorSecondary(string $color_secondary): void
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

    /**
     * @return void
     * @param  string  $path
     */
    public function setPath( string $path): void
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

    /**
     * @return void
     * @param  string  $file_name
     */
    public function setFileName( string $file_name): void
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

    /**
     * @return void
     * @param  string  $github
     */
    public function setGithub(string $github): void
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
    /**
     * @return void
     * @param  string  $linkedin
     */
    public function setLinkedin(string $linkedin): void
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

    /**
     * @return void
     * @param  string  $x
     */
    public function setX(string $x): void
    {
        $this->x = $x;
    }
}