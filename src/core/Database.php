<?php

namespace Core;

use PDO;
use PDOException;
use ReflectionProperty;
use Symfony\Component\Dotenv\Dotenv;
use ReflectionClass;

class Database
{
    private $pdo;

    public function __construct()
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'../../../.env');

        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $dbname = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getPDO()
    {
        return $this->pdo;
    }
}