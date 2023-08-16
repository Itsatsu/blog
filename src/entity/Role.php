<?php

namespace entity;

class Role
{
    private string$name;
    private int $id;

    public function __construct($name, $id = null)
    {
        $this->name = $name;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    public function setName($name): void
    {
        $this->name = $name;
    }
}
