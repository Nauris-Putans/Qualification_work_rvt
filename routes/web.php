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

Auth::routes();

Route::get('/admin', 'ZabbixController@historyGet')->name('admin.index');

Route::get('/', 'Pages\HomeController@index');
Route::get('/features', 'Pages\FeaturesController@index');
Route::get('/pricing', 'Pages\PricingController@index');
Route::get('/faq', 'Pages\FAQController@index');
Route::get('/contacts', 'Pages\ContactsController@index');

