<?php

use Controllers\HomeController;
use Controllers\PostController;
use Controllers\SecurityController;
use Core\Route;

Route::meth('/', HomeController::class, 'index');
Route::meth('/login', SecurityController::class, 'login');
Route::meth('/signup', SecurityController::class, 'signUp');
Route::meth('/posts', PostController::class, 'show_all_post');
Route::meth('/posts/liste-modification', PostController::class, 'show_all_edit_post');
Route::meth('/posts/modification', PostController::class, 'edit_post');
Route::meth('/posts/detail', PostController::class, 'show_post');