<?php

namespace entity;

class Categorie
{
    private string $name;
    private int $id;

    /**
     * Construit une nouvelle catégorie.
     * @param string $name Le nom de la catégorie.
     * @param int|null $id L'ID de la catégorie.
     */
    public function __construct(string $name, ?int $id= null)
    {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * Obtient l'ID de la catégorie.
     *
     * @return int L'ID de la catégorie.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Définit l'ID de la catégorie.
     *
     * @param int $id Le nouvel ID de la catégorie.
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Obtient le nom de la catégorie.
     *
     * @return string Le nom de la catégorie.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Définit le nom de la catégorie.
     *
     * @param string $name Le nouveau nom de la catégorie.
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
