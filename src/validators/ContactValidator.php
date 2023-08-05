<?php

namespace Validators;

use entity\Contact;

class ContactValidator
{
    private $contact;
    private $errors = [];
    /**
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }


    public function validate()
    {

        if(strlen($this->contact->getMessage())<3 ||strlen($this->contact->getMessage()) > 255 ){
            $this->addError('danger', "Le message est obligatoire et doit contenir entre 3 et 255 caractères.");
        }

        if (empty($this->contact->getEmail())) {
            $this->addError('danger', "L'email est obligatoire.");
        } elseif (!filter_var($this->contact->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $this->addError('danger', "L'email n'est pas valide.");
        }
        
        if(strlen($this->contact->getLastname())<3 ||strlen($this->contact->getLastname()) > 255 ){
            $this->addError('danger', "Le nom est obligatoire et doit contenir entre 3 et 255 caractères.");
        }

        if(strlen($this->contact->getFirstname())<3 ||strlen($this->contact->getFirstname()) > 255 ){
            $this->addError('danger', "Le prénom est obligatoire et doit contenir entre 3 et 255 caractères.");
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