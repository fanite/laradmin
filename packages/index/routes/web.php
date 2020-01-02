<?php

use Illuminate\Support\Facades\Route;

Route::get('{any?}', 'IndexController@index')->where('any', '/');
