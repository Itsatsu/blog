<?php

namespace controllers;

use Core\Controller;
use Core\Session;
use entity\User;
use Repository\UserRepository;

class PostController extends Controller
{
    function show_all_post()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));
        return $this->view('/posts/show_all_post.html.twig',[
            'message' => $session->getMessage(),
            'user' => $user,
        ]);

    }
    function show_post()
    {

        return $this->view('/posts/detail_post.html.twig');

    }
    function edit_post(){

        return $this->view('/posts/edit_post.html.twig');

    }
    function show_all_edit_post(){

        return $this->view('/posts/show_all_edit_post.html.twig');

    }


}