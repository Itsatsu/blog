<?php

namespace entity;

class Contact
{

    private ?int $id;
    private string $email;
    private string $message;
    private string $lastname;
    private string $firstname;

    public function __construct($firstname,$lastname,$email,$message, ?int $id = null)
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

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id):void
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

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email):void
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

    /**
     * @param string $message
     * @return void
     */
    public function setMessage(string $message):void
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

    /**
     * @param string $lastname
     * @return void
     */
    public function setLastname(string $lastname):void
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
    /**
     * @param string $firstname
     * @return void
     */
    public function setFirstname(string $firstname):void
    {
        $this->firstname= $firstname;
    }
}