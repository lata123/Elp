<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */
/* Amit Sharma */
Route::prefix('v1')->group(function() {
    Route::group(['middleware' => 'localization'], function () {
        Route::post('logout', 'App\Module\Controller\UserController@logout');
        
        /**
         * Users Routes
         */

        Route::prefix('user')->group(function() {
            Route::post('register', 'App\Module\Controller\UserController@register');
            Route::post('forgotPassword', 'App\Module\Controller\UserController@forgotPassword');
            Route::post('login', 'App\Module\Controller\LoginController@login');
            Route::group(['middleware' => 'jwt.auth'], function () {
                Route::post('changePassword', 'App\Module\Controller\UserController@changePassword');
                Route::post('uploadChatImage', 'App\Module\Controller\ChatController@uploadChatImage');
                Route::post('getUserDetail', 'App\Module\Controller\UserController@getUserDetail');
                Route::post('getUserListing', 'App\Module\Controller\UserController@getUserListing');
            });
        });

        /**
         * 
         * Admin Routes 
        */

        Route::prefix('admin')->group(function() {
            Route::post('forgotPassword', 'App\Module\Controller\AdminController@forgotPassword');
            Route::post('login', 'App\Module\Controller\LoginController@adminLogin');
            
            Route::group(['middleware' => 'auth.admin'], function () {
                Route::post('getUserDetail', 'App\Module\Controller\UserController@getUserDetail');
                Route::post('changePassword', 'App\Module\Controller\UserController@changePassword');
            });
        });
    });
});
