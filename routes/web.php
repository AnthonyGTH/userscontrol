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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/usuarios/create','HomeController@createform'); //mostrar crear usuario
Route::post('/usuarios/create','HomeController@store'); //Crear usuario
Route::get('/usuarios/preEdit/{id}', 'HomeController@preEdit');
Route::post('/usuarios/edit/{id}', 'HomeController@edit');
Route::get('/usuarios/delete/{id}', 'HomeController@delete');
