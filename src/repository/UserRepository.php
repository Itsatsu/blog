<?php

namespace Repository;


use Entity\User;
use PDO;
use Core\Database;

class UserRepository
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPDO();
    }

    public function create(User $user)
    {
        $user->setToken();
        $user->hashPassword($user->getPassword());
        $stmt = $this->pdo->prepare('INSERT INTO user (email, pseudo, country, password, token) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$user->getEmail(), $user->getPseudo(), $user->getCountry(), $user->getPassword(), $user->getToken()]);
        return $this->pdo->lastInsertId();
    }


    public function update(User $user)
    {
        $user->setIsActive();
        $stmt = $this->pdo->prepare('UPDATE user SET email = ?, pseudo = ?, country = ?, password = ?, is_active = ?, token = ? WHERE id = ?');
        $stmt->execute([$user->getEmail(), $user->getPseudo(), $user->getCountry(), $user->getPassword(),$user->getIsActive(), $user->getToken(),$user->getId()]);
        return $stmt->rowCount();
    }

    public function delete(User $user)
    {
        $stmt = $this->pdo->prepare('DELETE FROM user WHERE id = ?');
        $stmt->execute([$user->getId()]);
        return $stmt->rowCount();
    }

    public function findByToken(mixed $token)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE token = ?');
        $stmt->execute([$token]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $user = new User($data['email'], $data['password'], $data['pseudo'], $data['country']);
        $user->setId($data['id']);
        return $user;
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $user = new User($data['email'], $data['password'], $data['pseudo'], $data['country']);
        $user->setId($data['id']);
        return $user;
    }

    public function findIsActive($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE id = ? and is_active = 1');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return false;
        }
        return true;
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE email = ?');
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $user = new User($data['email'], $data['password'], $data['pseudo'], $data['country']);
        $user->setId($data['id']);
        return $user;
    }

}
