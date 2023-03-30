<?php

namespace controllers;

use Core\Controller;

class PostController extends Controller
{
    function show_all_post()
    {

        return $this->view('/posts/show_all_post.html.twig');

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