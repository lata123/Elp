<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', 'App\Module\Controller\UserController@welcome');
Route::get('/login', 'App\Module\Controller\UserController@welcome');

include(__DIR__.'/adminRoutes.php');

