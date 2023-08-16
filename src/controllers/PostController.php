<?php

namespace controllers;

use Core\Controller;
use Core\HttpRequest;
use Core\Session;
use DateTime;
use Entity\Comment;
use Entity\Post;
use Entity\User;
use Repository\CategorieRepository;
use Repository\CommentRepository;
use Repository\PostRepository;
use Repository\UserRepository;
use Validators\CommentValidator;
use Validators\PostValidator;

class PostController extends Controller
{
    public function show_all_post()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $postRepository = new PostRepository();
        $posts = $postRepository->findLastPost();
        $user = $userRepository->findById($session->get('user'));
        return $this->view('/posts/show_all_post.html.twig', [
            'posts' => $posts,
            'message' => $session->getMessage(),
            'user' => $user,
        ]);

    }

    public function show_post($params)
    {
        $session = new Session();
        if (!isset($params['id'])) {
            header('Location: /posts');
        }
        $postRepository = new PostRepository();
        $post = $postRepository->findById($params['id']);
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));
        $commentRepository = new CommentRepository();
        $request = new HttpRequest();
        if ($request->get('comment') == null) {
            return $this->view('/posts/detail_post.html.twig', [
                'post' => $post,
                'user' => $user,
                'comments' => $commentRepository->findLastCommentOfPost($post->getId()),
                'message' => $session->getMessage(),
            ]);
        }
        $sendComment = $request->get('comment');
        $comment = new Comment($user->getId(), $post->getId(), $sendComment['title'], $sendComment['content'], new DateTime(), new DateTime(), false);

        $commentValidator = new CommentValidator($comment);
        if (!$commentValidator->validate()) {
            return $this->view('/posts/detail_post.html.twig', [
                'post' => $post,
                'user' => $user,
                'errors' => $commentValidator->getErrors(),
                'comments' => $commentRepository->findLastCommentOfPost($post->getId()),
                'message' => $session->getMessage(),
            ]);
        }
        $commentRepository->create($comment);
        $session->setMessage('success', "Votre commentaire a bien été envoyé, il dois etre relu par un administrateur avant d'etre publié");
        header('Location: /posts/detail/' . $post->getId());
    }

    public function edit($params)
    {

        $session = new Session();

        if (!isset($params['id'])) {
            header('Location: /posts');
        }
        $postRepository = new PostRepository();
        $post = $postRepository->findById($params['id']);
        $user = $post->getUser();

        if ($session->get('user') != $user['id']) {
            header('Location: /posts');
        }
        $userRepository = new UserRepository();
        $categorieRepository = new CategorieRepository();
        $user = $userRepository->findById($session->get('user'));
        $categories = $categorieRepository->findAll();
        $request = new HttpRequest();

        if ($request->get('update') == null) {
            return $this->view('/posts/edit_post.html.twig', [
                'post' => $post,
                'user' => $user,
                'categories' => $categories,
                'message' => $session->getMessage(),
            ]);
        }
        $sendPost = $request->get('update');

        $post->setTitle($sendPost['title']);
        $post->setSubtitle($sendPost['subtitle']);
        $post->setContent($sendPost['content']);
        $post->setCategorie($sendPost['categorie']);
        $post->setUser($user->getId());

        $postValidator = new PostValidator($post);
        if (!$postValidator->validate()) {

            return $this->view('/posts/edit_post.html.twig', [
                'post' => $post,
                'user' => $user,
                'categories' => $categories,
                'errors' => $postValidator->getErrors(),
                'message' => $session->getMessage(),
            ]);
        }
        $time = new DateTime();
        $post->setUpdatedAt($time->format('Y-m-d H:i:s'));
        $post->setIsValidated(0);
        $postRepository->update($post);
        $session->setMessage('success', 'Votre article a bien été modifié, il dois etre relu par un administrateur avant d\'etre publié');
        header('Location: /posts');
    }


    public function new_post()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $categorieRepository = new CategorieRepository();
        $user = $userRepository->findById($session->get('user'));
        $categories = $categorieRepository->findAll();
        $request = new HttpRequest();

        if ($request->get('create') == null) {
            return $this->view('/posts/create_post.html.twig', [
                'user' => $user,
                'categories' => $categories,
                'message' => $session->getMessage(),
            ]);
        }
        $postRepository = new PostRepository();
        $sendPost = $request->get('create');
        $post = new Post($sendPost['categorie'], $user->getId(), $sendPost['title'], $sendPost['content'], $sendPost['subtitle'], null, null, 0);
        $postValidator = new PostValidator($post);
        if (!$postValidator->validate()) {
            return $this->view('/posts/create_post.html.twig', [
                'user' => $user,
                'categories' => $categories,
                'errors' => $postValidator->getErrors(),
                'message' => $session->getMessage(),
            ]);
        }
        $postRepository->create($post);
        $session->setMessage('success', 'Votre article a bien été créer, il dois etre relu par un administrateur avant d\'etre publié');
        header('Location: /posts');
    }


    public function validation_index()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $postRepository = new PostRepository();

        $user = $userRepository->findById($session->get('user'));
        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        $posts = $postRepository->findAllNotValidated();

        return $this->view('/posts/validation_index.html.twig', [
            'posts' => $posts,
            'message' => $session->getMessage(),
            'user' => $user,
        ]);

    }

    public function validation($params)
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $postRepository = new PostRepository();

        $user = $userRepository->findById($session->get('user'));

        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        if (isset($params['id'])) {
            $post = $postRepository->findById($params['id']);
            $post->setIsValidated(1);
            $time = new DateTime();
            $post->setUpdatedAt($time->format('Y-m-d H:i:s'));
            $postRepository->update($post);

            $session->setMessage('success', 'L\'article a bien été validé');
            header('Location: /administration/posts/validation_index');
        }
        header('Location: /administration/posts/validation_index');
    }

    public function delete($params)
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $postRepository = new PostRepository();

        $user = $userRepository->findById($session->get('user'));

        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        if (isset($params['id'])) {
            $post = $postRepository->findById($params['id']);
            $postRepository->delete($post);
            $session->setMessage('success', 'L\'article a bien été supprimé');
            header('Location: /administration/posts/validation_index');
        }
        header('Location: /administration/posts/validation_index');
    }


}