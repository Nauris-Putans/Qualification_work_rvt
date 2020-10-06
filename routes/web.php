<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', 'TestController@historyGet')->name('admin.index');

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

Route::get('/', function () {
    return view('sections/home');
});

Auth::routes();

Route::get('/zabbix/item', 'TestController@itemGet')->name('zabbix.item');


//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', function () {
    return view('sections/home');
});

Route::get('/features', function () {
    return view('sections/features');
});

Route::get('/pricing', function () {
    return view('sections/pricing');
});

Route::get('/faq', function () {
    return view('sections/faq');
});

Route::get('/contacts', function () {
    return view('sections/contacts');
});

