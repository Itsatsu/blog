<?php

namespace controllers;

use Core\Controller;
use Core\HttpRequest;
use Core\Request;
use Entity\User;
use Repository\UserRepository;
use Validators\UserValidator;

class SecurityController extends Controller
{
    public function login()
    {
        $request = new HttpRequest();
        if ($request->get('connection') != null)
        {
            $connection = $request->get('connection');
            $user = new User($connection['email'],
                $connection['password']);
        }


        return $this->view('/security/login.html.twig');

    }

    public function signUp()
    {

        $request = new HttpRequest();
        if ($request->get('signup') != null) {
            $signup = $request->get('signup');

            $user = new User($signup['email'],
                $signup['pseudo'],
                $signup['pays'],
                $signup['password']);

            $userValidator = new UserValidator($user);
            if ($userValidator->validateRegister($signup['confirmpass']) === true) {
                $userRepository = new UserRepository();
                $userRepository->create($user);
                return $this->view('/security/login.html.twig', [
                    'errors' => $userValidator->getErrors()]);

            }else{

                return $this->view('/security/signup.html.twig', [
                    'errors' => $userValidator->getErrors()]);

            }

        }
        return $this->view('/security/signup.html.twig');
    }
}


