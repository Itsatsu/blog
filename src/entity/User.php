<?php

namespace entity;
class User
{
    private $email;
    private $pseudo;
    private $country;
    private $password;


    public function __construct($email, $pseudo, $country, $password)
    {

        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->country = $country;
        $this->password = password_hash($password, PASSWORD_DEFAULT);

    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function getPassword()
    {
        return $this->password;
    }
}