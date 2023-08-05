<?php

namespace Validators;

use entity\Configuration;
use Repository\ConfigurationRepository;

class ConfigurationValidator
{
    private $configuration;
    private $errors = [];

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function validate()
    {

        $configurationRepository = new ConfigurationRepository();


        if (strlen($this->configuration->getFullname()) < 3 || strlen($this->configuration->getFullname()) > 50) {
            $this->addError('danger', "Le nom de la catégorie est obligatoire et doit faire entre 3 et 50 caractères.");
        }

        if (strlen($this->configuration->getTitle()) < 3 || strlen($this->configuration->getTitle()) > 50) {
            $this->addError('danger', "Le titre est obligatoire et doit faire entre 3 et 50 caractères.");
        }

        if (strlen($this->configuration->getSlogan()) < 3 || strlen($this->configuration->getSlogan()) > 150) {
            $this->addError('danger', "Le slogan est obligatoire et doit faire entre 3 et 150 caractères.");
        }

        if (empty($this->configuration->getColorPrimary())) {
            $this->addError('danger', "La couleur primaire est obligatoire.");
        }

        if (empty($this->configuration->getColorSecondary())) {
            $this->addError('danger', "La couleur secondaire est obligatoire.");
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