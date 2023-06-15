<?php

namespace Repository;


use DateTime;
use Entity\Post;
use PDO;
use Core\Database;

class PostRepository
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPDO();
    }

    public function create(Post $post)
    {
        $time = new DateTime();
        $post->setIsValidated(false);
        $post->setCreatedAt( $time);
        $post->setUpdatedAt($time);
        $stmt = $this->pdo->prepare('INSERT INTO post (categorie, user, title, content, subtitle, created_at, updated_at, is_validated) VALUES (?, ?, ?, ?, ?,?, ?, ?)');
        $stmt->execute([$post->getCategorie(), $post->getUser(), $post->getTitle(), $post->getContent(), $post->getSubtitle(), $post->getCreatedAt(), $post->getUpdatedAt(), $post->getIsValidated()]);
        return $this->pdo->lastInsertId();
    }


    public function update(Post $post)
    {
        $time = new DateTime();
        $post->setUpdatedAt($time);
        $stmt = $this->pdo->prepare('UPDATE post SET categorie = ?, user = ?, title = ?, content = ?, subtitle = ?, updated_at = ? WHERE id = ?');
        $stmt->execute([$post->getCategorie(), $post->getUser(), $post->getTitle(), $post->getContent(), $post->getSubtitle(), $post->getUpdatedAt(), $post->getId()]);
        return $stmt->rowCount();
    }

    public function delete(post $post)
    {
        $stmt = $this->pdo->prepare('DELETE FROM post WHERE id = ?');
        $stmt->execute([$post->getId()]);
        return $stmt->rowCount();
    }


    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM post WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $post = new post($data['categorie_id'], $data['user_id'], $data['title'], $data['content'], $data['subtitle'], $data['created_at'], $data['updated_at'], $data['is_validated']);
        $post->setId($data['id']);
        return $post;
    }

    public function findIsValidated($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM post WHERE id = ? and is_validate = 1');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return false;
        }
        return true;
    }

    public function findByUser($email)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM post WHERE email = ?');
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $post = new post($data['email'], $data['password'], $data['pseudo'], $data['country']);
        $post->setId($data['id']);
        return $post;
    }

    public function findLastPost()
    {
        //it weel be return an array of object post but only 10 and is_validate = 1
        $stmt = $this->pdo->prepare('SELECT * FROM post WHERE is_validated = 1 ORDER BY created_at DESC LIMIT 10 ');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $posts = [];
        $i = 0;
        foreach ($data as $line) {
            $post = new post($line['categorie_id'], $line['user_id'], $line['title'], $line['content'], $line['subtitle'], $line['created_at'], $line['updated_at'], $line['is_validated'], $line['id']);
            $posts[$i] = $post;
            $i++;
        }
        return $posts;
    }

}
