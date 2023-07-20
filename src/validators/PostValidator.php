<?php

namespace Validators;

use Repository\PostRepository;

class PostValidator
{
    private $post;
    private $errors = [];

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function validate()
    {

        $postRepository = new PostRepository();
        if (empty($this->post->getCategorie())) {
            $this->addError('danger', "La catégorie est obligatoire.");
        }

        if (empty($this->post->getContent())) {
            $this->addError('danger', "Le contenu est obligatoire.");
        }

        if (empty($this->post->getSubtitle())) {
            $this->addError('danger', "Le sous-titre est obligatoire.");
        }

        if (empty($this->post->getTitle())) {
            $this->addError('danger', 'Le titre est obligatoire.');
        }

        if (empty($this->errors)) {
            return true;
        }
        return false;

    }


    public function getErrors()
    {
        return $this->errors;
    }

    private function addError($type, $message)
    {
        $this->errors[$type] = $message;
    }
}