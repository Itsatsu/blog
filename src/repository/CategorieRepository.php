<?php

namespace Repository;


use DateTime;
use Entity\Categorie;
use Entity\Post;
use PDO;
use Core\Database;

class CategorieRepository{

    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPDO();
    }

    public function create(Categorie $categorie)
    {
        $stmt = $this->pdo->prepare('INSERT INTO categorie (name) VALUES (?)');
        $stmt->execute([$categorie->getName()]);
        return $this->pdo->lastInsertId();
    }

    public function update(Categorie $categorie)
    {
        $stmt = $this->pdo->prepare('UPDATE categorie SET name = ? WHERE id = ?');
        $stmt->execute([$categorie->getName(), $categorie->getId()]);
        return $stmt->rowCount();
    }

    public function delete(Categorie $categorie)
    {
        $stmt = $this->pdo->prepare('DELETE FROM categorie WHERE id = ?');
        $stmt->execute([$categorie->getId()]);
        return $stmt->rowCount();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM categorie WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $categorie = new Categorie($data['name'],$data['id']);
        return $categorie;
    }

    public function findAll()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM categorie');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categories = [];
        foreach ($data as $line) {
            $categorie = new Categorie($line['name'],$line['id']);
            $categories[] = $categorie;
        }
        return $categories;
    }


}
