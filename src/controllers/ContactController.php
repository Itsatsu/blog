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


    public function edit($params)
    {

        $session = new Session();

        if (!isset($params['id'])) {
            header('Location: /posts');
        }
        $commentRepository = new CommentRepository();
        $comment = $commentRepository->findById($params['id']);
        $user = $comment->getUser();

        if ($session->get('user') != $user['id']) {

            $session->setMessage('danger', "Vous n'avez pas accès à cette page");
            header('Location: /posts/detail/' . $comment->getPost());
        }

        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));
        $request = new HttpRequest();

        if ($request->get('update') == null) {
            return $this->view('/comment/edit.html.twig', [
                'comment' => $comment,
                'user' => $user,
                'message' => $session->getMessage(),
            ]);
        }
        $sendComment = $request->get('update');

        $comment->setTitle($sendComment['title']);
        $comment->setContent($sendComment['content']);

        $commentValidator = new CommentValidator($comment);

        if (!$commentValidator->validate()) {
            return $this->view('/comment/edit.html.twig', [
                'comment' => $comment,
                'user' => $user,
                'errors' => $commentValidator->getErrors(),
                'message' => $session->getMessage(),
            ]);
        }
        $time = new DateTime();
        $comment->setUpdatedAt($time->format('Y-m-d H:i:s'));
        $comment->setIsValidated(0);
        $commentRepository->update($comment);
        $session->setMessage('success', "Votre commentaire a bien été modifié, il dois etre relu par un administrateur avant d'etre publié");
        header('Location: /posts/detail/' . $comment->getPost());
    }

    public function validation_index()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $commentRepository = new CommentRepository();

        $user = $userRepository->findById($session->get('user'));
        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }

        $comments = $commentRepository->findAllNotValidated();

        return $this->view('/comment/validation_index.html.twig', [
            'comments' => $comments,
            'message' => $session->getMessage(),
            'user' => $user,
        ]);

    }

    public function validation($params)
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $commentRepository = new CommentRepository();

        $user = $userRepository->findById($session->get('user'));

        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        if (!isset($params['id'])) {
            header('Location: /administration/comments/validation_index');
        }
        $comment = $commentRepository->findById($params['id']);
        $comment->setIsValidated(1);
        $time = new DateTime();
        $comment->setUpdatedAt($time->format('Y-m-d H:i:s'));
        $commentRepository->update($comment);

        $session->setMessage('success', 'Le commentaire a bien été validé');
        header('Location: /administration/comments/validation_index');
    }


    public function delete($params)
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $commentRepository = new CommentRepository();

        $user = $userRepository->findById($session->get('user'));

        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        if (!isset($params['id'])) {
            header('Location: /administration/comments/validation_index');
        }
        $comment = $commentRepository->findById($params['id']);
        $commentRepository->delete($comment);
        $session->setMessage('success', "Le commentaire a bien été supprimé");
        header('Location: /administration/comments/validation_index');
    }

}