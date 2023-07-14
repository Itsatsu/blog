<?php

namespace Repository;

use Entity\Role;
use PDO;
use Core\Database;

class RoleRepository{

    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPDO();
    }

    public function create(Role $role)
    {
        $stmt = $this->pdo->prepare('INSERT INTO role (name) VALUES (?)');
        $stmt->execute([$role->getName()]);
        return $this->pdo->lastInsertId();
    }


    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM role WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $role = new role($data['name'],$data['id']);
        return $role;
    }

    public function findIdByName($name)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM role WHERE name = ?');
        $stmt->execute([$name]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        return $data['id'];
    }

    public function findAll()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM role');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $roles = [];
        foreach ($data as $line) {
            $role = new Role($line['name'],$line['id']);
            $roles[] = $role;
        }
        return $roles;
    }

    public function findRoleByUser($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM role_has_user WHERE user_id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $role = new role($data['name'],$data['id']);
        return $role;
    }



}
