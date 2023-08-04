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
        if ($request->get('connection') == null) {
            return $this->view('/security/login.html.twig', [
                'message' => $session->getMessage(),
            ]);
        }
        $connection = $request->get('connection');
        $user = [
            $connection['email'],
            $connection['password']
        ];

        $userValidator = new UserValidator($user);
        if (!$userValidator->validateLogin()) {
            return $this->view('/security/login.html.twig', [
                'message' => $session->getMessage(),
                'errors' => $userValidator->getErrors()
            ]);
        }

        $userRepository = new UserRepository();
        $user = $userRepository->findByEmail($user[0]);
        $session->set('user', $user->getId());
        $session->setMessage('success', 'Salut ' . $user->getPseudo() . '!');
        header('Location: /posts');
    }


    public function signUp()
    {

        $request = new HttpRequest();
        if ($request->get('signup') == null) {
            return $this->view('/security/signup.html.twig');
        }
        $signup = $request->get('signup');

        $user = new User(
            $signup['email'],
            $signup['password'],
            $signup['pseudo'],
            $signup['pays'],
            $signup['confirmpass'],
        );

        $userValidator = new UserValidator($user);


        if (!$userValidator->validateRegister()) {
            return $this->view('/security/signup.html.twig', [
                'errors' => $userValidator->getErrors()]);
        }
        $userRepository = new UserRepository();
        $userRepository->create($user);
        $mail = new Mail();
        $mail->send($user, 'activation', '/mail/activation.html.twig', [
                'user' => $user,
                'server' => $_SERVER['HTTP_HOST']
            ]
        );
        $session = new Session();
        $session->setMessage('success', 'Votre compte a bien été créé. Vérifier votre boite mail pour activer votre compte.');
        header('Location: /login');
    }

    public function activation($params)
    {
        $session = new Session();
        if (!isset($params['token'])) {
            header('Location:/login');
        }
        $token = $params['token'];

        $userRepository = new UserRepository();

        if (!$userRepository->findByToken($token)) {
            header('Location:/login');
        }
        $user = $userRepository->findByToken($token);
        $user->setIsActive();
        $user->removeToken();
        $userRepository->update($user);
        $session->setMessage('success', 'Votre compte a bien été Activé. Vous pouvez vous connecter.');
        header('Location:/login');
        exit();
    }

    public function resetPassword($params)
    {
        $request = new HttpRequest();
        $session = new Session();
        if (!isset($params['token'])) {
            header('Location:/login');
        }
        $token = $params['token'];
        $userRepository = new UserRepository();
        if (!$userRepository->findByToken($token)) {
            header('Location:/login');
        }

        $user = $userRepository->findByToken($token);
        if ($request->get('reset') == null) {
            return $this->view('/security/resetpassword.html.twig');
        }
        $reset = $request->get('reset');
        $password = $reset['password'];
        $confirmpass = $reset['confirmpass'];
        if ($password != $confirmpass) {
            $error['danger'] = 'Les mots de passe ne correspondent pas.';
            return $this->view('/security/resetpassword.html.twig', [
                'errors' => $error
            ]);
        }

        $user->hashPassword($password);
        $user->removeToken();
        $userRepository->update($user);
        $session->setMessage('success', 'Votre mot de passe a bien été réinitialisé.');
        header('Location:/login');

    }


    public function lostPass()
    {
        $request = new HttpRequest();
        if ($request->get('lostpass') == null) {
            return $this->view('/security/lostpass.html.twig');
        }

        $lostpass = $request->get('lostpass');
        $email = $lostpass['email'];

        $userRepository = new UserRepository();
        if ($userRepository->findByEmail($email)) {
            $user = $userRepository->findByEmail($email);
            $user->setToken();
            $userRepository->update($user);
            $mail = new Mail();
            $mail->send($user, 'Réinitialisation du mot de passe', '/mail/reset.html.twig', [
                    'user' => $user,
                    'server' => $_SERVER['HTTP_HOST']
                ]
            );

        }

        $session = new Session();
        $session->setMessage('success', 'Un mail de réinitialisation a été envoyé. Vérifier votre boite mail.');
        header('Location: /login');


    }

    public function logout()
    {
        $session = new Session();
        $session->destroy();
        $session->start();
        $session->setMessage('success', 'Vous êtes déconnecté.');
        header('Location: /login');
    }

    public function index()
    {
        $session = new Session();
        $userRepository = new UserRepository();

        $user = $userRepository->findById($session->get('user'));
        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        $users = $userRepository->findAll();
        return $this->view('/user/liste.html.twig', [
            'users' => $users,
            'message' => $session->getMessage(),
            'user' => $user
        ]);

    }

}


