<?php

require_once "vendor/autoload.php";
require_once "src/controllers/HomeController.php";
require_once "src/controllers/PostController.php";
use Core\Route;
$setup = 'setup.php';


if(!file_exists(".env")){
    $primaryColor = "#d1f8b3";
    $secondaryColor = "#b3f8ff";
    header('Location: '.$setup);
}else{
    require_once "src/config.php";
    Route::run();
}

