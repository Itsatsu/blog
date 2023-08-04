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

        if(strlen($this->post->getContent())<3 ||strlen($this->post->getContent()) > 255 ){
            $this->addError('danger', "Le contenue est obligatoire et doit contenir entre 3 et 255 caractères.");
        }

        if(strlen($this->post->getSubtitle())<3 ||strlen($this->post->getSubtitle()) > 255 ){
            $this->addError('danger', "Le sous-titre est obligatoire et doit contenir entre 3 et 255 caractères.");
        }

        if(strlen($this->post->getTitle())<3 ||strlen($this->post->getTitle()) > 255 ){
            $this->addError('danger', "Le titre est obligatoire et doit contenir entre 3 et 255 caractères.");
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