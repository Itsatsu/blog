<?php

namespace Validators;

use Repository\CategorieRepository;

class CategorieValidator
{
    private $categorie;
    private $errors = [];

    public function __construct($categorie)
    {
        $this->categorie = $categorie;
    }

    public function validate()
    {

        $categorieRepository = new CategorieRepository();

        if (empty($this->categorie->getName())) {
            $this->addError('danger', "Le nom est obligatoire.");
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