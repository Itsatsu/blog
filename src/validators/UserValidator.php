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

    public function validateRegister($confirmPassword)
    {

        $userRepository = new UserRepository();

        if (empty($this->user->getPseudo())) {
            $this->addError('pseudo', 'Le pseudo est obligatoire.');
        }

        if (empty($this->user->getEmail())) {
            $this->addError('email', 'L\'email est obligatoire.');
        } elseif (!filter_var($this->user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $this->addError('email', 'L\'email n\'est pas valide.');
        } elseif ($userRepository->findByEmail($this->user->getEmail()) !== null) {
            $this->addError('email', 'L\'email est déjà utilisé.');
        }
        if (empty($this->user->getPassword())) {
            $this->addError('password', 'Le mot de passe est obligatoire.');
        } elseif (password_verify($confirmPassword, $this->user->getPassword()) !== true) {
            $this->addError('password', 'Les mots de passe ne correspondent pas.');
        }

        if (empty($this->errors)) {
            $this->addError('valide', 'Votre compte a bien été créé. Vérifier votre boite mail pour activer votre compte.');
            return true;
        } else {
            return false;
        }

    }

    public function validateLogin()
    {
        $userRepository = new UserRepository();

        if (empty($this->user->getEmail())) {
            $this->addError('email', 'L\'email est obligatoire.');
        } elseif ($userRepository->findByEmail($this->user->getEmail()) === null) {
            $this->addError('email', 'L\'email n\'existe pas.');
        }

        if (empty($this->user->getPassword())) {
            $this->addError('password', 'Le mot de passe est obligatoire.');
        } elseif ($userRepository->findByEmail($this->user->getEmail())->verifyPassword($this->user->getPassword()) !== true) {
            $this->addError('password', 'Le mot de passe est incorrect.');
        }

        if (empty($this->errors)) {
            $this->addError('valide', 'Vous etes connecté.');
            return true;
        } else {
            return false;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function addError($field, $message)
    {
        $this->errors[$field] = $message;
    }
}