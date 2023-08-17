<?php

namespace controllers;

use Core\Controller;
use Core\HttpRequest;
use Core\Mail;
use Core\Session;
use Entity\Contact;
use Repository\ConfigurationRepository;
use Repository\ContactRepository;
use Repository\UserRepository;
use Validators\ContactValidator;
use Validators\UserValidator;

class HomeController extends Controller
{


    /**
     * Affiche la page d'accueil.
     *
     */
    public function index()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));
        $configurationRepository = new ConfigurationRepository();
        $info = $configurationRepository->findById($configurationRepository->findOne());
        $request = new HttpRequest();
        if ($request->get('create') !== null) {
            $newContact = $request->get('create');
            $contact = new Contact($newContact['firstname'], $newContact['lastname'], $newContact['email'], $newContact['message']);
            $contactValidator = new ContactValidator($contact);
            if ($contactValidator->validate()){
                $contactRepository = new ContactRepository();
                $contactRepository->create($contact);
                $session->setMessage('success', 'Votre message a bien été envoyé');
                header('Location: /');
            } else {
                return $this->view('/home/index.html.twig', [
                    'message' => $session->getMessage(),
                    'user' => $user,
                    'info' => $info,
                    'errors' => $contactValidator->getErrors()
                ]);

            }
        }


        return $this->view('/home/index.html.twig', [
                'message' => $session->getMessage(),
                'user' => $user,
                'info' => $info,
            ]
        );

    }

    public function profil()
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
            $userValidator = new UserValidator($user);
            if ($userValidator->validateUpdate()) {
                $userRepository->update($user);
                $session->setMessage('success', 'Votre profil a bien été modifié');
                header('Location: /profil');
            } else {
                return $this->view('/user/profil.html.twig', [
                    'message' => $session->getMessage(),
                    'user' => $user,
                    'errors' => $userValidator->getErrors()
                ]);

            }

        } else if ($request->get('resetPassword') !== null) {
            $newUser = $request->get('resetPassword');
            $user->setToken();
            $userRepository->update($user);
            $mail = new Mail();
            $mail->send($user, 'Réinitialisation du mot de passe', '/mail/reset.html.twig', [
                    'user' => $user,
                    'server' => filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_STRING),
                ]
            );

            $session->destroy();
            $session->start();
            $session->setMessage('success', 'Un email vous a été envoyé pour réinitialiser votre mot de passe');
            header('Location: /');
        }
        return $this->view('/user/profil.html.twig', [
            'message' => $session->getMessage(),
            'user' => $user,
        ]);

    }


    public function error404()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));

        return $this->view('/404.html.twig', [
            'message' => $session->getMessage(),
            'user' => $user,
        ]);

    }

}