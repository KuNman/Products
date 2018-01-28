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

Route::any('/zadanie', 'ProductsController@createAllProductsView');
Route::get('/zadanie/add', 'ProductsController@addNewProduct');
Route::post('/zadanie/add', 'ProductsController@addItemToDB');
Route::post('/zadanie/details', 'ProductsController@getDetails');
Route::post('/zadanie/delete', 'ProductsController@deleteProduct');
Route::post('/zadanie/update', 'ProductsController@updateProduct');
