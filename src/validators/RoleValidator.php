<?php

namespace Validators;

use entity\Role;
use Repository\RoleRepository;

class RoleValidator
{
    private $role;
    private $errors = [];

    public function __construct( Role $role)
    {
        $this->role = $role;
    }

    public function validate()
    {

        $postRepository = new RoleRepository();
        if (strlen($this->role->getName()) < 3 || strlen($this->role->getName()) > 50) {
            $this->addError('danger', "Le nom du role est obligatoire et doit faire entre 3 et 50 caractères.");
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