<?php

namespace Repository;


use entity\Role;
use Entity\User;
use PDO;
use Core\Database;
use Repository\RoleRepository;

class UserRepository
{
    private $pdo;
    private $roleRepository;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPDO();
        $this->roleRepository = new RoleRepository();
    }

    public function findAll()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user');
        $stmt->execute();
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($row['email'], $row['pseudo'], $row['country']) ;
            $user->setId($row['id']);
            $role = $this->roleRepository->findRoleByUser($row['id']);

            $user->setRole($role);
            $users[] = $user ;
        }
        return $users;
    }

    public function create(User $user)
    {
        $roleRepository = new RoleRepository();
        $role = $roleRepository->findIdByName('visitor');
        $user->setRole($role);
        $user->setToken();
        $user->hashPassword($user->getPassword());
        $stmt = $this->pdo->prepare('INSERT INTO user (email, pseudo, country, password, token) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$user->getEmail(), $user->getPseudo(), $user->getCountry(), $user->getPassword(), $user->getToken()]);
        $user->setId($this->pdo->lastInsertId());
        $stmt2 = $this->pdo->prepare('INSERT INTO role_has_user (role_id, user_id) VALUES (?, ?)');
        $stmt2->execute([$user->getRole(), $user->getId()]);
        return $user->getId();
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

        $stmt2 = $this->pdo->prepare('SELECT * FROM role_has_user WHERE user_id = ?');

        $stmt2->execute([$user->getId()]);
        $stmt3 = $this->pdo->prepare('SELECT * FROM role WHERE id = ?');
        $data2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $stmt3->execute([$data2['role_id']]);
        $data3 = $stmt3->fetch(PDO::FETCH_ASSOC);


        $user->setRole($data3);
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

        $stmt2 = $this->pdo->prepare('SELECT * FROM role_has_user WHERE user_id = ?');

        $stmt2->execute([$user->getId()]);
        $stmt3 = $this->pdo->prepare('SELECT * FROM role WHERE id = ?');
        $data2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $stmt3->execute([$data2['role_id']]);
        $data3 = $stmt3->fetch(PDO::FETCH_ASSOC);


        $user->setRole($data3);

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

        $stmt2 = $this->pdo->prepare('SELECT * FROM role_has_user WHERE user_id = ?');

        $stmt2->execute([$user->getId()]);
        $stmt3 = $this->pdo->prepare('SELECT * FROM role WHERE id = ?');
        $data2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $stmt3->execute([$data2['role_id']]);
        $data3 = $stmt3->fetch(PDO::FETCH_ASSOC);

        $user->setRole($data3);

        return $user;
    }

    public function addRole(User $user, Role $role)
    {
        $stmt = $this->pdo->prepare('INSERT INTO role_has_user (role_id, user_id) VALUES (?, ?)');
        $stmt->execute([$role->getId(), $user->getId()]);
        return $stmt->rowCount();
    }

    public function removeRole(User $user, Role $role)
    {
        $stmt = $this->pdo->prepare('DELETE FROM role_has_user WHERE role_id = ? AND user_id = ?');
        $stmt->execute([$role->getId(), $user->getId()]);
        return $stmt->rowCount();
    }

    public function updateRole(User $user, Role $role)
    {
        $stmt = $this->pdo->prepare('UPDATE role_has_user SET role_id = ? WHERE user_id = ?');
        $stmt->execute([$role->getId(), $user->getId()]);
        return $stmt->rowCount();
    }

}
