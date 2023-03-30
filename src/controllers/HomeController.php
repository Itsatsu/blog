<?php

namespace controllers;

use Core\Controller;

class HomeController extends Controller
{
    function index()
    {
       return $this->view('/home/index.html.twig');

    }
    function dexdex()
    {
        return $this->view('/home/home.html.twig');

    }
    function error()
    {
        return $this->view('/404.html.twig');

    }

}