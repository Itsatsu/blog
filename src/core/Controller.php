<?php
namespace Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    public function view(string $path)
    {
        $loader = new FilesystemLoader('./src/templates/');
        $twig = new Environment($loader);

        echo $twig->render($path);
    }

}