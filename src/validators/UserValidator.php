<?php

namespace Validators;

use Repository\UserRepository;

class UserValidator
{
    private $user;
    private $errors = [];

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function validateRegister()
    {

        $userRepository = new UserRepository();

        if (empty($this->user->getPseudo())) {
            $this->addError('danger', 'Le pseudo est obligatoire.');
        }

        if (empty($this->user->getEmail())) {
            $this->addError('danger', "L'email est obligatoire.");
        } elseif (!filter_var($this->user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $this->addError('danger', "L'email n'est pas valide.");
        } elseif ($userRepository->findByEmail($this->user->getEmail()) !== null) {
            $this->addError('danger', "L'email est déjà utilisé.");
        }

        if (empty($this->user->getPassword())) {
            $this->addError('danger', 'Le mot de passe est obligatoire.');
        } elseif (password_verify($this->user->getConfirmPassword(), $this->user->getPassword()) !== true) {
            $this->addError('danger', 'Les mots de passe ne correspondent pas.');
        }

        if (empty($this->errors)) {
            return true;
        }
        return false;

    }

    public function validateLogin()
    {
        $userRepository = new UserRepository();

        if (empty($this->user->getEmail())) {
            $this->addError('danger', "L'email est obligatoire.");
        } elseif ($userRepository->findByEmail($this->user->getEmail()) === null) {
            $this->addError('danger', "L'email n'existe pas.");
        }

        if (empty($this->user->getPassword())) {
            $this->addError('danger', 'Le mot de passe est obligatoire.');
        } elseif ($userRepository->findByEmail($this->user->getEmail())->verifyPassword($this->user->getPassword()) !== true) {
            $this->addError('danger', 'Le mot de passe est incorrect.');
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