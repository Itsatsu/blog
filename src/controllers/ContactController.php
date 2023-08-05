<?php

namespace controllers;

use Core\Controller;
use Core\HttpRequest;
use Core\Session;
use DateTime;
use Repository\CommentRepository;
use Repository\ContactRepository;
use Repository\PostRepository;
use Repository\UserRepository;
use Validators\CommentValidator;

class ContactController extends Controller
{
    public function detail($params)
    {
        $session = new Session();
        if (!isset($params['id'])) {
            header('Location: /');
        }

        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));

        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }

        $contactRepository = new ContactRepository();
        $contact = $contactRepository->findById($params['id']);
        $request = new HttpRequest();

        return $this->view('/contact/detail.html.twig', [
            'user' => $user,
            'contact' => $contact,
            'message' => $session->getMessage(),
        ]);

    }


    public function list()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $contactRepository = new ContactRepository();

        $user = $userRepository->findById($session->get('user'));
        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }

        $contacts = $contactRepository->findAll();

        return $this->view('/contact/list.html.twig', [
            'contacts' => $contacts,
            'message' => $session->getMessage(),
            'user' => $user,
        ]);

    }


    public function delete($params)
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $contactRepository = new ContactRepository();

        $user = $userRepository->findById($session->get('user'));

        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        if (!isset($params['id'])) {
            header('Location: /administration/contact/list');
        }
        $contact = $contactRepository->findById($params['id']);
        $contactRepository->delete($contact);
        $session->setMessage('success', "Le message a bien été supprimé");
        header('Location: /administration/contact/list');
    }

}