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

Route::get('/about', function () {
  return 'about page';
});

Route::get('/contact', function () {
  return 'contact page';
});

// route with parameter
Route::get('/post/{id}', function ($id) {
  return 'post ID: '. $id;
});

// route with multiple parameter
Route::get('/post/{id}/author/{name}', function ($id, $name) {
  return 'post ID: '. $id.', author name: '. $name;
});