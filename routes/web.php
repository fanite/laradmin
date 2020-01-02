<?php

use Illuminate\Support\Facades\Route;

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

Route::get('login', 'AdminController@index')->name('login');

Route::get('register', 'AdminController@index')->name('register');

Route::get('reset-password', 'AdminController@index')->name('reset.password');

Route::get('admin/{any?}', 'AdminController@index')->where('any', '(.*)');
