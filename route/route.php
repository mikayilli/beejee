<?php

use Config\Route;

Route::get('/', 'TaskController', 'index');
Route::get('/login', 'LoginController', 'show');
Route::post('/login', 'LoginController', 'login');
Route::get('/logout', 'LoginController', 'logout');
Route::get('/tasks/create', 'TaskController', 'create');
Route::post('/tasks','TaskController', 'store');
Route::post('/tasks/approve','TaskController', 'approve');
