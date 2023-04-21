<?php
namespace Repository;


use Entity\User;
use PDO;
use Core\Database;

class UserRepository
{
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getPDO();
    }

    public function create(User $user)
    {
        $stmt = $this->pdo->prepare('INSERT INTO user (email, pseudo, country, password) VALUES (?, ?, ?, ?)');
        $stmt->execute([$user->getEmail(), $user->getPseudo(), $user->getCountry(), $user->getPassword()]);
        return $this->pdo->lastInsertId();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        return new User($data['email'], $data['pseudo'], $data['country'], $data['password']);
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE email = ?');
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        return new User($data['email'], $data['pseudo'], $data['country'], $data['password']);
    }

    public function update(User $user)
    {
        $stmt = $this->pdo->prepare('UPDATE user SET email = ?, pseudo = ?, country = ?, password = ? WHERE id = ?');
        $stmt->execute([$user->getEmail(), $user->getPseudo(), $user->getCountry(), $user->getPassword(), $user->getId()]);
        return $stmt->rowCount();
    }

    public function delete(User $user)
    {
        $stmt = $this->pdo->prepare('DELETE FROM user WHERE id = ?');
        $stmt->execute([$user->getId()]);
        return $stmt->rowCount();
    }
}
