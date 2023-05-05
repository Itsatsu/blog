<?php

namespace controllers;

use Core\Controller;
use Core\HttpRequest;
use Core\Mail;
use Core\Request;
use Core\Session;
use Entity\User;
use Repository\UserRepository;
use Validators\UserValidator;

class SecurityController extends Controller
{
    public function login()
    {
        $session = new Session();
        $request = new HttpRequest();
        if ($request->get('connection') != null) {
            $connection = $request->get('connection');
            //$user = new User($connection['email'],
            //    $connection['password']);


        }


        return $this->view('/security/login.html.twig', [
            'message' => $session->getMessage(),
            // 'errors' =>$userValidator->getErrors()
        ]);

    }

    public function signUp()
    {

        $request = new HttpRequest();
        if ($request->get('signup') != null) {
            $signup = $request->get('signup');

            $user = new User(
                $signup['email'],
                $signup['password'],
                $signup['pseudo'],
                $signup['pays'],
                $signup['confirmpass'],
            );

            $userValidator = new UserValidator($user);


            if ($userValidator->validateRegister()) {
                $userRepository = new UserRepository();
                $userRepository->create($user);
                $mail = new Mail();
                $mail->send($user, 'activation', 'Activation de votre compte');
                $session = new Session();
                $session->setMessage('success', 'Votre compte a bien été créé. Vérifier votre boite mail pour activer votre compte.');
                header('Location: /login');
                exit();
            }
            return $this->view('/security/signup.html.twig', [
                'errors' => $userValidator->getErrors()]);

        }
        return $this->view('/security/signup.html.twig');

    }

    public function activation()
    {
        $request = new HttpRequest();
        if ($request->get('token') != null) {
            $token = $request->get('token');
            $userRepository = new UserRepository();

            if ($userRepository->findByToken($token)) {
                $user = $userRepository->findByToken($token);
                $user->setIsActive(1);
                $session = new Session();
                $session->setMessage('success', 'Votre compte a bien été Activé. Vous pouvez vous connecter.');
                header('Location: /login');
                exit();
            }
            $session = new Session();
            $session->setMessage('error', "Ce token n'existe pas.");
            header('Location:/');
        }


        return $this->view('/security/login.html.twig', [
            'message' => $session->getMessage(),
            // 'errors' =>$userValidator->getErrors()
        ]);

    }
}


