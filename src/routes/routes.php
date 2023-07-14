<?php

use Controllers\AdminController;
use Controllers\CategorieController;
use Controllers\HomeController;
use Controllers\PostController;
use Controllers\RoleController;
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


//posts
Route::meth('/posts', PostController::class, 'show_all_post');
Route::meth('/posts/liste-modification', PostController::class, 'show_all_edit_post');
Route::meth('/posts/modification/{id}', PostController::class, 'edit_post');
Route::meth('/posts/create', PostController::class, 'new_post');
Route::meth('/posts/detail/{id}', PostController::class, 'show_post');

Route::meth('/administration', AdminController::class, 'index');

//roles
Route::meth('/administration/roles/', RoleController::class, 'index');
Route::meth('/administration/roles/add-user', RoleController::class, 'add_user');
Route::meth('/administration/roles/create', RoleController::class, 'new');
//posts
Route::meth('/administration/posts/validation_index', PostController::class, 'validation_index');
Route::meth('/administration/posts/validation/{id}', PostController::class, 'validation');
Route::meth('/administration/posts/detail/{id}', PostController::class, 'show_post');
Route::meth('/administration/posts/delete/{id}', PostController::class, 'delete');

//categories
Route::meth('/administration/categorie', CategorieController::class, 'show');
Route::meth('/administration/categorie/create', CategorieController::class, 'new');
Route::meth('/administration/categorie/edit/{id}', CategorieController::class, 'edit');

//users
Route::meth('/administration/user/index', SecurityController::class, 'index');