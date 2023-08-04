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

        if (strlen($this->categorie->getName()) < 3 || strlen($this->categorie->getName()) > 50) {
            $this->addError('danger', "Le nom de la catégorie est obligatoire et doit faire entre 3 et 50 caractères.");
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