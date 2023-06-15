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
        } elseif ($this->user->getConfirmPassword() !== $this->user->getPassword()){
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

        if (empty($this->user[0])) {
            $this->addError('danger', "L'email est obligatoire.");
        }
        $user = $userRepository->findByEmail($this->user[0]);

        if ( $user === null) {
            $this->addError('danger', "L'email ou le mot de passe est incorrect.");
        }

        if (empty($this->user[1])) {
            $this->addError('danger', 'Le mot de passe est obligatoire.');
        }

        if ($user->verifyPassword($this->user[1]) !== true) {
            $this->addError('danger', "L'email ou le mot de passe est incorrect.");
        }

        if($user->getIsActive() === false){
            $this->addError('danger', "Votre compte n'est pas activé.");
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