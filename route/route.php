<?php

use Config\Route;
Route::get('/', 'TaskController', 'index')
    ->middleware('auth');
Route::get('/login', 'LoginController', 'show');
Route::post('/login', 'LoginController', 'login');
Route::get('/logout', 'LoginController', 'logout');
Route::get('/tasks/create', 'TaskController', 'create')
    ->middleware('auth');
Route::post('/tasks','TaskController', 'store')
    ->middleware('auth');
Route::post('/tasks/approve','TaskController', 'approve')
    ->middleware('auth');
