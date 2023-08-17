<?php

namespace entity;

class User
{
    private string $email;
    private ?string $pseudo;
    private ?string $country;
    private ?string $password;
    private ?string $password_confirm;
    private ?string $token;
    private $is_active;
    private ?int $id;
    private mixed $role;

    public function __construct($email, ?string $password= null , ?string $pseudo = null, ?string $country = null, ?string $password_confirm = null,)
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
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPseudo():string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     * @return void
     */
    public function setPseudo(string $pseudo):void
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

    /**
     * @param string $country
     * @return void
     */
    public function setCountry(string $country):void
    {
        $this->country = $country;
    }

    /**
     * @param string $newPassword
     * @return void
     */
    public function hashPassword( string $newPassword):void
    {
        $this->password = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    /**
     * @param string $password
     * @return void
     */
    public function setPassword(string $password):void
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
     * @param string $password_confirm
     * @return void
     */
    public function setConfirmPassword(string $password_confirm):void
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

    /**
     * @return void
     */
    public function setToken():void
    {
        $this->token = sha1(uniqid());
    }

    public function setAddToken($token):void
    {
        $this->token = $token;
    }

    /**
     * @return bool
     */
    public function getIsActive():bool
    {
        return $this->is_active;
    }

    /**
     * @return void
     */
    public function setIsActive():void
    {
        $this->is_active = true;
    }

    /**
     * @return void
     */
    public function addIsActive($isActive):void
    {
        $this->is_active = $isActive;
    }

    /**
     * @return void
     */
    public function removeToken():void
    {
        $this->token = null;
    }

    /**
     * @return mixed
     */
    public function getRole():mixed
    {
        return $this->role;
    }
    /**
     *
     * @return void
     */
    public function setRole($role):void
    {
        $this->role = $role;
    }
}