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

Route::get('/cliente', 'ClienteController@index')->name('index-cliente');
Route::get('/cliente/create', 'ClienteController@create')->name('create-cliente');
Route::post('/cliente/store', 'ClienteController@store')->name('store-cliente');
Route::get('/cliente/edit/{pessoa}', 'ClienteController@edit')->name('edit-cliente');
Route::patch('/cliente/update/{pessoa}', 'ClienteController@update')->name('update-cliente');
Route::post('/cliente/destroy{pessoa}', 'ClienteController@destroy')->name('destroy-cliente');
