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
    private $path;
    private $file_name;

    public function __construct($fullname, $title, $slogan, $color_primary, $color_secondary, $path = null, $file_name =null, $id = null)
    {
        $this->fullname = $fullname;
        $this->title = $title;
        $this->slogan = $slogan;
        $this->color_primary = $color_primary;
        $this->color_secondary = $color_secondary;
        $this->path = $path;
        $this->file_name = $file_name;
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function setFullname($fullname): void
    {
        $this->fullname = $fullname;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getSlogan()
    {
        return $this->slogan;
    }

    public function setSlogan($slogan): void
    {
        $this->slogan = $slogan;
    }

    public function getColorPrimary()
    {
        return $this->color_primary;
    }

    public function setColorPrimary($color_primary): void
    {
        $this->color_primary = $color_primary;
    }

    public function getColorSecondary()
    {
        return $this->color_secondary;
    }

    public function setColorSecondary($color_secondary): void
    {
        $this->color_secondary = $color_secondary;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path): void
    {
        $this->path = $path;
    }

    public function getFileName()
    {
        return $this->file_name;
    }

    public function setFileName($file_name): void
    {
        $this->file_name = $file_name;
    }

}