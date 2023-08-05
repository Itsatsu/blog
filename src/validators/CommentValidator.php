<?php

namespace Validators;

use entity\Comment;

class CommentValidator
{
    private $comment;
    private $errors = [];
    /**
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }


    public function validate()
    {

        if(strlen($this->comment->getContent())<3 ||strlen($this->comment->getContent()) > 255 ){
            $this->addError('danger', "Le contenue est obligatoire et doit contenir entre 3 et 255 caractères.");
        }

        if(strlen($this->comment->getTitle())<3 ||strlen($this->comment->getTitle()) > 255 ){
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