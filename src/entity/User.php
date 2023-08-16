<?php

namespace entity;

class User
{
    private string $email;
    private string $pseudo;
    private string $country;
    private string $password;
    private string $password_confirm;
    private string $token;
    private bool $is_active;
    private int $id;
    private int $role;

    public function __construct($email, $password= null , $pseudo = null, $country = null, $password_confirm = null,)
    {
        $this->email = $email;
        $this->password = $password;

        $this->pseudo = $pseudo;
        $this->country = $country;
        $this->password_confirm = $password_confirm;

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
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPseudo():string
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo):void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getCountry():string
    {
        return $this->country;
    }

    public function setCountry($country):void
    {
        $this->country = $country;
    }

    public function hashPassword($newPassword):void
    {
        $this->password = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    public function setPassword($password):void
    {
        $this->password = $password;
    }

    /**
     * @param $password
     * @return bool
     */
    public function verifyPassword($password):bool
    {

        return password_verify($password, $this->password);
    }

    /**
     * @return string
     */
    public function getPassword():string
    {
        return $this->password;
    }

    /**
     * @param $password_confirm
     */
    public function setConfirmPassword($password_confirm):void
    {
        $this->password_confirm = $password_confirm;
    }

    /**
     * @return string
     */
    public function getConfirmPassword():string
    {
        return $this->password_confirm;
    }

    /**
     * @return string
     */
    public function getToken():string
    {
        return $this->token;
    }

    public function setToken():void
    {
        $this->token = sha1(uniqid());
    }

    /**
     * @return bool
     */
    public function getIsActive():bool
    {
        return $this->is_active;
    }

    public function setIsActive():void
    {
        $this->is_active = true;
    }

    public function removeToken():void
    {
        $this->token = null;
    }

    public function getRole():int
    {
        return $this->role;
    }

    public function setRole($role):void
    {
        $this->role = $role;
    }
}