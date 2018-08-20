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

Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth','admin'])->prefix('admin')->group(function(){
  Route::get('/products', 'ProductController@index');
  Route::get('/products/create', 'ProductController@create');
  Route::post('/products', 'ProductController@store');
  Route::get('/products/{id}/edit', 'ProductController@edit');
  Route::post('/products/{id}/edit', 'ProductController@update');
  Route::delete('/products/{id}', 'ProductController@destroy');

    Route::get('/products/{id}/images', 'ImageController@index');
    Route::post('/products/{id}/images', 'ImageController@store');
    Route::delete('/products/{id}/images', 'ImageController@destroy');

    Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); //destacar imagen
});
