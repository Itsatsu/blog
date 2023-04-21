<?php

require_once "vendor/autoload.php";
require_once "src/controllers/HomeController.php";
require_once "src/controllers/PostController.php";
use Core\Route;
$setup = 'setup.php';


if(!file_exists(".env")){
    header('Location: '.$setup);
    exit();
}else{
    Route::run();
}

