<?php

namespace controllers;

use Core\Controller;
use Core\HttpRequest;
use Core\Session;
use DateTime;
use Entity\Post;
use Entity\User;
use Repository\CategorieRepository;
use Repository\PostRepository;
use Repository\UserRepository;

class PostController extends Controller
{
    function show_all_post()
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

    function show_post($params)
    {
        $session = new Session();
        if (!isset($params['id'])) {
            header('Location: /posts');
        }
        $postRepository = new PostRepository();
        $post = $postRepository->findById($params['id']);
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));

        return $this->view('/posts/detail_post.html.twig', [
            'post' => $post,
            'user' => $user,
            'author' => $userRepository->findById($post->getUser()),
        ]);

    }

    function edit_post($params)
    {

        $session = new Session();

        if (isset($params['id'])) {
            $postRepository = new PostRepository();
            $post = $postRepository->findById($params['id']);
            if ($session->get('user') == $post->getUser()) {
                $userRepository = new UserRepository();
                $categorieRepository = new CategorieRepository();
                $user = $userRepository->findById($session->get('user'));
                $categories = $categorieRepository->findAll();
                $request = new HttpRequest();
                if ($request->get('update') != null) {
                    $sendPost = $request->get('update');

                    $post->setTitle($sendPost['title']);
                    $post->setSubtitle($sendPost['subtitle']);
                    $post->setContent($sendPost['content']);
                    $post->setCategorie($sendPost['categorie']);
                    $post->setUser($user->getId());
                    $time = new DateTime();
                    $post->setUpdatedAt($time->format('Y-m-d H:i:s'));
                    $postRepository->update($post);
                    $session->setMessage('success', 'Votre article a bien été modifié, il dois etre relu par un administrateur avant d\'etre publié');
                    header('Location: /posts');
                }
                return $this->view('/posts/edit_post.html.twig', [
                    'post' => $post,
                    'user' => $user,
                    'categories' => $categories,
                ]);
            }
        }
        header('Location: /posts');
    }

    function new_post()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $categorieRepository = new CategorieRepository();
        $user = $userRepository->findById($session->get('user'));
        $categories = $categorieRepository->findAll();
        $request = new HttpRequest();

        if ($request->get('create') != null) {
            $postRepository = new PostRepository();
            $sendPost = $request->get('create');
            $post = new Post($sendPost['categorie'], $user->getId(), $sendPost['title'], $sendPost['content'], $sendPost['subtitle'], null, null, 0);
            $postRepository->create($post);
            $session->setMessage('success', 'Votre article a bien été créer, il dois etre relu par un administrateur avant d\'etre publié');
            header('Location: /posts');
        }
        return $this->view('/posts/create_post.html.twig', [
            'user' => $user,
            'categories' => $categories,
        ]);
    }




function show_all_edit_post()
{

    return $this->view('/posts/show_all_edit_post.html.twig');

}


}