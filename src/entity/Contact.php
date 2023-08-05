<?php

namespace entity;

class Contact
{

    private $id;
    private $email;
    private $message;
    private $lastname;
    private $firstname;

    public function __construct($email, $message, $lastname, $firstname, $id = null)
    {
        $this->email = $email;
        $this->message = $message;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email= $email;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message= $message;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname= $lastname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname= $firstname;
    }

}