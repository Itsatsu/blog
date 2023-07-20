<?php

namespace Controllers;

use Core\Controller;
use Core\HttpRequest;
use Core\Mail;
use Core\Session;
use Entity\Configuration;
use Repository\ConfigurationRepository;
use Repository\UserRepository;

class AdminController extends Controller
{
    function index()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));
        if($user->getRole()['name'] != 'admin'){
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }


       return $this->view('/admin/index.html.twig',[
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
        if($user->getRole()['name'] != 'admin'){
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
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

    function configuration(){
        $session = new Session();
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));
        if($user->getRole()['name'] != 'admin'){
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        $request = new HttpRequest();
        if ($request->get('update') != null) {
            $configRepository = new ConfigurationRepository();
            $sendconfig = $request->get('update');
            var_dump($sendconfig['cv']);
            $config = new Configuration($sendconfig['fullname'], $sendconfig['slogan'], $sendconfig['title'], $sendconfig['color_primary'], $sendconfig['color_secondary'], $sendconfig['cv']);
            $configRepository->update($config);
            $session->setMessage('success', 'Votre configuration a bien été modifié');
            header('Location: /administration/');
        }

        $configRepository = new ConfigurationRepository();
        return $this->view('/admin/edit_configuration.html.twig',[
            'message' => $session->getMessage(),
            'user' => $user,
            'config' => $configRepository->findById(1),
        ]);
    }

    function error()
    {
        return $this->view('/404.html.twig');

    }


}