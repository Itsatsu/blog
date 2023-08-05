<?php

namespace entity;

class User
{
    private $email;
    private $pseudo;
    private $country;
    private $password;
    private $password_confirm;
    private $token;
    private $is_active;
    private $id;
    private $role;

    public function __construct($email, $password= null , $pseudo = null, $country = null, $password_confirm = null,)
    {
        $this->email = $email;
        $this->password = $password;

        $this->pseudo = $pseudo;
        $this->country = $country;
        $this->password_confirm = $password_confirm;

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

    public function hashPassword($newPassword)
    {
        $this->password = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function verifyPassword($password)
    {

        return password_verify($password, $this->password);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setConfirmPassword($password_confirm)
    {
        $this->password_confirm = $password_confirm;
    }

    public function getConfirmPassword()
    {
        return $this->password_confirm;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken()
    {
        $this->token = sha1(uniqid());
    }

    public function getIsActive()
    {
        return $this->is_active;
    }

    public function setIsActive()
    {
        $this->is_active = true;
    }

    public function removeToken()
    {
        $this->token = null;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }


}