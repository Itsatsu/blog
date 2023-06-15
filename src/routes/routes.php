<?php

use Controllers\HomeController;
use Controllers\PostController;
use Controllers\SecurityController;
use Core\Route;

Route::meth('/', HomeController::class, 'index');
Route::meth('/profil', HomeController::class, 'profil');
Route::meth('/logout', SecurityController::class, 'logout');
Route::meth('/login', SecurityController::class, 'login');
Route::meth('/signup', SecurityController::class, 'signUp');
Route::meth('/lostpass', SecurityController::class, 'lostPass');
Route::meth('/activation/{token}', SecurityController::class, 'activation');
Route::meth('/resetpassword/{token}', SecurityController::class, 'resetPassword');
Route::meth('/test', SecurityController::class, 'test');
Route::meth('/posts', PostController::class, 'show_all_post');
Route::meth('/posts/liste-modification', PostController::class, 'show_all_edit_post');
Route::meth('/posts/modification/{id}', PostController::class, 'edit_post');
Route::meth('/posts/detail/{id}', PostController::class, 'show_post');