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
            $user = [
                $connection['email'],
                $connection['password']
            ];

            $userValidator = new UserValidator($user);
            if ($userValidator->validateLogin()) {

                $userRepository = new UserRepository();
                $user = $userRepository->findByEmail($user[0]);
                $session->set('user', $user->getId());
                $session->setMessage('success', 'Salut '. $user->getPseudo().'!');
                header('Location: /posts');
            }

            return $this->view('/security/login.html.twig', [
                'message' => $session->getMessage(),
                'errors' => $userValidator->getErrors()
            ]);
        }
        return $this->view('/security/login.html.twig', [
            'message' => $session->getMessage(),
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
                $mail->send($user, 'activation', '/mail/activation.html.twig', [
                        'user' => $user,
                        'server' => $_SERVER['HTTP_HOST']
                    ]
                );
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

    public
    function activation($params)
    {
        $session = new Session();
        if (isset($params['token'])) {
            $token = $params['token'];

            $userRepository = new UserRepository();

            if ($userRepository->findByToken($token)) {
                $user = $userRepository->findByToken($token);
                $user->setIsActive();
                $user->removeToken();
                $userRepository->update($user);
                $session->setMessage('success', 'Votre compte a bien été Activé. Vous pouvez vous connecter.');
                header('Location:/login');
                exit();
            }

            //$session->setMessage('error', "Ce token n'existe pas.");
            header('Location:/login');
        }

        //$session->setMessage('error', "Ce token n'existe pas.");
        header('Location:/login');

    }

    public
    function resetPassword($params)
    {
        $request = new HttpRequest();
        $session = new Session();
        if (isset($params['token'])) {

            $token = $params['token'];
            $userRepository = new UserRepository();
            if ($userRepository->findByToken($token)) {


                $user = $userRepository->findByToken($token);
                if ($request->get('reset') != null) {

                    $reset = $request->get('reset');
                    $password = $reset['password'];
                    $confirmpass = $reset['confirmpass'];
                    if ($password == $confirmpass) {

                        $user->hashPassword($password);
                        $user->removeToken();
                        $userRepository->update($user);
                        $session->setMessage('success', 'Votre mot de passe a bien été réinitialisé.');
                        header('Location:/login');

                    } else {
                        $error['danger'] = 'Les mots de passe ne correspondent pas.';
                        return $this->view('/security/resetpassword.html.twig', [
                            'errors' => $error
                        ]);
                    }
                }
                return $this->view('/security/resetpassword.html.twig');
            }
            header('Location:/login');
            //$session->setMessage('error', "Ce token n'existe pas.");
        }
        header('Location:/login');
    }


    public
    function lostPass()
    {
        $request = new HttpRequest();
        if ($request->get('lostpass') != null) {

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
        return $this->view('/security/lostpass.html.twig');

    }

    public function logout()
    {
        $session = new Session();
        $session->destroy();
        $session->start();
        $session->setMessage('success', 'Vous êtes déconnecté.');
        header('Location: /login');
    }
}


