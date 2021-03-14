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

Route::get('/', 'HomeController')->name('top');
Route::get('/shops', 'Api\Client\Shop\SearchShopController');
Route::get('/home', 'HomeController')->name('home');

Route::get('/health', 'HealthController')->name('health');
