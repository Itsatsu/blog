<?php

namespace Controllers;

use Core\Controller;
use Core\HttpRequest;
use Core\Mail;
use Core\Session;
use Entity\Role;
use Repository\RoleRepository;
use Repository\UserRepository;
use Validators\RoleValidator;

class RoleController extends Controller
{
    public function index()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));
        $roleRepository = new RoleRepository();
        $roles = $roleRepository->findAll();
        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }


        return $this->view('/role/liste.html.twig', [
                'message' => $session->getMessage(),
                'user' => $user,
                'roles' => $roles,
            ]
        );

    }

    public function new()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));
        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        $request = new HttpRequest();

        if ($request->get('create') == null) {
            return $this->view('/role/new.html.twig', [
                'user' => $user,
            ]);
        }
        $roleRepository = new RoleRepository();
        $sendRole = $request->get('create');
        $role = new Role($sendRole['name']);
        $validator = new RoleValidator($role);
        if (!$validator->validate()) {
            return $this->view('/role/new.html.twig', [
                'user' => $user,
                'errors' => $validator->getErrors(),
            ]);
        }
        $roleRepository->create($role);
        $session->setMessage('success', 'Votre role a bien été créer');
        header('Location: /administration/roles');
    }

    public function add_user()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $roleRepository = new RoleRepository();
        $user = $userRepository->findById($session->get('user'));
        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        $roles = $roleRepository->findAll();
        $users = $userRepository->findAll();

        $request = new HttpRequest();
        if ($request->get('create') == null) {
            return $this->view('/role/add_user.html.twig', [
                'user' => $user,
                'users' => $users,
                'roles' => $roles,
            ]);
        }
        $userRepository = new UserRepository();
        $sendUserRole = $request->get('create');
        $user = $userRepository->findById($sendUserRole['user']);
        $role = $roleRepository->findById($sendUserRole['role']);
        $userRepository->updateRole($user, $role);

        $session->setMessage('success', 'Le role de l\'utilisateur a bien été modifié');
        header('Location: /administration/');

    }


}