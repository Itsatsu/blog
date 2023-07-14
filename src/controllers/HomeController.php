<?php

namespace controllers;

use Core\Controller;
use Core\HttpRequest;
use Core\Mail;
use Core\Session;
use Repository\UserRepository;

class HomeController extends Controller
{
    function index()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));

       return $this->view('/home/index.html.twig',[
           'message' => $session->getMessage(),
               'user' => $user,
       ]
       );

    }
    function profil()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));
        $request = new HttpRequest();
        if ($request->get('profil') != null) {
            $newUser = $request->get('profil');
            $user->setPseudo($newUser['pseudo']);
            $user->setEmail($newUser['email']);
            $user->setCountry($newUser['country']);
            $userRepository->update($user);
            $session->setMessage('success', 'Votre profil a bien été modifié');
            header('Location: /profil');

        }elseif ($request->get('resetPassword') != null) {
            $newUser = $request->get('resetPassword');
            $user->setToken();
            $userRepository->update($user);
            $mail = new Mail();
            $mail->send($user, 'Réinitialisation du mot de passe', '/mail/reset.html.twig', [
                    'user' => $user,
                    'server' => $_SERVER['HTTP_HOST']
                ]
            );

            $session->destroy();
            $session->start();
            $session->setMessage('success', 'Un email vous a été envoyé pour réinitialiser votre mot de passe');
            header('Location: /');
        }
        return $this->view('/user/profil.html.twig',[
            'message' => $session->getMessage(),
            'user' => $user,
        ]);

    }
    function error()
    {
        return $this->view('/404.html.twig');

    }


}