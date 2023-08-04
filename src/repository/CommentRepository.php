<?php

namespace Repository;


use DateTime;
use Entity\Comment;
use PDO;
use Core\Database;

class CommentRepository
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPDO();
    }

    public function create(Comment $comment)
    {
        $time = new DateTime();
        $comment->setIsValidated(0);
        $comment->setCreatedAt( $time->format('Y-m-d H:i:s'));
        $comment->setUpdatedAt($time->format('Y-m-d H:i:s'));
        $stmt = $this->pdo->prepare('INSERT INTO Comment ( user_id, post_id, title, content, created_at, updated_at, is_validated) VALUES (:user_id, :post_id, :title, :content, :created_at, :updated_at, :is_validated)');

        $params = [
            ':user_id' => $comment->getUser(),
            ':post_id' => $comment->getPost(),
            ':title' => $comment->getTitle(),
            ':content' => $comment->getContent(),
            ':created_at' => $comment->getCreatedAt(),
            ':updated_at' => $comment->getUpdatedAt(),
            ':is_validated' => $comment->getIsValidated(),
        ];

        foreach ($params as $paramName => $paramValue) {
            $stmt->bindValue($paramName, $paramValue);
        }
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }


    public function update(Comment $comment)
    {
        $stmt = $this->pdo->prepare('UPDATE comment SET user_id = :user_id, post_id = :post_id, title = :title, content = :content, updated_at = :updated_at, is_validated = :is_validated WHERE id = :id');
       $params = [
            ':user_id' => $comment->getUser(),
            ':post_id' => $comment->getPost(),
            ':title' => $comment->getTitle(),
            ':content' => $comment->getContent(),
            ':updated_at' => $comment->getUpdatedAt(),
            ':is_validated' => $comment->getIsValidated(),
            ':id' => $comment->getId(),
        ];


        foreach ($params as $paramName => $paramValue) {
            $stmt->bindValue($paramName, $paramValue);
        }

        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete(Comment $comment)
    {
        $stmt = $this->pdo->prepare('DELETE FROM comment WHERE id = :id');
        $id = $comment->getId();
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }


    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM comment WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $stmt2 = $this->pdo->prepare('SELECT * FROM user WHERE id = :id');
        $stmt2->bindParam(':id', $data['user_id']);
        $stmt2->execute();
        $user = $stmt2->fetch(PDO::FETCH_ASSOC);

        $comment = new Comment($user, $data['post_id'], $data['title'], $data['content'], $data['created_at'], $data['updated_at'], $data['is_validated'], $data['id']);
        return $comment;
    }

    public function findIsValidated($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM comment WHERE id = :id and is_validate = 1');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return true;
        }
        return false;
    }
    public function findAllNotValidated()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM comment WHERE is_validated = 0');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$data) {
            return false;
        }
        $comments = [];
        $i = 0;
        foreach ($data as $line) {
            $stmt2 = $this->pdo->prepare('SELECT * FROM user WHERE id = :id');
            $stmt2->bindParam(':id', $line['user_id']);
            $stmt2->execute();
            $user = $stmt2->fetch(PDO::FETCH_ASSOC);

            $comment = new Comment($user, $line['post_id'], $line['title'], $line['content'], $line['created_at'], $line['updated_at'], $line['is_validated'], $line['id']);
            $comments[$i] = $comment;
            $i++;
        }

        return $comments;
    }

    public function findLastCommentOfPost($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM comment WHERE post_id = :post_id AND is_validated = 1 ORDER BY created_at DESC LIMIT 10 ');
        $stmt->bindParam(':post_id', $id);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $comments = [];
        $i = 0;
        foreach ($data as $line) {
            $stmt2 = $this->pdo->prepare('SELECT * FROM user WHERE id = :id');
            $stmt2->bindParam(':id', $line['user_id']);
            $stmt2->execute();
            $user = $stmt2->fetch(PDO::FETCH_ASSOC);

            $comment = new Comment($user, $line['post_id'], $line['title'], $line['content'], $line['created_at'], $line['updated_at'], $line['is_validated'], $line['id']);
            $comments[$i] = $comment;
            $i++;
        }


        return $comments;
    }
}
