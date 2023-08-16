<?php

namespace entity;

class Contact
{

    private int $id;
    private string $email;
    private string $message;
    private string $lastname;
    private string $firstname;

    public function __construct($firstname,$lastname,$email,$message, $id = null)
    {
        $this->email = $email;
        $this->message = $message;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->id = $id;
    }
    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    public function setId($id):void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail():string
    {
        return $this->email;
    }

    public function setEmail($email):void
    {
        $this->email= $email;
    }

    /**
     * @return string
     */
    public function getMessage():string
    {
        return $this->message;
    }

    public function setMessage($message):void
    {
        $this->message= $message;
    }

    /**
     * @return string
     */
    public function getLastname():string
    {
        return $this->lastname;
    }

    public function setLastname($lastname):void
    {
        $this->lastname= $lastname;
    }

    /**
     * @return string
     */
    public function getFirstname():string
    {
        return $this->firstname;
    }

    public function setFirstname($firstname):void
    {
        $this->firstname= $firstname;
    }

}