<?php

namespace Controllers;

use Core\Controller;
use Core\HttpRequest;
use Core\Mail;
use Core\Session;
use Entity\Configuration;
use Repository\ConfigurationRepository;
use Repository\UserRepository;
use Validators\ConfigurationValidator;

class AdminController extends Controller
{


    public function index()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));
        if ($user->getRole()['name'] !== 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        return $this->view('/admin/index.html.twig', [
                'message' => $session->getMessage(),
                'user' => $user,
            ]
        );
    }


    public function configuration()
    {
        $session = new Session();
        $userRepository = new UserRepository();
        $user = $userRepository->findById($session->get('user'));
        if ($user->getRole()['name'] != 'admin') {
            $session->setMessage('danger', 'Vous n\'avez pas accès à cette page');
            header('Location: /');
        }
        $request = new HttpRequest();
        $configRepository = new ConfigurationRepository();
        if ($request->get('update') == null) {
            return $this->view('/admin/edit_configuration.html.twig', [
                'message' => $session->getMessage(),
                'user' => $user,
                'config' => $configRepository->findById($configRepository->findOne()),
            ]);
        }
        $sendconfig = $request->get('update');
        $cv = $_FILES['cv'];
        $profil = $_FILES['profil'];
        $config = new Configuration($sendconfig['fullname'], $sendconfig['title'], $sendconfig['slogan'], $sendconfig['color_primary'], $sendconfig['color_secondary'], $sendconfig['github'], $sendconfig['linkedin'], $sendconfig['x']);
        $validator = new ConfigurationValidator($config);
        if (!$validator->validate()) {
            return $this->view('/admin/edit_configuration.html.twig', [
                'message' => $session->getMessage(),
                'user' => $user,
                'config' => $configRepository->findById($configRepository->findOne()),
                'errors' => $validator->getErrors(),
            ]);
        }
        $id = $configRepository->findOne();
        if ($cv['tmp_name'] === "") {
            $path = $configRepository->findById($id)->getPath();
            $fileName = $configRepository->findById($id)->getFileName();
        } else {
            move_uploaded_file($cv['tmp_name'], "public/assets/uploads/" . "cv.pdf");
            $fileName = $cv['name'];
            $path = "public/assets/uploads/cv.pdf";
        }
        if (!$profil['tmp_name'] === "") {
            move_uploaded_file($profil['tmp_name'], "public/assets/uploads/" . "profil.png");
        }
        $config->setPath($path);
        $config->setFileName($fileName);
        $config->setId($id);
        $configRepository->update($config);
        $session->setMessage('success', 'Votre configuration a bien été modifié');
        header('Location: /administration/');
    }
}