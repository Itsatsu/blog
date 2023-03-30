<?php

namespace controllers;

use Core\Controller;

class SecurityController extends Controller
{
    function login()
    {

        return $this->view('/security/login.html.twig');

    }
    function signUp()
    {

        return $this->view('/security/signup.html.twig');

    }
}