<?php

namespace entity;

class Comment
{

    private int $user;
    private int $post;
    private string $title;
    private string $content;
    private mixed $created_at;
    private mixed $updated_at;
    private bool $is_validated;
    private int $id;

    /**
     * Constructeur de la classe Comment.
     *
     * @param int $user L'ID de l'utilisateur associé au commentaire.
     * @param int $post L'ID du post auquel le commentaire est lié.
     * @param string $title Le titre du commentaire.
     * @param string $content Le contenu du commentaire.
     * @param mixed $created_at La date de création du commentaire.
     * @param mixed $updated_at La date de mise à jour du commentaire.
     * @param bool $is_validated Indique si le commentaire est validé ou non.
     * @param int $id L'ID du commentaire.
     */

    public function __construct(
        int $user,
        int $post,
        string $title,
        string $content,
        mixed $created_at = null,
        mixed $updated_at = null,
        bool $is_validated = null,
        int $id = null
    )
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
     * Obtient l'ID du commentaire.
     *
     * @return int L'ID du commentaire.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Définit l'ID du commentaire.
     *
     * @param int $id Le nouvel ID du commentaire.
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Obtient l'ID de l'utilisateur associé au commentaire.
     *
     * @return int L'ID de l'utilisateur.
     */
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     * Définit l'ID de l'utilisateur associé au commentaire.
     *
     * @param int $user Le nouvel ID de l'utilisateur.
     * @return void
     */
    public function setUser(int $user): void
    {
        $this->user = $user;
    }

    /**
     * Retourne l'ID du post auquel le commentaire est lié.
     * @return int
     */
    public function getPost():int
    {
        return $this->post;
    }

    /**
     * Définit l'ID du post auquel le commentaire est lié.
     * @param int $post l'ID du post
     * @return void
     */
    public function setPost(int $post):void
    {
        $this->post = $post;
    }

    /**
     * Recupère le titre du commentaire
     * @return string
     */
    public function getTitle():string
    {
        return $this->title;
    }

    /**
     * Définit le titre du commentaire
     * @param string $title le titre du commentaire
     * @return void
     */
    public function setTitle(string $title):void
    {
        $this->title = $title;
    }

    /**
     * Recupère le contenu du commentaire
     * @return string
     */
    public function getContent():string
    {
        return $this->content;
    }

    /**
     * Définit le contenu du commentaire
     * @param string $content le contenu du commentaire
     * @return void
     */
    public function setContent(string $content):void
    {
        $this->content = $content;
    }

    /**
     * Recupère la date de création du commentaire
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Définit la date de création du commentaire
     * @param mixed $created_at la date de création du commentaire
     * @return void
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * Recupère la date de mise à jour du commentaire
     * @return mixed|null
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Définit la date de mise à jour du commentaire
     * @param mixed|null $updated_at la date de mise à jour du commentaire
     * @return void
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * Recupère si le commentaire est validé ou non
     * @return bool
     */
    public function getIsValidated():bool
    {
        return $this->is_validated;
    }

    /**
     * Définit si le commentaire est validé ou non
     *
     * @param bool $is_validated validé ou non
     * @return void
     */
    public function setIsValidated(bool $is_validated):void
    {
        $this->is_validated = $is_validated;
    }
}
