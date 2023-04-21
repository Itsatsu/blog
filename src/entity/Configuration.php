<?php

namespace entity;
class Configuration
{
    private $fullname;
    private $title;
    private $slogan;
    private $color_primary;
    private $color_secondary;
    private $cv;

    public function __construct($fullname, $title, $slogan, $color_primary, $color_secondary, $cv)
    {
        $this->fullname = $fullname;
        $this->title = $title;
        $this->slogan = $slogan;
        $this->color_primary = $color_primary;
        $this->color_secondary = $color_secondary;
        $this->cv = $cv;
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

    public function getCv()
    {
        return $this->cv;
    }

    public function setCv($cv): void
    {
        $this->cv = $cv;
    }

}