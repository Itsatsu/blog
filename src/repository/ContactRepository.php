<?php

namespace Repository;


use DateTime;
use Entity\Contact;
use PDO;
use Core\Database;

class ContactRepository
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPDO();
    }

    public function create(Contact $contact)
    {
        $stmt = $this->pdo->prepare('INSERT INTO contact ( firstname, lastname, email, message) VALUES (:firstname, :lastname, :email, :message)');

        $params = [
            ':firstname' => $contact->getFirstname(),
            ':lastname' => $contact->getLastname(),
            ':email' => $contact->getEmail(),
            ':message' => $contact->getMessage(),
        ];

        foreach ($params as $paramName => $paramValue) {
            $stmt->bindValue($paramName, $paramValue);
        }
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }


    public function delete(Contact $contact)
    {
        $stmt = $this->pdo->prepare('DELETE FROM contact WHERE id = :id');
        $id = $contact->getId();
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM contact WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $contact = new Contact($data['firstname'], $data['lastname'], $data['email'], $data['message'], $data['id']);
        return $contact;
    }

    public function findAll()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM contact');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $contacts = [];
        foreach ($data as $contact) {
            $contacts[] = new Contact($contact['firstname'], $contact['lastname'], $contact['email'], $contact['message'], $contact['id']);
        }
        return $contacts;
    }

}
