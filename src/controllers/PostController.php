<?php

namespace controllers;

use Core\Controller;
use Core\Session;
use entity\User;
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
        $posts= $postRepository->findLastPost();
        $user = $userRepository->findById($session->get('user'));
        return $this->view('/posts/show_all_post.html.twig',[
            'posts' => $posts,
            'message' => $session->getMessage(),
            'user' => $user,
        ]);

    }
    function show_post($params)
    {
        $session = new Session();
        if (isset($params['id'])) {
            $postRepository = new PostRepository();
            $post = $postRepository->findById($params['id']);
            $userRepository = new UserRepository();
            $user = $userRepository->findById($session->get('user'));
                return $this->view('/posts/detail_post.html.twig', [
                    'post' => $post,
                    'user' => $user,
                ]);
            }

        header('Location: /posts');

    }
    function edit_post($params){

        $session = new Session();

        if (isset($params['id'])) {
            $postRepository = new PostRepository();
            $post = $postRepository->findById($params['id']);
            if ($session->get('user') == $post->getUser()){
                $userRepository = new UserRepository();
                $categorieRepository = new CategorieRepository();
                $user = $userRepository->findById($session->get('user'));
                $categories = $categorieRepository->findAll();

                return $this->view('/posts/edit_post.html.twig', [
                    'post' => $post,
                    'user' => $user,
                    'categories' => $categories,
                ]);
            }
        }


        header('Location: /posts');

    }


    function show_all_edit_post(){

        return $this->view('/posts/show_all_edit_post.html.twig');

    }


}