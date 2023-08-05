<?php

use Controllers\AdminController;
use Controllers\CategorieController;
use Controllers\CommentController;
use controllers\ContactController;
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
Route::meth('/posts/edit/{id}', PostController::class, 'edit');
Route::meth('/posts/create', PostController::class, 'new_post');
Route::meth('/posts/detail/{id}', PostController::class, 'show_post');
Route::meth('/administration/posts/validation_index', PostController::class, 'validation_index');
Route::meth('/administration/posts/validation/{id}', PostController::class, 'validation');
Route::meth('/administration/posts/detail/{id}', PostController::class, 'show_post');
Route::meth('/administration/posts/delete/{id}', PostController::class, 'delete');

Route::meth('/administration', AdminController::class, 'index');

//roles
Route::meth('/administration/roles/', RoleController::class, 'index');
Route::meth('/administration/roles/add-user', RoleController::class, 'add_user');
Route::meth('/administration/roles/create', RoleController::class, 'new');
//posts


//categories
Route::meth('/administration/categorie', CategorieController::class, 'show');
Route::meth('/administration/categorie/create', CategorieController::class, 'new');
Route::meth('/administration/categorie/edit/{id}', CategorieController::class, 'edit');

//comments
Route::meth('/comment/edit/{id}', CommentController::class, 'edit');
Route::meth('/administration/comments/validation_index', CommentController::class, 'validation_index');
Route::meth('/administration/comments/detail/{id}', CommentController::class, 'detail');

Route::meth('/administration/comments/validation/{id}', CommentController::class, 'validation');
Route::meth('/administration/comments/delete/{id}', CommentController::class, 'delete');

//contact
Route::meth('/administration/contact/list', ContactController::class, 'list');
Route::meth('/administration/contact/detail', ContactController::class, 'detail');
Route::meth('/administration/contact/delete/{id}', ContactController::class, 'delete');

//users
Route::meth('/administration/user/index', SecurityController::class, 'index');

//configuration
Route::meth('/administration/configuration/edit', AdminController::class, 'configuration');
