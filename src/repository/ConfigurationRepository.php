<?php
namespace Repository;


use Entity\Configuration;
use PDO;
use Core\Database;

class ConfigurationRepository
{
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getPDO();
    }

    public function create(Configuration $configuration)
    {
        $stmt = $this->pdo->prepare('INSERT INTO configuration (fullname, title, slogan, color_primary, color_secondary, github, linkedin, x, path, file_name) 
                                            VALUES (:fullname, :title, :slogan, :color_primary, :color_secondary, :github, :linkedin, :x ,:path, :filename)');
          $params = [
            ':fullname' => $configuration->getFullname(),
            ':title' => $configuration->getTitle(),
            ':slogan' => $configuration->getSlogan(),
            ':color_primary' => $configuration->getColorPrimary(),
            ':color_secondary' => $configuration->getColorSecondary(),
            ':github' => $configuration->getGithub(),
            ':linkedin' => $configuration->getLinkedin(),
            ':x' => $configuration->getX(),
            ':path' => $configuration->getPath(),
            ':filename' => $configuration->getFileName()
              ];
        foreach ($params as $paramName => $paramValue) {
            $stmt->bindValue($paramName, $paramValue);
        }
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM configuration WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        return new Configuration($data['fullname'], $data['title'], $data['slogan'], $data['color_primary'], $data['color_secondary'],$data['github'], $data['linkedin'], $data['x'], $data['path'], $data['file_name'], $data['id']);
    }

    public function update(Configuration $configuration)
    {
        $stmt = $this->pdo->prepare('UPDATE configuration SET fullname = :fullname , title = :title, slogan = :slogan , color_primary = :color_primary, color_secondary = :color_secondary, github = :github, linkedin = :linkedin, x = :x, path = :path, file_name = :filename WHERE id = :id');
        $params = [
            ':fullname' => $configuration->getFullname(),
            ':title' => $configuration->getTitle(),
            ':slogan' => $configuration->getSlogan(),
            ':color_primary' => $configuration->getColorPrimary(),
            ':color_secondary' => $configuration->getColorSecondary(),
            ':github' => $configuration->getGithub(),
            ':linkedin' => $configuration->getLinkedin(),
            ':x' => $configuration->getX(),
            ':path' => $configuration->getPath(),
            ':filename' => $configuration->getFileName(),
            ':id' => $configuration->getId()
        ];
        foreach ($params as $paramName => $paramValue) {
            $stmt->bindValue($paramName, $paramValue);
        }
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function findOne()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM configuration');
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        return $id = $data['id'];
    }
}
