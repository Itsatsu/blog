<?php

namespace Controllers;

use Core\Controller;
use Core\HttpRequest;
use Core\Session;
use Entity\Categorie;

use Repository\CategorieRepository;

use Repository\UserRepository;
use Validators\CategorieValidator;

class CategorieController extends Controller
{
    public function show()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $categorieRepository = new CategorieRepository();
        $user = $userRepository->findById($session->get('user'));
        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        $categories = $categorieRepository->findAll();

        return $this->view('/categorie/liste.html.twig', [
            'categories' => $categories,
            'message' => $session->getMessage(),
            'user' => $user,
        ]);

    }

    public function edit($params)
    {

        $session = new Session();
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));
        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        if (!isset($params['id'])) {
            header('Location: /categories');
        }
        $request = new HttpRequest();

        $categorieRepository = new CategorieRepository();
        $categorie = $categorieRepository->findById($params['id']);
        if ($request->get('update') == null) {
            return $this->view('/categorie/edit.html.twig', [
                'categorie' => $categorie,
                'user' => $user,
            ]);
        }
        $categorie->setName($request->get('update')['name']);
        $categorieRepository->update($categorie);
        $session->setMessage('success', 'Votre catégorie a bien été modifié');
        header('Location: /administration/categorie');


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
            return $this->view('/categorie/create_categorie.html.twig', [
                'user' => $user,
            ]);
        }
        $categorieRepository = new CategorieRepository();
        $sendCategorie = $request->get('create');
        $categorie = new Categorie($sendCategorie['name']);
        $categorieValidator = new CategorieValidator($categorie);
        if ($categorieValidator->validate()) {
            $categorieRepository->create($categorie);
            $session->setMessage('success', 'Votre catégorie a bien été créer');
            header('Location: /administration/categorie');
        }
        return $this->view('/categorie/create_categorie.html.twig', [
            'user' => $user,
            'errors' => $categorieValidator->getErrors(),
        ]);
    }


    public function show_all_edit_post()
    {

        return $this->view('/posts/show_all_edit_post.html.twig');

    }


}