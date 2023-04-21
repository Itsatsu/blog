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
        $stmt = $this->pdo->prepare('INSERT INTO configuration (fullname, title, slogan, color_primary, color_secondary, cv) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$configuration->getFullname(), $configuration->getTitle(), $configuration->getSlogan(), $configuration->getColorPrimary(), $configuration->getColorSecondary(), $configuration->getCv()]);
        return $this->pdo->lastInsertId();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM configuration WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        return new Configuration($data['fullname'], $data['title'], $data['slogan'], $data['color_primary'], $data['color_secondary'], $data['cv']);
    }

    public function update(Configuration $configuration)
    {
        $stmt = $this->pdo->prepare('UPDATE configuration SET fullname = ?, title = ?, slogan = ?, color_primary = ?, color_secondary = ?, cv = ? WHERE id = ?');
        $stmt->execute([$configuration->getFullname(), $configuration->getTitle(), $configuration->getSlogan(), $configuration->getColorPrimary(), $configuration->getColorSecondary(), $configuration->getCv()]);
        return $stmt->rowCount();
    }
}
