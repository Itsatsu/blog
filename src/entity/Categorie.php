<?php

namespace entity;

class Categorie
{
    private $name;
    private $id;

    public function __construct($name, $id = null)
    {
        $this->name = $name;
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }
}
